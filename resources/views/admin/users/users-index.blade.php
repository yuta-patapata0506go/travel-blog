<link rel="stylesheet" href="{{asset('css/admin/main.css')}}">

@extends('layouts.app')

@section('title', 'Admin: Users')

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
                        <a href="admin-users-index" class="icon-item active">
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
                    <td><img src="https://via.placeholder.com/40" alt="User Icon" class="icon-image"></td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                Visible
                            </button>
                        
                            <div class="dropdown-menu">
                                @if (isset($user)) {{-- $user->trashed() --}}
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-user-"> {{-- data-bs-target: #unhide-user-{{ $user->id }} --}}
                                        <i class="fa-solid fa-eye"></i> Visible {{-- {{ $user->id }} --}}
                                    </button>
                                @else
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-user-"> {{-- data-bs-target: #unhide-user-{{ $user->id }} --}}
                                        <i class="fa-solid fa-eye-slash"></i> Hidden {{-- {{ $user->id }} --}}
                                    </button>
                                @endif
                            </div>
                        </div>
                        
                        @include('admin.users.modals.visibility')
                        
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->    
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <!-- Previous Page Link -->
                @if ($all_users->onFirstPage())
                    <li class="page-item disabled"><a class="page-link" href="#"><</a></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $all_users->previousPageUrl() }}"><</a></li>
                @endif
        
                <!-- Page Number Links -->
                @for ($i = 1; $i <= $all_users->lastPage(); $i++)
                    <li class="page-item {{ ($all_users->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $all_users->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
        
                <!-- Next Page Link -->
                @if ($all_users->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $all_users->nextPageUrl() }}">></a></li>
                @else
                    <li class="page-item disabled"><a class="page-link" href="#">></a></li>
                @endif
            </ul>
        </nav>
        
    </div>

    <!-- Footer -->

</body>
@endsection