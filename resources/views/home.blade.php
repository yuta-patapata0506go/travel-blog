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
        
       {{-- Search --}}
        <div class="d-flex justify-content-center mt-4">
            <div class="search-container d-flex justify-content-left mb-4">
                <form class="d-flex align-items-center mb-4" role="search" action="{{ route('search') }}" method="GET">
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
                    <!-- Search Button -->
                    <button class="btn fs-3 fw-bold me-3" type="submit">Search</button>                    
                </form>
            </div>
           <!-- Map Icon -->
    <a href="{{ route('map.page') }}" style="text-decoration: none;">
        <i class="fa-regular fa-map" style="font-size: 3rem; color: #6c757d;"></i>
    </a>
        </div>
        
        @if(!empty($results))
            <h3 class="mt-4">Search Results for: {{ $query }}</h3>
            <ul>
                @foreach($results as $result)
                    <li>
                        <a href="{{ route('events-tourism', ['keyword' => $query]) }}">
                            {{ $result->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
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
     

        <!-- Tourism Recommendation Section -->
        <div class="tourism-recommendation mt-5">
            <h3 class="text-start">Tourism Recommendation</h3>
            <div class="row">
                @for ($i = 0; $i < 4; $i++)
                    <div class="col-md-3 mb-4"> <!-- 4列にするため、col-md-3に変更 -->
                        <div class="card tourism-card shadow-card">
                            <img src="{{ asset('images/castle.jpg') }}" class="card-img-top" alt="Tourism Image">
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
                            <img src="{{ asset('images/firework.jpeg') }}" class="card-img-top" alt="Event Image">
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
