@extends('layouts.app')

@section('title', 'Admin: Spots')

@section('content')

<link rel="stylesheet" href="{{asset('css/admin/main.css')}}">

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
            <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#category-modal"> {{-- Updated this line --}}
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
                        <a href="admin-posts-index" class="icon-item">
                            <i class="fa-solid fa-newspaper"></i>
                        </a>
                        <a href="admin-spots-index" class="icon-item active">
                            <i class="fa-solid fa-location-dot"></i>
                        </a>
                        <a href="admin-categories-index" class="icon-item">
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
                <br>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Address</th>
                    <th>Create</th>
                    <th>Update</th>
                    <th>Visibility</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <!-- ページ1 -->
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Sphinx</td>
                        <td><img src="https://via.placeholder.com/60" alt="Spot Image"></td>
                        <td>Glzeh, AI Qahlrah, Egypt</td>
                        <td>2024-09-25 10:00:00</td>
                        <td>2024-09-25 10:00:00</td>
                        <td>
                            {{-- Dropdown for visibility --}}
                                <div class="dropdown">
                                    <button class="btn btn-sm" data-bs-toggle="dropdown">
                                        Visible
                                    </button>
                                
                                    <div class="dropdown-menu">
                                        @if (isset($spot)) {{-- $spot->trashed() --}}
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-spot-"> {{-- data-bs-target: #unhide-spot-{{ $spot->id }} --}}
                                                <i class="fa-solid fa-eye"></i> Visible {{-- {{ $spot->id }} --}}
                                            </button>
                                        @else
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-spot-"> {{-- data-bs-target: #hide-spot-{{ $spot->id }} --}}
                                                <i class="fa-solid fa-eye-slash"></i> Hidden {{-- {{ $spot->id }} --}}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                
                                @include('admin.spots.modals.visibility')
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
                        <td>Great Wall of China</td>
                        <td><img src="https://via.placeholder.com/60" alt="Spot Image"></td>
                        <td>China</td>
                        <td>2024-09-25 10:00:00</td>
                        <td>2024-09-25 10:00:00</td>
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
                        <td>Colosseum</td>
                        <td><img src="https://via.placeholder.com/60" alt="Spot Image"></td>
                        <td>Rome, Italy</td>
                        <td>2024-09-25 10:00:00</td>
                        <td>2024-09-25 10:00:00</td>
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
                        <td>Machu Picchu</td>
                        <td><img src="https://via.placeholder.com/60" alt="Spot Image"></td>
                        <td>Peru</td>
                        <td>2024-09-25 10:00:00</td>
                        <td>2024-09-25 10:00:00</td>
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
                        <td>Eiffel Tower</td>
                        <td><img src="https://via.placeholder.com/60" alt="Spot Image"></td>
                        <td>Paris, France</td>
                        <td>2024-09-25 10:00:00</td>
                        <td>2024-09-25 10:00:00</td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown5" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hidden
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
                        <td>Statue of Liberty</td>
                        <td><img src="https://via.placeholder.com/60" alt="Spot Image"></td>
                        <td>New York, USA</td>
                        <td>2024-09-25 10:00:00</td>
                        <td>2024-09-25 10:00:00</td>
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
                        <td>Taj Mahal</td>
                        <td><img src="https://via.placeholder.com/60" alt="Spot Image"></td>
                        <td>Agra, India</td>
                        <td>2024-09-25 10:00:00</td>
                        <td>2024-09-25 10:00:00</td>
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
                        <td>Mount Fuji</td>
                        <td><img src="https://via.placeholder.com/60" alt="Spot Image"></td>
                        <td>Japan</td>
                        <td>2024-09-25 10:00:00</td>
                        <td>2024-09-25 10:00:00</td>
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
                        <td>Christ the Redeemer</td>
                        <td><img src="https://via.placeholder.com/60" alt="Spot Image"></td>
                        <td>Rio de Janeiro, Brazil</td>
                        <td>2024-09-25 10:00:00</td>
                        <td>2024-09-25 10:00:00</td>
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
                        <td>Petra</td>
                        <td><img src="https://via.placeholder.com/60" alt="Spot Image"></td>
                        <td>Jordan</td>
                        <td>2024-09-25 10:00:00</td>
                        <td>2024-09-25 10:00:00</td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown10" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hidden
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