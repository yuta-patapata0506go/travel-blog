@extends('layouts.app')

@section('title', 'Edit Profile')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/style_personal.css')}}">  
@endsection

@section('content')
<div class="mypage-bg">
  <div class="container-mypage">
        <div class="row justify-content-center">
        <div class="col-8">
          <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          
          <div class="row mb-3">
            <div class="col-5 mt-5">
              @if ($user->avatar)
                  <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle d-block mx-auto avatar-size">
              @else
                <div style="font-size:8rem">
                  <i class="fa-regular fa-circle-user d-block text-center"></i>
                </div>
                  
              @endif
                
                  <input type="file" name="avatar" id="avatar" class="form-control mt-3" aria-describedby="avatar-info">
                    <div id="avatar-info" class="form-text text-dark">
                      Acceptable formats: jpeg, jpg, png, gif only.<br>
                      Max file size:1048Kb.
                    </div>          
            </div>      
            <div class="col-2"></div>
            <div class="col-5">
              <div class="row">
                  <div class="mb-5">
                    <label for="username" class="form-label label-text text-s24 mb-0">User Name</label>
                      <input type="text" name="username" id="username" class="form-control" placeholder="User Name" value="{{old('username', $user->username)}}" autofocus>
                    @error('username')
                    <p class="text-danger small">{{ $message }}</p>
                    @enderror
                  </div>
              </div>
            

              <div class="row">              
                  <div class="mb-5">
                      <label for="email" class="form-label label-text text-s24 mb-0">Email Address</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" value="{{old('email', $user->email)}}">
                      @error('email')
                      <p class="text-danger small">{{ $message }}</p>
                      @enderror
                  </div>
              </div>
                
                <div class="row">            
                    <div class="mb-3">
                      <label for="introduction" class="form-label label-text text-s24 mb-0">Bio</label>
                      <textarea name="introduction" id="introduction" rows="5" class="form-control" placeholder="Describe yourself">{{old('introduction', $user->introduction)}}</textarea>
                      @error('introduction')
                      <p class="text-danger small">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
              </div>
              
          </div>   
          <button type="submit" class="btn btn-green mx-3">Save</button>
          <a href="{{route('profile.show', Auth::user()->id)}}" class="btn btn-black">Cancel</a>
        </form>
        </div>
      </div>
  </div>  
  
</div>
@endsection