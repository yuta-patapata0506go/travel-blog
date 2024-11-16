@extends('layouts.app')

@section('css')
<link href="{{ asset('css/select-post.css') }}" rel="stylesheet">
@endsection

@section('title', 'Select-post-form')

@section('content')
<div class="background"></div> <!-- 背景画像の要素 -->
    <div class="full-height　mt~０"> <!-- ここにクラスを適用 -->
        <div class="container text-center ">
            <h2 class="centered-text long-underline ">Register Spot</h2>

            <div class="d-flex justify-content-center">
                <div class="position-relative">
                    <img src="images/whereToGo_navbar_sample.png" alt="Your Image" class="img-fluid rounded-image">
                    <a href="{{ route('spot.create') }}" class="overlay-text">Register <span class="red-text">New</span> Spot</a>
                </div>
            </div>
            <br>
            <br>
            <h2 class="centered-text long-underline">Post to the registered spot</h2>
            <div class="d-flex justify-content-center">
                <div class="position-relative post-option mx-3">
                    <img src="images/left.png" alt="Event" class="img-fluid rounded-image">
                    <a href="{{ route('post.create', ['type' => 0]) }}" class="overlay-text">Create Event Post</a>
                </div>
                <div class="position-relative post-option mx-3">
                    <img src="images/right.png" alt="Tourism" class="img-fluid rounded-image lightened-image">
                    <a href="{{ route('post.create', ['type' => 1]) }}" class="overlay-text">Create Tourism Post</a>
                </div>
            </div>
            <br> 
            <br>
            <p class="centered-text small-large-text">Thank you for your contribution to the submission!</p>
        </div>    
    </div>
@endsection




