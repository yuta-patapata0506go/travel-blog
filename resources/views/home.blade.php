@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="background-overlay" ></div> <!-- 背景画像の透過オーバーレイ -->
    <div class="container position-relative" style="background-image: url('{{ asset('images/christmas.png') }}'); background-size: cover; background-position: center;">
       
        <!-- Header with Image -->
        <div class="text-center mt-4">
            <img src="{{ asset('images/Group 316.png') }}" alt="Where To Go?" class="img-fluid">
     
            {{-- Search Bar --}}
            <div class="d-flex justify-content-center mt-4">
                <div class="search-container d-flex justify-content-left mb-4">
                    <form class="d-flex mb-4" role="search">
                        <input class="form-control form-control-lg me-2" type="search" aria-label="Search">
                        <i class="fas fa-search icon_size"></i>
                        <button class="btn fs-3 fw-bold" type="submit">Search</button>
                    </form>
                </div>
            </div>
                        
            <!-- Event and Tourism Page -->
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="card page-link-card shadow-card">
                        <img src="{{ asset('images/event.jpg') }}" class="card-img-top" alt="Event Page Image">
                        <div class="card-body text-center">
                            <h5 class="card-title">Event Page</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card page-link-card shadow-card">
                        <img src="{{ asset('images/tourism.jpg') }}" class="card-img-top" alt="Tourism Page Image">
                        <div class="card-body text-center">
                            <h5 class="card-title">Tourism Page</h5>
                        </div>
                    </div>
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

            {{-- <!-- Footer -->
            <footer class="text-center mt-5 p-3 footer">
                <div class="social-icons">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                </div>
                <div class="footer-content">
                    <p>© 2024 WhereToGo</p>
                    <div class="footer-links">
                        <a href="#">Contact</a> | <a href="#">About</a>
                    </div>
                </div>
            </footer> --}}
        </div>
    </div>
@endsection
