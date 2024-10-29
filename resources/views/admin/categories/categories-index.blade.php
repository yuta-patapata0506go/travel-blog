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
                        <a href="admin-categories-index" class="icon-item">
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
        <td>
        {{ $category->created_at->format('Y-m-d H:i:s') }}
        </td>
        
        
        <td>
        
        {{ $category->updated_at->format('Y-m-d H:i:s') }}
        
        
</td>
        <td>

            {{-- Dropdown for visibility --}}
            <div class="dropdown">
              <button class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                {{ $category->status === 0 ? 'Visible' : 'Hidden' }}
             </button>

                 <div class="dropdown-menu">
                    @if ($category->status === 0)
                      <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-category-{{ $category->id }}">
                        <i class="fa-solid fa-eye-slash"></i> Hide
                      </button>
                    @else
                      <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-category-{{ $category->id }}">
                        <i class="fa-solid fa-eye"></i> Unhide
                      </button>
                    @endif
                    
                </div>
            </div>
           
            @include('admin.categories.modals.visibility')
        </td>

        <td>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#update-category-{{$category->id}}">
            <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
        </button>

        
        </td>
    </tr>


   
    
    @include('admin.categories.modals.update_category')
    @endforeach
</tbody>


        </table>

        <!-- Pagination -->    
        <nav aria-label="Page navigation">
            <ul class="pagination">
             @if ($all_categories->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link"><</a>
                </li>
             @else
                <li class="page-item">
                    <a class="page-link" href="{{$all_categories->previousPageUrl()}}" rel="prev"><</a>
                </li>
            @endif

            @for ($page = 1; $page <= $all_categories->lastPage(); $page++)
              @if ($page == $all_categories->currentPage())
                <li class="page-item active">
                    <span class="page-link">{{ $page }}</>
                </li>
              @else
                <li class="page-item">
                    <a class="page-link" href="{{ $all_categories->url($page) }}">{{ $page }}  
                    </a></li>
                @endif
        @endfor

        {{-- 次のページへのリンク --}}
        @if ($all_categories->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $all_categories->nextPageUrl() }}" rel="next">＞</a>
            </li>
        @else
            <li class="page-item disabled"><span class="page-link">＞</span></li>
        @endif
    </ul>

            
        </nav>
    </div>

    <!-- Footer -->

</body>
@endsection
 