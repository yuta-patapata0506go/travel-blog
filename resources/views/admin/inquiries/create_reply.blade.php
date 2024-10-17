@extends('layouts.app')

@section('title', 'Admin Create Reply')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/create_reply.css') }}">
@endsection

@section('content')
<div class="container w-75">
    <h1 class="text-center my-5">Create Reply</h2>

    <!-- Inquiry ID -->
    <div class="mb-3">
        <label for="inquiryID" class="form-label">Inquiry ID:</label>
        <input type="text" id="inquiryID" class="form-control" value="123" readonly> {{-- value: {{ $inquiry->id }} --}}
    </div>

    <!-- Title -->
    <div class="mb-4">
        <label for="title" class="form-label">Title:</label>
        <input type="text" id="title" class="form-control" value="Thank you for your inquiry, [User Name]!" readonly> {{-- value[]: {{ $inquiry->user->name }} --}}
    </div>

    <!-- Body -->
    <div class="mb-5">
        <label for="body" class="form-label">Body:</label>
        <textarea id="body" class="form-control" rows="10">
Dear [User name], {{-- {{ $inquiry->user->name }} --}}

Thank you for reaching out to us!

If you have any additional information to share, please feel free to reply to this email.

Best regards,
[Your Name]
[Your Position]
Where To Go
Email: wheretogo@mail.com
Phone: 0123456789
        </textarea>
    </div>

    <!-- Buttons -->
    <div class="text-center w-100 my-5">
        <a href="#" class="btn btn-cancel w-25">Cancel</a> {{-- {{ route('inquiries.index') }} --}}
        <button type="submit" class="btn btn-submit w-25">Submit</button>
    </div>
</div>
@endsection