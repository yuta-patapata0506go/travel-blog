<link href="{{ asset('css/select-post.css') }}" rel="stylesheet">
@extends('layouts.app')

@section('title', 'Select-post-form')

@section('content')
<div class="background"></div> <!-- 背景画像の要素 -->
    <div class="full-height"> <!-- ここにクラスを適用 -->
        <div class="container text-center">
            <h1 class="centered-text long-underline">Register Spot</h1>

            <div class="d-flex justify-content-center">
                <div class="position-relative">
                    <img src="images/whereToGo_navbar_sample.png" alt="Your Image" class="img-fluid rounded-image">
                    <a href="your-link.html" class="overlay-text">Register <span class="red-text">New</span> Spot</a>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <h1 class="centered-text long-underline">Post to the registered spot</h1>
            <div class="d-flex justify-content-center">
                <div class="position-relative post-option mx-3">
                    <img src="images/left.png" alt="Event" class="img-fluid rounded-image">
                    <a href="your-link.html" class="overlay-text">Create Event Post</a>
                </div>
                <div class="position-relative post-option mx-3">
                    <img src="images/right.png" alt="Tourism" class="img-fluid rounded-image lightened-image">
                    <a href="your-link.html" class="overlay-text">Create Tourism Post</a>
                </div>
            </div>
            <br> 
            <br>
            <p class="centered-text small-large-text">Thank you for your contribution to the submission!</p>
        </div>    
    </div>
@endsection




