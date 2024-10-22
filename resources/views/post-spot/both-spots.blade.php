<div class="show_spot mt-4 bg-white">
  <div class="row">
    @for ($i = 0; $i < 6; $i++)
        <div class="small_spot col-md-4 mb-4">
            <div class="card">
                <a href="#" >
                  <img src="{{ asset('images/map_samples/spot_pc_sample.png') }}" class="card-img-top " alt="Tourism Image">
                </a>
                
                <div class="card-body">

                  <div class="row">
                    <div class="col-auto">
                      <h5 class="fw-bolder">Spot Name</h5>
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

                    <div class="row mb-1">
                      <div class="col-auto">
                        <span class="badge bg-secondary bg-opacity-50 rounded-pill">Category</span>
                        <span class="badge bg-secondary bg-opacity-50 rounded-pill">Category</span>
                      </div>
                    </div>
                    <p class="card-text">Adless:-----</p>
                    
                  </div>
                  
                </div>
            </div>
        </div>
    @endfor
  </div>
</div>