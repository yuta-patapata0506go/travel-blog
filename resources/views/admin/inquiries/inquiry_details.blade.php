@extends('layouts.app')

@section('title', 'Admin Inquiry Details')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/inquiry_details.css') }}">
@endsection

@section('content')
{{-- Admin Show Inquiry Page --}}

<div class="container w-75">
    <h1 class="text-center contact-title my-4">Inquiry Details</h1>

        <div class="row mb-3 mt-5">
            <div class="col-md-2"><strong>ID:</strong></div>
            <div class="col-md-10">123</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"><strong>Date:</strong></div>
            <div class="col-md-10">2024-10-12</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"><strong>Name:</strong></div>
            <div class="col-md-10">John Doe</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"><strong>Email:</strong></div>
            <div class="col-md-10">john.doe@example.com</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2"><strong>Content:</strong></div>
            <div class="col-md-10">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Libero, voluptates non neque porro cum accusamus. Aliquid nesciunt labore facere voluptatum? Consequatur, laboriosam? Fugit enim laborum natus, adipisci excepturi error neque quod tenetur sunt dolore non asperiores nam quos sint delectus odit ad vero amet ipsam esse optio eos corporis molestias magni. Ratione veniam officiis omnis nostrum quam ipsa doloremque tempore temporibus deleniti, dolore rem rerum earum commodi optio quaerat et fuga eum voluptas eligendi. Dicta dolores atque voluptatibus tenetur nihil, accusantium omnis ullam harum sint praesentium, cum, ex similique laboriosam quo cumque! Recusandae eveniet numquam consectetur quod sit a eos.</div>
        </div>


        
        {{-- Dropdown for visibility --}}
        <div class="dropdown">
            <button class="btn btn-sm" data-bs-toggle="dropdown">
                Visibility
            </button>

            <div class="dropdown-menu">
                @if (isset($inquiry)) {{-- $inquiry->trashed() --}}
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-inquiry-"> {{-- data-bs-target: #unhide-inquiry-{{ $inquiry->id }} --}}
                        <i class="fa-solid fa-eye"></i> Visible {{-- {{ $inquiry->id }} --}}
                    </button>
                @else
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-inquiry-"> {{-- data-bs-target: #unhide-inquiry-{{ $inquiry->id }} --}}
                        <i class="fa-solid fa-eye-slash"></i> Hidden {{-- {{ $inquiry->id }} --}}
                    </button>
                @endif
            </div>
        </div>

        @include('admin.inquiries.modals.visibility')
        

        {{-- Dropdown for status --}}
        <div class="dropdown">
            <button class="btn btn-sm" data-bs-toggle="dropdown">
                Status
            </button>

            <div class="dropdown-menu"> {{-- After setting up the table, remove the comments from @if --}}
                {{-- @if ($inquiry->status !== 'unprocessed') --}}
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unprocessed-inquiry-"> {{-- data-bs-target: #unprocessed-inquiry-{{ $inquiry->id }} --}}
                        Unprocessed {{-- {{ $inquiry->id }} --}}
                    </button>
                {{-- @endif --}}
                
                {{-- @if ($inquiry->status !== 'responded') --}}
                    <button class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#responded-inquiry-"> {{-- data-bs-target: #responded-inquiry-{{ $inquiry->id }} --}}
                        Responded {{-- {{ $inquiry->id }} --}}
                    </button>
                {{-- @endif --}}

                {{-- @if ($inquiry->status !== 'resolved') --}}
                    <button class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#resolved-inquiry-"> {{-- data-bs-target: #resolved-inquiry-{{ $inquiry->id }} --}}
                        Resolved {{-- {{ $inquiry->id }} --}}
                    </button>
                {{-- @endif --}}
            </div>
        </div>




    <!-- Back and Reply Buttons -->
    <div class="text-center my-5">
        <a href="#" class="btn btn-back w-25">Back</a> {{-- {{ route('inquiries.index') }} --}}
        <a href="#" class="btn btn-reply w-25">Reply</a> {{-- {{ route('inquiries.reply', ['id' => 123]) }} --}}
    </div>
</div>

@endsection