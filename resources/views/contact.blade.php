@extends('layouts.app')

@section('title', 'Contact')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('body-class', 'contact')

@section('content')
{{-- Contact Admin Page --}}

<div class="container contact w-50">
    <h1 class="text-center contact-title">Contact Us</h1>

    <p>User Name: {{ Auth::user()->username }}</p> 

    <form method="POST" action="{{ route('contact.store') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
        </div>

        <!-- Content -->
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="body" name="body" rows="4" placeholder="text here..." required></textarea>
        </div>

        <!-- Send Button -->
        <div class="row mb-4">
            <div class="col text-center">
                <button type="submit" class="btn btn-send w-50">Send</button>
            </div>
        </div>
    </form>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {!! nl2br(e(session('success'))) !!}
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('contact.create') }}" class="btn btn-ok mt-2 w-50">OK</a>
        </div>
    @endif
</div>

@endsection

