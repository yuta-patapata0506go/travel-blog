@extends('layouts.app')

@section('css')

{{-- CSS --}}
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('title', 'Home')

@section('content')
    <!-- Header with Image -->
    <div class="text-center mt-4">
        <img src="{{ asset('images/Group 316.png') }}" alt="Where To Go?" class="img-fluid">
    
        {{-- Search Bar --}}
        <div class="d-flex justify-content-center mt-4">
            <div class="search-container d-flex justify-content-left mb-4">
                <form class="d-flex mb-4" role="search" action="{{ route('search') }}" method="GET">
                    <!-- Search Input -->
                    <input 
                        class="form-control form-control-lg me-2" 
                        type="search" 
                        name="query" 
                        value="{{ request('query') }}" 
                        placeholder="Search here..." 
                        aria-label="Search"
                    >
                    <i class="fas fa-search icon_size"></i>

                    {{-- <!-- Sort Dropdown -->
                    <select 
                        class="form-select form-control-lg me-2" 
                        name="sort" 
                        aria-label="Sort">
                        <option value="recommended" {{ request('sort') == 'recommended' ? 'selected' : '' }}>Recommended</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Post</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popular</option>
                        <option value="many_likes" {{ request('sort') == 'many_likes' ? 'selected' : '' }}>Many Likes</option>
                        <option value="many_views" {{ request('sort') == 'many_views' ? 'selected' : '' }}>Many Views</option>
                    </select> --}}

                    <!-- Submit Button -->
                    <button class="btn fs-3 fw-bold" type="submit">Search</button>
                </form>
            </div>
        </div>
        
        <!-- Event and Tourism Display  -->
        <div class="image-container">
            <div class="image-item">
              <a href="{{ route('events') }}"> <!-- イベントページへのリンク -->
                 <img src="images/event-link.png" alt="Event Page">
                 <div class="overlay-text">Event Page</div>
              </a>
            </div>
            <div class="image-item">
               <a href="{{ route('tourism') }}"> <!-- ツーリズムページへのリンク -->
                  <img src="images/tourism-link.png" alt="Tourism Page">
                  <div class="overlay-text">Tourism Page</div>
               </a>
            </div>
      </div>            
     

        <!-- Tourism Recommendation Section -->
        <div class="tourism-recommendation mt-5">
            <h3 class="text-start">Tourism Recommendation</h3>
            <div class="row">
                @for ($i = 0; $i < 4; $i++)
                    <div class="col-md-3 mb-4"> <!-- 4列にするため、col-md-3に変更 -->
                        <div class="card tourism-card shadow-card">
                            <img src="{{ asset('images/tourism.jpg') }}" class="card-img-top" alt="Tourism Image">
                            <div class="card-body">
                                <h5 class="card-title">Title</h5>
                                <p class="card-text">Category 1 / Category 2</p>
                                <p class="card-text">Short description of the tourism spot.</p>
                                <button class="btn comment-card">Learn More</button>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Event Recommendation Section -->
        <div class="event-recommendation mt-5">
            <h3 class="text-start">Event Recommendation</h3>
            <div class="row">
                @for ($i = 0; $i < 4; $i++)
                    <div class="col-md-3 mb-4"> <!-- 4列にするため、col-md-3に変更 -->
                        <div class="card event-card shadow-card">
                            <img src="{{ asset('images/event.jpg') }}" class="card-img-top" alt="Event Image">
                            <div class="card-body">
                                <h5 class="card-title">Title</h5>
                                <p class="card-text">Category 1 / Category 2</p>
                                <p class="card-text">Short description of the event.</p>
                                <button class="btn comment-card">Learn More</button>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection
