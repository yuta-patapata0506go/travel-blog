<link rel="stylesheet" href="{{asset('css/admin/main.css')}}">

@extends('layouts.app')

@section('title', 'Admin: Posts')

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
                <br>
            </thead>
            <!-- ページ1 -->
<tbody>
    <tr>
        <td>1</td>
        <td>First visit to Egypt</td>
        <td>Pyramid</td>
        <td>Miki</td>
        <td>Africa, History</td>
        <td>Tourism</td>
        <td>2024-07-12 11:12:30</td>
        <td>

{{-- Dropdown for visibility --}}
<div class="dropdown">
    <button class="btn btn-sm" data-bs-toggle="dropdown">
        Visibility
    </button>
  
    <div class="dropdown-menu">
        @if (isset($post)) {{-- $post->trashed() --}}
            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-post-"> {{-- data-bs-target: #unhide-post-{{ $post->id }} --}}
                <i class="fa-solid fa-eye"></i> Visible {{-- {{ $post->id }} --}}
            </button>
        @else
            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-post-"> {{-- data-bs-target: #hide-post-{{ $post->id }} --}}
                <i class="fa-solid fa-eye-slash"></i> Hidden {{-- {{ $post->id }} --}}
            </button>
        @endif
    </div>
  </div>
  
  @include('admin.posts.modals.visibility')
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
        </td>
    </tr>
    
    <tr>
        <td>2</td>
        <td>Exploring the Sphinx</td>
        <td>Sphinx</td>
        <td>Ken</td>
        <td>Africa, Outdoors</td>
        <td>Event</td>
        <td>2024-08-01 09:45:00</td>
        <td>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="visibilityDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                    Hidden
                </button>
                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown2">
                    <li><a class="dropdown-item" href="#">Visible</a></li>
                    <li><a class="dropdown-item" href="#">Hidden</a></li>
                </ul>
            </div>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
        </td>
    </tr>
    
    <tr>
        <td>3</td>
        <td>Desert Adventure</td>
        <td>Desert</td>
        <td>Alice</td>
        <td>Outdoors, Africa</td>
        <td>Tourism</td>
        <td>2024-09-05 08:20:45</td>
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
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
        </td>
    </tr>
    
    <tr>
        <td>4</td>
        <td>Nile River Cruise</td>
        <td>Nile River</td>
        <td>John</td>
        <td>Africa, History, Outdoors</td>
        <td>Event</td>
        <td>2024-09-15 14:35:20</td>
        <td>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="visibilityDropdown4" data-bs-toggle="dropdown" aria-expanded="false">
                    Hidden
                </button>
                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown4">
                    <li><a class="dropdown-item" href="#">Visible</a></li>
                    <li><a class="dropdown-item" href="#">Hidden</a></li>
                </ul>
            </div>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
        </td>
    </tr>
    
    <tr>
        <td>5</td>
        <td>Great Pyramids Tour</td>
        <td>Pyramids</td>
        <td>Sarah</td>
        <td>Africa, History</td>
        <td>Tourism</td>
        <td>2024-10-01 10:00:00</td>
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
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
        </td>
    </tr>
    
    <tr>
        <td>6</td>
        <td>Exploring Luxor</td>
        <td>Luxor Temple</td>
        <td>Tom</td>
        <td>Africa, History</td>
        <td>Event</td>
        <td>2024-10-10 09:15:30</td>
        <td>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="visibilityDropdown6" data-bs-toggle="dropdown" aria-expanded="false">
                    Hidden
                </button>
                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown6">
                    <li><a class="dropdown-item" href="#">Visible</a></li>
                    <li><a class="dropdown-item" href="#">Hidden</a></li>
                </ul>
            </div>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
        </td>
    </tr>
    
    <tr>
        <td>7</td>
        <td>Valley of the Kings</td>
        <td>Valley</td>
        <td>Linda</td>
        <td>Africa, History</td>
        <td>Tourism</td>
        <td>2024-11-20 16:25:00</td>
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
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
        </td>
    </tr>
    
    <tr>
        <td>8</td>
        <td>Camel Ride Adventure</td>
        <td>Camel Ride</td>
        <td>Mike</td>
        <td>Outdoors, Africa</td>
        <td>Event</td>
        <td>2024-12-05 13:45:00</td>
        <td>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="visibilityDropdown8" data-bs-toggle="dropdown" aria-expanded="false">
                    Hidden
                </button>
                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown8">
                    <li><a class="dropdown-item" href="#">Visible</a></li>
                    <li><a class="dropdown-item" href="#">Hidden</a></li>
                </ul>
            </div>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
        </td>
    </tr>
    
    <tr>
        <td>9</td>
        <td>Aswan High Dam Tour</td>
        <td>Aswan Dam</td>
        <td>Kathy</td>
        <td>Africa, History, Outdoors</td>
        <td>Tourism</td>
        <td>2024-12-15 11:30:00</td>
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
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
        </td>
    </tr>
    <tr>
        <td>10</td>
        <td>Hot Air Balloon Ride</td>
        <td>Balloon</td>
        <td>Emma</td>
        <td>Outdoors, Africa</td>
        <td>Event</td>
        <td>2024-12-20 07:30:00</td>
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
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
        </td>
    </tr>
    
</tbody>
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

