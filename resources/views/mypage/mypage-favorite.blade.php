@extends('layouts.app')

@section('title', 'Edit favorites')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style_personal.css') }}">
@endsection

@section('content')

<div class="mypage-bg">
        @include('mypage.mypage-header')
        <div class="container-mypage">
            <div style="margin-top: 50px, margin-bottom:50px">
                <div class="row mb-5">
                    {{-- favorite posts --}}
                      
                        @if ($user->favoritePosts->isNotEmpty())
                      
                            <h3>Your favorite Posts</h3>
                            <div class="show_posts">    
                                <div class="row">
                                    @foreach ($user->favoritePosts as $favorite)
                                  
                                        <div class="small_post col-md-3">
                                            <a href="{{route('post.show', $favorite->post->id)}}" class="text-decoration-none text-dark">
                                            <div class="card">
                                                    <img src="{{ asset('/storage/'. $favorite->post->images->first()->image_url)}}" class="card-img-top" alt="Tourism Image">           

                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <h5 class="fw-bolder">{{ $favorite->post->title }}</h5>
                                                        </div>
                                                        <div class="col-auto">
                                                       
                                                                <button type="submit" class="btn btn-sm shadow-none p-0">
                                                                    @if ($favorite->post->isLiked())
                                                                        <i class="fa-regular fa-heart text-danger"></i> 
                                                                    @else
                                                                        <i class="fa-regular fa-heart"></i> 
                                                                    @endif
                                                                    </button>
                                                                    <span>&nbsp;{{$favorite->post->likes->count()}}</span> 
                                                        </div>
                                                        <div class="col-auto p-0">    
                                                                <button type="submit" class="btn btn-sm shadow-none p-0">
                                                                    @if ($favorite->post)
                                                                    <i class="fa-regular fa-star text-warning"></i> 
                                                                    @else
                                                                      <i class="fa-regular fa-star"></i>  
                                                                    @endif
                                                                    <span>&nbsp;{{$favorite->post->favorites->count()}}</span>
                                                                </button>
                                                              
                                                                
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        
                                                        <div class="col-auto mb-1">
                                                            @if($favorite->post->categories)
                                                             @foreach ($favorite->post->categories as $cats)
                                                                  <span
                                                                class="badge bg-secondary bg-opacity-50 rounded-pill">{{$cats->name}}</span>
                                                             @endforeach                                      @endif                     
                                                        </div>
                                                    </div>
                                                    <div class="post_text">
                                                        <p>{{ $favorite->post->comments }}</p>
                                                        <a href={{route('post.show', $favorite->post->id)}} class="btn btn-green">Read More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @else   
                            <h3 class="text-start">No Favorite Posts Yet</h3> 
                        @endif
                    
                </div>
                
                {{-- favorite spots --}}

                <div class="row-mb-5"> 
                    @if ($user->favoriteSpots->isNotEmpty())
                    <div class="col-auto">
                        <h3>Your favorite Spots</h3>1
                        <div class="show_posts">
                            <div class="row">
                                @foreach ($user->favoriteSpots as $favorite)
                                    <div class="small_post col-md-3">
                                        <a href="{{ route('spot.show', $favorite->spot->id)}}" class="text-decoration-none">
                                            <div class="card">
                                            <img src="{{ asset('/storage/'. $favorite->spot->images->first()->image_url)}}" class="card-img-top" alt="Tourism Image"> 

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <h5 class="fw-bolder">{{ $favorite->spot->name }}</h5>
                                                    </div>
                                                    <div class="col-auto">
                                               
                                                            <button type="submit" class="btn btn-sm shadow-none p-0">
                                                                @if ($favorite->spot->isLiked())
                                                                    <i class="fa-regular fa-heart text-danger"></i> 
                                                               
                                                                @else
                                                                    <i class="fa-regular fa-heart"></i>
                                                                @endif
                                                                </button>                                                      
                                                                <span>&nbsp;{{$favorite->spot->likes->count()}}</span>
                                                      
                                                                
                                                
                                                    </div>
                                                    <div class="col-auto p-0">
                                                        <form action="{{route('spot.show', $favorite->spot_id)}}">
                                                            <button type="submit" class="btn btn-sm shadow-none p-0">
                                                                @if ($favorite)
                                                                    <i class="fa-regular fa-star text-warning"></i> 
                                                                @else
                                                                    <i class="fa-regular fa-star"></i>
                                                                @endif
                                                            </button>
                                                            <span>&nbsp;{{$favorite->spot->favorites->count()}}</span>                                                                                                      
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @else                            
                 </div>
                 <h3 class="text-start">No Favorite Spots Yet</h3>           
                @endif
                </div>
            </div>
        </div>
        </div>
</div>
@endsection
