
@include('mypage.modal.menu')
  <div class="container-mypage">
        <div class="row justify-content-center">
            <div class="col-4">
              @if ($user->avatar)
                  <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle d-block mx-auto avatar-size">                 
              @else
                  <i class="fa-regular fa-circle-user d-block text-end icon-big"></i>
                  
              @endif
            </div>
       
          <div class="col-8">
            <div class="row mb-3">
              <div class="col-auto">
                <h1 class="m-2 text-s36 fw-bold">{{$user->username}}</h1>
              </div>
              

              <div class="col-auto p-2">
                @if (Auth::user()->id === $user->id)
                <button type="button" class="btn-green text-center" data-bs-toggle="modal" data-bs-target="#select-menu-{{ $user->id }}">
                  Menu
              </button>
          
                
                  @else
                 @if ($user->isFollowed())
                    <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-black">Following</button> 
                    </form> 
                  @else
                    <form action="{{ route('follow.store', $user->id)}}" method="post">
                      @csrf
                      <button type="submit" class="btn btn-green">Follow</button>
                    </form>
                  @endif
                @endif
              </div>
              <p class="text-s16 dark-text">Bio: {{$user->introduction}}</p>

            </div>
            <div class="row">
              <div class="col-auto">
                  <strong>{{ $user->posts->count() ." "}}</strong>{{ $user->posts->count() <=1 ? 'Post':'Posts '}}
              </div>
              <div class="col-auto">
                <a href="{{route('profile.followers',$user->id)}}" class="text-decoration-none text-dark">
                  <strong>{{ $user->followers->count() }}</strong> {{ $user->followers->count() <= 1? 'Follower':'Followers'}}
                </a> 
        
              </div>
              <div class="col-auto">
                <a href="{{route('profile.following', $user->id)}}" class="text-decoration-none text-dark">
                  <strong>{{ $user->following->count() }}</strong> Following
                </a>
              </div>
            </div>
            
          </div>    
        </div>
  </div>
