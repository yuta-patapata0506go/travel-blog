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


        <!-- Visibility Dropdown & Status Dropdown -->
        <div class="row my-5">
            <div class="col">
                <label for="visibility" class="form-label">Visibility</label>
                <select id="visibility" class="form-select" onchange="showModal()">
                    <option value="">Select Visibility</option>
                    <option value="visible">Visible</option>
                    <option value="hidden">Hidden</option>
                </select>
            </div>
            <div class="col">
                <label for="status" class="form-label">Status</label>
                <select id="status" class="form-select" onchange="showModal()">
                    <option value="">Select Status</option>
                    <option value="new">New</option>
                    <option value="in-progress">In Progress</option>
                    <option value="resolved">Resolved</option>
                </select>
            </div>
        </div>
        
        <!-- Modal -->
        {{-- <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Confirm Change</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="modalMessage">Are you sure you want to change the selected option?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="confirmChange()">Confirm</button>
                    </div>
                </div>
            </div>
        </div> --}}



    <!-- Back and Reply Buttons -->
    <div class="text-center my-5">
        <a href="#" class="btn btn-back w-25">Back</a> {{-- {{ route('inquiries.index') }} --}}
        <a href="#" class="btn btn-reply w-25">Reply</a> {{-- {{ route('inquiries.reply', ['id' => 123]) }} --}}
    </div>
</div>

@endsection