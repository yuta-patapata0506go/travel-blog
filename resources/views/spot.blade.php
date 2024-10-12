@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/spot.css') }}">
@endsection

@section('content')
    <div class="container">
        <!-- Card -->
        <div class="post-card">
            <!-- HEART BUTTON + no. of likes & FAVORITE BUTTON + no. of likes -->
            <div class="icons d-flex align-items-center">
                <form action="#" method="post" class="d-inline">
                    <button type="submit" class="btn btn-sm shadow-none p-0 d-flex align-items-center">
                        <i class="fa-solid fa-heart" id="like-icon"></i> <!-- Heart -->
                        <span class="ms-1" id="like-count">10</span> <!-- no. of Like -->
                    </button>
                    @csrf
                </form>
                <form action="#" method="post" class="d-inline">
                    <button type="submit" class="btn btn-sm shadow-none p-0 d-flex align-items-center">
                        <i class="fa-solid fa-star" id="favorite-icon"></i> <!-- Star -->
                        <span class="ms-1" id="favorite-count">5</span> <!-- no. of Favorite -->
                    </button>
                    @csrf
                </form>
            </div>

            <div class="spot-container">
                <!-- Main -->
                <div class="main-image">
                    <img id="featured" src="/images/castle.jpg" alt="main_image" class="img-fluid">
                </div>
                <h2 class="">Spot Name</h2>

                <!-- Thumbnail Images -->
                <div class="thumbnails">
                    <div class="thumbnail" onclick="switchImage('/images/castle.jpg')">
                        <img src="/images/castle.jpg" alt="Image1" class="img-fluid">
                    </div>
                    <div class="thumbnail" onclick="switchImage('/images/castle.jpg')">
                        <img src="/images/castle.jpg" alt="Image2" class="img-fluid">
                    </div>
                    <div class="thumbnail" onclick="switchImage('/images/castle.jpg')">
                        <img src="/images/castle.jpg" alt="Image3" class="img-fluid">
                    </div>
                    <div class="thumbnail" onclick="switchImage('/images/castle.jpg')">
                        <img src="/images/castle.jpg" alt="Image4" class="img-fluid">
                    </div>
                    <div class="thumbnail" onclick="switchImage('/images/castle.jpg')">
                        <img src="/images/castle.jpg" alt="Image5" class="img-fluid">
                    </div>

                    <!-- Right Arrow Button for Additional Images -->
                    <button class="arrow-right text-dark" onclick="nextImage()"><i class="fa-regular fa-circle-right"></i></button>
                </div>
 
                
            </div>

            <!-- Divider -->
            <hr class="divider">

                <!-- Map and Weather Display -->
                <div class="info-container">
                    <div class="map">
                        <h5>Map</h5>
                        <i class="fa-regular fa-map"></i>
                        <img src="/images/map.png" alt="">
                        <p>Map will be displayed here.</p>
                        <!-- Embed map code here -->
                    </div>
                    <div class="weather">
                        <h5>Weather</h5>
                        <i class="fa-solid fa-cloud-sun"></i>
                        <img src="/images/weather.png" alt="">
                        <p>Weather information will be displayed here.</p>
                        <!-- Embed weather code here -->
                    </div>
                </div>

                <!-- Comments -->
                <div class="comment-card mt-5">
                    <h5>Question & Comment</h5>
                    <form action="#" method="post" class="mt-3">
                            <a href="comment" ></a>
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="comment-card" class="form-control form-control-sm" id="comment" placeholder="Write a question or comment">
                                <button type="submit" class="btn btn-outline-secondary btn-sm">Add</button>
                            </div>
                    </form>
                    <div class="overflow-auto" style="height: 15rem; " >
                            <div class="card mb-3">
                                <div class="card-header bg-white border-0">
                                    <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- if user has avatar should display -->
                                                <a href="#">
                                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                                </a>
                                            </div>
                                            <div class="col ps-0">
                                                <a href="#" class="text-decoration-none text-dark">NAME</a>
                                            </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                        <div class="d-flex">
                                            <!-- Comment Text -->
                                            <div class="flex-grow-1">
                                                <p class="card-text">comment</p>
                                            </div>
                                                <!-- Reply Button & Delete Option -->
                                                <div class="ms-auto d-flex flex-column align-items-end">
                                                    @if(auth()->user() && auth()->user()->id === $comment->user_id)
                                                        <form action="{{ route('comment.delete', [$post->id, $comment->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-dark btn-sm mb-2">delete</button>
                                                        </form>
                                                    @endif
                                                    <small class="text-muted">2024.10.8</small>
                                                    <button class="btn btn-sm btn-outline-secondary mt-2 reply-button" data-comment-id="">reply</button>
                                                </div>
                                        </div>
                                        <!-- Reply Form -->
                                        <div class="reply-form mt-3" id="reply-form-" style="display: none;">
                                            <form action="#" method="POST">
                                                @csrf
                                                <div class="mb-2">
                                                    <textarea name="comment-card" rows="2" class="form-control" placeholder="reply here....."></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
                                            </form>
                                        </div>
                                        <!-- Replies (Nested Comments) -->
                                        <div class="card mt-2">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <!-- if user has avatar should display -->
                                                                <a href="#">
                                                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                                                </a>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <a href="#" class="text-decoration-none text-dark">NAME</a>
                                                            </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="card-text"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                        </div>
                    </div>
                    <p class="">No, comments </p>
                </div>

                <!-- Event and Tourism Display -->
                <div class="event-tourism-container mt-5">
                    <div class="event text-white text-shadow">
                        <h5>Event</h5>
                    </div>
                    <div class="tourism text-white text-shadow">
                        <h5>Tourism</h5>
                    </div>
                </div>

                <!-- Posts Gallery -->
                <h4 class="post-display mt-5">POST related to "SPOT NAME"</h4>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle rounded-dropdown" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort by
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <label class="dropdown-item">
                                <input type="checkbox" value="Newest Post" class="form-check-input me-1"> Newest Post
                            </label>
                        </li>
                        <li>
                            <label class="dropdown-item">
                                <input type="checkbox" value="Popular" class="form-check-input me-1"> Popular
                            </label>
                        </li>
                        <li>
                            <label class="dropdown-item">
                                <input type="checkbox" value="Many Likes" class="form-check-input me-1"> Many Likes
                            </label>
                        </li>
                        <li>
                            <label class="dropdown-item">
                                <input type="checkbox" value="Many Views" class="form-check-input me-1"> Many Views
                            </label>
                        </li>
                    </ul>
                </div>
                    <div class="post-container">
                        <button class="arrow-left text-dark" onclick="nextImage()"><i class="fa-regular fa-circle-left"></i></button>
                        @for($i = 0;$i < 5;$i++)
                            <div class="card post shadow-card">
                                <img src="{{asset('images/beer.jpg')}}" class="img-fluid" alt="Post 1">
                                <div class="card-body">
                                    <h5 class="card-title">Title</h5>
                                    <p class="card-text">Category1/ Category2</p>
                                    <p class="card-text">Short description of the tourism spot</p>
                                    <button class="btn comment-card">Learn More</button>
                                </div>
                            </div>
                        @endfor
                        <button class="arrow-right text-dark" onclick="nextImage()"><i class="fa-regular fa-circle-right"></i></button>
                    </div>
                        <!--<div class="post-container">
                        <button class="arrow-left text-dark" onclick="nextImage()"><i class="fa-regular fa-circle-left"></i></button>
                        <div class="post">
                            <img src="/images/beer.jpg" alt="Post 1" class="img-fluid">
                            <p>Post 1</p>
                        </div>
                        <div class="post">
                            <img src="/images/beer.jpg" alt="Post 2" class="img-fluid">
                            <p>Post 2</p>
                        </div>
                        <div class="post">
                            <img src="/images/beer.jpg" alt="Post 3" class="img-fluid">
                            <p>Post 3</p>
                        </div>
                        <div class="post">
                            <img src="/images/beer.jpg" alt="Post 4" class="img-fluid">
                            <p>Post 4</p>
                        </div>
                        <div class="post">
                            <img src="/images/beer.jpg" alt="Post 5" class="img-fluid">
                            <p>Post 5</p>
                        </div>
                        <button class="arrow-right text-dark" onclick="nextImage()"><i class="fa-regular fa-circle-right"></i></button>
                    </div>-->



                
            </div>
        </div>
    </div>

    <script>
        function switchImage(imagePath) {
            document.getElementById('featured').src = imagePath;
        }

        function nextImage() {
            // Logic to implement for additional images in the gallery can be added here
        }
    </script>
