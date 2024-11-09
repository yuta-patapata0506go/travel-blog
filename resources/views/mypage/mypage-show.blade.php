
@extends('layouts.app')

@section('title', 'Show Profile')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/style_personal.css')}}">  
@endsection

@section('content')

<div class="mypage-bg">
    @include('mypage.mypage-header')
  <div class="container-mypage">
        <div style="margin-top: 50px, margin-bottom: 50px">
            @if($user->posts->isNotEmpty())
            <div class="show_posts">
                    <div class="row">
                        @foreach ($user->posts as $posts)
                                <div class="small_post col-md-3">
                                    <div class="card">
                                        {{-- <a href="#" >写真のリンクを残すかどうか--}} 
                                            <img src="{{ asset('/storage/'. $posts->images->first()->image_url)}}" class="card-img-top" alt="Tourism Image">
                                        {{--</a>--}}
                        
                                        <div class="card-body">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <h5 class="fw-bolder">{{$posts->title}}</h5>
                                                    </div>
                                                    <div class="col-auto">
                                                        <form action="#">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm shadow-none p-0">
                                                                {{-- <i class="fa-regular fa-heart"></i>{{ $user->likedPost->count() }} --}}
                                                            </button>
                                                        </form>
                                
                                                    </div>
                                                    <div class="col-auto p-0">
                                                        <form action="#">
                                                            @csrf
                                                        <button type="submit" class="btn btn-sm shadow-none p-0"><i class="fa-regular fa-star"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                        
                                                <div class="row">
                                                    <div class="col-auto mb-1">
                                                        @foreach ($posts->categories as $categories)
                                                        <span class="badge bg-secondary bg-opacity-50 rounded-pill">{{$categories->name}}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="post_text">
                                                <p>{{$posts->comments}}</p>
                                                <a href={{route('post.show', $posts->id)}} class="btn btn-green">Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            @endforeach
                    </div>
                </div>  
            </div> 
        </div>
      
        @else
        <h3 class="text-center">No Posts Yet</h3>
        @endif
   
    </div> 

@endsection
