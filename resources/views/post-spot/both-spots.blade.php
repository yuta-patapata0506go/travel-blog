<div class="show_spot mt-5 bg-white">
  <div class="row">
    @forelse ($spots as $spot)
        <div class="small_spot col-md-4 mb-4">
          <a href="{{ route('spot.show', $spot->id )}}" class="text-decoration-none">
            <div class="card">
              @if ($spot->images->isNotEmpty())
                  <img src="{{ asset('storage/' . $spot->images->first()->image_url) }}" class="card-img-top" alt="{{ $spot->name }}">
            
              @else
                  
                      <img src="{{ asset('images/map_samples/spot_pc_sample.png') }}" class="card-img-top" alt="Default Image">
                
              @endif
                
                <div class="card-body">

                  <div class="row">
                    <div class="col-auto">
                    
                        <h5 class="fw-bolder text-truncate spot_name">{{ $spot->name }}</h5>

                    </div>
  
                    <div class="row d-flex justify-content-end pe-2">

                      {{-- Likes --}}
                        <div class="col-auto">
                            <form action="{{ route('spot.like', $spot->id ?? 1) }}" method="POST">
                              @csrf
                              <button type="submit" class="btn btn-sm shadow-none p-0" aria-label="like">
                                  <i class="fa-regular fa-heart {{ $spot->isLiked() ? 'active' : '' }}" id="like-icon"></i>
                              </button>
                              <span class="count-text ms-1" id="like-count">{{ $spot->likes->count() }}</span>
                             </form>
                         
                        </div>

                        {{-- Favorites --}}
                        <div class="col-auto p-0">
                            <form action="{{ route('spot.favorite', $spot->id ?? 1) }}" method="POST">
                              @csrf
                              <button type="submit" class="btn btn-sm shadow-none p-0" aria-label="star">
                                  <i class="fa-regular fa-star {{ $spot->isFavorited ? 'active' : '' }}" id="favorite-icon"></i>
                              </button>
                              <span class="count-text ms-1" id="favorite-count">{{ $spot->favorites->count() }}</span>
                            </form>

                        </div>
                    </div>

                    {{-- <p class="card-text text-truncate">{{ $spot->address }}</p> --}}
                    
                  </div>
                  
                </div>
            </div>
          </a>
        </div>
    @empty
        <p>No nearby spots found.</p>
    @endforelse
  </div>
</div>
