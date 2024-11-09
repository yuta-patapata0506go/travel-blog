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
                                            <div class="card">
                                                    <img src="{{ asset('/storage/'. $favorite->favoritePostsDetail->images->first()->image_url)}}" class="card-img-top" alt="Tourism Image">           

                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <h5 class="fw-bolder">{{ $favorite->favoritePostsDetail->title }}</h5>
                                                        </div>
                                                        <div class="col-auto">
                                                            <form action="#">
                                                                <button type="submit" class="btn btn-sm shadow-none p-0"><i
                                                                        class="fa-regular fa-heart"></i></button>
                                                            </form>
                                                        </div>
                                                        <div class="col-auto p-0">
                                                            <form action="#">
                                                                <button type="submit" class="btn btn-sm shadow-none p-0"><i
                                                                        class="fa-regular fa-star"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        
                                                        <div class="col-auto mb-1">
                                                            @if($favorite->favoritePostsDetail->categories)
                                                             @foreach ($favorite->favoritePostsDetail->categories as $cats)
                                                                  <span
                                                                class="badge bg-secondary bg-opacity-50 rounded-pill">{{$cats->name}}</span>
                                                             @endforeach                                      @endif                     
                                                        </div>
                                                    </div>
                                                    <div class="post_text">
                                                        <p>{{ $favorite->favoritePostsDetail->comments }}</p>
                                                        <a href={{route('post.show', $favorite->favoritePostsDetail->id)}} class="btn btn-green">Read More</a>
                                                    </div>
                                                </div>
                                            </div>
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
                       
                        <h3>Your favorite Spots</h3>
                        <div class="show_posts">
                            <div class="row">
                                @foreach ($user->favoriteSpots as $favorite)
                                    <div class="small_post col-md-3">
                                        <div class="card">
                                            <img src="{{ asset('/storage/'. $favorite->spot->images->first()->image_url)}}" class="card-img-top" alt="Tourism Image"> 

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <h5 class="fw-bolder">{{ $favorite->spot->name }}</h5>
                                                    </div>
                                                    <div class="col-auto">
                                                        <form action="#">
                                                            <button type="submit" class="btn btn-sm shadow-none p-0"><i
                                                                    class="fa-regular fa-heart"></i></button>
                                                        </form>
                                                    </div>
                                                    <div class="col-auto p-0">
                                                        <form action="#">
                                                            <button type="submit" class="btn btn-sm shadow-none p-0"><i
                                                                    class="fa-regular fa-star"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
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

<div class="show_posts">
    <div class="row">
        @foreach ($user->favoriteSpots as $favorite)
            <div class="card small-post shadow-card m-2" style="cursor: pointer; width: 18rem;" onclick="this.querySelector('form').submit();">
                
                {{-- <div class="card"> --}}
                    <img src="{{ asset('/storage/'. $favorite->spot->images->first()->image_url)}}" class="card-img-top" alt="Tourism Image"> 

                    {{-- <div class="card-body" style="width: 18rem"> --}}
                        <div class="row">
                            <div class="col-auto">
                                <h5 class="fw-bolder">{{ $favorite->spot->name }}</h5>
                            </div>
                            <div class="col-auto">
                                <form action="#">
                                    <button type="submit" class="btn btn-sm shadow-none p-0"><i
                                            class="fa-regular fa-heart"></i></button>
                                </form>
                            </div>
                            <div class="col-auto p-0">
                                <form action="#">
                                    <button type="submit" class="btn btn-sm shadow-none p-0"><i
                                            class="fa-regular fa-star"></i></button>
                                </form>
                            </div>
                        </div>
                        
                    {{-- </div> --}}
                {{-- </div> --}}
            </div>
        @endforeach
    </div>
</div>



@endsection
