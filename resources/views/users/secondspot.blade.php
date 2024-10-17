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
    <style>
        body {
            background-image: url('/images/christmas.png'); /* Background image */
            background-size: cover; /* Cover the entire viewport */
            background-position: center; /* Center the background */
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #336B87;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .post-card {
            background-color: #ffffff;
            width: 100%;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 500px; /* Adjusted for header */
            margin-bottom: 200px;
        }

        .thumbnails {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            
        }

        .thumbnail {
            cursor: pointer;
            flex: 1;
            margin-right: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* 軽い影を追加 */
        }

        .thumbnail:last-child {
            margin-right: 0; /* Remove margin for the last item */
        }

        .info-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .comment-card {
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* 軽い影を追加 */
        }

        .post-gallery {
            display: flex;
            justify-content: space-between;
            flex-wrap: nowwrap;
            margin-top: 20px;
            overflow-x: auto; /* 必要に応じて横スクロールを有効にする */
        }

        .post {
            flex: 18%; /* Allow 5 posts per row */
            margin-right: 10px;
            text-align: center;
        }

        .post:last-child {
            margin-right: 0; /* Remove margin for the last item */
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

        .arrow-right {
            background-color: #336B87;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <nav>WhereToGo Navbar</nav>
    </header>

    <div class="container">
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
                </div>

                <!-- Right Arrow Button for Additional Images -->
                <button class="arrow-right" onclick="nextImage()">→</button>
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

            <!-- Comment Form -->
            <div class="comment-card">
                <h5>Questions for Everyone: Anyone can ask or answer here!</h5>
                <form>
                    <textarea placeholder="Your comment here..." rows="4" class="form-control"></textarea>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>

            <!-- Event and Tourism Display -->
            <div class="event-tourism-container mt-4">
                <div class="event text-white">
                    <h5>Event</h5>
                    <p>Your event description here...</p>
                </div>
                <div class="tourism text-white text-shadow">
                    <h5>Tourism</h5>
                    <p>Your tourism description here...</p>
                </div>
            </div>

            <!-- Posts Gallery -->
            <div class="post-gallery mt-4">
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

    <footer>
        <p>&copy; 2024 WhereToGo. All Rights Reserved.</p>
    </footer>
</body>
</html>  