<div class="show_spot mt-4 bg-white">
  <div class="row">
    @forelse ($spots as $spot)
        <div class="small_spot col-md-4 mb-4">
            <div class="card">
              @if ($spot->images->isNotEmpty())
              <a href="#">
                  <img src="{{ asset('storage/' . $spot->images->first()->image_url) }}" class="card-img-top" alt="{{ $spot->name }}">
              </a>
              @else
                  <a href="#">
                      <img src="{{ asset('images/map_samples/spot_pc_sample.png') }}" class="card-img-top" alt="Default Image">
                  </a>
              @endif
                
                <div class="card-body">

                  <div class="row">
                    <div class="col-auto">
                      <a href="#" class="text-dark text-decoration-none ">
                        <h5 class="fw-bolder text-truncate spot_name">{{ $spot->name }}</h5>
                      </a>
                    </div>
  
                    <div class="row">
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

                    {{-- <p class="card-text text-truncate">{{ $spot->address }}</p> --}}
                    
                  </div>
                  
                </div>
            </div>
        </div>
    @empty
        <p>No nearby spots found.</p>
    @endforelse
  </div>
</div>