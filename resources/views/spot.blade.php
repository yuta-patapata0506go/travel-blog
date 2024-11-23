@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/spot.css') }}" rel="stylesheet">
@endsection

@section('title', 'Spot')

@section('content')


    <div class="post-container">

        <!-- Card of whole page -->        
        <div class="post-card-1">
            <!-- HEART BUTTON + no. of likes & FAVORITE BUTTON + no. of likes -->
            <div class="icons d-flex align-items-center">
            
                @if ($spot->isLiked())
                <form action="{{ route('spot.like', ['id' => $spot->id, 'type' => 'spot']) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm shadow-none p-0 d-flex align-items-center">
                            <i class="fa-solid fa-heart" id="like-icon"></i>
                            <span class="ms-1" id="like-count">{{ $likesCount }}</span>
                        </button>
                    </form>
                @else
                <form action="{{ route('spot.like', ['id' => $spot->id, 'type' => 'spot']) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm shadow-none p-0 d-flex align-items-center">
                            <i class="fa-regular fa-heart" id="like-icon"></i>
                            <span class="ms-1" id="like-count">{{ $likesCount }}</span>
                        </button>
                    </form>
                @endif
                
                @if ($spot->isFavorited)
                    <form action="{{ route('spot.favorite', ['id' => $spot->id, 'type' => 'spot']) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm shadow-none p-0 d-flex align-items-center">
                            <i class="fa-solid fa-star" id="favorite-icon"></i>
                            <span class="ms-1" id="favorite-count">{{ $favoritesCount }}</span>
                        </button>
                    </form>
                @else
                    <form action="{{ route('spot.favorite', ['id' => $spot->id, 'type' => 'spot']) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm shadow-none p-0 d-flex align-items-center">
                            <i class="fa-regular fa-star" id="favorite-icon"></i>
                            <span class="ms-1" id="favorite-count">{{ $favoritesCount }}</span>
                        </button>
                    </form>
                @endif
            
            </div>

        
            <!-- スポットの写真 -->
            <h1 class="spot-title">{{ $spot->name }}</h1>
            <div class="spot-container">
                <!-- 画像 -->
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
                        @foreach ($spot->images as $show => $image)
                            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $show }}" class="{{ $show === 0 ? 'active' : '' }}" aria-label="Slide {{ $show + 1 }}">
                                <img src="{{ asset('storage/' . $image->image_url) }}" class="thumbnail-img" alt="Thumbnail {{ $show + 1 }}">
                            </button>
                        @endforeach
                    </div>
                </div>            
            </div>


            <!-- Divider -->
            <hr class="divider">

                <!-- Map and Weather Display -->
                <div class="info-container">
                    <!-- Mapへの遷移用フォーム -->
                    <div class="map">
                     <div class="card3 border-0  bg-white" style="height: 20rem;">
                        <div class="card-body">
                                <h3 class="map-location"><i class="fa-solid fa-location-dot"></i>  {{ $spot->name }}</h3>              
                            <iframe 
                                src="https://www.google.com/maps?q={{ $spot->latitude ?? 0 }},{{ $spot->longitude ?? 0 }}&output=embed"
                                width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen="">
                            </iframe>
                            <p class="mt-1">Postal/Zip code:{{ $spot->postalcode ?? 'N/A' }}</p>
                            <p>{{ $spot->address ?? 'N/A' }}</p>
                        </div>
                     </div>
                </div>
                    
                </form>

                <!-- Weather -->
                <div class="weather"> 
                    <h3>Weather Information</h3>
                    <br>              
                    <!-- Weather Condition Icon -->
                    <div class="weather-icon-container"> 
                        <div class="weather-icon"> <img src="http://openweathermap.org/img/wn/{{ $spot->weather_icon }}.png" alt="{{ $spot->weather_condition }}"> 
                        </div> 
                        <div class="weather-info"> 
                            <p class="weather-condition">{{ ucfirst($spot->weather_condition) }}</p> 
                            <span class="temperature">{{ $spot->temperature }}°C</span> 
                        </div> 
                    </div> 
                    <div class="weather-details"> 
                        <p>Humidity: <span class="large-number">{{ $spot->humidity }}<span class="unit">%</span></span></p> 
                        <p>Wind Speed: <span class="large-number">{{ $spot->wind_speed }}<span class="unit">m/s</span></span></p> 
                        <p>Precipitation: <span class="large-number">{{ $spot->precipitation }}<span class="unit">mm</span></span></p> 
                        <p>UV Index: <span class="large-number">{{ $spot->uv_index }}</span></p>
                    </div> 
                </div> 
            </div>

            <!-- Comments -->
            <div class="comments-section my-2">
                <a name="comment">
                    <h5>Question & Comment</h5>
                </a>
                <form action="{{ route('comment.store', ['id' => $spot->id]) }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="spot_id" value="{{ $spot->id }}"> <!-- spot_id を追加 -->
                    <div class="input-group mb-3">
                        <input type="text" name="comment" class="form-control form-control-sm" id="comment" placeholder="Write a question or comment">
                        <button type="submit" class="btn btn-primary btn-sm">Add</button>
                    </div>
                </form>
                <div class="card comments-container" style="max-height: 400px; overflow-y: auto;">
                    @foreach ($comments as $comment)
                        <div class="card comment-card mt-2 border-top-0">
                            <div class="card-body bg-light">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="col-auto">
                                            <a href="{{ route('profile.show', ['id' => $comment->user->id]) }}">
                                                @if ($comment->user->avatar)
                                                    <img src="{{ $comment->user->avatar }}" alt="User Avatar" class="rounded-circle" style="width: 30px; height: 30px;">
                                                @else
                                                    <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                                                @endif
                                            </a>
                                        </div>
                                        <div class="ps-2">
                                            <a href="{{ route('profile.show', ['id' => $comment->user->id]) }}" class="text-decoration-none text-dark fw-bold">
                                                {{ $comment->user->username ?? 'Unknown User' }}
                                            </a>
                                        </div>
                                    </div>
                                    <small class="text-muted">{{ $comment->created_at->format('Y.m.d') }}</small>
                                </div>
                                <!-- コメント内容とリプライボタン、削除ボタンを左右に配置 -->
                                <div class="d-flex justify-content-between mt-2">
                                    <p class="card-text mb-0">{{ $comment->body }}</p>
                                    <div>
                                        <button class="btn btn-reply btn-sm btn-link" onclick="toggleReplyForm({{ $comment->id }})">Reply</button>
                                        @if (Auth::id() === $comment->user_id)
                                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-reply btn-sm">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="reply-form mt-3" id="reply-form-{{ $comment->id }}" style="display: none;">
                                    <form action="{{ route('comment.store', ['id' => $spot->id]) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                        <textarea name="comment" rows="1" class="form-control flex-grow-1 me-2" placeholder="Reply here..."></textarea>
                                        <button type="submit" class="btn btn-outline-secondary btn-reply btn-sm">Add</button>
                                    </form>
                                </div>
                                @foreach ($comment->replies as $reply)
                                    <div class="card mt-2 ms-4">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="col-auto">
                                                        <a href="{{ route('profile.show', ['id' => $reply->user->id]) }}">
                                                            @if ($reply->user->avatar)
                                                                <img src="{{ $reply->user->avatar }}" alt="User Avatar" class="rounded-circle" style="width: 30px; height: 30px;">
                                                            @else
                                                                <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="ps-2">
                                                        <a href="{{ route('profile.show', ['id' => $reply->user->id]) }}" class="text-decoration-none text-dark fw-bold">{{ $reply->user->username }}</a>
                                                    </div>
                                                </div>
                                                <small class="text-muted">{{ $reply->created_at->format('Y.m.d') }}</small>
                                            </div>
                                            <div class="mt-2 d-flex justify-content-between">
                                                <p class="mb-0 text-muted">{{ $reply->body }}</p>
                                                @if (Auth::id() === $reply->user_id)
                                                    <form action="{{ route('comment.destroy', $reply->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-reply btn-sm r">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
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
            <h2 class="post-gallery mt-5">POST related to  <span class="spot-name">" {{$spot->name}} "</span></h2>
            <!-- Sort by dropdown -->
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle rounded-dropdown" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Sort by
                </button>
                <ul class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton">
                    
                    <!-- Clear button -->
                    <li class="text-end">
                        <span class="text-primary cursor-pointer" id="clearCheckboxes">Clear</span>
                    </li>
                    
                    <!-- Sort options -->
                    <form action="{{ route('spot.show', $spot->id) }}" method="GET" id="sortForm">
                        <li>
                            <label class="dropdown-item">
                                <input type="radio" name="sort" value="newest" class="form-check-input me-1" {{ $sort === 'newest' ? 'checked' : '' }}> Newest Post
                            </label>
                        </li>
                        <li>
                            <label class="dropdown-item">
                                <input type="radio" name="sort" value="popular" class="form-check-input me-1" {{ $sort === 'popular' ? 'checked' : '' }}> Popular
                            </label>
                        </li>
                        <li>
                            <label class="dropdown-item">
                                <input type="radio" name="sort" value="many_likes" class="form-check-input me-1" {{ $sort === 'many_likes' ? 'checked' : '' }}> Many Likes
                            </label>
                        </li>

                        <!-- Done button -->
                        <li class="text-end mt-2">
                            <button type="submit" class="btn btn-primary btn-sm">Done</button>
                        </li>
                    </form>
                </ul>
            </div>

                    <!-- Small posts -->
                    <div class="small-post-container">
                        @if (!$posts->onFirstPage())
                        <a href="{{ add_query_param($posts->previousPageUrl(), request()->query()) }}">
                            <button class="arrow-left" onclick="prevPage()">
                                <i class="fa-solid fa-circle-left"></i>
                            </button>
                        </a>
                        @endif
                        <div class="post-wrapper d-flex">
                            @foreach ($posts as $index => $post)
                            <div class="card small-post shadow-card m-2 post-card" style="cursor: pointer; width: 18rem;" onclick="location.href='{{ route('post.show', ['id' => $post->id]) }}'">
                                <!-- カード内のフォーム -->
                                <div class="carousel-inner">
                                    @foreach ($post->images as $imgIndex => $image)
                                        <div class="carousel-item {{ $imgIndex === 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $image->image_url) }}" class="d-block w-100 main-carousel-img" alt="Image {{ $imgIndex + 1 }}">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-truncate">{{ $post->title }}</h5>
                                    <p class="card-text text-truncate">{{ $post->comments }}</p>
                                    <div class="col d-flex smallpost-category justify-content-end">
                                        @foreach ($post->categories as $category)
                                            <div class="badge bg-secondary bg-opacity-50 rounded-pill">{{ $category->name }}</div>
                                        @endforeach
                                    </div>
                                    <div class="row d-flex justify-content-end pe-2">
                                        {{-- Likes and Favorites --}}
                                        <div class="d-flex align-items-center gap-3">
                                            {{-- Likes --}}
                                            <form action="{{ route('post.like', $post->id ?? 1) }}" method="POST" class="d-flex align-items-center">
                                                @csrf
                                                <button type="submit" class="btn btn-sm shadow-none p-0" aria-label="like">
                                                    <i class="fa-regular fa-heart {{ $post->isLiked() ? 'active' : '' }}" id="like-icon"></i>
                                                </button>
                                                <span class="count-text ms-1" id="like-count">{{ $post->likes->count() }}</span>
                                            </form>
                                            {{-- Favorites --}}
                                            <form action="{{ route('post.favorite', $post->id ?? 1) }}" method="POST" class="d-flex align-items-center">
                                                @csrf
                                                <button type="submit" class="btn btn-sm shadow-none p-0" aria-label="star">
                                                    <i class="fa-regular fa-star {{ $post->isFavorited ? 'active' : '' }}" id="favorite-icon"></i>
                                                </button>
                                                <span class="count-text ms-1" id="favorite-count">{{ $post->favorites->count() }}</span>
                                            </form>
                                        </div>
                                    </div>
                                    <form action="/post/show/{{$post->id}}" method="get">
                                        <button type="submit" class="btn-small-post-card">Read More</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                            @if ($posts->isEmpty())
                                <p>No posts available.</p>
                            @endif
                        </div>
                        @if ($posts->hasMorePages())
                            <a href="{{ add_query_param($posts->nextPageUrl(), request()->query()) }}">
                            <button class="arrow-right" onclick="nextPage()">
                                <i class="fa-solid fa-circle-right"></i>
                            </button>
                            </a>
                        @endif
                    </div>
                </div>
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

    <!-- JavaScript for clearing selections -->
    <script>
        document.getElementById('clearCheckboxes').addEventListener('click', function() {
        document.querySelector('input[name="sort"]:checked').checked = false;
        document.getElementById('sortForm').submit();
    });

    </script>

    <script>
    function toggleReplyForm(commentId) {
        const replyForm = document.getElementById(`reply-form-${commentId}`);
        replyForm.style.display = replyForm.style.display === "none" ? "block" : "none";
    }
    document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // ページ遷移を防ぐ
    // フォームデータを送信する処理
    });
    </script>
    
    <!-- JavaScript for "Read More" functionality -->
    <script>
        document.getElementById('read-more-btn')?.addEventListener('click', function () {
            const commentsContainer = document.querySelector('.comments-container');
            commentsContainer.innerHTML = `
                @foreach ($comments as $comment)
                    <div class="card comment-card mt-2 border-top-0">
                        <div class="card-body bg-light">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('profile.show', ['id' => $comment->user->id]) }}">
                                        @if ($comment->user->avatar)
                                            <img src="{{ $comment->user->avatar }}" alt="User Avatar" class="rounded-circle" style="width: 30px; height: 30px;">
                                        @else
                                            <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                                        @endif
                                    </a>
                                    <span class="ps-2 fw-bold">{{ $comment->user->username }}</span>
                                </div>
                                <small class="text-muted">{{ $comment->created_at->format('Y.m.d') }}</small>
                            </div>
                            <p class="card-text mt-2">{{ $comment->body }}</p>
                        </div>
                    </div>
                @endforeach
            `;
        });
    </script>

