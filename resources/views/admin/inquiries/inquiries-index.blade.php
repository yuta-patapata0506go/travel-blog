@extends('layouts.app')

@section('title', 'Admin: Inquiries')

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
        </div>

        <!-- Inquiries Table -->
        
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
                        <a href="{{ route('admin.spots.index') }}" class="icon-item">
                            <i class="fa-solid fa-location-dot"></i>
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="icon-item">
                            <i class="fa-solid fa-shapes"></i>
                        </a>
                        <a href="{{ route('admin.inquiries.index') }}" class="icon-item active">
                            <i class="fa-solid fa-address-card"></i>
                        </a>
                        <a href="{{ route('admin.spot_applications.index') }}" class="icon-item">
                            <i class="fa-solid fa-photo-film"></i>
                        </a>
                    </div>
                </tr>

                <div class="d-flex justify-content-center">
                    <div class="search-container d-flex flex-wrap align-items-center my-4 w-100">
                        <!-- Form -->
                        <form class="d-flex align-items-center w-100" role="search" action="{{ route('admin.inquiries.index') }}" method="GET">
                            <!-- Search Bar -->
                            <div class="position-relative flex-grow-1 me-3 mb-2">
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
                
                            <!-- Search Button -->
                            <button class="btn btn-outline-dark btn-lg me-3" type="submit">Search</button>
                
                            <!-- Status Filter -->
                            <div class="me-3">
                                <select name="status" id="status" class="form-select form-select-lg" onchange="this.form.submit()">
                                    <option value="" {{ request()->status == '' ? 'selected' : '' }}>All Status</option>
                                    <option value="Unprocessed" {{ request()->status == 'Unprocessed' ? 'selected' : '' }}>Unprocessed</option>
                                    <option value="Responded" {{ request()->status == 'Responded' ? 'selected' : '' }}>Responded</option>
                                    <option value="Resolved" {{ request()->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                </select>
                            </div>
                
                            <!-- Visibility Filter -->
                            <div>
                                <select name="visibility" id="visibility" class="form-select form-select-lg" onchange="this.form.submit()">
                                    <option value="" {{ request()->status == '' ? 'selected' : '' }}>All Visibility</option>
                                    <option value="Visible" {{ request()->visibility == 'Visible' ? 'selected' : '' }}>Visible</option>
                                    <option value="Hidden" {{ request()->visibility == 'Hidden' ? 'selected' : '' }}>Hidden</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                
                
                 

                <br>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th>Visibility</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($all_inquiries as $inquiry) <!-- Loop through each inquiry -->
                        <tr>
                            <td>{{ $inquiry->id }}</td>
                            <td>{{ $inquiry->created_at->format('Y-m-d') }}</td>
                            {{-- <td>{{ $inquiry->user->username }}</td> --}}
                            <td>{{ $inquiry->user ? $inquiry->user->username : 'Deleted User' }}</td>
                            <td>{{ $inquiry->user->email }}</td>
                            <td class="textCell">
                                <p>{{ Str::limit($inquiry->body, 50) }}</p>
                                <a href="{{ route('admin.inquiries.inquiry_details', $inquiry->id) }}">Read More...</a>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown{{ $inquiry->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $inquiry->status }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown{{ $inquiry->id }}">
                                        <li>
                                            <form action="{{ route('admin.inquiries.changeStatus', $inquiry->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="unprocessed">
                                                <button type="submit" class="dropdown-item {{ $inquiry->status == 'Unprocessed' ? 'active' : '' }}">Unprocessed</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.inquiries.changeStatus', $inquiry->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="responded">
                                                <button type="submit" class="dropdown-item {{ $inquiry->status == 'Responded' ? 'active' : '' }}">Responded</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.inquiries.changeStatus', $inquiry->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="resolved">
                                                <button type="submit" class="dropdown-item {{ $inquiry->status == 'Resolved' ? 'active' : '' }}">Resolved</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm" data-bs-toggle="dropdown">
                                        {{ $inquiry->visibility === 'Visible' ? 'Visible' : 'Hidden' }}
                                    </button>
                                    <div class="dropdown-menu">
                                        @if ($inquiry->visibility === 'Visible')
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-inquiry-{{ $inquiry->id }}">
                                                <i class="fa-solid fa-eye-slash"></i> Hide
                                            </button>
                                        @else
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-inquiry-{{ $inquiry->id }}">
                                                <i class="fa-solid fa-eye"></i> Unhide
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                @include('admin.inquiries.modals.visibility', ['inquiry' => $inquiry]) <!-- Pass inquiry to the modal -->
                            </td>
                            <td>
                                <a href="{{ route('admin.inquiries.inquiry_details', $inquiry->id) }}" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>                
        </table>

        <div class="d-flex justify-content-center">
            {{ $all_inquiries->links() }}
        </div>
    </div>

</body>
@endsection