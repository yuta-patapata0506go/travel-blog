@section('css')
  <link rel="stylesheet" href="{{ asset('css/style_personal.css')}}">  
@endsection

<div class="mypage-bg"> 
          
      <div class="d-flex justify-content-center">
        <div class="search-container d-flex justify-content-left mb-4">
            <form class="d-flex mb-4" role="search" action="{{ route('mypage.search') }}" method="GET">
                <!-- Search Input -->
                <input 
                    class="form-control form-control-lg me-2" 
                    type="search" 
                    name="keyword" 
                    value="{{ request('keyword') }}" 
                    placeholder="Search here..." 
                    aria-label="Search"
                >
                <i class="fas fa-search icon_size"></i>
                <!-- Submit Button -->
                <button class="btn fs-3 fw-bold" type="submit">Search</button>
            </form>
        </div>
    </div>      
</div>    


            