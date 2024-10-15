 


  <div class="container-mypage">
        <div class="row justify-content-center">
            <div class="col-4">
              {{-- @if ($user->avatar)
                  <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
                  
              @else --}}
                  <i class="fa-regular fa-circle-user d-block text-end icon-big"></i>
                  
              {{-- @endif --}}
            </div>
          <div class="col-8">
            <div class="row mb-3">
              <div class="col-auto">
                <h2 class="display-6 mb-0 text-s48"> USER NAME </h2>
              </div>
              <div class="col-auto p-2">
                {{--@if (Auth::user()->id === $user->id) --}}
                    <a href="#" class="btn mx-5 my-3 fw-bold btn-green">Edit Profile</a>
                {{--@else
                  @if ($user->isFollowed())
                    <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-2 fw-bold">Following</button>
                    </form> 
                  @else
                    <form action="{{ route('follow.store', $user->id)}}" method="post">
                      @csrf
                      <button type="submit" class="btn btn-3 fw-bold">Follow</button>
                    </form>
                  @endif
                @endif
              </div> --}}
            </div>
            {{-- <div class="row mb-3">
              <div class="col-auto">
                <a href="#" class="text-decoration-none text-dark">
                  <strong>{{ $user->posts->count() }}</strong> {{ $user->posts->count() <=1 ? 'Post':'Posts '}}
                </a>
              </div>
              <div class="col-auto">
                <a href="{{ route('profile.followers', $user->id)}}" class="text-decoration-none text-dark">
                  <strong>{{ $user->followers->count() }}</strong> {{ $user->followers->count() <= 1? 'Follower':'Followers'}}
                </a>
        
              </div>
              <div class="col-auto">
                <a href="{{ route('profile.following', $user->id)}}" class="text-decoration-none text-dark">
                  <strong>{{ $user->following->count() }}</strong> Following
                </a>
              </div>
            </div> --}}
            <p class="fw-bold text-s24 dark-text"> BIO: I love traveling. </p>
          </div>    
        </div>
  </div>
