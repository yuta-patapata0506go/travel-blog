<link rel="stylesheet" href="{{asset('css/admin/main.css')}}">

@extends('layouts.app')

@section('title', 'Admin: Spot_applications')

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
                        <button class="btn btn-outline-dark">Create New Spot</button>
        </div>

        <!-- User Table -->
        
        <table class="table table-hover table-bordered text-center" style="background-color: #ffffff;">
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
                        <a href="admin-categories-index" class="icon-item">
                            <i class="fa-solid fa-shapes"></i>
                        </a>
                        <a href="admin-inquiries-index" class="icon-item">
                            <i class="fa-solid fa-address-card"></i>
                        </a>
                        <a href="admin-spot_applications-index" class="icon-item active">
                            <i class="fa-solid fa-photo-film"></i>
                        </a>
                    </div>
                </tr>
                <br>
                        <tr>
                            <th>ID</th>
                            <th>Spot Name</th>
                            <th>Address</th>
                            <th>Create</th>
                            <th>Status</th>
                            <th>Visibility</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Great Sphinx of Giza</td>
                            <td>Gizeh, Al Qahirah, Egypt</td>
                            <td>2024-07-12 11:12:30</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pending
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown1">
                                        <li><a class="dropdown-item" href="#">Pending</a></li>
                                        <li><a class="dropdown-item" href="#">Approved</a></li>
                                        <li><a class="dropdown-item" href="#">Denied</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                {{-- Dropdown for visibility --}}
                                <div class="dropdown">
                                    <button class="btn btn-sm" data-bs-toggle="dropdown">
                                        Visibility
                                    </button>
                                
                                    <div class="dropdown-menu">
                                        @if (isset($spot_application)) {{-- $spot_application->trashed() --}}
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-spot_application-"> {{-- data-bs-target: #unhide-spot_application-{{ $spot_application->id }} --}}
                                                <i class="fa-solid fa-eye"></i> Visible {{-- {{ $spot_application->id }} --}}
                                            </button>
                                        @else
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-spot_application-"> {{-- data-bs-target: #hide-spot_application-{{ $spot_application->id }} --}}
                                                <i class="fa-solid fa-eye-slash"></i> Hidden {{-- {{ $spot_application->id }} --}}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                
                                @include('admin.spot_applications.modals.visibility')
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                            </td>
                        </tr>
                    
                        <tr>
                            <td>2</td>
                            <td>Eiffel Tower</td>
                            <td>Paris, France</td>
                            <td>2024-07-13 10:10:00</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                        Approved
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown3">
                                        <li><a class="dropdown-item" href="#">Pending</a></li>
                                        <li><a class="dropdown-item" href="#">Approved</a></li>
                                        <li><a class="dropdown-item" href="#">Denied</a></li>
                                    </ul>
                                </div>
                            </td>
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
                                <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                            </td>
                        </tr>
                    
                        <tr>
                            <td>3</td>
                            <td>Statue of Liberty</td>
                            <td>New York, USA</td>
                            <td>2024-07-14 14:15:20</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown5" data-bs-toggle="dropdown" aria-expanded="false">
                                        Denied
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown5">
                                        <li><a class="dropdown-item" href="#">Pending</a></li>
                                        <li><a class="dropdown-item" href="#">Approved</a></li>
                                        <li><a class="dropdown-item" href="#">Denied</a></li>
                                    </ul>
                                </div>
                            </td>
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
                                <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                            </td>
                        </tr>
                    
                        <tr>
                            <td>4</td>
                            <td>Colosseum</td>
                            <td>Rome, Italy</td>
                            <td>2024-07-15 09:05:55</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown7" data-bs-toggle="dropdown" aria-expanded="false">
                                        Approved
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown7">
                                        <li><a class="dropdown-item" href="#">Pending</a></li>
                                        <li><a class="dropdown-item" href="#">Approved</a></li>
                                        <li><a class="dropdown-item" href="#">Denied</a></li>
                                    </ul>
                                </div>
                            </td>
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
                                <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                            </td>
                        </tr>
                    
                        <tr>
                            <td>5</td>
                            <td>Great Wall of China</td>
                            <td>Beijing, China</td>
                            <td>2024-07-16 17:22:40</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown9" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pending
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown9">
                                        <li><a class="dropdown-item" href="#">Pending</a></li>
                                        <li><a class="dropdown-item" href="#">Approved</a></li>
                                        <li><a class="dropdown-item" href="#">Denied</a></li>
                                    </ul>
                                </div>
                            </td>
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
                                <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                            </td>
                        </tr>
                    
                        <tr>
                            <td>6</td>
                            <td>Taj Mahal</td>
                            <td>Agra, India</td>
                            <td>2024-07-17 08:18:10</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown11" data-bs-toggle="dropdown" aria-expanded="false">
                                        Approved
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown11">
                                        <li><a class="dropdown-item" href="#">Pending</a></li>
                                        <li><a class="dropdown-item" href="#">Approved</a></li>
                                        <li><a class="dropdown-item" href="#">Denied</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown12" data-bs-toggle="dropdown" aria-expanded="false">
                                        Visible
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown12">
                                        <li><a class="dropdown-item" href="#">Visible</a></li>
                                        <li><a class="dropdown-item" href="#">Hidden</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                            </td>
                        </tr>
                    
                        <tr>
                            <td>7</td>
                            <td>Eiffel Tower</td>
                            <td>Paris, France</td>
                            <td>2024-07-22 08:00:00</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown21" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pending
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown21">
                                        <li><a class="dropdown-item" href="#">Pending</a></li>
                                        <li><a class="dropdown-item" href="#">Approved</a></li>
                                        <li><a class="dropdown-item" href="#">Denied</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown22" data-bs-toggle="dropdown" aria-expanded="false">
                                        Hidden
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown22">
                                        <li><a class="dropdown-item" href="#">Visible</a></li>
                                        <li><a class="dropdown-item" href="#">Hidden</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                            </td>
                        </tr>
                    
                        <tr>
                            <td>8</td>
                            <td>Sydney Opera House</td>
                            <td>Sydney, Australia</td>
                            <td>2024-07-23 10:15:30</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown23" data-bs-toggle="dropdown" aria-expanded="false">
                                        Approved
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown23">
                                        <li><a class="dropdown-item" href="#">Pending</a></li>
                                        <li><a class="dropdown-item" href="#">Approved</a></li>
                                        <li><a class="dropdown-item" href="#">Denied</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown24" data-bs-toggle="dropdown" aria-expanded="false">
                                        Visible
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown24">
                                        <li><a class="dropdown-item" href="#">Visible</a></li>
                                        <li><a class="dropdown-item" href="#">Hidden</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                            </td>
                        </tr>
                    
                        <tr>
                            <td>9</td>
                            <td>Colosseum</td>
                            <td>Rome, Italy</td>
                            <td>2024-07-24 14:45:15</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown25" data-bs-toggle="dropdown" aria-expanded="false">
                                        Denied
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown25">
                                        <li><a class="dropdown-item" href="#">Pending</a></li>
                                        <li><a class="dropdown-item" href="#">Approved</a></li>
                                        <li><a class="dropdown-item" href="#">Denied</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown26" data-bs-toggle="dropdown" aria-expanded="false">
                                        Hidden
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown26">
                                        <li><a class="dropdown-item" href="#">Visible</a></li>
                                        <li><a class="dropdown-item" href="#">Hidden</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                            </td>
                        </tr>
                    
                        <tr>
                            <td>10</td>
                            <td>Great Wall of China</td>
                            <td>China</td>
                            <td>2024-07-25 09:30:00</td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown27" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pending
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown27">
                                        <li><a class="dropdown-item" href="#">Pending</a></li>
                                        <li><a class="dropdown-item" href="#">Approved</a></li>
                                        <li><a class="dropdown-item" href="#">Denied</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="visibilityDropdown28" data-bs-toggle="dropdown" aria-expanded="false">
                                        Visible
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="visibilityDropdown28">
                                        <li><a class="dropdown-item" href="#">Visible</a></li>
                                        <li><a class="dropdown-item" href="#">Hidden</a></li>
                                    </ul>
                                </div>
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
