@extends('layouts.app')

@section('title', 'About')

@section('content')
<div class="container about w-75 text-center">
    <h1 class="my-5">About</h1>

    <!-- Logo Image -->
    <img src="{{ asset('images/logos/Logo(Large).png') }}" alt="Logo" class="logo-image mb-4">

    <!-- Subtitle -->
    <h2 class="my-5">You can post and reference it easily!</h2>

    <!-- Body Text -->
    <p>
        We have created a platform where users can easily post and access travel and event information without any hassle! This app is designed for people who want to participate in or share their travel and event experiences, as well as for those seeking information.
    </p>
</div>

@endsection

{{-- css --}}
<link rel="stylesheet" href="{{ asset('css/about.css') }}">