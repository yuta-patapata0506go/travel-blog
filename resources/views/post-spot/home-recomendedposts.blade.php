<div class="row">
    <!-- レコメンド機能 recommend -->
    @if(!$tourismRecommendations->isEmpty() || !$eventRecommendations->isEmpty())
    @foreach ($tourismRecommendations as $spot)
        <a href="{{ route('spot.show', $spot->id) }}" class="small_post col-md-3">
            <!-- コンテンツ表示 -->
        </a>
    @endforeach
@else
    <div>
    </div>
@endif
        <!-- Tourism Recommendations -->
        @if(!$tourismRecommendations->isEmpty())
            <h2>Tourism Recommendations</h2>
            @foreach ($tourismRecommendations->take(4) as $recommendation)
                <div class="small_post col-md-3">
                    <div class="card">
                        <a href="{{ route('post.show', $recommendation->post->id) }}">
                            <img src="{{ asset('storage/' . $recommendation->post->images->first()->image_url) }}" class="card-img-top" alt="Post Image">
                        </a>
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <h5 class="fw-bolder">{{ $recommendation->post->title }}</h5>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-end pe-2">
                                {{-- Likes --}}
                                <div class="col-auto">
                                    <form action="{{ route('post.like', $recommendation->post->id ?? 1) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm shadow-none p-0" aria-label="like">
                                            <i class="fa-regular fa-heart {{ $recommendation->post->isLiked() ? 'active' : '' }}" id="like-icon"></i>
                                        </button>
                                        <span class="count-text ms-1" id="like-count">{{ $recommendation->post->likes->count() }}</span>
                                    </form>
                                </div>
                                <div class="col-auto p-0">
                                    <form action="{{ route('post.favorite', $recommendation->post->id ?? 1) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm shadow-none p-0" aria-label="star">
                                            <i class="fa-regular fa-star {{ $recommendation->post->isFavorited ? 'active' : '' }}" id="favorite-icon"></i>
                                        </button>
                                        <span class="count-text ms-1" id="favorite-count">{{ $recommendation->post->favorites->count() }}</span>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-auto mb-1">
                                    @foreach ($recommendation->post->categories as $category)
                                        @if ($category->id == $recommendedCategory->id) <!-- レコメンドされたカテゴリのみ表示 -->
                                            <span class="badge bg-secondary bg-opacity-50 rounded-pill">{{ $category->name }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <!-- 投稿の本文を制限して表示 -->
                            <div class="post_text">
                                <p class="mb-2">{{ $recommendation->post->comments ?? '' }}</p>
                                <a href="{{ route('post.show', $recommendation->post->id )}}">
                                    <button class="btn comment-card">Learn More</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- Event Recommendations -->
        @if(!$eventRecommendations->isEmpty())
            <h2>Event Recommendations</h2>
            @foreach ($eventRecommendations->take(4) as $recommendation)
                <div class="small_post col-md-3">
                    <div class="card">
                        <a href="{{ route('post.show', $recommendation->post->id) }}">
                            <img src="{{ asset('storage/' . $recommendation->post->images->first()->image_url) }}" class="card-img-top" alt="Post Image">
                        </a>
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <h5 class="fw-bolder">{{ $recommendation->post->title }}</h5>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-end pe-2">
                                {{-- Likes --}}
                                <div class="col-auto">
                                    <form action="{{ route('post.like', $recommendation->post->id ?? 1) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm shadow-none p-0" aria-label="like">
                                            <i class="fa-regular fa-heart {{ $recommendation->post->isLiked() ? 'active' : '' }}" id="like-icon"></i>
                                        </button>
                                        <span class="count-text ms-1" id="like-count">{{ $recommendation->post->likes->count() }}</span>
                                    </form>
                                </div>
                                <div class="col-auto p-0">
                                    <form action="{{ route('post.favorite', $recommendation->post->id ?? 1) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm shadow-none p-0" aria-label="star">
                                            <i class="fa-regular fa-star {{ $recommendation->post->isFavorited ? 'active' : '' }}" id="favorite-icon"></i>
                                        </button>
                                        <span class="count-text ms-1" id="favorite-count">{{ $recommendation->post->favorites->count() }}</span>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-auto mb-1">
                                    @foreach ($recommendation->post->categories as $category)
                                        @if ($category->id == $recommendedCategory->id) <!-- レコメンドされたカテゴリのみ表示 -->
                                            <span class="badge bg-secondary bg-opacity-50 rounded-pill">{{ $category->name }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <!-- 投稿の本文を制限して表示 -->
                            <div class="post_text">
                                <p class="mb-2">{{ $recommendation->post->comments ?? '' }}</p>
                                <a href="{{ route('post.show', $recommendation->post->id )}}">
                                    <button class="btn comment-card">Learn More</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
         @endif
</div>