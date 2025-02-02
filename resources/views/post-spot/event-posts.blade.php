<div class="show_posts">
  <div class="container">
     <div class="row">
      <!-- レコメンド機能 recommend -->
            @if($eventRecommendations->isEmpty())
           <@foreach ($eventRecommendations as $spot)
          <a href="{{ route('spot.show', $spot->id )}}" class="small_post col-md-3">
          </a>
          @endforeach
          @else
          <div></div>
          @endif
           <!-- card -->
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

 
 <div class="post_text">
     <p class="mb-2">{{ $recommendation->post->comments ?? '' }}</p>
      <a href="{{ route('post.show', $recommendation->post->id )}}" >
           <button class="btn comment-card">Learn More</button>
     </a>
 </div>
              

    </div>
        </div>
  </div>
</a>
 @endforeach
@endif
</div>

<!-- レコメンド以外で表示するポスト -->

<div class="row">
        <div class="col-md event-content">
           <!-- カテゴリ名または「検索結果」を表示 -->
           <div>
               @if(isset($selectedCategory))
                    <h2>Posts related to "{{$selectedCategory->name}}"</h2>
                @elseif(!empty($query))
                    <h2>Search results for "{{ $query }}"</h2> <!-- 検索キーワードを表示 -->
                @else
                    <h2>Event posts</h2> 
                @endif
           </div>
           </div>

<div class="show_posts">
  <div class="row">
      @if($posts->isEmpty())
      <!-- 投稿が存在しない場合のメッセージ -->
       <div class="col-md text-center no-posts-message">
           <h3>No related posts available.</h3>
      </div>
      @else
       @foreach($posts as $post) <!-- 各スポットに紐づくポストをループ -->
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
                    <p class="mb-2">{{ $post->comments ?? '' }}</p>
                    <a href="{{ route('post.show', $post->id )}}" >
                      <button class="btn comment-card">Learn More</button>
                    </a>
                   
                  </div>
              
                </div>
            </div>
          </a>
        </div>
        @endforeach
        @endif

   
  </div>
</div>

  