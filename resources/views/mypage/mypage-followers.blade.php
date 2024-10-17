@extends('layouts.app')

@section('title', 'Followers Page')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/style_personal.css')}}">  
@endsection
 
@section('content')
<div class="mypage-bg">
   @include('mypage.mypage-header')

      <div class="container-mypage">
               <div style="margin-top: 50px">
               {{--@if ($user->followers->isNotEmpty()) --}}
                  <div class="row justify-content-center">
                     <div class="col-4">
                        <div class="row">
                           <div class="col-6">
                              <a href="#" class="text-decoration-none text-dark text-s16">Followers</a>
                           </div>
                           <div class="col-6 ps-5">  
                              <a href="#" class="text-decoration-none text-start btn-green text-s16 btn-follow pw-5">Following</a>
                           </div>
                        </div>
                     </div>   
                        {{-- @foreach ($user->followers as $follower) --}}
                        <div class="row content-justify-center mt-5">
                           <h2 class="text-center fw-bold">Followers</h2>                     
                        </div>
                        
                        <div class="col-4"> 
                           <div class="row align-center mt-3">
                              <div class="col-auto">
                              {{-- <a href="{{ route('profile.show', $follower->follower->id)}}">
                                    @if ($follower->follower->avatar)
                                       <img src="{{ $follower->follower->avatar }}" alt="{{ $follower->follower->name }}" class="rounded-circle avatar-sm">
                                    @else --}}
                                       <i class="fa-solid fa-circle-user text-dark icon-small"></i>
                                 {{-- @endif
                                 </a> --}}
                              </div>
                              <div class="col ps-0 text-truncate">
                                 <a href="#" class="text-decoration-none text-s16 text-dark fw-bold">USER NAME</a>
                              </div>
                              <div class="col-auto text-end">
                                 {{--@if ($follower->follower->id !== Auth::user()->id)
                                    @if ($follower->follwer->isFollowed())
                                       <form action="{{ route('follow.destroy', $follower->follower->id)}}" method="post"> --}}
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="border-0 bg-transparent p-0 text-dark btn-sm">Following</button>
                                       {{--</form>
                                    @else
                                       <form action="{{route('follower.store', $follower->follwer->id)}}" method="post"> --}}
                                          @csrf
                                          <button type="submit" class="border-0 btn-black  btn-sm">Follow</button>
                                       {{--</form>
                                    
                                    @endif                          
                                 @endif --}}
                              </div>
                           </div>
                           {{-- @endforeach --}}
                     </div>
                  </div>
               {{--@else--}}
                  <h3 class="text-dark text-s32 text-center">No Followers</h3>
               {{--@endif--}}
            </div>
      </div>
</div>
   
@endsection