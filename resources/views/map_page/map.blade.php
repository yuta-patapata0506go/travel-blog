@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/map.css') }}">
@endsection

@section('title', 'Map View')

@section('content')
<div class="map_container">
  <h2 class="fs-1 fw-bolder mb-4">Search from the map</h2>

  {{-- Search Bar --}}

  <div class="search-container d-flex justify-content-left">
      <form class="d-flex mb-4" role="search">
          <input class="form-control form-control-lg me-2" type="search" aria-label="Search">
          <i class="fas fa-search icon_size"></i>
          <button class="btn fs-3 fw-bold" type="submit">Search</button>
      </form>
  </div>

  <div class="map">
    <img src={{ asset('images/map_samples/map_sample.png') }} alt="#" class="map w-100">
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
               
  {{-- Spots Section --}}
  @include('map_page.contents.small_spots')

  {{-- Posts Section --}}
  @include('map_page.contents.small_posts')
    
  </div>
@endsection