@endsection

@section('style')
    <style>
        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* ビューポート全体の高さ */
            background-color: rgba(0, 0, 0, 0.3); /* ここで0.15は透過率15% */
            background-image: url('/images/christmas.png'); /* 画像のパスを設定 */
            background-size: cover; /* 画像を画面全体に広げる */
            background-position: center; /* 画像の中心を表示 */
        }

        header {
            position: absolute;
            top: 0;
            width: 100%;
            background-color: #336B87;
            color: #fff;
            padding: 20px;
            text-align: center;
            z-index: 1000; /* 他のコンテンツより上に表示 */

        }

        h1 {
            margin-top: 60px; /* ヘッダーの下にスペースを作る */
        }

        /* 投稿カード */
        .post-card {
            position: relative;
            background-color: #ffffff; /* 背景を白に */
            width: auto;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 軽い影を追加して浮かせる効果 */
            border-radius: 10px; /* 角を丸くする */
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 800px; /* ナビゲーションバーとの間隔を40pxに設定 */
        }

        .icons {
            position: absolute;
            top: 10px;
            right: 20px;
            display: flex;  /* アイコンを横並びに */
        }

        .icons i {
            font-size: 40px;
            color: #888;  /* デフォルトは灰色 */
            margin-left: 10px;
            cursor: pointer;
            border-radius: 50%;  /* 丸くする */
            padding: 5px;  /* アイコンの周りにスペース */
            background: transparent;  /* 塗りつぶしなし */
        }


        #like-icon:hover {
            color:red;  /* ハートが赤くなる */
        }

        #favorite-icon:hover {
            color: #ffd700;  /* 星が金色になる */
        }

        /* その他のスタイル */
        body {
            font-family: Arial, sans-serif;
            background-color: #FBF4F4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; /* 縦方向に並べる */
            min-height: 250vh; /* ビューポート全体の高さ */
        }

        .post-card img {
            width: 100%; /* カードの幅に合わせる */
            height: auto; /* 縦横比を保持しつつ高さを自動調整 */
            max-height: 300px; /* 最大高さを300pxに設定 */
            border-radius: 10px; /* 角を丸くする */
            margin-bottom: 20px;
            object-fit: cover; /* 画像が枠内に収まるように切り取る */
        }

        /* 投稿カード内のコンテンツ */
        .post-content h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .post-content p {
            font-size: 1rem;
            color: #555;
            text-align: center;
        }

        /* 画像ギャラリー */
        .gallery {
            display: flex; /* 横並びにする */
            justify-content: space-between; /* 画像の間隔を均等にする */
            gap: 30px; /* 画像の間に隙間を作る */
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* 軽い影を追加 */
        }

        .gallery img {
            width: 70px; /* 各画像の幅を設定 */
            height: 70px; /* 各画像の高さを設定 */
            border-radius: 5px; /* 角を丸くする */
            object-fit: cover; /* 画像が枠に収まるようにする */
        }

        .arrow-right {
            position: absolute;
            top: 50%;  /* 垂直中央に配置 */
            right: 10px;  /* 右端から10pxの位置に配置 */
            transform: translateY(-50%);  /* 中央に正確に配置するために調整 */
            background: none;  /* ボタンの背景をなしに */
            border: none;  /* ボタンの枠線をなしに */
            font-size: 30px;  /* 矢印アイコンのサイズ */
            cursor: pointer;  /* ポインタをカーソルに */
        }

        .arrow-right i {
            font-size: 40px;  /* アイコンのサイズを指定 */
        }

        .arrow-right:hover {
            color: #000;  /* ホバー時に色を黒に変更 */
        }

        /* 横線のスタイル */
        .divider {
            width: 100%; /* 横線の幅をカードの幅に合わせる */
            border: none; /* デフォルトの境界線を無効にする */
            border-top: 1px solid #ccc; /* 上側の境界線を作成 */
            margin: 20px 0; /* 上下に20pxのマージンを追加 */
        }

        /* 地図と天気のコンテナ */
        .info-container {
            display: flex; /* 横並びにする */
            justify-content: center space-between; /* 要素の間にスペースを均等に配置 */
            width: 100%; /* カードの幅に合わせる */
            margin-top: 20px; /* 上に少しスペースを追加 */
            gap: 20px;  /* 要素間のスペースを20pxに設定 */
        }

        /* 地図と天気のスタイル */
        .map, .weather {
            width: 48%; /* 各要素を横に2つ並べるために48%に設定 */
            padding: 10px;
            background-color: #FBF4F4; /* 背景色 */
            border-radius: 5px; /* 角を丸くする */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* 軽い影を追加 */
        }

        /* コメントカード */
        .comment-card {
            background-color: #FBF4F4; /* カードの背景色 */
            width: calc(100% - 30px); /* 幅を100%から20px引いた値に設定 */
            padding: 20px;
            border-radius: 10px; /* 角を丸くする */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* 軽い影を追加 */
            margin-top: 20px; /* 上に少しスペースを追加 */
        }

        /* コメントフォームのスタイル */
        .comment-card text {
            width: calc(100% - 60px); /* 幅を100%から20px引いた値に設定 */
            height: 40px; /* 高さを調整 */
            padding: 10px; /* 内側の余白 */
            border-radius: 5px; /* 角を丸くする */
            border: 1px solid #ccc; /* 境界線のスタイル */
            resize: none; /* サイズ変更を無効にする */
            margin: 0; /* マージンをリセット */
        }

        .comment-card button {
            height: 40px; /* 高さを調整 */
            padding: 10px 15px; /* ボタンの内側の余白 */
            background-color: #336B87; /* ボタンの背景色 */
            color: #ffffff; /* ボタンのテキスト色 */
            border: none; /* ボタンの境界線を無効にする */
            border-radius: 5px; /* 角を丸くする */
            cursor: pointer; /* カーソルをポインターに変更 */
        }

        /* テキストエリアの横にスペースを追加したい場合 */
        .comment-card {
            padding: 10px; /* カード内のパディングを調整 */
        }

        .comment-card button:hover {
            background-color: #90AFC5; /* ホバー時の背景色 */
            color: #2A3132; /* ボタンのテキスト色 */
        }

        /* イベントと観光のスタイル */
        .event, .tourism {
            width: 48%; /* 各要素を横に2つ並べるために48%に設定 */
            padding: 10px;
            background-color: #FBF4F4; /* 背景色 */
            border-radius: 5px; /* 角を丸くする */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* 軽い影を追加 */
        }

        .event-tourism-container {
            display: flex; /* 横並びにする */
            justify-content: center space-between; /* 要素の間にスペースを均等に配置 */
            width: 100%; /* カードの幅に合わせる */
            margin-top: 20px; /* 上に少しスペースを追加 */
            gap: 20px;  /* 要素間のスペースを20pxに設定 */
            justify-content: space-around; /* コンテナ内で均等に配置 */
            text-align: center;  /* テキストを中央揃えに */
        }

        .event {
            width: 48%;
            padding: 10px;
            background-image: url('/images/market.png'); /* 背景画像を指定 */
            background-size: cover; /* 画像を要素のサイズに合わせる */
            background-position: center; /* 画像を中央に配置 */
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .tourism {
            width: 48%;
            padding: 10px;
            background-image: url('/images/sea.png'); /* 背景画像を指定 */
            background-size: cover; /* 画像を要素のサイズに合わせる */
            background-position: center; /* 画像を中央に配置 */
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .post-gallery {
            display: flex;
            justify-content: space-between; /* 要素の間隔を均等に配置 */
            margin-top: 60px;
            gap: 20px; /* ポスト間の余白を設定 */
        }

        /* 各投稿のスタイル */
        .post {
            flex: 1; /* 各投稿が均等に幅を占めるようにする */
            max-width: 18%; /* 5つ並んだときに横いっぱいになるようにする */
            background-color: #fff; /* 背景色を設定 */
            border-radius: 10px; /* 角を丸くする */
            padding: 10px; /* 内側の余白 */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* 軽い影を追加 */
            text-align: center; /* テキストを中央揃えにする */
            margin: 10px; /* マージンを追加して隙間を調整 */
        }

        .post img {
            width: 100%; /* 画像をポストの幅に合わせる */
            height: auto; /* 縦横比を保持 */
            max-height: 500px; /* 最大高さを増やす */
            border-radius: 10px; /* 角を丸くする */
            object-fit: cover; /* 画像が枠に収まるようにする */
        }

        .post-gallery .post-card {
            flex: 1; /* 各ポストカードが等しく横幅を取るようにする */
            width: calc(20% - 20px); /* 5つ並ぶように、各ポストの幅を20%に設定し、余白を考慮 */
            padding: 10px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .spot-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .main-image img {
            width: 100%;
            max-width: 800px;
            height: auto;
        }

        .thumbnails {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .thumbnail img {
            width: 100px;
            height: auto;
            cursor: pointer;
            margin: 0 5px;
        }

        .arrow-right {
            background-color: transparent;
            border: none;
            font-size: 24px;
            cursor: pointer;
            margin-top: 10px;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 10px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        .hero {
            background-color: #ffdd57;
            padding: 50px;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        footer {
            background-color: #336B87;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
@endsection