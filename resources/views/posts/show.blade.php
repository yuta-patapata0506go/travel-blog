<link rel="stylesheet" href="{{asset('css/posts.css')}}">
@extends('layouts.app')

@section('title', 'Post')

@section('content')
<div class="container background  ">
   <div class="card my-4">
      <div class="card-body1 bg-white p-5">

            <h2>{{ $post->title }}</h2>
                <div class="row align-items-center">
                        <div class="col-auto">
                            <!-- if user has avatar should display -->
                            <a href="{{ route('profile.show', ['id' => $post->user->id]) }}">
                            @if ($post->user->avatar)
                                <img src="{{ $post->user->avatar }}" alt="User Avatar" class="rounded-circle" style="width: 40px; height: 40px;">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                            @endif
                        </a>
                        </div>
                        <div class="col ps-0">
                            <a href="{{ route('profile.show', ['id' => $post->user->id]) }}" class="text-decoration-none text-dark fw-bold">
                                {{ $post->user->username }}
                            </a>
                        </div>
                        <div class="col-auto ps-0">
                            <!-- 投稿の所有者のみ表示 -->
                            @if (Auth::id() === $post->user_id)
                                <div class="dropdown">
                                    <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                    
                                    <div class="dropdown-menu">
                                        <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                                            <i class="fa-regular fa-edit"></i> Edit
                                        </a>
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-post">
                                            <i class="fa-regular fa-trash-can"></i> Delete
                                        </button>
                                    </div>
                                    
                                    {{-- Delete モーダルを含む --}}
                                    @include('posts.modals.delete')
                                </div>
                            @endif
                        </div>
                </div>
            

                <!-- Image Display Section -->
            <div class="card col mt-3" style="height: auto;">
                <!-- Main Image Carousel -->
                <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel" style="max-height: 500px;">
                    <div class="carousel-inner">
                        @foreach ($post->images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <!-- Storageパスを解決して画像を表示 -->
                                <img src="{{ asset('storage/' . $image->image_url) }}" class="d-block w-100 main-carousel-img" alt="Image {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>

                    <!-- Carousel Controls (Previous/Next) -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Thumbnail Images as Carousel Indicators -->
                <div class="carousel-indicators-wrapper mt-3 d-flex justify-content-center gap-2 flex-wrap">
                    @foreach ($post->images as $index => $image)
                        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}">
                            <img src="{{ asset('storage/' . $image->image_url) }}" class="thumbnail-img" alt="Thumbnail {{ $index + 1 }}">
                        </button>
                    @endforeach
                </div>
            </div>


            <div class="row align-items-center">
                <!-- Event Name -->
                @if ($post->type ==0)
                    <!-- Event Name -->
                    <div class="col-auto">
                        <h2 class="event-name mt-3 p-2 border rounded">{{ $post->event_name }}</h2>
                    </div>
                @endif


                <!-- Category Group -->
                <div class="col d-flex justify-content-end">
                @foreach ($post->categories as $category)
                    <div class="badge bg-secondary bg-opacity-50 m-2">{{ $category->name }}</div>
                @endforeach
                </div>
            </div>


            <!-- Comments -->
            <p class="mt-3">
                {{ $post->comments}}
            </p>

            <!-- post Date -->
            <small class="text-muted"> {{ $post->created_at->format('Y-m-d') }}</small>

            <!-- Button -->
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end align-items-center button-container">
                            <!-- comment count -->
                            <div class="d-flex align-items-center me-3">
                                <a href="#comment" class="no-link-style">
                                    <i class="fa-regular fa-comment"></i>
                                </a>
                                <span class="count-text ms-1">{{ $commentCount }}</span>
                            </div>

                           <!-- Heart Count -->
                            <div class="d-flex align-items-center me-3 mt-3">
                                <form action="{{ route('post.like', $post->id ?? 1) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm shadow-none p-0" aria-label="like">
                                        <i class="fa-regular fa-heart {{ $post->isLiked() ? 'active' : '' }}" id="like-icon"></i>
                                    </button>
                                    <span class="count-text ms-1" id="like-count">{{ $post->likes->count() }}</span>
                                </form> {{--FIXED!!8 --}}
                            </div>

                            <!-- Star Count -->
                            <div class="d-flex align-items-center me-3 mt-3">
                                <form action="{{ route('post.favorite', $post->id ?? 1) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm shadow-none p-0" aria-label="star">
                                        <i class="fa-regular fa-star {{ $post->isFavorited ? 'active' : '' }}" id="favorite-icon"></i>
                                    </button>
                                    <span class="count-text ms-1" id="favorite-count">{{ $post->favorites->count() }}</span>
                                </form>
                            </div>

                            <!-- Share Button -->
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-share" data-bs-toggle="modal" data-bs-target="#shareModal"></i>
                        </div>

                        <!-- Share Modal -->
                        <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="shareModalLabel">Share This Post</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Share this post on social media or copy the link:</p>
                                        
                                        <!-- Social Media Icons -->
                                        <div class="d-flex justify-content-center mb-3">
                                            <a href="#" id="facebookShare" class="me-3"><i class="fa-brands fa-facebook fa-2x" style="color: #3b5998;"></i></a>
                                            <a href="#" id="twitterShare" class="me-3"><i class="fa-brands fa-x-twitter fa-2x" style="color: #000000;"></i></a>
                                            <a href="https://instagram.com/" id="instagramShare"><i class="fa-brands fa-instagram fa-2x" style="color: #C13584;"></i></a>
                                        </div>
                                        
                                        <!-- Copy Link Section -->
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="shareLink" readonly>
                                            <button class="btn btn-outline-secondary" onclick="copyLink()">Copy Link</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <!-- map -->  
            <div class="row mt-3">            
                <div class="col-6 map ">
                     <div class="card3 border-0  bg-white" style="height: 20rem;">
                        <div class="card-body">
                           <a href="{{ route('spot.show', ['id' => $post->spot->id]) }}">
                            @if ($post->spot)
                                <a href="{{ route('spot.show', ['id' => $post->spot->id]) }}">
                                    <h3><i class="fa-solid fa-location-dot"></i> {{ $post->spot->name }}</h3>
                                </a>
                            @else
                                <p><i class="fa-solid fa-location-dot"></i> Location not available</p>
                            @endif
                            </a>                
                            <iframe 
                                src="https://www.google.com/maps?q={{ $post->spot->latitude ?? 0 }},{{ $post->spot->longitude ?? 0 }}&output=embed"
                                width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen="">
                            </iframe>
                            <p class="mt-1">Postal/Zip code:{{ $post->spot->postalcode ?? 'N/A' }}</p>
                            <p>{{ $post->spot->address ?? 'N/A' }}</p>
                        </div>
                     </div>
                </div>

               <!-- Detail -->
                <div class="col-6">
                    <div class="card3 bg-white ps-4 mb-3  rounded-0" style="height: 20rem; border-left: 1px solid black; border-top: none; border-right: none; border-bottom: none;">
                        <div class="card-body">
                            <!-- event ID がであれば表示する -->
                            @if ($post->type == 0)
                                <h5 class="fw-bold" style="margin-bottom: 5px;">Event Date</h5>

                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <!-- Start Date -->
                                    @if (!empty($post->start_date))
                                        <div style="flex: 1; text-align: center; margin: 0; padding: 0;">
                                            <p style="margin: 0;">Start Date:</p>
                                            <p style="margin: 0; font-size: 1.2em;">{{ $post->start_date->format('Y-m-d') }}</p>
                                            <small style="display: block; color: gray; margin: 0;">({{ $post->start_date->diffForHumans() }})</small>
                                        </div>
                                    @endif

                                    <!-- 矢印またはハイフン -->
                                    <div style="text-align: center; color: gray;">
                                        ➔ <!-- 矢印の代わりに "-" を表示したい場合は、ここを "-" に変更 -->
                                    </div>

                                    <!-- End Date -->
                                    @if (!empty($post->end_date))
                                        <div style="flex: 1; text-align: center; margin: 0; padding: 0;">
                                            <p style="margin: 0;">End Date:</p>
                                            <p style="margin: 0; font-size: 1.2em;">{{ $post->end_date->format('Y-m-d') }}</p>
                                            <small style="display: block; color: gray; margin: 0;">({{ $post->end_date->diffForHumans() }})</small>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            <br>

                            <div>
                                <!-- Adult Fee -->
                                @if (!empty($post->adult_fee) && !empty($post->adult_currency))
                                <h5 class="fw-bold">Fee</h5>
                                    <p>
                                        <strong>Adult Fee:</strong> 
                                        {{ $post->adult_fee }} 
                                        <small>{{ $post->adult_currency }}</small>
                                    </p>
                                @endif

                                <!-- Child Fee -->
                                @if (!empty($post->child_fee) && !empty($post->child_currency))
                                    <p>
                                        <strong>Child Fee:</strong> 
                                        {{ $post->child_fee }} 
                                        <small>{{ $post->child_currency }}</small>
                                    </p>
                                @endif
                            </div>

                            @if (!empty($post->helpful_info))
                                <h5 class="fw-bold">Useful Information About This Spot</h5>
                                <p>&middot; &nbsp; {{ $post->helpful_info }}</p>
                            @endif

                                                        
                        </div>
                    </div>
                </div>
           </div>
           <hr>


           @include('posts.comment')

              
      </div>        
   </div>
</div>
@endsection
@section('scripts')

    <script src="{{ asset('js/share.js') }}"></script>

@endsection