<script>
    let isScrolling = false; // スクロール中かどうかを追跡
    function nextPage() {
        if (isScrolling) return; // スクロール中の場合、次の操作をブロック
        const container = document.querySelector('.small-post-container');
        const scrollAmount = 200; // スクロールする幅
        // スクロールをスムーズに実行
        container.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
        // スクロール完了後にページ遷移
        isScrolling = true;
        setTimeout(function() {
            updatePageParam('next');
            isScrolling = false; // スクロールが完了したらフラグを戻す
        }, 500); // 500ms後にページ遷移
    }
    function prevPage() {
        if (isScrolling) return; // スクロール中の場合、次の操作をブロック
        const container = document.querySelector('.small-post-container');
        const scrollAmount = 200; // スクロールする幅
        // スクロールをスムーズに実行
        container.scrollBy({
            left: -scrollAmount,
            behavior: 'smooth'
        });
        // スクロール完了後にページ遷移
        isScrolling = true;
        setTimeout(function() {
            updatePageParam('prev');
            isScrolling = false; // スクロールが完了したらフラグを戻す
        }, 500); // 500ms後にページ遷移
    }
    function updatePageParam(direction) {
        const url = new URL(window.location);
        const currentPage = parseInt(url.searchParams.get('page')) || 1; // 現在のページを取得
        if (direction === 'next') {
            url.searchParams.set('page', currentPage + 1); // 次のページ
        } else if (direction === 'prev' && currentPage > 1) {
            url.searchParams.set('page', currentPage - 1); // 前のページ
        }
        // ページ遷移を遅延させて行う
        window.location.href = url.toString(); // ページ遷移
    }
    </script>
@endsection

@section('styles')
   
@endsection