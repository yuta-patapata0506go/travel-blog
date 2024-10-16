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
    <tr>
        <td>1</td>
        <td>Category4</td>
        <td>2024-07-12 11:12:30</td>
        <td>2024-07-12 11:12:30</td>
        <td>

            {{-- Dropdown for visibility --}}
            <div class="dropdown">
                <button class="btn btn-sm" data-bs-toggle="dropdown">
                    Visibility
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
    
    <tr>
        <td>2</td>
        <td>Category2</td>
        <td>2024-08-15 09:20:45</td>
        <td>2024-08-15 09:20:45</td>
        <td>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="visibilityDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                    Visible
                </button>
                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown2">
                    <li><a class="dropdown-item" href="#">Visible</a></li>
                    <li><a class="dropdown-item" href="#">Hidden</a></li>
                </ul>
            </div>
        </td>
        <td>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#update-category">
                <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
            </button>
        </td>
    </tr>
    
    <tr>
        <td>3</td>
        <td>Category5</td>
        <td>2024-09-05 14:55:00</td>
        <td>2024-09-05 14:55:00</td>
        <td>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="visibilityDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                    Visible
                </button>
                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown3">
                    <li><a class="dropdown-item" href="#">Visible</a></li>
                    <li><a class="dropdown-item" href="#">Hidden</a></li>
                </ul>
            </div>
        </td>
        <td>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#update-category">
                <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
            </button>
        </td>
    </tr>
    
    <tr>
        <td>4</td>
        <td>Category1</td>
        <td>2024-10-12 16:30:00</td>
        <td>2024-10-12 16:30:00</td>
        <td>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="visibilityDropdown4" data-bs-toggle="dropdown" aria-expanded="false">
                    Visible
                </button>
                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown4">
                    <li><a class="dropdown-item" href="#">Visible</a></li>
                    <li><a class="dropdown-item" href="#">Hidden</a></li>
                </ul>
            </div>
        </td>
        <td>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#update-category">
                <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
            </button>
        </td>
    </tr>
    
    <tr>
        <td>5</td>
        <td>Category3</td>
        <td>2024-11-20 08:45:30</td>
        <td>2024-11-20 08:45:30</td>
        <td>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="visibilityDropdown5" data-bs-toggle="dropdown" aria-expanded="false">
                    Visible
                </button>
                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown5">
                    <li><a class="dropdown-item" href="#">Visible</a></li>
                    <li><a class="dropdown-item" href="#">Hidden</a></li>
                </ul>
            </div>
        </td>
        <td>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#update-category">
                <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
            </button>
        </td>
    </tr>
    
    <tr>
        <td>6</td>
        <td>Category1</td>
        <td>2024-12-02 13:25:50</td>
        <td>2024-12-02 13:25:50</td>
        <td>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="visibilityDropdown6" data-bs-toggle="dropdown" aria-expanded="false">
                    Visible
                </button>
                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown6">
                    <li><a class="dropdown-item" href="#">Visible</a></li>
                    <li><a class="dropdown-item" href="#">Hidden</a></li>
                </ul>
            </div>
        </td>
        <td>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#update-category">
                <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
            </button>
        </td>
    </tr>
    
    <tr>
        <td>7</td>
        <td>Category4</td>
        <td>2024-06-25 07:35:10</td>
        <td>2024-06-25 07:35:10</td>
        <td>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="visibilityDropdown7" data-bs-toggle="dropdown" aria-expanded="false">
                    Visible
                </button>
                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown7">
                    <li><a class="dropdown-item" href="#">Visible</a></li>
                    <li><a class="dropdown-item" href="#">Hidden</a></li>
                </ul>
            </div>
        </td>
        <td>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#update-category">
                <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
            </button>
        </td>
    </tr>
    
    <tr>
        <td>8</td>
        <td>Category2</td>
        <td>2024-05-18 09:10:20</td>
        <td>2024-05-18 09:10:20</td>
        <td>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="visibilityDropdown8" data-bs-toggle="dropdown" aria-expanded="false">
                    Visible
                </button>
                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown8">
                    <li><a class="dropdown-item" href="#">Visible</a></li>
                    <li><a class="dropdown-item" href="#">Hidden</a></li>
                </ul>
            </div>
        </td>
        <td>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#update-category">
                <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
            </button>
        </td>
    </tr>
    
    <tr>
        <td>9</td>
        <td>Category5</td>
        <td>2024-03-29 17:50:40</td>
        <td>2024-03-29 17:50:40</td>
        <td>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="visibilityDropdown9" data-bs-toggle="dropdown" aria-expanded="false">
                    Visible
                </button>
                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown9">
                    <li><a class="dropdown-item" href="#">Visible</a></li>
                    <li><a class="dropdown-item" href="#">Hidden</a></li>
                </ul>
            </div>
        </td>
        <td>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#update-category">
                <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
            </button>
        </td>
    </tr>
    
    <tr>
        <td>10</td>
        <td>Category3</td>
        <td>2024-01-12 15:15:30</td>
        <td>2024-01-12 15:15:30</td>
        <td>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="visibilityDropdown10" data-bs-toggle="dropdown" aria-expanded="false">
                    Visible
                </button>
                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown10">
                    <li><a class="dropdown-item" href="#">Visible</a></li>
                    <li><a class="dropdown-item" href="#">Hidden</a></li>
                </ul>
            </div>
        </td>
        <td>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#update-category">
                <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
            </button>
        </td>
    </tr>
    
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
 