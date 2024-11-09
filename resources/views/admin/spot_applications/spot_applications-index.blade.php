@extends('layouts.app')

@section('title', 'Admin: Spot_applications')

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/main.css')}}">
@endsection

@section('content')

<body>
    <!-- Success message display -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Admin Page Title -->
    <div class="container mt-5">
        <div style="text-align: center;">
            <h1 style="display: inline-block; border-bottom: 2px solid #000; padding-bottom: 5px;">Admin Page</h1>
        </div>
        
        <!-- Recommend Setting Button -->
        <div class="text-end mb-3">
            {{-- modal button --}}
            <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#category-modal">
                Recommended Posts Setting
            </button>

            {{-- @include('admin.modals.recommended_post') --}}
            @include('admin.modals.recommended_post', ['categories' => $categories])

            {{-- <button class="btn btn-outline-dark">Create New Spot</button> --}}
            <a href="#" class="btn btn-outline-dark">Create New Spot</a>
        </div>

        <!-- Spot Applications Table -->
        
        <table class="table table-hover table-bordered text-center" style="background-color: #ffffff;">
            <thead class="table-dark">
                <tr>
                    <div class="icon-container">
                        <a href="admin-users-index" class="icon-item">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <a href="admin-posts-index" class="icon-item">
                            <i class="fa-solid fa-newspaper"></i>
                        </a>
                        <a href="admin-spots-index" class="icon-item">
                            <i class="fa-solid fa-location-dot"></i>
                        </a>
                        <a href="admin-categories-index" class="icon-item">
                            <i class="fa-solid fa-shapes"></i>
                        </a>
                        <a href="{{ route('admin.inquiries.index') }}" class="icon-item">
                            <i class="fa-solid fa-address-card"></i>
                        </a>
                        <a href="{{ route('admin.spot_applications.index') }}" class="icon-item active">
                            <i class="fa-solid fa-photo-film"></i>
                        </a>
                    </div>
                </tr>
                <br>
                <tr>
                    <th>ID</th>
                    <th>Spot Name</th>
                    <th>Address</th>
                    <th>Create</th>
                    <th>Status</th>
                    <th>Visibility</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pendingSpots as $spot) <!-- Loop through each pending spot -->
                    <tr>
                        <td>{{ $spot->id }}</td>
                        <td>{{ $spot->name }}</td>
                        <td>{{ $spot->address }}</td>
                        <td>{{ $spot->created_at->format('Y-m-d') }}</td>
                        
                        <!-- Status Dropdown -->
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="statusDropdown{{ $spot->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $spot->pivot->status }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $spot->id }}">
                                    <li>
                                        <form action="#" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="0">
                                            <button type="submit" class="dropdown-item {{ $spot->pivot->status == 0 ? 'active' : '' }}">Pending</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="#" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="1">
                                            <button type="submit" class="dropdown-item {{ $spot->pivot->status == 1 ? 'active' : '' }}">Approved</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="#" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="2">
                                            <button type="submit" class="dropdown-item {{ $spot->pivot->status == 2 ? 'active' : '' }}">Denied</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        
                        <!-- Visibility Dropdown -->
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm" data-bs-toggle="dropdown">
                                    {{ $spot->visibility === 'Visible' ? 'Visible' : 'Hidden' }}
                                </button>
                                <div class="dropdown-menu">
                                    @if ($spot->visibility === 'Visible')
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-spot-{{ $spot->id }}">
                                            <i class="fa-solid fa-eye-slash"></i> Hide
                                        </button>
                                    @else
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-spot-{{ $spot->id }}">
                                            <i class="fa-solid fa-eye"></i> Unhide
                                        </button>
                                    @endif
                                </div>
                            </div>
                            @include('admin.spots.modals.visibility', ['spot' => $spot]) <!-- Pass spot to the modal -->
                        </td>

                        <!-- Details Button -->
                        <td>
                            <a href="#" class="btn btn-sm">
                                <i class="fa-regular fa-newspaper"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No pending spots found.</td> <!-- Show a message when no data is available -->
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $pendingSpots->links() }}
        </div>
    </div>

</body>
@endsection
