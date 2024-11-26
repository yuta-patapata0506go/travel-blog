@extends('layouts.app')

@section('title', 'Admin: Spots')

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

    <!-- Error message display -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
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

            @include('admin.modals.recommended_post')

            {{-- Create New Spot Button --}}
            <a href="{{ route('admin.spots.create') }}" class="btn btn-outline-dark">Create New Spot</a>
        </div>

        <!-- Spots Table -->
        <table class="table table-hover table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <div class="icon-container">
                        <a href="{{ route('admin.users.index') }}" class="icon-item">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <a href="{{ route('admin.posts.index') }}" class="icon-item">
                            <i class="fa-solid fa-newspaper"></i>
                        </a>
                        <a href="{{ route('admin.spots.index') }}" class="icon-item active">
                            <i class="fa-solid fa-location-dot"></i>
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="icon-item">
                            <i class="fa-solid fa-shapes"></i>
                        </a>
                        <a href="{{ route('admin.inquiries.index') }}" class="icon-item">
                            <i class="fa-solid fa-address-card"></i>
                        </a>
                        <a href="{{ route('admin.spot_applications.index') }}" class="icon-item">
                            <i class="fa-solid fa-photo-film"></i>
                        </a>
                    </div>
                </tr>

                <div class="d-flex justify-content-center">
                    <div class="search-container d-flex justify-content-left my-4">
                        <form class="d-flex mb-4" role="search" action="{{ route('admin.spots.index') }}" method="GET">
                            <!-- Search Input -->
                            <div class="position-relative w-100 me-2">
                                <input 
                                    class="form-control form-control-lg pe-5" 
                                    type="search" 
                                    name="search" 
                                    value="{{ request('search') }}" 
                                    placeholder="Search here..." 
                                    aria-label="Search"
                                >
                                <!-- Search Icon -->
                                <i class="fas fa-search fa-2x position-absolute top-50 end-0 translate-middle-y me-3"></i>
                            </div>
                            <!-- Submit Button -->
                            <button class="btn btn-outline-dark" type="submit">Search</button>

                            <!-- Status Filter -->
                            <div class="w-25 ms-4">
                                <select name="status" id="status" class="form-select-lg" onchange="this.form.submit()">
                                    <option value="" {{ request()->status == '' ? 'selected' : '' }}>All</option>
                                    <option value="pending" {{ request()->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ request()->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="denied" {{ request()->status == 'denied' ? 'selected' : '' }}>Denied</option>
                                </select>
                            </div>

                        </form>
                    </div>
                </div>  

                <br>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Address</th>
                    <th>Create</th>
                    <th>Update</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($all_spots as $spot)
                <tr>
                    <td>{{ $spot->id }}</td>
                    <td>{{ $spot->name }}</td>
                    <td>
                        @if($spot->images->first())
                            <img src="{{ asset('storage/' . $spot->images->first()->image_url) }}" alt="Spot Image" width="60">
                        @else
                            <i class="fa-solid fa-location-dot"></i> 
                        @endif
                    </td>
                    <td>{{ $spot->address }}</td>
                    <td>{{ $spot->created_at }}</td>
                    <td>{{ $spot->updated_at }}</td>
                    <td> <!-- Status Dropdown -->
                        <div class="dropdown">
                            <button class="dropdown-toggle" type="button" id="statusDropdown{{ $spot->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $spot->status }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $spot->id }}">
                                @if($spot->status == 'pending')
                                    <li>
                                        <form action="{{ route('admin.spots.changeStatus', $spot->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="dropdown-item">Approved</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{ route('admin.spots.changeStatus', $spot->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="status" value="denied">
                                            <button type="submit" class="dropdown-item">Denied</button>
                                        </form>
                                    </li>
                                @elseif($spot->status == 'denied')
                                    <li>
                                        <form action="{{ route('admin.spots.changeStatus', $spot->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="dropdown-item">Approved</button>
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('admin.spots.edit', $spot->id) }}" class="btn btn-sm">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('spot.show', $spot->id) }}" class="btn btn-sm">
                            <i class="fa-regular fa-newspaper"></i>
                        </a>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $spot->id }}">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                        @include('admin.spots.modals.delete')
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
            
        </table>

        <div class="d-flex justify-content-center">
            {{ $all_spots->links() }}
        </div>
    </div>

</body>
@endsection
