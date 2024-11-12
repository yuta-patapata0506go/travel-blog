<div class="show_posts">
  <div class="container">
     <div class="row">
      <!-- レコメンド機能 recommend -->
          <h3>Recommended Events Posts</h3>
            @if($eventRecommendations->isEmpty())
          <a href="{{ route('spot.show', $spot->id )}}" class="text-decoration-none">
          <div class="col-12">
               <p class="text-center text-danger">No recommendations available at the moment.</p>
         </div>
           <!-- card -->
            @else
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
     <p>{{ Str::limit($recommendation->post->comments, 50) }}</p>
<a href="{{ route('post.show', $recommendation->post->id) }}"  class="btn comment-card">Learn More</></a>
   </div>

    </div>
        </div>
  </div>
</a>
 @endforeach
@endif
</div>
  <div class="row">
    
    @foreach ($posts as $post)
      <div class="small_post col-md-3">
        <div class="card">
          
          <a href="{{ route('post.show', ['id' => $post->id]) }}">
  <img src="{{ $post->images->isNotEmpty() ? asset('storage/' . $post->images->first()->image_url) : asset('images/default.png') }}" class="card-img-top" alt="Tourism Image">
</a>
          
        
  <div class="card-body">
    <div class="row">
       <div class="col-auto">
           <h5 class="fw-bolder">{{$post->title}}</h5>
              </div>
                  <div class="col-auto">
                     <form action="#">
                        <button type="submit" class="btn btn-sm shadow-none p-0"><i class="fa-regular fa-heart"></i></button>
                      </form>
                    </div>
                    <div class="col-auto p-0">
                      <form action="#">
                        <button type="submit" class="btn btn-sm shadow-none p-0"><i class="fa-regular fa-star"></i></button>
                      </form>
                    </div>
                  </div>

                  
                    <div class="col-auto mb-1">
                      <span class="badge bg-secondary bg-opacity-50 rounded-pill">Category</span>
                      <span class="badge bg-secondary bg-opacity-50 rounded-pill">Category</span>
                    </div>
                  </div>
                  <div class="post_text">
                    
                    <button class="btn comment-card">Learn More</button>
                   
                  </div>
              
            </div>
         </div>
          
            @endforeach
        </div>
  </div>


  