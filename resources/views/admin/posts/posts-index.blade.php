@extends('layouts.app')

@section('title', 'Admin: Posts')

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

        <!-- User Table -->

        <table class="table table-hover table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <div class="icon-container">
                        <a href="admin-users-index" class="icon-item">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <a href="admin-posts-index" class="icon-item active">
                            <i class="fa-solid fa-newspaper"></i>
                        </a>
                        <a href="admin-spots-index" class="icon-item">
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
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->spot->name }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->category }}</td>
                    <td>{{ $post->type }}</td>
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
                    <td>
                        <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
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
