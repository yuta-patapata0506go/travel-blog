
@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{asset('css/events-tourism.css')}}">

<!-- desaign is from here -->
<div class="container background-image">
        <div class="col-md-11 event-content mx-auto">
           <!-- images -->
             <div class=" images">
                 <div class="logo-img">
                     <img src="images/Group 316.png" class="mx-auto d-block" alt="logo">  
                 </div>
    
           <!-- search form -->
                    <div class="search-container  justify-content-center">
                          <form action="" method="GET" class=" w-50 " role="search">
                               <div class="input-group mx-auto" style="">
                                      <input type="search" name="query" class="search-input form-control me-2" type="search" placeholder="Search" aria-label="Search" required>
                                      <button type="submit" class="btn btn-success" type="submit">Search</button>
                                 </div>
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
                <div class="image-container">
                      <div class="image-item">
                        <a href="#">
                           <img src="images/event-link.png" alt="Event Page">
                           <div class="overlay-text">Event Page</div>
                        </a>
                      </div>
                      <div class="image-item">
                        <a href="#">
                            <img src="images/tourism-link.png" alt="Tourism Page">
                            <div class="overlay-text">Tourism Page</div>
                         </a>
                      </div>
                </div>

                  <!-- sort part -->
                   <div class="sort">
                      <button class="btn btn-outline-secondary dropdown-toggle rounded-pill" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort by recommended
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="?sort=likes">Likes</a></li>
                        <li><a class="dropdown-item" href="?sort=favorites">Favorites</a></li>
                        <li><a class="dropdown-item" href="?sort=lately">lately</a></li>
                      </ul>
                   </div>


                   

        
</div>

{{-- Spots Section --}}
@include('post-spot.both-spots')

{{-- Posts Section --}}
@include('post-spot.both-posts')

     </div>

     
  </div>

  
  
  </div>
  @endsection
  
  


