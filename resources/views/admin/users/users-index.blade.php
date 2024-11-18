@extends('layouts.app')

@section('title', 'Admin: Users')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
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
            <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#category-modal">Recommended Posts Setting</button>
            @include('admin.modals.recommended_post')
        </div>

                <!-- User Table -->
        
                <table class="table table-hover table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <div class="icon-container">
                                <a href="{{ route('admin.users.index') }}" class="icon-item active">
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
                                <a href="{{ route('admin.inquiries.index') }}" class="icon-item">
                                    <i class="fa-solid fa-address-card"></i>
                                </a>
                                <a href="{{ route('admin.spot_applications.index') }}" class="icon-item">
                                    <i class="fa-solid fa-photo-film"></i>
                                </a>
                            </div>
                        </tr>

        <!-- User Table -->
        <table class="table table-hover table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th></th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Create</th>
                    <th>Visibility</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        <div class="user-profile">
                            @if($user->avatar) 
                                <img src="data:image/{{ explode(';', $user->avatar)[0] }};base64,{{ explode(',', $user->avatar)[1] }}" width="55" height="55" class="rounded-circle" alt="{{ $user->username }}"> 
                            @else 
                                <i class="fas fa-user-circle fa-4x"></i> 
                            @endif 
                        </div>
                   </td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                {{ $user->trashed() ? 'Hidden' : 'Visible' }}
                            </button>
                            <div class="dropdown-menu">
                                @if ($user->trashed())
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-user-{{ $user->id }}">
                                        <i class="fa-solid fa-eye"></i> Unhide
                                    </button>
                                @else
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-user-{{ $user->id }}">
                                        <i class="fa-solid fa-eye-slash"></i> Hide
                                    </button>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                    </td>
                    <td>
                        <a href="{{ route('profile.show', $user->id) }}" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                    </td>
                </tr>

                <!-- Include visibility modals for each user -->
                @include('admin.users.modals.visibility', ['user' => $user])
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->    
        <div class="d-flex justify-content-center">
            {{ $all_users->links() }}
        </div>
    </div>

</body>
@endsection
