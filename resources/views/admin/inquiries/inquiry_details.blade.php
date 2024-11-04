@extends('layouts.app')

@section('title', 'Admin Inquiry Details')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/inquiry_details.css') }}">
@endsection

@section('content')

<div class="container w-75">
    <h1 class="text-center contact-title my-4">Inquiry Details</h1>

        <div class="row mb-3 mt-5">
            <div class="col-md-2"><strong>ID:</strong></div>
            <div class="col-md-10">{{ $inquiry->id }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"><strong>Date:</strong></div>
            <div class="col-md-10">{{ $inquiry->created_at->format('Y-m-d') }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"><strong>Name:</strong></div>
            <div class="col-md-10">{{ $inquiry->user->username }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"><strong>Email:</strong></div>
            <div class="col-md-10">{{ $inquiry->user->email }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"><strong>Content:</strong></div>
            <div class="col-md-10">
                {{ $inquiry->body }}
            </div>
        </div>        


    <!-- Back and Reply Buttons -->
    <div class="text-center my-5">
        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-back w-25">Back</a>
        <a href="{{ route('admin.inquiries.create_reply', $inquiry->id) }}" class="btn btn-reply w-25">Reply</a>

    </div>
</div>

@endsection