@extends('layouts.app')

@section('title', 'Edit favorites')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/style_personal.css')}}">  
@endsection
    
@section('content')

<div class="mypage-bg">
@include('mypage-header')


  <div class="container-mypage">
    <div style="margin-top: 50px, margin-bottom:50px">
    <div class="row">
        <div class="col-auto">
          {{--@if($user->favorites->isNotEmpty())--}}
          <h1>Your favorites</h1>
            {{--@foreach($user->favorites as $post)--}}
              {{--<div class="col-lg-4 col-md-6 mb-4">
                <a href="{{ route('post.show', $post->id)}}">
                  <img src="{{ $post->image }}" alt="{{ $post->id }}" class="grid-img">
                </a> 
              </div> --}}
            {{--@endforeach--}}
          {{--@else--}}
          <div class="row">
            @for ($i = 0; $i < 6; $i++)
                    <div class="col-md-3 mb-4">
                        <div class="card tourism-card shadow-card">
                            <img src="{{ asset('images/tourism.jpg') }}" class="card-img-top" alt="Tourism Image">
                            <div class="card-body">
                                <h5 class="card-title">Title</h5>
                                <p class="card-text">Category 1 / Category 2</p>
                                <p class="card-text">Short description of the tourism spot.</p>
                                <button class="btn comment-card">Learn More</button>
                            </div>
                        </div>
                    </div>
                @endfor
          </div>
          {{--<h3 class="text-muted text-center">No Favorites Yet</h3>--}}
         {{--@endif--}}
        </div>    
     </div>
    </div>
  </div>
</div>
  

@endsection