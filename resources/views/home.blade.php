@extends('layouts.app')

@section('css')

{{-- CSS --}}
<link rel="stylesheet" href="{{ asset('css/map.css') }}">
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
                    <input class="form-control form-control-lg me-2" type="search" aria-label="Search">
                    <i class="fas fa-search icon_size"></i>
                    <button class="btn fs-3 fw-bold" type="submit">Search</button>
                </form>
            </div>
        </div>
                    
        <!-- Event and Tourism Page -->
        <div class="row mt-5">
            <div class="col-md-6">
                <a href="{{ route('events') }}"> <!-- イベントページへのリンク -->
                    <div class="card page-link-card shadow-card">
                        <img src="{{ asset('images/event.jpg') }}" class="card-img-top" alt="Event Page Image">
                        <div class="card-body text-center">
                            <h5 class="card-title">Event Page</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('tourism') }}"> <!-- ツーリズムページへのリンク -->
                    <div class="card page-link-card shadow-card">
                        <img src="{{ asset('images/tourism.jpg') }}" class="card-img-top" alt="Tourism Page Image">
                        <div class="card-body text-center">
                            <h5 class="card-title">Tourism Page</h5>
                        </div>
                    </div>
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

