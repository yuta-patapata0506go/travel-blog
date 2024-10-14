<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spot Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <nav>WhereToGo Navbar</nav>     
    </header>

    <!-- Card -->
    <div class="post-card">
        <!-- HEART BUTTON + no. of likes & FAVORITE BUTTON + no. of likes -->
        <div class="icons row align-items-center">
            <i class="fa-solid fa-regular fa-heart" id="like-icon"></i>  <!-- Heart -->
            <i class="fa-solid fa-regular fa-star" id="favorite-icon"></i>  <!-- Star -->
        </div>
        <div class="spot-container">
            <!-- Main -->
             <div class="main-image">
                <img id="featured" src="/images/26.png" alt="main_image">
             </div>
             <h1>TOKYO TOWER (Spot Name)</h1>

            <!-- Thumbnail 2枚目以降 -->
            <div class="thumbnails">
                <div class="thumbnail" onclick="switchImage('/images/01.png')">
                    <img src="/images/01.png" alt="Image1">
                </div>
                <div class="thumbnail" onclick="switchImage('/images/10.png')">
                    <img src="/images/10.png" alt="Image2">
                </div>
                <div class="thumbnail" onclick="switchImage('/images/11.png')">
                    <img src="/images/11.png" alt="Image3">
                </div>
                <div class="thumbnail" onclick="switchImage('/images/13.png')">
                    <img src="/images/13.png" alt="Image4">
                </div>
                <div class="thumbnail" onclick="switchImage('/images/14.png')">
                    <img src="/images/14.png" alt="Image5">
                </div>
            </div>

            <!-- 右矢印ボタンで追加画像をスクロール -->
            <button class="arrow-right" onclick="nextImage()">→</button>
        </div>
         
        <!--<img src="/images/pexels-spdel-3375997" alt="Tokyo Tower">
        <img src="/images/197a83081ab1acc3e4fd0ac385546aae_1200x1200" alt="">
        <div class="post-content">
            <p>This is the landmark in Tokyo (Detail)</p>
        </div>-->
        
        <!-- 画像ギャラリー -->
        <!--<div class="gallery">
            <img src="/images/01.png" alt="Photo 1">
            <img src="/images/10.png" alt="Photo 2">
            <img src="/images/11.png" alt="Photo 3">
            <img src="/images/13.png" alt="Photo 4">
            <img src="/images/14.png" alt="Photo 5">
        </div>-->
        
        <!-- 横線 -->
        <hr class="divider">
        
        <!-- 地図と天気の表示 -->
        <div class="info-container">
            <div class="map">
                <h3>Map</h3>
                <p>Map will be displayed here.</p>
                <!-- 地図の埋め込みコードなどをここに追加 -->
            </div>
            <div class="weather">
                <h3>Weather</h3>
                <p>Weather information will be displayed here.</p>
                <!-- 天気情報の埋め込みコードなどをここに追加 -->
            </div>
        </div>
        <!-- コメントフォーム -->
        <div class="comment-card">
            <h3>Questions for Everyone: Anyone can ask or answer here!</h3>
            <form>
                <textarea placeholder="Your comment here..." rows="4"></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>
        <!-- EventとTourismの表示 -->
        <div class="event-tourism-container">
            <div class="event">
                <h3>Event</h3>
                <p></p>
                <!-- 埋め込みコードなどをここに追加 -->
            </div>
            <div class="tourism">
                <h3>Tourism</h3>
                <p></p>
                <!-- 埋め込みコードなどをここに追加 -->
            </div>
        </div>
        <!-- 5つの投稿カード -->
        <div class="post-gallery">
            <div class="post">
                <img src="/images/01.png" alt="Post 1">
                <p>Post 1</p>
            </div>
            <div class="post">
                <img src="/images/10.png" alt="Post 2">
                <p>Post 2</p>
            </div>
            <div class="post">
                <img src="/images/11.png" alt="Post 3">
                <p>Post 3</p>
            </div>
            <div class="post">
                <img src="/images/13.png" alt="Post 4">
                <p>Post 4</p>
            </div>
            <div class="post">
                <img src="/images/14.png" alt="Post 5">
                <p>Post 5</p>
            </div>
        </div>
    </div>

    @yield('content')

        <!-- ここにJavaScriptコードを追加します -->
    <script>
        function switchImage(imagePath) {
        document.getElementById('featured').src = imagePath;
        }

        function nextImage() {
        // 追加の画像をサムネイルに反映させるロジックをここに追加
        }
    </script>

</body>
</html>