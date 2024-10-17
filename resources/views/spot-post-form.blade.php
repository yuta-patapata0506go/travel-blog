<link href="{{ asset('css/spot-post.css') }}" rel="stylesheet">

@extends('layouts.app')

@section('title', 'Select-post-form')

@section('content')
<div class="background"></div> <!-- 背景画像 -->
<div class="full-height">
<div class="container mt-5 text-center">
    <h1 class="long-underline position-relative">Spot Post Form</h1>

    <form action="#" method="post" enctype="multipart/form-data" class="mt-4">
        @csrf
        <div class="mb-3 text-start">
            <label for="spot-name" class="form-label">
                Spot name <span class="text-danger">*</span>:
            </label>
            <input type="text" id="spot-name" class="form-control" placeholder="ex. Tokyo sky tree" required>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 text-start">
                <label for="postal-code" class="form-label">
                    Postal Code <span class="text-danger">*</span>:
                </label>
                <input type="text" id="postal-code" class="form-control" placeholder="ex. 〒130-0002" required>
            </div>
            <div class="col-md-9 text-start">
                <label for="address" class="form-label">
                    Address <span class="text-danger">*</span>:
                </label>
                <input type="text" id="address" class="form-control" placeholder="ex. 5-10 Narihiru, Sumida Ward, Tokyo" required>
            </div>
        </div>

        <div class="mb-3 text-start">
            <label for="image" class="form-label">
                Image <span class="text-danger">*</span>:
            </label>
            <input type="file" id="image" class="form-control" required>
            <small class="form-text text-muted">The acceptable formats are jpeg, jpg, png, and gif only. Max file size is 1048kb.</small>
        </div>
        <br>
        
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn-post btn-lg-custom">Request registration</button>
            <button type="button" class="btn cancel-btn btn-lg-custom">Cancel</button>
        </div>          
    </form>
    <br>
    <p class="notice mt-3 text-muted">
        <u>Please note that it may take a few hours to register a spot.</u>
    </p>
</div>
</div>
@endsection



