
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
            {{-- @if($user->posts->isNotEmpty()) --}}
            <div class="show_posts">
                    <div class="row">
                            @for ($i = 0; $i < 8; $i++)
                                <div class="small_post col-md-3">
                                    <div class="card">
                                        <a href="#" >
                                            <img src="{{ asset('images/map_samples/post_pc_sample.png') }}" class="card-img-top" alt="Tourism Image">
                                        </a>
                        
                                        <div class="card-body">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <h5 class="fw-bolder">Title</h5>
                                                    </div>
                                                    <div class="col-auto">
                                                        <form action="#">
                                                        <button type="submit" class="btn btn-sm shadow-none p-0"><i class="fa-regular fa-heart"></i></button>
                                                        </form>
                                                    </div>
                                                    <div class="col-auto p-0">
                                                        <form action="#">
                                                        <button type="submit" class="btn btn-sm shadow-none p-0"><i class="fa-regular fa-star"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                        
                                                <div class="row">
                                                    <div class="col-auto mb-1">
                                                        <span class="badge bg-secondary bg-opacity-50 rounded-pill">Category</span>
                                                        <span class="badge bg-secondary bg-opacity-50 rounded-pill">Category</span>
                                                    </div>
                                                </div>
                                                <div class="post_text">
                                                <p>text text text text text text text text text text text text text text text text text text text text</p>
                                                <button class="btn comment-card">Learn More</button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            @endfor
                    </div>
                </div>  
            </div> 
        </div>
      
        {{-- @else
        <h3 class="text-muted text-center">No Posts Yet</h3>
        @endif --}}
   
    </div> 
</div>

@endsection
