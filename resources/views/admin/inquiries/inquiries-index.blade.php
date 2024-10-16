<link rel="stylesheet" href="{{asset('css/admin/main.css')}}">

@extends('layouts.app')

@section('title', 'Admin: Inquiries')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
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
                        <a href="admin-posts-index" class="icon-item">
                            <i class="fa-solid fa-newspaper"></i>
                        </a>
                        <a href="admin-spots-index" class="icon-item">
                            <i class="fa-solid fa-location-dot"></i>
                        </a>
                        <a href="admin-categories-index" class="icon-item">
                            <i class="fa-solid fa-shapes"></i>
                        </a>
                        <a href="admin-inquiries-index" class="icon-item active">
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
                    <th>Date</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th>Visibility</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>2025-10-11</td>
                        <td>Miki</td>
                        <td>miki@mail.com</td>
                        <td class="textCell">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, officiis. Libero sed corporis enim eaque quibusdam. Asperiores nulla necessitatibus nostrum, animi sit magni reprehenderit debitis neque consequuntur odio porro ullam?</td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Unprocessed
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown1">
                                    <li><a class="dropdown-item" href="#">Unprocessed</a></li>
                                    <li><a class="dropdown-item" href="#">Responded</a></li>
                                    <li><a class="dropdown-item" href="#">Resolved</a></li>
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
                                    @if (isset($inquiry)) {{-- $inquiry->trashed() --}}
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-inquiry-"> {{-- data-bs-target: #unhide-inquiry-{{ $inquiry->id }} --}}
                                            <i class="fa-solid fa-eye"></i> Visible {{-- {{ $inquiry->id }} --}}
                                        </button>
                                    @else
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-inquiry-"> {{-- data-bs-target: #hide-inquiry-{{ $inquiry->id }} --}}
                                            <i class="fa-solid fa-eye-slash"></i> Hidden {{-- {{ $inquiry->id }} --}}
                                        </button>
                                    @endif
                                </div>
                            </div>

                            @include('admin.inquiries.modals.visibility')
                            </div>
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                        </td>
                    </tr>
                
                    <tr>
                        <td>2</td>
                        <td>2025-10-10</td>
                        <td>Taro</td>
                        <td>taro@mail.com</td>
                        <td class="textCell">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, officiis. Libero sed corporis enim eaque quibusdam. Asperiores nulla necessitatibus nostrum, animi sit magni reprehenderit debitis neque consequuntur odio porro ullam?</td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                    Responded
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown3">
                                    <li><a class="dropdown-item" href="#">Unprocessed</a></li>
                                    <li><a class="dropdown-item" href="#">Responded</a></li>
                                    <li><a class="dropdown-item" href="#">Resolved</a></li>
                                </ul>
                            </div>
                        </td>
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
                            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                        </td>
                    </tr>
                
                    <tr>
                        <td>3</td>
                        <td>2025-10-09</td>
                        <td>Yuki</td>
                        <td>yuki@mail.com</td>
                        <td class="textCell">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, officiis. Libero sed corporis enim eaque quibusdam. Asperiores nulla necessitatibus nostrum, animi sit magni reprehenderit debitis neque consequuntur odio porro ullam?</td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown5" data-bs-toggle="dropdown" aria-expanded="false">
                                    Resolved
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown5">
                                    <li><a class="dropdown-item" href="#">Unprocessed</a></li>
                                    <li><a class="dropdown-item" href="#">Responded</a></li>
                                    <li><a class="dropdown-item" href="#">Resolved</a></li>
                                </ul>
                            </div>
                        </td>
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
                            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                        </td>
                    </tr>
                
                    <tr>
                        <td>4</td>
                        <td>2025-10-08</td>
                        <td>Hana</td>
                        <td>hana@mail.com</td>
                        <td class="textCell">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, officiis. Libero sed corporis enim eaque quibusdam. Asperiores nulla necessitatibus nostrum, animi sit magni reprehenderit debitis neque consequuntur odio porro ullam?</td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown7" data-bs-toggle="dropdown" aria-expanded="false">
                                    Unprocessed
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown7">
                                    <li><a class="dropdown-item" href="#">Unprocessed</a></li>
                                    <li><a class="dropdown-item" href="#">Responded</a></li>
                                    <li><a class="dropdown-item" href="#">Resolved</a></li>
                                </ul>
                            </div>
                        </td>
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
                            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                        </td>
                    </tr>
                
                    <tr>
                        <td>5</td>
                        <td>2025-10-07</td>
                        <td>Satoshi</td>
                        <td>satoshi@mail.com</td>
                        <td class="textCell">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, officiis. Libero sed corporis enim eaque quibusdam. Asperiores nulla necessitatibus nostrum, animi sit magni reprehenderit debitis neque consequuntur odio porro ullam?</td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown9" data-bs-toggle="dropdown" aria-expanded="false">
                                    Resolved
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown9">
                                    <li><a class="dropdown-item" href="#">Unprocessed</a></li>
                                    <li><a class="dropdown-item" href="#">Responded</a></li>
                                    <li><a class="dropdown-item" href="#">Resolved</a></li>
                                </ul>
                            </div>
                        </td>
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
                            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                        </td>
                    </tr>
                
                    <tr>
                        <td>6</td>
                        <td>2025-10-06</td>
                        <td>Akira</td>
                        <td>akira@mail.com</td>
                        <td class="textCell">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, officiis. Libero sed corporis enim eaque quibusdam. Asperiores nulla necessitatibus nostrum, animi sit magni reprehenderit debitis neque consequuntur odio porro ullam?</td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown11" data-bs-toggle="dropdown" aria-expanded="false">
                                    Responded
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown11">
                                    <li><a class="dropdown-item" href="#">Unprocessed</a></li>
                                    <li><a class="dropdown-item" href="#">Responded</a></li>
                                    <li><a class="dropdown-item" href="#">Resolved</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown12" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hidden
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
                        <td>2025-10-05</td>
                        <td>Rika</td>
                        <td>rika@mail.com</td>
                        <td class="textCell">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, officiis. Libero sed corporis enim eaque quibusdam. Asperiores nulla necessitatibus nostrum, animi sit magni reprehenderit debitis neque consequuntur odio porro ullam?</td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown13" data-bs-toggle="dropdown" aria-expanded="false">
                                    Unprocessed
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown13">
                                    <li><a class="dropdown-item" href="#">Unprocessed</a></li>
                                    <li><a class="dropdown-item" href="#">Responded</a></li>
                                    <li><a class="dropdown-item" href="#">Resolved</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown14" data-bs-toggle="dropdown" aria-expanded="false">
                                    Visible
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown14">
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
                        <td>2025-10-04</td>
                        <td>Ken</td>
                        <td>ken@mail.com</td>
                        <td class="textCell">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, officiis. Libero sed corporis enim eaque quibusdam. Asperiores nulla necessitatibus nostrum, animi sit magni reprehenderit debitis neque consequuntur odio porro ullam?</td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown15" data-bs-toggle="dropdown" aria-expanded="false">
                                    Responded
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown15">
                                    <li><a class="dropdown-item" href="#">Unprocessed</a></li>
                                    <li><a class="dropdown-item" href="#">Responded</a></li>
                                    <li><a class="dropdown-item" href="#">Resolved</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown16" data-bs-toggle="dropdown" aria-expanded="false">
                                    Visible
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown16">
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
                        <td>2025-10-03</td>
                        <td>Mai</td>
                        <td>mai@mail.com</td>
                        <td class="textCell">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, officiis. Libero sed corporis enim eaque quibusdam. Asperiores nulla necessitatibus nostrum, animi sit magni reprehenderit debitis neque consequuntur odio porro ullam?</td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown17" data-bs-toggle="dropdown" aria-expanded="false">
                                    Resolved
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown17">
                                    <li><a class="dropdown-item" href="#">Unprocessed</a></li>
                                    <li><a class="dropdown-item" href="#">Responded</a></li>
                                    <li><a class="dropdown-item" href="#">Resolved</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown18" data-bs-toggle="dropdown" aria-expanded="false">
                                    Visible
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown18">
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
                        <td>2025-10-02</td>
                        <td>Aoi</td>
                        <td>aoi@mail.com</td>
                        <td class="textCell">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, officiis. Libero sed corporis enim eaque quibusdam. Asperiores nulla necessitatibus nostrum, animi sit magni reprehenderit debitis neque consequuntur odio porro ullam?</td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown19" data-bs-toggle="dropdown" aria-expanded="false">
                                    Unprocessed
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown19">
                                    <li><a class="dropdown-item" href="#">Unprocessed</a></li>
                                    <li><a class="dropdown-item" href="#">Responded</a></li>
                                    <li><a class="dropdown-item" href="#">Resolved</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="visibilityDropdown20" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hidden
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="visibilityDropdown20">
                                    <li><a class="dropdown-item" href="#">Visible</a></li>
                                    <li><a class="dropdown-item" href="#">Hidden</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm"><i class="fa-regular fa-newspaper"></i></a>
                        </td>
                    </tr>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const cells = document.querySelectorAll(".textCell"); // .textCellクラスを持つ全てのセルを取得
                            const maxLength = 100;
                    
                            cells.forEach(function(cell) {
                                const fullText = cell.innerText;
                    
                                if (fullText.length > maxLength) {
                                    const visibleText = fullText.substring(0, maxLength);
                                    cell.innerHTML = visibleText + ' <span class="more-button" onclick="showMore(this)">more...</span>';
                                    cell.setAttribute("data-fulltext", fullText); // 元のテキストを保存
                                }
                            });
                    
                            window.showMore = function(button) {
                                const cell = button.parentElement; // 親要素である<td>を取得
                                const fullText = cell.getAttribute("data-fulltext");
                                cell.innerHTML = fullText; // 元のテキストに戻す
                            };
                        });
                    </script>
                    
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

