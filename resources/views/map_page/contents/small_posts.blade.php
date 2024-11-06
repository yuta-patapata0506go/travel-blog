

<div class="show_posts">
  <div class="row">
    @foreach($spots as $spot) <!-- 各スポットをループ -->
        @foreach($spot->posts as $post) <!-- 各スポットに紐づくポストをループ -->
        <div class="small_post col-md-3">
            <div class="card">
              <a href="#">
                @if ($post->images->isNotEmpty() && $post->images->first())
                    <img src="{{ asset($post->images->first()->image_url) }}" class="card-img-top" alt="Tourism Image">
                @else
                    <img src="{{ asset('images/map_samples/post_pc_sample.png') }}" class="card-img-top" alt="Default Image">
                @endif
              </a>

                <div class="card-body">

                  <div class="row">
                    <div class="col-auto">
                      <h5 class="fw-bolder">{{ $post->title }}</h5>
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

                  <!-- Category表示部分 -->
                  <div class="row">
                    <div class="col-auto mb-1">
                      @foreach($post->categories as $category)
                        <span class="badge bg-secondary bg-opacity-50 rounded-pill">{{ $category->name }}</span>
                      @endforeach
                    </div>
                  </div>

                  <div class="post_text">
                    <p>{{ $post->comments ?? '' }}</p>
                    <button class="btn comment-card">Learn More</button>
                   
                  </div>
              
                </div>
            </div>
        </div>
        @endforeach
    @endforeach
  </div>
</div>


