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
            <!-- ページ1 -->
<tbody>
    <tr>
        <td>1</td>
        <td><img src="https://via.placeholder.com/40" alt="User Icon" class="icon-image"></td>
        <td>Miki</td>
        <td>miki@mail.com</td>
        <td>2024-07-12 11:12:30</td>
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
    <tr>
        <td>2</td>
        <td><img src="https://via.placeholder.com/40" alt="User Icon" class="icon-image"></td>
        <td>Minori</td>
        <td>minori@mail.com</td>
        <td>2024-07-12 11:12:30</td>
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
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
        </td>
    </tr>
    <tr>
        <td>3</td>
        <td><img src="https://via.placeholder.com/40" alt="User Icon" class="icon-image"></td>
        <td>Mutsumi</td>
        <td>mutsumi@mail.com</td>
        <td>2024-07-12 11:12:30</td>
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
        <td><img src="https://via.placeholder.com/40" alt="User Icon" class="icon-image"></td>
        <td>Tomomi</td>
        <td>tomomi@mail.com</td>
        <td>2024-07-12 11:12:30</td>
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
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
        </td>
    </tr>
    <tr>
        <td>5</td>
        <td><img src="https://via.placeholder.com/40" alt="User Icon" class="icon-image"></td>
        <td>Chika</td>
        <td>chika@mail.com</td>
        <td>2024-07-12 11:12:30</td>
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
        <td><img src="https://via.placeholder.com/40" alt="User Icon" class="icon-image"></td>
        <td>Yumi</td>
        <td>yumi@mail.com</td>
        <td>2024-07-12 11:12:30</td>
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
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
        </td>
    </tr>
    <tr>
        <td>7</td>
        <td><img src="https://via.placeholder.com/40" alt="User Icon" class="icon-image"></td>
        <td>Ayaka</td>
        <td>ayaka@mail.com</td>
        <td>2024-07-12 11:12:30</td>
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
        <td><img src="https://via.placeholder.com/40" alt="User Icon" class="icon-image"></td>
        <td>Yuta</td>
        <td>yuta@mail.com</td>
        <td>2024-07-12 11:12:30</td>
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
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </td>
        <td>
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
        </td>
    </tr>
    <tr>
        <td>9</td>
        <td><img src="https://via.placeholder.com/40" alt="User Icon" class="icon-image"></td>
        <td>Hayato</td>
        <td>hayato@mail.com</td>
        <td>2024-07-12 11:12:30</td>
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
        <td><img src="https://via.placeholder.com/40" alt="User Icon" class="icon-image"></td>
        <td>Shohei</td>
        <td>shohei@mail.com</td>
        <td>2024-07-12 11:12:30</td>
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