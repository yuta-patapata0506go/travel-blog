@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{asset('css/events.css')}}">
@vite(['resources/js/app.js','resources/css/app.css'])

<!-- design starts from here -->
<div class="container background-image">
    <div class="row">
        <div class="col-md-11 event-content mx-auto">
           <!-- images -->
            <div class="images">
                 <div class="logo-img">
                     <img src="images/Group 316.png" class="mx-auto d-block" alt="logo">  
                 </div>
                 <div class="eventbar">
                      <img src="images/eventbar.png" alt="Event Banner" class="banner-img">
                      <div class="banner-text">Event</div>
                 </div>
            </div> 
        </div> 
    </div> 
    
    <!-- start of another row -->
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="spot-banner">
                <a href="#">
                    <img src="images/map.png" class="spot-banner-img mx-auto d-block" alt="map pictures">
                    <div class="spot-banner-text">
                            <h2>Spots near You</h2>
                            <div class="map-marker"></div>
                    </div>
                 </a>
            </div>

            <!-- search form -->
            <div class="search-container justify-content-center">
                <form action="" method="GET" class="w-75" role="search">
                    <div class="input-group mx-auto">
                        <input type="search" name="query" class="search-input form-control me-2" placeholder="Search" aria-label="Search" required>
                        <button type="submit" class="btn btn-success">Search</button>
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

        <!-- Calendar Section -->
        <div class="col-md-2">
            <div class="calendar-container">
                <div class="calendar-header">
                    <button id="prev-month" class="nav-btn">←</button>
                    <h2 id="month-year"></h2>
                    <button id="next-month" class="nav-btn">→</button>
                </div>
                <table id="calendar">
                    <thead>
                        <tr>
                            <th>SUN</th>
                            <th>MON</th>
                            <th>TUE</th>
                            <th>WED</th>
                            <th>THU</th>
                            <th>FRI</th>
                            <th>SAT</th>
                        </tr>
                    </thead>
                    <tbody id="calendar-body">
                        <!-- JavaScriptでここに日付が挿入される -->
                    </tbody>
                </table>
            </div>
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
            <li><a class="dropdown-item" href="?sort=lately">Lately</a></li>
        </ul>
    </div>

    {{-- Posts Section --}}
    @include('post-spot.event-posts')


@endsection