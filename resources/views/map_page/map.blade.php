@extends('layouts.app')

@section('css')

{{-- CSS --}}
<link rel="stylesheet" href="{{ asset('css/map.css') }}">
@endsection

@section('title', 'Map View')

@section('content')
<div class="map_container">
  <h2 class="fs-1 fw-bolder mb-4">Search from the map</h2>

 <div class="row justify-content-between">
    {{-- Search Bar --}}
    <div class="col-auto search-container d-flex justify-content-left">
        <form class="d-flex mb-4" role="search" method="GET" action="{{ route('map.page') }}">
            <input type="hidden" name="latitude" value="{{ request('latitude') }}">
            <input type="hidden" name="longitude" value="{{ request('longitude') }}">
            <input class="form-control form-control-lg me-2" type="search" aria-label="Search" name="keyword" aria-label="Search" value="{{ old('keyword', request('keyword', $keyword ?? '')) }}">
            <i class="fas fa-search icon_size"></i>
            <button class="btn fs-3 fw-bold" type="submit">Search</button>
        </form>
    </div>

    <div class="col-auto back">
        <a href="javascript:history.go(-2)">
            <button type="button" class="btn"><i class="fa-solid fa-chevron-left"></i> Back</button>
        </a>
    </div>


 </div>
  
  

 

 {{-- Map --}}

    <div id="map" class="map mb-5"></div>

               
  {{-- Spots Section --}}
  @include('map_page.contents.small_spots')

  {{-- Posts Section --}}
  @include('map_page.contents.small_posts')
    
  </div>


  {{-- Mapbox JavaScript --}}
  <script>
    document.addEventListener("DOMContentLoaded", () => {
    mapboxgl.accessToken = '{{ env("MAPBOX_API_KEY") }}';

    //Pre-generate the image URL path within Blade and pass it to JavaScript.
    // const storagePath = "{{ asset('storage/images') }}";

    
    const urlParams = new URLSearchParams(window.location.search);
    const latitude = urlParams.get('latitude');
    const longitude = urlParams.get('longitude');
    const keyword = urlParams.get('keyword'); // 検索キーワードも取得

    // Only fetch geolocation if latitude and longitude are not in URL parameters
    if (!latitude || !longitude) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const userLatitude = position.coords.latitude;
            const userLongitude = position.coords.longitude;
            
            // 現在の検索ワードが存在すればURLに追加
            const searchKeyword = keyword ? `&keyword=${encodeURIComponent(keyword)}` : '';

            // Redirect to the page with latitude and longitude only if not present
            window.location.href = `{{ route('map.page') }}?latitude=${userLatitude}&longitude=${userLongitude}${searchKeyword}`;
        });
    } else {
        // Initialize the map with the latitude and longitude from URL parameters
        fetch(`{{ route('map.index') }}?latitude=${latitude}&longitude=${longitude}&keyword=${encodeURIComponent(keyword || '')}`)
            .then(response => response.json())
            .then(data => {
                const map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/streets-v11',
                    center: [longitude, latitude], // Use URL params for user location
                    zoom: 9
                });

                // マーカーを追加し、ピンが画面に収まるようにするための `bounds` オブジェクトを作成
                const bounds = new mapboxgl.LngLatBounds();


                // Marker and Popup of User's Current Location
                const userLocationPopup = `
                            <div class="current_locaiton_popup">
                                <p>Your current location</p>
                            </div>
                        `;
                new mapboxgl.Marker({ color: 'blue' })
                    .setLngLat([longitude, latitude])
                    .setPopup(new mapboxgl.Popup().setHTML(userLocationPopup))
                    .addTo(map);

                    bounds.extend([longitude, latitude]); // 現在地も含める

                // Marker and Popup of Spots
                data.spots.forEach(spot => {
                    if (spot.latitude && spot.longitude) {

                        const spotUrl = `{{ url('/spot') }}/${spot.id}`; // 'spot.show' ルートに対応するURLを生成

                        const popupContent = `
                            <div class="spot_popup">
                                <a href="${spotUrl}" class="small_spot">
                                    <img src="${spot.images.length>0?"storage/"+spot.images[0].image_url:"images/map_samples/spot_pc_sample.png"}" alt="Spot Image" >
                                </a>
                                <a href="${spotUrl}" class="spot_name">
                                    <p>${spot.name}</p>
                                </a>
                            </div>
                        `;

                        new mapboxgl.Marker()
                            .setLngLat([spot.longitude, spot.latitude])
                            .setPopup(new mapboxgl.Popup().setHTML(popupContent))  // HTML形式でポップアップを設定
                            .addTo(map);

                        // 各スポットの座標を `bounds` に追加
                        bounds.extend([spot.longitude, spot.latitude]);
                    }
                });

                // マップをすべてのマーカーが表示されるようにズーム・位置調整
                if (data.spots.length > 0) {
                    map.fitBounds(bounds, { padding: 50 });
                }
            })
            .catch(error => console.error('Error:', error));
    }
});


</script>
 @endsection
