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
          <form action="#" method="post" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          
          <div class="row mb-3">
            <div class="col-5 mt-5">
              {{-- @if ($user->avatar)
                  <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
              @else --}}
                <div style="font-size:8rem">
                  <i class="fa-regular fa-circle-user d-block text-center"></i>
                </div>
                  
              {{-- @endif --}}
                
                  <input type="file" name="avatar" id="avatar" class="form-control mt-3" aria-describedby="avatar-info">
                    <div id="avatar-info" class="form-text">
                      Acceptable formats: jpeg, jpg, png, gif only.<br>
                      Max file size:1048Kb.
                    </div>          
            </div>      
            <div class="col-2"></div>
            <div class="col-5">
              <div class="row">
                  <div class="mb-5">
                    <label for="name" class="form-label label-text text-s24 mb-0">User Name</label>
                      <input type="text" name="name" id="name" class="form-control" placeholder="User Name" value="" autofocus>
                    @error('name')
                    <p class="text-danger small">{{ $message }}</p>
                    @enderror
                  </div>
              </div>
            

              <div class="row">              
                  <div class="mb-5">
                      <label for="email" class="form-label label-text text-s24 mb-0">Email Address</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" value="">
                      @error('email')
                      <p class="text-danger small">{{ $message }}</p>
                      @enderror
                  </div>
              </div>
                
                <div class="row">            
                    <div class="mb-3">
                      <label for="bio" class="form-label label-text text-s24 mb-0">Bio</label>
                      <textarea name="bio" id="bio" rows="5" class="form-control" placeholder="Describe yourself"></textarea>
                      @error('bio')
                      <p class="text-danger small">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
              </div>
              
          </div>   
          <button type="submit" class="btn btn-green mx-3">Save</button>
          <button type="button" class="btn btn-black">Cancel</button>
        </form>
        </div>
      </div>
  </div>
  
</div>
@endsection