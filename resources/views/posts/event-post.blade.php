
<link rel="stylesheet" href="{{asset('css/tourism.css')}}">

@extends('layouts.app')



@section('content')

<div class="container background-image  ">
<div class="card my-4">
    <div class="card-body1 bg-white p-5">
            <h1>This is an Event Page !!!!!</h1>
            <div class="row align-items-center">
                    <div class="col-auto">
                        <!-- if user has avatar should display -->
                        <a href="#">
                            <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                        </a>
                    </div>
                    <div class="col ps-0">
                        <a href="#" class="text-decoration-none text-dark">NAME</a>
                    </div>
                 

                    <div class="col-auto ps-0 ">
                        <!-- IF you are the OWNER of the post, you can EDIT or DELETE the post -->                 
                            <div class="dropdown">
                                    <button class="btn btn-sm shadow-none"  data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                
                                    <div class="dropdown-menu">
                                        <a href="" class="dropdown-item">
                                            <i class="fa-regular fa-edit"></i>Edit
                                        </a>
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#">
                                            <i class="fa-regular fa-trash-can"></i>Delete
                                        </button>
                                    </div>
                                    <!-- Modal for delete post -->
                            </div>
                    </div>
            </div>

            <!-- Image -->
            <div class="card col mt-3" style="height: auto;">
                <!-- Main Image -->
                <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel" style="max-height: 500px;">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/firework.jpeg') }}" class="d-block w-100 main-carousel-img" alt="Firework Image 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/firework2.jpeg') }}" class="d-block w-100 main-carousel-img" alt="Firework Image 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/firework3.jpeg') }}" class="d-block w-100 main-carousel-img" alt="Firework Image 3">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/beach.jpeg') }}" class="d-block w-100 main-carousel-img" alt="Beach Image">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/firework5.jpeg') }}" class="d-block w-100 main-carousel-img" alt="Another Image">
                        </div>
                    </div>

                    <!-- カルーセルのコントロール（前後に移動） -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- SubImages(thumbnail) -->
                <div class="carousel-indicators-wrapper mt-3 d-flex justify-content-center gap-2 flex-wrap">
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">
                        <img src="{{ asset('images/firework.jpeg') }}" class="thumbnail-img" alt="Firework Thumbnail 1">
                    </button>
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1" aria-label="Slide 2">
                        <img src="{{ asset('images/firework2.jpeg') }}" class="thumbnail-img" alt="Firework Thumbnail 2">
                    </button>
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2" aria-label="Slide 3">
                        <img src="{{ asset('images/firework3.jpeg') }}" class="thumbnail-img" alt="Firework Thumbnail 3">
                    </button>
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="3" aria-label="Slide 4">
                        <img src="{{ asset('images/beach.jpeg') }}" class="thumbnail-img" alt="Beach Thumbnail">
                    </button>
                    <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="4" aria-label="Slide 5">
                        <img src="{{ asset('images/firework5.jpeg') }}" class="thumbnail-img" alt="Another Thumbnail">
                    </button>
                </div>
            </div>
  



            <div class="row align-items-center">
                <!-- Event Name -->
                <div class="col-auto">
                    <h2 class="event-name mt-3 p-2 border rounded"> Event Title </h2>
                </div>

                <!-- Category Group -->
                <div class="col d-flex justify-content-end">
                    <div class="badge bg-secondary bg-opacity-50 me-2">category1</div>
                    <div class="badge bg-secondary bg-opacity-50">category2</div>
                </div>
            </div>


            <!-- Comments -->
            <p class="mt-3">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero laudantium et, ducimus id ut error delectus incidunt omnis quas saepe officia temporibus exercitationem cum? Asperiores itaque maiores aperiam illum at?</p>
            </p>

            <!-- Date -->
            <small class="text-muted"> Date</small>

            <!-- Button -->
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end align-items-center button-container">
                            <!-- commnt count -->
                            <div class="d-flex align-items-center me-3">
                                <a href="#comment" class="no-link-style">
                                    <i class="fa-regular fa-comment"></i>
                                </a>
                                <span class="count-text ms-1">3</span>
                            </div>

                            <!-- Heart Count -->
                            <div class="d-flex align-items-center me-3 mt-3">
                                <form action="#" method="post" class="d-flex align-items-center">
                                    @csrf
                                    <button type="submit" class="btn btn-sm shadow-none p-0" aria-label="いいね">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                    <span class="count-text ms-1">3</span>
                                </form>
                            </div>

                            <!-- Star count-->
                            <div class="d-flex align-items-center me-3 mt-3">
                                <form action="#" method="post" class="d-flex align-items-center">
                                    @csrf
                                    <button type="submit" class="btn btn-sm shadow-none p-0" aria-label="スター">
                                        <i class="fa-regular fa-star"></i>
                                    </button>
                                    <span class="count-text ms-1">3</span>
                                </form>
                            </div>

                            <!-- Share-->
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-share"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <!-- map -->  
            <div class="row mt-3">            
                <div class="col-6 map ">
                     <div class="card3 border-0  bg-white" style="height: 20rem;">
                        <div class="card-body">
                            <a href="#" class="">
                                    <i class="fa-solid fa-location-dot"></i> Spot name
                            </a>                
                            <iframe 
                                src="https://www.google.com/maps?q= &output=embed"
                                width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen="">
                            </iframe>
                            <p>〒123-4567</p>
                            <p>730 Nagi, Narita City, Chiba Prefecture, Japan</p>
                        </div>
                     </div>
                </div>

               <!-- Detail -->
                <div class="col-6">
                    <div class="card3 bg-white ps-4 mb-3  rounded-0" style="height: 20rem; border-left: 1px solid black; border-top: none; border-right: none; border-bottom: none;">
                        <div class="card-body">
                        <h5 class="fw-bold">Event Date</h5>
                            <p>2024/8/1</p>
                            <h5 class="fw-bold">Fee</h5>
                            <p>Free</p>
                            <h5>Useful Information About This Spot</h5>
                            <p> &middot; &nbsp; It's better to go earier</p>
                            <p> &middot; &nbsp; It's better to go earier</p>
                            <p> &middot; &nbsp; It's better to go earier</p>
                        </div>
                    </div>
                </div>
           </div>
           <hr>


                            <!-- Comments -->
                            <div class="comments-section my-2">
                            <a name="comment"> <h5>Question & Comment</h5></a> 
                                <form action="#" method="post" class="mt-3">
                                    <a href="comment"></a>
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="text" name="comment" class="form-control form-control-sm" id="comment" placeholder="Write a question or comment">
                                        <button type="submit" class="btn">Add</button>
                                    </div>
                                </form>  

                                <!-- コメントセクションにスクロールバーを付与 -->
                                <div class="card comments-container" style=" max-height: 400px; overflow-y: auto;"> 
                                    <!-- 各コメントをカードで表示 -->
                                    <div class="card comment-card ">
                                        <div class="card-body bg-white">
                                            <!-- 名前と日付を左右に配置 -->
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="col-auto">
                                                        <a href="#">
                                                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                                        </a>
                                                    </div>         
                                                    <div class="ps-2">
                                                        <a href="#" class="text-decoration-none text-dark fw-bold">NAME</a>
                                                    </div>
                                                </div>
                                                <small class="text-muted">2024.10.8</small> <!-- 日付を右側に配置 -->
                                            </div>

                                            <!-- コメントとリプライボタンを左右に配置 -->
                                            <div class="d-flex align-items-center justify-content-between mt-2">
                                                <p class="card-text mb-0">comment</p>
                                                <button class="btn btn-reply btn-sm" data-comment-id="">reply</button>
                                            </div>

                                            <!-- Reply Form -->
                                            <div class="reply-form mt-3" id="reply-form-" style="display: none;">
                                                <form action="#" method="POST">
                                                    @csrf
                                                    <div class="mb-2">
                                                        <textarea name="comment" rows="2" class="form-control" placeholder="reply here....."></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
                                                </form>
                                            </div>

                                            <!-- Replies (Nested Comments) -->
                                            <div class="card mt-2">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <div class="col-auto">
                                                                <a href="#">
                                                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                                                </a>
                                                            </div>         
                                                            <div class="ps-2">
                                                                <a href="#" class="text-decoration-none text-dark fw-bold">NAME</a>
                                                            </div>
                                                        </div>
                                                        <!-- 日付を右側に配置 -->
                                                        <small class="text-muted">2024.10.8</small>
                                                    </div>
                                                    <div class="mt-2">
                                                        <p class="mb-0 text-muted">reply comment here</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <p class="">No, comments </p>
            </div>
        </div>
      
    </div>
</div>



@endsection
