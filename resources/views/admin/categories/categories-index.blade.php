@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/main.css')}}">
@endsection

@section('content')

<body>
    <!-- Success message display -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error message display -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Admin Page Title -->
    <div class="container mt-5">
        <div style="text-align: center;">
            <h1 style="display: inline-block; border-bottom: 2px solid #000; padding-bottom: 5px;">Admin Page</h1>
        </div>
        
        <!-- Recommend Setting Button -->
        <div class="text-end mb-3">
            {{-- modal button --}}
            <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#category-modal">
                Recommended Posts Setting
            </button>

            @include('admin.modals.recommended_post')
        

            <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#create-category">
                Create New Category
            </button>
        </div>
        @include('admin.categories.modals.create_category')

        <!-- Categories Table -->
        
        <table class="table table-hover table-bordered text-center">
            <thead class="table-dark">
            <tr>
                <div class="icon-container">
                    <a href="{{ route('admin.users.index') }}" class="icon-item">
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <a href="{{ route('admin.posts.index') }}" class="icon-item">
                        <i class="fa-solid fa-newspaper"></i>
                    </a>
                    <a href="{{ route('admin.spots.index') }}" class="icon-item">
                        <i class="fa-solid fa-location-dot"></i>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="icon-item active">
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
                <th>Create</th>
                <th>Update</th>
                {{-- <th>Visibility</th> --}}
                <th></th>
            </tr>
          </thead>

          <tbody>
                @foreach ($all_categories as $category)
            <!-- parent categories -->
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $category->updated_at->format('Y-m-d H:i:s') }}</td>
                        {{-- <td>
                            <div class="dropdown">
                                <button class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                    {{ $category->status === 0 ? 'Hidden' : 'Visible' }}
                                </button>
                                <div class="dropdown-menu">
                                    @if ($category->status === 0)
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-category-{{ $category->id }}">
                                            <i class="fa-solid fa-eye-slash"></i> UnHide
                                        </button>
                                    @else
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-category-{{ $category->id }}">
                                            <i class="fa-solid fa-eye"></i> Hide
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </td> --}}
                        <td>
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#update-category-{{$category->id}}">
                                <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                            </button>
                        </td>
                    </tr>
        
                    @include('admin.categories.modals.visibility', ['category' => $category])
                    @include('admin.categories.modals.update_category', ['category' => $category])
        
            <!-- child categories -->
            @foreach ($category->children as $child)
                    <tr>
                        <td>{{ $child->id }}</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;└ {{ $child->name }}</td>
                        <td>{{ $child->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $child->updated_at->format('Y-m-d H:i:s') }}</td>
                        {{-- <td>
                            <div class="dropdown">
                                <button class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                    {{ $child->status === 0 ? 'Hidden' : 'Visible' }}
                                </button>
                                <div class="dropdown-menu">
                                    @if ($child->status === 0)
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#unhide-category-{{ $child->id }}">
                                            <i class="fa-solid fa-eye-slash"></i> UnHide
                                        </button>
                                    @else
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#hide-category-{{ $child->id }}">
                                            <i class="fa-solid fa-eye"></i> Hide
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </td> --}}
                        <td>
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#update-child-category-{{ $child->id }}">
                                <a href="#" class="btn btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                            </button>
                        </td>
                    </tr>
            
                    @include('admin.categories.modals.visibility_child_category', ['child' => $child])
                    @include('admin.categories.modals.update_child_category', ['child' => $child])
                @endforeach
        @endforeach
        
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $all_categories->links() }}
</div>        

</body>
@endsection
 