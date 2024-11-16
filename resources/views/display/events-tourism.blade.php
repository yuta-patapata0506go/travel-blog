
@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{asset('css/events-tourism.css')}}">

<!-- desaign is from here -->
<div class="container background-image">
  <div class="row">
        <div class="col-md-11 event-content mx-auto">
           <!-- images -->
             <div class=" images">
                 <div class="logo-img text-center mt-4 mb-4">
                     <img src="{{ asset('images/Group 316.png') }}" alt="Where To Go?" class="img-fluid mb-2">
                 </div>
    
          {{-- Search Bar --}}
          <div class="search-container d-flex justify-content-center">
                  <form class="d-flex mb-4" role="search"     method="GET" action="{{ route('events-tourism.posts.search') }}">
                     <input class="form-control form-control-lg me-2" type="search" name="keyword" aria-label="Search" value="{{ request('keyword') }}">
                     <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                     <button class="btn fs-3 fw-bold" type="submit">Search</button>
                </form>
          
            </div>
            
                    <!-- category part -->
            <div class="categories">
                @foreach($parentCategories as $parent)
                  <div class="parent-category">
                        <a href="{{ route('events-tourism.category', ['category_id' => $parent->id]) }}">{{ $parent->name }}</a>
                        <div class="child-categories">
                              @foreach($parent->children as $child)
                                 <a href="{{ route('events-tourism.category', ['category_id' => $child->id]) }}">{{ $child->name }}</a>
                              @endforeach
                      </div>
                 </div>
                @endforeach
            </div>

        </div>
    </div> 


                <!-- Event and Tourism Display  -->
                  <div class="image-container">
                    <div class="image-item">
                      <a href="{{ route('display.events') }}"> <!-- イベントページへのリンク -->
                         <img src="images/event-link.png" alt="Event Page">
                         <div class="overlay-text">Event Page</div>
                      </a>
                    </div>
                    <div class="image-item">
                       <a href="{{ route('display.tourism') }}"> <!-- ツーリズムページへのリンク -->
                          <img src="images/tourism-link.png" alt="Tourism Page">
                          <div class="overlay-text">Tourism Page</div>
                       </a>
                    </div>
                </div>
                
                <div class="image-container">
                      <div class="image-item">
                        <a href="{{ route('display.events', ['keyword' => request('keyword'), 'category_id' => request('category_id')]) }}">
                           <img src="{{asset('images/event-link.png')}}" alt="Event Page">
                           <div class="overlay-text">Event Page</div>
                        </a>
                      </div>
                      <div class="image-item">
                        <a href="{{ route('display.tourism', ['keyword' => request('keyword'), 'category_id' => request('category_id')]) }}">
                            <img src="{{asset('images/tourism-link.png')}}" alt="Tourism Page">
                            <div class="overlay-text">Tourism Page</div>
                         </a>
                      </div>
                </div>

    {{-- Sort Button --}}
        <form id="sort" class="sort_button" method="GET" action="{{ url()->current() }}">
    {{-- 検索キーワードがある場合 --}}
        <input type="hidden" name="keyword" value="{{ request()     ->input('keyword') }}">
    {{-- カテゴリIDが選択されている場合 --}}
        @if(isset($selectedCategory))
        <input type="hidden" name="category_id" value="{{ $selectedCategory->id }}">
         @endif

    <label for="sortOptions" class="fs-4">Sort by</label>
    <select name="sort" id="sortOptions" class="fs-4" onchange="this.form.submit()">
        <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>Newest</option>
        <option value="popular" {{ $sort == 'popular' ? 'selected' : '' }}>Popular</option>
        <option value="many_likes" {{ $sort == 'many_likes' ? 'selected' : '' }}>Many Likes</option>
        <option value="many_views" {{ $sort == 'many_views' ? 'selected' : '' }}>Many Views</option>
    </select>
    <i class="fa-solid fa-chevron-down icon_size"></i>
</form>



                   

        


{{-- Spots Section --}}
@include('map_page.contents.small_spots')

{{-- Posts Section --}}
@include('post-spot.both-posts')

  
  </div>
  </div>
  </div>
  @endsection
  
  


