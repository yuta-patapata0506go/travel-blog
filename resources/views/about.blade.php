@extends('layouts.app')

@section('title', 'About')

@section('content')
<div class="container about w-75 text-center">
    <h1 class="my-3">About</h1>

    <!-- Logo Image -->
    <img src="{{ asset('images/logos/Logo(Large).png') }}" alt="Logo" class="logo-image mb-4">

    <!-- Subtitle -->
    <h2 class="my-1">You can post and reference it easily!</h2>

    <!-- Body Text -->
    <p class="my-2">
        We have created a platform where users can easily post and access travel and event information without any hassle! This app is designed for people who want to participate in or share their travel and event experiences, as well as for those seeking information.
    </p>

    <p>
    This logo embodies a dual meaning that represents our group.

First, as the phrase "Where to go" suggests, the number "25" represents "places to go" or "the direction we aim for." The design elements, like the map, compass, and pin, illustrate our drive to keep moving forward toward the future.

The second meaning is that "25" stands for "25th batch," symbolizing our cohort. This represents the unity and identity we share as we journey together.

In this way, this logo serves as a symbol of "Where to go" and our group as the 25th batch, capturing the essence of our shared path toward the future.
</p>
</div>

@endsection

{{-- css --}}
<link rel="stylesheet" href="{{ asset('css/about.css') }}">