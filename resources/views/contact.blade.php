@extends('layouts.app')

@section('title', 'Contact-page-UI')

@section('body-class', 'contact')

@section('content')
{{-- Contact Admin Page --}}

<div class="container contact w-50">
    <h1 class="text-center contact-title">Contact Us</h1>

    <p>User Name: Logged-in User Name</p> {{-- {{ Auth::user()->name }} --}}

    <form method="POST" action="#"> {{-- {{ route('contact.submit') }} --}}
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="User@mail.com" required> {{-- value: {{ Auth::user()->email }} --}}
        </div>

        <!-- Content -->
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
        </div>

        <!-- Send Button -->
        <div class="row">
            <div class="col text-center">
                <button type="submit" class="btn btn-primary w-50">Send</button>
            </div>
        </div>
    </form>
</div>

@endsection

<style>
body.contact {
    font-family: 'Open Sans', sans-serif;
    background-image: url('/images/backgrounds/logo_bg.svg');
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    background-color: #fbf4f4;
}

h1.contact-title {
    font-family: 'Lato', sans-serif;
    padding-top: 50px;
    padding-bottom: 50px;
    margin-top: 50px;
    margin-bottom: 50px;
}

body.contact textarea, body.contact input {
    border-radius: 10px;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
}
</style>