@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{asset('css/tourism.css')}}">

<!-- design starts from here -->
<div class="container background-image">
    <div class="row">
        <div class="col-md-11 event-content mx-auto">
           <!-- images -->
            <div class="images">
                  <div class="logo-img text-center mt-4 mb-4">
                     <img src="{{ asset('images/Group 316.png') }}" alt="Where To Go?" class="img-fluid mb-2">
                 </div>
                 <div class="tourismbar">
                      <img src="images/tourismbar.png" alt="Tourism Banner" class="banner-img">
                      <div class="banner-text">Tourism</div>
                 </div>
            </div> 
    
            <div class="spot-banner">
                <a href="#">
                    <img src="images/map.png" class="spot-banner-img mx-auto d-block" alt="map pictures">
                    <div class="spot-banner-text">
                            <h2>Spots near You</h2>
                            <div class="map-marker"></div>
                    </div>
                 </a>
            </div>

             {{-- Search Bar --}}
             <div class="search-container d-flex justify-content-center">
                <form class="d-flex mb-4" role="search">
                    <input class="form-control form-control-lg me-2" type="search" aria-label="Search">
                    <i class="fas fa-search icon_size"></i>
                    <button class="btn fs-3 fw-bold" type="submit">Search</button>
                </form>
            </div>

            <!-- category part -->
            <div class="category">
                @php
                    $categories = ['rainy day','with kid','couple','local','music'];
                @endphp

                @foreach ($categories as $category)
                    <a href="#">{{$category}}</a>
                @endforeach
                <a href="#"><i class="fa-solid fa-ellipsis"></i></a>
            </div>
        </div>
    </div> 
    
    {{-- Sort Button --}}
  <form id="sort" class="sort_button">
    <label for="sortOptions" class="fs-4">Sort by</label>
    <select name="price" id="sortOptions" class="fs-4">
        <option value="1">Recommended</option>
        <option value="2">Newest Post</option>
        <option value="3">Popular</option>
        <option value="4">Many Likes</option>
        <option value="5">Many Views</option>
    </select>
    <i class="fa-solid fa-chevron-down icon_size"></i>
  </form>
           

    {{-- Posts Section --}}
    @include('post-spot.tourism-posts')
@endsection
  