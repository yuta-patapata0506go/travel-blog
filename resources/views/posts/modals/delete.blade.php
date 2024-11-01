<link rel="stylesheet" href="{{asset('css/modal.css')}}">


<div class="modal fade" id="delete-post">
   <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header justify-content-center">
                <h3 class="h5 modal-title ">
                    Delete Post
                </h3>
            </div>

            <div class="modal-body text-center">
                <div class="mt-3">
                    <img src="{{ $firstImage ? $firstImage->image_url : '' }}" alt="Post Image" class="image-lg">
                    <p class="mt-1 text-muted">Title: {{ $post->title }}</p>
                </div>
                <div class="mt-1">
                    <i class="fa-solid fa-triangle-exclamation fa-4x"></i>
                    <p class="fw-bold">Are you sure you want to delete this post?</p>
                </div>
            </div>

            <div class="modal-footer border-0 justify-content-center">
                 <form action="{{ route('post.destroy', $post->id) }}" method="post">

                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-modal btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-modal btn-sm">Delete</button>

                </form>  
            </div>
        </div>
       
   </div>
</div>
