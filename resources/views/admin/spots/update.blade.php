@extends('layouts.app')

@section('title', 'Admin: Update Spot')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/form.css') }}">
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
        <h1 class="text-center">Update Spot</h1>
        <form action="{{ route('admin.spots.update', $spot->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            @method('PATCH')

            <div class="mb-3 text-start">
                <label for="spot-name" class="form-label">
                    Spot Name:
                </label>
                <input type="text" id="spot-name" name="name" class="form-control form-shadow" 
                       value="{{ old('name', $spot->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="col-md-3 text-start">
                    <label for="postal-code" class="form-label">
                        Postal Code:
                    </label>
                    <input type="text" id="postal-code" name="postalcode" class="form-control form-shadow" 
                           value="{{ old('postalcode', $spot->postalcode) }}" required>
                    @error('postalcode')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-9 text-start">
                    <label for="address" class="form-label">
                        Address:
                    </label>
                    <input type="text" id="address" name="address" class="form-control form-shadow" 
                           value="{{ old('address', $spot->address) }}" required>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Display current images with delete options -->
            <div class="mb-3 text-start">
                <label>Current Images:</label>
                <div class="current-images d-flex flex-wrap">
                    @foreach($images as $image)
                        <div class="image m-2 text-center">
                            <img src="{{ asset('storage/' . $image->image_url) }}" alt="Image" width="100">
                            <br>
                            <label>
                                <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"> Delete
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Upload new images -->
            <div class="mb-3 text-start">
                <label for="image" class="form-label">
                    Upload New Images:
                </label>
                <input type="file" class="form-control form-shadow" id="image" name="image[]" accept="image/*" multiple>
                <small class="form-text text-muted">Acceptable formats are jpeg, jpg, png, and gif. (Max file size: 1048kb)</small>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <br>

            <div class="d-flex justify-content-center mt-4">
                <a href="{{ route('admin.spots.index') }}" class="btn-admin">Cancel</a>
                <button type="submit" class="btn-admin">Update Spot</button>
            </div>
        </form>
    </div>
@endsection
