@extends('layouts.app')

@section('title', 'Admin: Spots')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">

<body>
    <!-- Admin Page Title -->
    <div class="container mt-5">
        <div style="text-align: center;">
            <h1 style="display: inline-block; border-bottom: 2px solid #000; padding-bottom: 5px;">Admin Page</h1>
        </div>

        <!-- Recommend Setting Button -->
        <div class="text-end mb-3">
            <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#category-modal">Recommended Posts Setting</button>
            @include('admin.modals.recommended_post')
        </div>

        <!-- Navigation Icons -->
        <table class="table table-hover table-bordered text-center">
            <thead class="table-dark">
        <tr>
            <div class="icon-container">
                <a href="admin-users-index" class="icon-item">
                    <i class="fa-solid fa-user"></i>
                </a>
                <a href="admin-posts-index" class="icon-item">
                    <i class="fa-solid fa-newspaper"></i>
                </a>
                <a href="admin-spots-index" class="icon-item active">
                    <i class="fa-solid fa-location-dot"></i>
                </a>
                <a href="admin-categories-index" class="icon-item">
                    <i class="fa-solid fa-shapes"></i>
                </a>
                <a href="admin-inquiries-index" class="icon-item">
                    <i class="fa-solid fa-address-card"></i>
                </a>
                <a href="admin-spot_applications-index" class="icon-item">
                    <i class="fa-solid fa-photo-film"></i>
                </a>
            </div>
        </tr>

        <!-- Spots Table -->
        <table class="table table-hover table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Address</th>
                    <th>Create</th>
                    <th>Update</th>
                    <th>Visibility</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_spots as $spot)
                    <tr>
                        <td>{{ $spot->id }}</td>
                        <td>{{ $spot->name }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $spot->image_url) }}" alt="{{ $spot->name }}" style="width: 60px; height: auto;">
                        </td>
                        <td>{{ $spot->address }}</td>
                        <td>{{ $spot->created_at }}</td>
                        <td>{{ $spot->updated_at }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    {{ $spot->trashed() ? 'Hidden' : 'Visible' }}
                                </button>
                                <div class="dropdown-menu">
                                    @if ($spot->trashed())
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-spot-{{ $spot->id }}">
                                            <i class="fa-solid fa-eye"></i> Unhide
                                        </button>
                                    @else
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-spot-{{ $spot->id }}">
                                            <i class="fa-solid fa-eye-slash"></i> Hide
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.spots.edit', $spot->id) }}" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                        </td>
                        <td>
                            <a href="{{ route('admin.spots.show', $spot->id) }}" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                        </td>
                    </tr>

                    <!-- Include visibility modals for each spot -->
                    @include('admin.spots.modals.visibility', ['spot' => $spot])
                @endforeach
            </tbody>
        </table>
    
        <div class="d-flex justify-content-center">
            {{ $all_spots->links() }}
        </div>
    </div>

</body>
@endsection
