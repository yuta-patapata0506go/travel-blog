@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/events.css')}}">
<link rel="stylesheet" href="{{asset('css/event-calender.css')}}">
@endsection


@section('content')


<!-- design starts from here -->
<div class="container background-image">
    <div class="row">
        <div class="col-md-11 event-content mx-auto">
           <!-- images -->
           <div class="images">
                <div class="logo-img text-center mt-4 mb-4">
                     <img src="{{ asset('images/Group 316.png') }}" alt="Where To Go?" class="img-fluid mb-2">
                </div>
               
            
                 <div class="eventbar">
                      <img src="{{ asset('images/eventbar.png')}}" alt="Event Banner" class="banner-img">
                      <div class="banner-text">Event</div>
                 </div>
            </div> 
        </div> 
    </div> 
    
    <!-- start of another row -->
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="spot-banner">
                <a href="{{ route('map.page', ['keyword' => request('keyword')]) }}">
                    <img src="{{ asset('images/map.png')}}"
                    class="spot-banner-img mx-auto d-block" alt="map pictures">
                    <div class="spot-banner-text">
                            <h2>Spots near You</h2>
                    </div>
                 </a>
            </div>

            {{-- Search Bar --}}
            <div class="search-container d-flex justify-content-center">
              <form class="d-flex mb-4" role="search"     method="GET" action="#">
                 
                     <input class="form-control form-control-lg me-2" type="search" name="keyword" aria-label="Search" value="{{ request('keyword') }}">
                     <button class="btn fs-3 fw-bold" type="submit">Search</button>
                </form>
          
            </div>

           
        </div> 


        <!-- Calendar Section -->
        @include('display.calender')
    
    </div> 
    
  {{-- Sort Button --}}
<form id="sort" class="sort_button" method="GET" action="{{ url()->current() }}">
    {{-- 検索キーワードがある場合 --}}
    <input type="hidden" name="keyword" value="{{ request()->input('keyword') }}">
    
    {{-- カテゴリIDが選択されている場合 --}}
    @if(isset($selectedCategory))
        <input type="hidden" name="category_id" value="{{ $selectedCategory->id }}">
    @endif

    <label for="sortOptions" class="fs-4">Sort by</label>
    <select name="sort" id="sortOptions" class="fs-4" onchange="this.form.submit()">
        <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>Newest Post</option>
        <option value="popular" {{ $sort == 'popular' ? 'selected' : '' }}>Popular</option>
        <option value="many_likes" {{ $sort == 'many_likes' ? 'selected' : '' }}>Many Likes</option>
        <option value="many_views" {{ $sort == 'many_views' ? 'selected' : '' }}>Many Views</option>
    </select>
    <i class="fa-solid fa-chevron-down icon_size"></i>
</form>




  <!-- クリックした日付のイベント表示エリア -->
<div class="event-section" id="selected-date-section" style="display: none;">
    <h2>Events on <span id="selected-date"></span></h2>
    <div id="event-list" class="event-list row">
        <!-- JavaScriptで生成されるイベントカードがここに表示されます -->
    </div>
</div>

<div class="event-section">
    <h2>Today's Events</h2>
    <div id="today-events" class="event-list row">
        <!-- JavaScriptで生成される今日のイベントカードがここに表示されます -->
    </div>
</div>

<div class="event-section">
    <h2>Tomorrow's Events</h2>
    <div id="tomorrow-events" class="event-list row">
        <!-- JavaScriptで生成される明日のイベントカードがここに表示されます -->
    </div>
</div>

<div class="event-section">
    <h2>This Month's Events</h2>
    <div id="month-events" class="event-list row">
        <!-- JavaScriptで生成される今月のイベントカードがここに表示されます -->
    </div>
</div>


             


    {{-- Posts Section --}}
  


@endsection

@section('scripts')
<script src="{{asset('js/event-calender.js')}}"></script>
@endsection