@extends('layouts.app')

@section('title', 'Admin: Create New Spot')

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/form.css')}}">
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
    <div class="container w-75 mt-5">
        <h1 class="text-center">Create New Spot</h1>
        <form action="{{ route('admin.spots.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            <div class="mb-3 text-start">
                <label for="spot-name" class="form-label">
                    Spot Name <span class="text-danger">*</span>:
                </label>
                <input type="text" id="spot-name" name="name" class="form-control form-shadow" placeholder="ex. Tokyo sky tree" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="row mb-3">
                <div class="col-md-3 text-start">
                    <label for="postal-code" class="form-label">
                        Postal Code <span class="text-danger">*</span>:
                    </label>
                    <input type="text" id="postal-code" name="postalcode" class="form-control form-shadow" placeholder="ex. 〒130-0002" required>
                    @error('postalcode')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-9 text-start">
                    <label for="address" class="form-label">
                        Address <span class="text-danger">*</span>:
                    </label>
                    <input type="text" id="address" name="address" class="form-control form-shadow" placeholder="ex. 5-10 Narihiru, Sumida Ward, Tokyo" required>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
    
            <div class="mb-3 text-start">
                <label for="image" class="form-label">
                    Image <span class="text-danger">*</span>:
                </label>
                <input type="file" class="form-control form-shadow" id="image" name="image[]" accept="image/*" multiple>
                <small class="form-text text-muted">The acceptable formats are jpeg, jpg, png, and gif only. (Max file size is 1048kb.)</small>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <br>
            
            <div class="d-flex justify-content-center mt-4">
                <a href="{{ route('admin.spots.index') }}" class="btn-admin">Cancel</a>
                <button type="submit" class="btn-admin ">Create</button>
            </div>          
        </form>

    </div>
@endsection
