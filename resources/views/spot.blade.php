@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/spot.css') }}" rel="stylesheet">
@endsection

@section('title', 'Spot')

@section('content')


    <div class="post-container">

            <!-- Card of whole page -->
        
        <div class="post-card">
            <!-- HEART BUTTON + no. of likes & FAVORITE BUTTON + no. of likes -->
            <div class="icons d-flex align-items-center">
            @foreach($spots as $spot)
                @if ($spot->isLiked())
                    <form action="{{ route('spot.like', $spot->id ?? 1) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm shadow-none p-0 d-flex align-items-center">
                            <i class="fa-solid fa-heart" id="like-icon"></i>
                            <span class="ms-1" id="like-count">{{ $spot->likes->count() }}</span>
                        </button>
                    </form>
                @else
                    <form action="{{ route('spot.like', $spot->id ?? 1) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm shadow-none p-0 d-flex align-items-center">
                            <i class="fa-regular fa-heart" id="like-icon"></i>
                            <!--<span class="ms-1" id="like-count"></span>-->
                        </button>
                    </form>
                @endif
                
                @if ($spot->isFavorited)
                    <form action="{{ route('spot.favorite', $spot->id ?? 1) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm shadow-none p-0 d-flex align-items-center">
                            <i class="fa-solid fa-star" id="favorite-icon"></i>
                            <span class="ms-1" id="favorite-count">{{ $spot->favorites->count() }}</span>
                        </button>
                    </form>
                @else
                    <form action="{{ route('spot.favorite', $spot->id ?? 1) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm shadow-none p-0 d-flex align-items-center">
                            <i class="fa-regular fa-star" id="favorite-icon"></i>
                            <!--<span class="ms-1" id="favorite-count"></span>-->
                        </button>
                    </form>
                @endif
            @endforeach
            </div>

        
            <!-- スポットの写真 -->
            <h2>{{ $spot->name }}</h2>
            <div class="spot-container">
            @foreach($spots as $spot)
                <!-- 画像 -->asdfghjk
                <div class="card col mt-3" style="height: auto;">
                    <!-- メイン画像カルーセル -->
                    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel" style="max-height: 500px;">
                        <div class="carousel-inner">
                            @foreach ($spot->images as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image->image_url) }}" class="d-block w-100 main-carousel-img" alt="Image {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                        <!-- カルーセルコントロール（前/次） -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- サムネイル画像のカルーセルインジケーター -->
                    <div class="carousel-indicators-wrapper mt-3 d-flex justify-content-center gap-2 flex-wrap">
                        @foreach ($spot->images as $index => $image)
                            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}">
                                <img src="{{ asset('storage/' . $image->image_url) }}" class="thumbnail-img" alt="Thumbnail {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>
                </div>
            @endforeach
            </div>


            <!-- Divider -->
            <hr class="divider">

                <!-- Map and Weather Display -->
                <div class="info-container">
                    <!-- Mapへの遷移用フォーム -->
                    <form action="/mappage" method="GET" class="map-form" onclick="this.parentElement.submit()">
                        <div class="map" onclick="this.parentElement.submit()">
                        <h5>Map</h5>
                        <i class="fa-regular fa-map"></i>
                        <img src="/images/map.png" alt="">
                        <p>Map will be displayed here.</p>
                        <h6>Address</h6>
                        <p>000-0000</p>
                        <p>Petra - Wadi Musa, Jordan</p>
                        </div>
                    </form>
                    <!-- Weather -->
                    <div class="weather">
                        <h5>Weather</h5>
                        <i class="fa-solid fa-cloud-sun"></i>
                        <img src="/images/weather.png" alt="">
                        <p>Weather information will be displayed here.</p>
                        <!-- Embed weather code here -->
                    </div>
                </div>

                <!-- Comments -->
                            <div class="comments-section my-2">
                                <h5>Question & Comment</h5>
                                <form action="#" method="post" class="mt-3">
                                    <a href="comment"></a>
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="text" name="comment" class="form-control form-control-sm" id="comment" placeholder="Write a question or comment">
                                        <button type="submit" class="btn">Add</button>
                                    </div>
                                </form>
                                <!-- コメントセクションにスクロールバーを付与 -->
                                <div class="card comments-container" style=" max-height: 400px; overflow-y: auto;">
                                    <!-- 各コメントをカードで表示 -->
                                    <div class="card comment-card ">
                                        <div class="card-body bg-white">
                                            <!-- 名前と日付を左右に配置 -->
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="col-auto">
                                                        <a href="#">
                                                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                                        </a>
                                                    </div>
                                                    <div class="ps-2">
                                                        <a href="#" class="text-decoration-none text-dark fw-bold">NAME</a>
                                                    </div>
                                                </div>
                                                <small class="text-muted">2024.10.8</small> <!-- 日付を右側に配置 -->
                                            </div>
                                            <!-- コメントとリプライボタンを左右に配置 -->
                                            <div class="d-flex align-items-center justify-content-between mt-2">
                                                <p class="card-text mb-0">comment</p>
                                                <button class="btn btn-reply btn-sm" data-comment-id="">reply</button>
                                            </div>
                                            <!-- Reply Form -->
                                            <div class="reply-form mt-3" id="reply-form-" style="display: none;">
                                                <form action="#" method="POST">
                                                    @csrf
                                                    <div class="mb-2">
                                                        <textarea name="comment" rows="2" class="form-control" placeholder="reply here....."></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
                                                </form>
                                            </div>
                                            <!-- Replies (Nested Comments) -->
                                            <div class="card mt-2">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <div class="col-auto">
                                                                <a href="#">
                                                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                                                </a>
                                                            </div>
                                                            <div class="ps-2">
                                                                <a href="#" class="text-decoration-none text-dark fw-bold">NAME</a>
                                                            </div>
                                                        </div>
                                                        <!-- 日付を右側に配置 -->
                                                        <small class="text-muted">2024.10.8</small>
                                                    </div>
                                                    <div class="mt-2">
                                                        <p class="mb-0 text-muted">reply comment here</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                <!-- Event and Tourism Display -->
                <div class="event-tourism-container mt-5">
                    <!-- Eventページに遷移するフォーム -->
                    <form action="/events" method="GET" class="event-link event text-white text-shadow" 
                        style="cursor: pointer;" onclick="this.submit();">
                        <h5>Event</h5>
                    </form>

                    <!-- Tourismページに遷移するフォーム -->
                    <form action="/tourism" method="GET" class="tourism-link tourism text-white text-shadow" 
                        style="cursor: pointer;" onclick="this.submit();">
                        <h5>Tourism</h5>
                    </form>
                </div>

            <!-- Posts Gallery -->
            <h4 class="post-gallery mt-5">POST related to "SPOT NAME"</h4>
            <!-- Sort by dropdown -->
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle rounded-dropdown" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort by
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    
                        <li class="text-end pe-3">
                            <span class="text-primary cursor-pointer" id="clearCheckboxes">Clear</span>
                        </li>
                        <li>
                            <label class="dropdown-item">
                                <input type="checkbox" value="Newest Post" class="form-check-input me-1"> Newest Post
                            </label>
                        </li>
                        <li>
                            <label class="dropdown-item">
                                <input type="checkbox" value="Popular" class="form-check-input me-1"> Popular
                            </label>
                        </li>
                        <li>
                            <label class="dropdown-item">
                                <input type="checkbox" value="Many Likes" class="form-check-input me-1"> Many Likes
                            </label>
                        </li>
                        <li>
                            <label class="dropdown-item">
                                <input type="checkbox" value="Many Views" class="form-check-input me-1"> Many Views
                            </label>
                        </li>
                        
                        <li class="text-end pe-3">
                            <form action="#" method="GET">
                                <button type="submit" class="btn-done">Done</button>
                            </form>
                        </li>
                </ul>
            </div>

                <!-- Post display and jump to the Post Page-->
            <div class="small-post-container d-flex align-items-center">
                    <button class="arrow-left" onclick="nextImage()">
                        <i class="fa-solid fa-circle-left"></i>
                    </button>

                    @for($i = 0; $i < 4; $i++)
                    <div class="card post shadow-card m-2" style="cursor: pointer; width: 18rem;" onclick="this.querySelector('form').submit();">
                        <!-- カード内のフォーム -->
                        <form action="/posts-event-post" method="GET">
                                <img src="{{ asset('images/beer.jpg') }}" class="card-img-top" alt="Post Image">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="">
                                            <div class="col-auto title-line">
                                                <h5 class="card-title">Title {{ $i + 1 }}</h5>
                                                <div class="col-auto">
                                                    <form action="#">
                                                        <button type="submit" class="btn shadow-none p-0"><i class="fa-solid fa-heart"></i></button>
                                                    </form>
                                                    <form action="#">
                                                        <button type="submit" class="btn shadow-none p-0"><i class="fa-solid fa-star"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-2">
                                                <span class="col badge bg-secondary bg-opacity-50 rounded-pill">Category</span>
                                                <span class="col badge bg-secondary bg-opacity-50 rounded-pill">Category</span>
                                            </div>
                                            
                                            <p class="card-text">Short description of the tourism spot.</p>
                                            
                                            <button type="button" class="btn-small-post-card">Read More</button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                    @endfor

                    <button class="arrow-right" onclick="nextImage()">
                        <i class="fa-solid fa-circle-right"></i>
                    </button>
            </div>    
        </div>   
    </div>

        
    <script>
        function switchImage(imagePath) {
            document.getElementById('featured').src = imagePath;
        }

        function nextImage() {
            // Logic to implement for additional images in the gallery can be added here
        }
    </script>

    <script>
        // Clear all checkboxes when "Clear" button is clicked
        document.getElementById('clearCheckboxes').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('.dropdown-menu input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
        checkbox.checked = false;
            });
        });
    </script>
@endsection

@section('styles')
   
@endsection