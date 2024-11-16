
@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{asset('css/events-tourism.css')}}">

<!-- desaign is from here -->
<div class="container background-image">
  <div class="row">
        <div class="col-md-11 event-content mx-auto">
           <!-- images -->
             <div class=" images">
                 <div class="logo-img text-center mt-4 mb-4">
                     <img src="{{ asset('images/Group 316.png') }}" alt="Where To Go?" class="img-fluid mb-2">
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

                <!-- Event and Tourism Display  -->
                <!-- Event and Tourism Display  -->
        <div class="image-container">
          <div class="image-item">
            <a href="{{ route('display.events') }}"> <!-- イベントページへのリンク -->
               <img src="images/event-link.png" alt="Event Page">
               <div class="overlay-text">Event Page</div>
            </a>
          </div>
          <div class="image-item">
             <a href="{{ route('display.tourism') }}"> <!-- ツーリズムページへのリンク -->
                <img src="images/tourism-link.png" alt="Tourism Page">
                <div class="overlay-text">Tourism Page</div>
             </a>
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


                   

        


{{-- Spots Section --}}
@include('map_page.contents.small_spots')

{{-- Posts Section --}}
@include('post-spot.both-posts')

  
  </div>
  </div>
  </div>
  @endsection
  
  


