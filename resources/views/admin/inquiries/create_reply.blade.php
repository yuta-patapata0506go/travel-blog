@extends('layouts.app')

@section('title', 'Admin Create Reply')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/create_reply.css') }}">
@endsection

@section('content')

<!-- Success message display -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- Error message display -->
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="container w-75">
    <h1 class="text-center my-5">Create Reply</h1>

    <form action="{{ route('admin.inquiries.reply', $inquiry->id) }}" method="POST">
        @csrf

        <!-- Inquiry ID -->
        <div class="mb-3">
            <label for="inquiryID" class="form-label">Inquiry ID:</label>
            <input type="text" id="inquiryID" class="form-control" value="{{ $inquiry->id }}" readonly> 
        </div>
    
        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="form-label">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', 'Thank you for your inquiry, ' . $inquiry->user->username . '!') }}"> 
            @error('title') 
                <div class="text-danger small">{{ $message }}</div> 
            @enderror
        </div>
    
        <!-- Body -->
        <div class="mb-5">
            <label for="body" class="form-label">Body:</label>
            <textarea name="body" id="body" class="form-control" rows="10">{{ old('body', "Dear {$inquiry->user->username},\n\nThank you for reaching out to us!\n\n[Message here...]\n\nIf you have any additional information to share, please feel free to reply to this email.\n\nBest regards,\nAdmin: " . auth()->user()->username . "\nWhere To Go\nEmail: where25.inquiry@gmail.com\nPhone: 0123456789") }}</textarea>
            @error('body') 
                <div class="text-danger small">{{ $message }}</div> 
            @enderror
        </div>
    
        <!-- Buttons -->
        <div class="text-center w-100 my-5">
            <a href="{{ route('admin.inquiries.inquiry_details', $inquiry->id) }}" class="btn btn-cancel w-25">Cancel</a>
            <button type="submit" class="btn btn-submit w-25">Submit</button>
        </div>
    
    </form>    

</div>
@endsection