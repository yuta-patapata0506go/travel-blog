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


    const urlParams = new URLSearchParams(window.location.search);
    const keyword = urlParams.get('keyword'); // 検索キーワードも取得

    // セッションから緯度・経度を取得
    const sessionLatitude = "{{ session('latitude') }}";
    const sessionLongitude = "{{ session('longitude') }}";


    if (!sessionLatitude || !sessionLongitude) {
        // ユーザーの緯度・経度がセッションにない場合のみ現在地を取得
        navigator.geolocation.getCurrentPosition(function(position) {
            const userLatitude = position.coords.latitude;
            const userLongitude = position.coords.longitude;

            // 現在の検索ワードが存在すればURLに追加
            const searchKeyword = keyword ? `&keyword=${encodeURIComponent(keyword)}` : '';

            // セッションに緯度・経度を保存するためのAPIエンドポイントへリクエスト
            fetch(`{{ route('save.location') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ latitude: userLatitude, longitude: userLongitude })
            }).then(() => {
                // ページをリロードしてセッションから緯度・経度を読み込む
                window.location.reload();
            }).catch(error => console.error('Error saving location:', error));
        });

    } else {
        // セッションに緯度・経度が保存されている場合、それを利用して地図を初期化
        // 検索キーワードもパラメータに含めてAPIリクエスト
        fetch(`{{ route('map.index') }}?keyword=${encodeURIComponent(keyword)}`)
            .then(response => response.json())
            .then(data => {
                const map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/streets-v11',
                    center: [sessionLongitude, sessionLatitude], // セッションの緯度・経度を使用
                    zoom: 9
                });

                const bounds = new mapboxgl.LngLatBounds();

                // ユーザーの現在地をマーカーで表示
                const userLocationPopup = `<div class="current_location_popup"><p class="fw-bold">Your location</p></div>`;
                new mapboxgl.Marker({ color: 'blue' })
                    .setLngLat([sessionLongitude, sessionLatitude])
                    .setPopup(new mapboxgl.Popup().setHTML(userLocationPopup))
                    .addTo(map);

                bounds.extend([sessionLongitude, sessionLatitude]);

                // スポットのマーカー表示
                data.spots.forEach(spot => {
                    if (spot.latitude && spot.longitude) {
                        const spotUrl = `{{ url('/spot') }}/${spot.id}`;
                        const popupContent = `
                            <div class="spot_popup">
                                <a href="${spotUrl}" class="small_spot">
                                    <img src="${spot.images.length > 0 ? "storage/" + spot.images[0].image_url : "images/map_samples/spot_pc_sample.png"}" alt="Spot Image">
                                </a>
                                <a href="${spotUrl}" class="spot_name">
                                    <p>${spot.name}</p>
                                </a>
                            </div>
                        `;
                        new mapboxgl.Marker()
                            .setLngLat([spot.longitude, spot.latitude])
                            .setPopup(new mapboxgl.Popup().setHTML(popupContent))
                            .addTo(map);

                        bounds.extend([spot.longitude, spot.latitude]);
                    }
                });

                if (data.spots.length > 0) {
                    map.fitBounds(bounds, { padding: 50 });
                }
            })
            .catch(error => console.error('Error:', error));
    }
});

    </script>
 @endsection
