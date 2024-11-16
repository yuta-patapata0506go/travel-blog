

<div class="show_posts">
  <div class="row">
    @foreach($spots as $spot) <!-- 各スポットをループ -->
        @foreach($spot->posts as $post) <!-- 各スポットに紐づくポストをループ -->
        <div class="small_post col-md-3">
          <a href="{{ route('post.show', $post->id )}}" class="text-decoration-none text-black">
            <div class="card">
              
                @if ($post->images->isNotEmpty() && $post->images->first())
                    <img src="{{ asset('storage/' . $post->images->first()->image_url) }}" class="card-img-top" alt="Tourism Image">
                @else
                    <img src="{{ asset('images/map_samples/post_pc_sample.png') }}" class="card-img-top" alt="Default Image">
                @endif
              

                <div class="card-body">

                  <div class="row">
                    <div class="col-auto">
                      <h5 class="fw-bolder post_title text-truncate">{{ $post->title }}</h5>
                    </div>
                  </div>


                  <div class="row d-flex justify-content-end pe-2">
                      {{-- Likes --}}
                    <div class="col-auto">
                      <form action="{{ route('post.like', $post->id ?? 1) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm shadow-none p-0" aria-label="like">
                            <i class="fa-regular fa-heart {{ $post->isLiked() ? 'active' : '' }}" id="like-icon"></i>
                        </button>
                        <span class="count-text ms-1" id="like-count">{{ $post->likes->count() }}</span>
                    </form>
                      {{-- <form action="#">
                        <button type="submit" class="btn btn-sm shadow-none p-0"><i class="fa-regular fa-heart"></i></button>
                      </form> --}}
                    </div>

                    {{-- Favorites --}}
                    <div class="col-auto p-0">
                      <form action="{{ route('post.favorite', $post->id ?? 1) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm shadow-none p-0" aria-label="star">
                            <i class="fa-regular fa-star {{ $post->isFavorited ? 'active' : '' }}" id="favorite-icon"></i>
                        </button>
                        <span class="count-text ms-1" id="favorite-count">{{ $post->favorites->count() }}</span>
                      </form>
                      {{-- <form action="#">
                        <button type="submit" class="btn btn-sm shadow-none p-0"><i class="fa-regular fa-star"></i></button>
                      </form> --}}
                    </div>
                  </div>
                    
                  

                  <!-- Category表示部分 -->
                  <div class="row">
                    <div class="col-auto mb-1">
                      @foreach($post->categories as $category)
                        <span class="badge bg-secondary bg-opacity-50 rounded-pill">{{ $category->name }}</span>
                      @endforeach
                    </div>
                  </div>

                  <!-- comments部分 & Buttno -->
                  <div class="post_text">
                    <p class="mb-2 text-truncate">{{ $post->comments ?? '' }}</p>
                    <a href="{{ route('post.show', $post->id )}}" >
                      <button class="btn comment-card">Learn More</button>
                    </a>
                   
                  </div>
              
                </div>
            </div>
          </a>
        </div>
        @endforeach


    @endforeach
  </div>
</div>


