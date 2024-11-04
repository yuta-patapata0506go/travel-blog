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
                            <h1>Your favorite Posts</h1>
                            <div class="show_posts">    
                                <div class="row">
                                    @foreach ($user->favoritePosts as $favorite)
                                        <div class="small_post col-md-3">
                                            <div class="card">
                                                {{-- <a href="{{ route('post.show', $favorite->post_id)}}">
                                                    <img src="{{ asset('images/map_samples/post_pc_sample.png') }}" alt="{{ $favorite->post_id }}"
                                                        class="card-img-top" alt="Tourism Image">
                                                </a> --}}

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
                                                        <div class="col-autp p-0">
                                                            <form action="#">
                                                                <button type="submit" class="btn btn-sm shadow-none p-0"><i
                                                                        class="fa-regular fa-star"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-auto mb-1">
                                                            <span
                                                                class="badge bg-secondary bg-opacity-50 rounded-pill">Category</span>
                                                            <span
                                                                class="badge bg-secondary bg-opacity-50 rounded-pill">Category</span>
                                                        </div>
                                                    </div>
                                                    <div class="post_text">
                                                        <p>{{ $favorite->favoritePostsDetail->comments }}</p>
                                                        <button class="btn comment-card">Learn More</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @else   
                            <h3 class="text-end">No Favorite Posts Yet</h3> 
                        @endif
                    
                </div>
                
                {{-- favorite spots --}}

                <div class="row">

                    <div class="col-auto">
                        @if ($user->favoriteSpots->isNotEmpty())
                        <h1>Your favorite Spots</h1>
                        <div class="show_posts">
                            <div class="row">
                                @foreach ($user->favoriteSpots as $favorite)
                                {{-- @foreach ($user->favorites as $post) --}}
                                    <div class="small_post col-md-3">
                                        <div class="card">
                                            {{-- <a href="{{ route('post.show', $favorite->post_id)}}">
                                                <img src="{{ asset('images/map_samples/post_pc_sample.png') }}" alt="{{ $favorite->post_id }}"
                                                    class="card-img-top" alt="Tourism Image">
                                            </a> --}}

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <h5 class="fw-bolder">{{ $favorite->spots_id }}</h5>
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
                                                        <span
                                                            class="badge bg-secondary bg-opacity-50 rounded-pill">Category</span>
                                                        <span
                                                            class="badge bg-secondary bg-opacity-50 rounded-pill">Category</span>
                                                    </div>
                                                </div>
                                                <div class="post_text">
                                                    <p>text text text text text text text text text text text text text text
                                                        text text text text text text</p>
                                                    <button class="btn comment-card">Learn More</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @else 
                        <div class="justify-content-center">
                            <h3 class="text-end">No Favorite Spots Yet</h3>
                        </div>
                 </div>
            </div>
                @endif

            </div>
        </div>
        </div>
   
</div>



@endsection
