<link href="{{ asset('css/spot-post.css') }}" rel="stylesheet">

@extends('layouts.app')

@section('title', 'Spot-post-form')

@section('content')
<div class="background"></div> <!-- 背景画像 -->
<div class="full-height">
<div class="container mt-5 text-center">
    <h1 class="long-underline position-relative">Spot Post Form</h1>

    <form action="{{ route('spot.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        <div class="mb-3 text-start">
            <label for="spot-name" class="form-label">
                Spot name <span class="text-danger">*</span>:
            </label>
            <input type="text" id="spot-name" name="name" class="form-control form-shadow" placeholder="ex. Tokyo sky tree" required>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 text-start">
                <label for="postal-code" class="form-label">
                    Postal Code <span class="text-danger">*</span>:
                </label>
                <input type="text" id="postal-code" name="postalcode" class="form-control form-shadow" placeholder="ex. 〒130-0002" required>
            </div>
            <div class="col-md-9 text-start">
                <label for="address" class="form-label">
                    Address <span class="text-danger">*</span>:
                </label>
                <input type="text" id="address" name="address" class="form-control form-shadow" placeholder="ex. 5-10 Narihiru, Sumida Ward, Tokyo" required>
            </div>
        </div>

        <div class="mb-3 text-start">
            <label for="image" class="form-label">
                Image <span class="text-danger">*</span>:
            </label>
            <input type="file" id="image" name="image" class="form-control form-shadow" required>
            <small class="form-text text-muted">The acceptable formats are jpeg, jpg, png, and gif only. (Max file size is 1048kb.)</small>
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



