<head>
    <link rel="stylesheet" href="{{ asset('css/admin/modals.css') }}"> <!-- link modal.css -->
  </head>
  
  {{-- Visible (Unhide) --}}
  <div class="modal fade" id="unhide-post-{{ $post->id }}"> {{-- id: unhide-post-{{ $post->id }} --}}
    <div class="modal-dialog w-50 text-center">
        <div class="modal-content border-dark">
            <div class="modal-header border-dark text-center bg-dark">
                <h5 class="modal-title text-light mx-auto">
                    <i class="fa-solid fa-eye"></i> Unhide Post
                </h5>
            </div>
            <div class="modal-body">
                <div class="mt-3">
                    <i class="fa-solid fa-newspaper fa-4x"></i>
                    <p class="mt-1 text-muted">Post ID: {{ $post->id }}</p> {{-- ポストIDを表示 --}}
                </div>
                <i class="fa-solid fa-triangle-exclamation fa-4x"></i>
                <p>Are you sure you want to unhide this post?</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <form action="{{ route('admin.posts.unhide', $post->id) }}" method="post"> {{-- 適切なルートを設定 --}}
                    @csrf
                    @method('PATCH')
  
                    <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark btn-sm">Unhide</button>
                </form>
            </div>
        </div>
    </div>
  </div>
  
  {{-- Hidden (Hide) --}}
  <div class="modal fade" id="hide-post-{{ $post->id }}"> {{-- id: hide-post-{{ $post->id }} --}}
    <div class="modal-dialog w-50 text-center">
        <div class="modal-content border-dark">
            <div class="modal-header border-dark text-center bg-dark">
                <h5 class="modal-title text-light mx-auto">
                    <i class="fa-solid fa-eye-slash"></i> Hide Post
                </h5>
            </div>
            <div class="modal-body">
                <div class="mt-3">
                    <i class="fa-solid fa-newspaper fa-4x"></i>
                    <p class="mt-1 text-muted">Post Title: {{ $post->title }}</p> {{-- ポストタイトルを表示 --}}
                </div>
                <i class="fa-solid fa-triangle-exclamation fa-4x"></i>
                <p>Are you sure you want to hide this post?</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <form action="{{ route('admin.posts.hide', $post->id) }}" method="post"> {{-- 適切なルートを設定 --}}
                    @csrf
                    @method('DELETE')
  
                    <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark btn-sm">Hide</button>
                </form>
            </div>
        </div>
    </div>
  </div>
  