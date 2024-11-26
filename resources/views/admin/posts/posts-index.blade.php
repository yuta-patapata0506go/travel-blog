@extends('layouts.app')

@section('title', 'Admin: Posts')

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
                        <a href="{{ route('admin.users.index') }}" class="icon-item">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <a href="{{ route('admin.posts.index') }}" class="icon-item active">
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

                <div class="d-flex justify-content-center">
                    <div class="search-container d-flex justify-content-left my-4">
                        <form class="d-flex mb-4" role="search" action="{{ route('admin.posts.index') }}" method="GET">
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

                            <!-- Status Filter (Active or Deleted) -->
                            <div class="w-25 ms-4">
                                <select name="status" id="status" class="form-select-lg" onchange="this.form.submit()">
                                    <option value="" {{ request()->status == '' ? 'selected' : '' }}>All</option>
                                    <option value="active" {{ request()->status == 'active' ? 'selected' : '' }}>Visible</option>
                                    <option value="deleted" {{ request()->status == 'deleted' ? 'selected' : '' }}>Hidden</option>
                                </select>
                            </div>

                        </form>
                    </div>
                </div>    

        <!--  Table -->
        <table class="table table-hover table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Spot</th>
                    <th>User Name</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Create</th>
                    <th>Visibility</th>
                    {{-- <th></th> --}}
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->SpotPost->name }}</td>
                    {{-- <td>{{ $post->user->username }}</td> --}}
                    <td>{{ $post->user ? $post->user->username : 'Deleted User' }}</td>
                    <td>
                        @if($post->categories->isNotEmpty())
                        @foreach($post->categories as $cats)
                        {{$cats->name}},
                        @endforeach
                        @endif
                    </td>
                    <td>
                        {{ $post->type === 0 ? 'Event' : ($post->type === 1 ? 'Tourism' : 'Unknown') }}
                    </td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                {{ $post->trashed() ? 'Hidden' : 'Visible' }}
                            </button>
                            <div class="dropdown-menu">
                                @if ($post->trashed())
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-post-{{ $post->id }}">
                                        <i class="fa-solid fa-eye"></i> Unhide
                                    </button>
                                @else
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-post-{{ $post->id }}">
                                        <i class="fa-solid fa-eye-slash"></i> Hide
                                    </button>
                                @endif
                            </div>
                        </div>
                    </td>
                    {{-- <td>
                        <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                    </td> --}}
                    <td>
                        <a href="{{ route('post.show', $post->id) }}" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                    </td>
                </tr>

                <!-- Include visibility modals for each post -->
                @include('admin.posts.modals.visibility', ['post' => $post])
                @endforeach
            </tbody>
        </table>

            <div class="d-flex justify-content-center">
                {{ $all_posts->links() }}
            </div>
        </div>

    <!-- Footer -->

</body>
@endsection
