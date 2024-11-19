
@extends('layouts.app')

@section('title', 'Show Profile')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/style_personal.css')}}">  
@endsection

@section('content')

<div class="mypage-bg">
    @include('mypage.mypage-header')
    @include('mypage.mypage-search')
  <div class="container-mypage">
        <div style="margin-top: 50px, margin-bottom: 50px">
            
            @if($user->posts->isNotEmpty())
            <div class="show_posts">
                    <div class="row">
                        @foreach ($user->posts as $posts)
                                <div class="small_post col-md-3">
                                    <a href="{{route('post.show', $posts->id)}}" class="text-decoration-none text-dark">
                                         <div class="card">
                                                <img src="{{ asset('/storage/'. $posts->images->first()->image_url)}}" class="card-img-top" alt="Tourism Image">
                                
                                                <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <h5 class="fw-bolder">{{$posts->title}}</h5>
                                                            </div>
                                                            <div class="row d-flex justify-content-end pe-2">
                                                                <div class="col-auto">
                                                                    <form action="{{route('post.show', $posts->id)}}">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-sm shadow-none p-0">
                                                                            @if ($posts->isLiked())
                                                                            <i class="fa-regular fa-heart text-danger"></i>
                                                                        @else
                                                                            <i class="fa-regular fa-heart"></i>
                                                                        @endif
                                                                        </button>  
                                                                        
                                                                        &nbsp;{{ $posts->likes->count() }}
                                                                    </form>
                                        
                                                                </div>
                                                                <div class="col-auto p-0">
                                                                    <form action="{{route('post.show', $posts->id)}}">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-sm shadow-none p-0">
                                                                            @if ($posts->getIsFavoritedAttribute())
                                                                                <i class="fa-regular fa-star text-warning"></i>
                                                                            @else
                                                                                <i class="fa-regular fa-star"></i>
                                                                            @endif
                                                                        </button>
                                                                        &nbsp;{{ $posts->favorites->count()}}
                                                                    </form>
                                                                </div>
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
                                    </a>
                                    
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
