@extends('layouts.app')

@section('css')
{{-- Mapbox CSS --}}
<link href='https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css' rel='stylesheet' />
{{-- CSS --}}
<link rel="stylesheet" href="{{ asset('css/map.css') }}">
@endsection

@section('title', 'Map View')

@section('content')
<div class="map_container">
  <h2 class="fs-1 fw-bolder mb-4">Search from the map</h2>

  {{-- Search Bar --}}

  <div class="search-container d-flex justify-content-left">
      <form class="d-flex mb-4" role="search">
          <input class="form-control form-control-lg me-2" type="search" aria-label="Search">
          <i class="fas fa-search icon_size"></i>
          <button class="btn fs-3 fw-bold" type="submit">Search</button>
      </form>
  </div>

{{-- Map --}}

    <div id="map" ></div>

  
{{-- Sort Button --}}
  <form id="sort" class="sort_button">
    <label for="sortOptions" class="fs-4">Sort by</label>
    <select name="price" id="sortOptions" class="fs-4">
        <option value="1">Recommended</option>
        <option value="2">Newest Post</option>
        <option value="3">Popular</option>
        <option value="4">Many Likes</option>
        <option value="5">Many Views</option>
    </select>
    <i class="fa-solid fa-chevron-down icon_size"></i>
  </form>
               
  {{-- Spots Section --}}
  @include('map_page.contents.small_spots')

  {{-- Posts Section --}}
  @include('map_page.contents.small_posts')
    
  </div>

  {{-- Mapbox JavaScript --}}
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js'></script>
  <script>
        document.addEventListener("DOMContentLoaded", () => {
    mapboxgl.accessToken = '{{ env("MAPBOX_API_KEY") }}';
    
    const urlParams = new URLSearchParams(window.location.search);
    const latitude = urlParams.get('latitude');
    const longitude = urlParams.get('longitude');
    // Only fetch geolocation if latitude and longitude are not in URL parameters
    if (!latitude || !longitude) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const userLatitude = position.coords.latitude;
            const userLongitude = position.coords.longitude;
            // Redirect to the page with latitude and longitude only if not present
            window.location.href = `{{ route('map.page') }}?latitude=${userLatitude}&longitude=${userLongitude}`;
        });
    } else {
        // Initialize the map with the latitude and longitude from URL parameters
        fetch(`{{ route('map.index') }}?latitude=${latitude}&longitude=${longitude}`)
            .then(response => response.json())
            .then(data => {
                const map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/streets-v11',
                    center: [longitude, latitude], // Use URL params for user location
                    zoom: 10
                });
                new mapboxgl.Marker({ color: 'blue' })
                    .setLngLat([longitude, latitude])
                    .setPopup(new mapboxgl.Popup().setText('Your current location'))
                    .addTo(map);
                data.spots.forEach(spot => {
                    if (spot.latitude && spot.longitude) {
                        new mapboxgl.Marker()
                            .setLngLat([spot.longitude, spot.latitude])
                            .setPopup(new mapboxgl.Popup().setText(spot.name))
                            .addTo(map);
                    }
                });
            })
            .catch(error => console.error('Error:', error));
    }
});



</script>
@endsection



