
@extends('layouts.app')

@section('title', 'Following Page')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/style_personal.css')}}">  
@endsection

@section('content')
<div class="mypage-bg">
    @include('mypage.mypage-header')
      <div class="container-mypage">       
            @if ($user->following->isNotEmpty())

               <div class="row justify-content-center">
                  <div class="col-4">
                     <div class="row">
                        <div class="col-6">
                           <a href="{{route('profile.followers', $user->id)}}" class="text-decoration-none text-start btn-green text-s16 btn-follow">Followers</a>
                        </div>
                        <div class="col-6 ps-5">
                           <a href="{{route('profile.following', $user->id)}}" class="text-decoration-none text-dark text-s16 px-5">Following</a>
                        </div>
                     </div>
                  </div>   
                  <div class="row content-justify-center mt-5">
                        <h2 class="text-center fw-bold">Following</h2>                     
                  </div>
                  
                  
                  <div class="col-4"> 
                     @foreach ($user->following as $following)        
                        <div class="row align-center mt-3">       
                           <div class="col-2">
                              <a href="{{ route('profile.show', $following->following->id)}}">
                                 @if ($following->following->avatar)
                                    <img src="{{ $following->following->avatar}}" alt="{{ $following->following->username }}" class="rounded-circle avatar-small">
                                 @else
                                    <i class="fa-solid fa-circle-user text-dark icon-small"></i>
                                 @endif
                              </a>
                           </div>
                           <div class="col-6 m-auto text-truncate">
                              <a href="{{route('profile.show', $following->following->id)}}" class="text-decoration-none text-dark text-s16 fw-bold">{{ $following->following->username }}</a>
                           </div>
                           <div class="col-4 text-center mt-2">
                              @if ($following->following->id !== Auth::user()->id)
                                 @if ($following->following->isFollowed())
                                    <form action="{{ route('follow.destroy', $following->following->id)}}" method="post">
                                       @csrf
                                       @method('DELETE')
                                       <button type="submit" class="border-0 bg-transparent text-dark btn-sm">Following</button>
                                    </form>
                                 @else
                                    <form action="{{ route('follow.store', $following->following->id)}}" method="post">
                                       @csrf
                                       <button type="submit" class="border-0 btn-black btn-sm">Follow</button>
                                    </form>
                                 @endif
                              @endif                            
                           </div>
                        </div>                       
                     @endforeach
                  </div>
                  
               </div>
            @else
               <h3 class="text-dark text-s32 text-center">No Following</h3>
            @endif
      </div>
</div>
    
@endsection