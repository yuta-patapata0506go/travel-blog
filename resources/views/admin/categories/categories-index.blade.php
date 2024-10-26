<link rel="stylesheet" href="{{asset('css/admin/main.css')}}">

@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')

<body>
    <!-- Navbar -->


    <!-- Admin Page Title -->
    <div class="container mt-5">
        <div style="text-align: center;">
            <h1 style="display: inline-block; border-bottom: 2px solid #000; padding-bottom: 5px;">Admin Page</h1>
        </div>
        



        <!-- Recommend Setting Button -->
        <div class="text-end mb-3">
            {{-- <button class="btn btn-outline-dark">Recommended Posts</button> --}}
            {{-- modal button --}}
            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#category-modal"> {{-- Updated this line --}}
                Recommended Posts Setting {{-- {{ $categoryModalLabel->id }} --}}
            </button>

            @include('admin.modals.recommended_post')

            {{-- <button class="btn btn-outline-dark">Create New Category</button> --}}
            <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#create-category">
                Create New Category
            </button>
        </div>
        @include('admin.categories.modals.create_category')

        <!-- User Table -->
        
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
                        <a href="admin-spots-index" class="icon-item">
                            <i class="fa-solid fa-location-dot"></i>
                        </a>
                        <a href="admin-categories-index" class="icon-item active">
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
                <br>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Create</th>
                    <th>Update</th>
                    <th>Visibility</th>
                    <th></th>
                </tr>
            </thead>
<tbody>
    @foreach ($all_categories as $category)
    <tr>
        <td>{{$category->id}}</td>
        <td>{{$category->title}}</td>
        <td>{{$category->created_at }}</td>
        <td>{{ $category->updated_at }}</td>
        <td>

            {{-- Dropdown for visibility --}}
            <div class="dropdown">
                <button class="btn btn-sm" data-bs-toggle="dropdown">
                    Visible
                </button>

                <div class="dropdown-menu">
                    @if (isset($category)) {{-- $category->trashed() --}}
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-category-"> {{-- data-bs-target: #unhide-category-{{ $category->id }} --}}
                            <i class="fa-solid fa-eye"></i> Visible {{-- {{ $category->id }} --}}
                        </button>
                    @else
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-category-"> {{-- data-bs-target: #hide-category-{{ $category->id }} --}}
                            <i class="fa-solid fa-eye-slash"></i> Hidden {{-- {{ $category->id }} --}}
                        </button>
                    @endif
                </div>
            </div>

            @include('admin.categories.modals.visibility')
        </td>
        <td>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#update-category">
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </button>
        </td>
    </tr>
    @endforeach
    
  
</tbody>
@include('admin.categories.modals.update_category')
        </table>

        <!-- Pagination -->    
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link" href="#"><</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">></a></li>
            </ul>
        </nav>
    </div>

    <!-- Footer -->

</body>
@endsection
 