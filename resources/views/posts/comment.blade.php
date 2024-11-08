<div class="comments-section my-2">
    <a name="comment">
        <h5>Question & Comment</h5>
    </a>
    <form action="{{ route('comment.store', ['id' => $post->id]) }}" method="POST" class="mt-3">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="comment" class="form-control form-control-sm" id="comment" placeholder="Write a question or comment">
            <button type="submit" class="btn btn-primary btn-sm">Add</button>
        </div>
    </form>

    <div class="card comments-container" style="max-height: 400px; overflow-y: auto;">
        @foreach ($comments as $comment)
            <div class="card comment-card mt-2 border-top-0">
                <div class="card-body bg-light">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('profile.show', ['id' => $comment->user->id]) }}">
                                    @if ($comment->user->avatar)
                                        <img src="{{ $comment->user->avatar }}" alt="User Avatar" class="rounded-circle" style="width: 30px; height: 30px;">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="ps-2">
                                <a href="{{ route('profile.show', ['id' => $comment->user->id]) }}" class="text-decoration-none text-dark fw-bold">
                                    {{ $comment->user->username ?? 'Unknown User' }}
                                </a>
                            </div>
                        </div>
                        <small class="text-muted">{{ $comment->created_at->format('Y.m.d') }}</small>
                    </div>

                    <!-- コメント内容とリプライボタン、削除ボタンを左右に配置 -->
                    <div class="d-flex justify-content-between mt-2">
                        <p class="card-text mb-0">{{ $comment->body }}</p>
                        <div>
                            <button class="btn btn-reply btn-sm btn-link" onclick="toggleReplyForm({{ $comment->id }})">Reply</button>
                            @if (Auth::id() === $comment->user_id)
                                <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-reply btn-sm">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="reply-form mt-3" id="reply-form-{{ $comment->id }}" style="display: none;">
                        <form action="{{ route('comment.store', ['id' => $post->id]) }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <textarea name="comment" rows="1" class="form-control flex-grow-1 me-2" placeholder="Reply here..."></textarea>
                            <button type="submit" class="btn btn-outline-secondary btn-reply btn-sm">Add</button>
                        </form>
                    </div>

                    @foreach ($comment->replies as $reply)
                        <div class="card mt-2 ms-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="col-auto">
                                            <a href="{{ route('profile.show', ['id' => $reply->user->id]) }}">
                                                @if ($reply->user->avatar)
                                                    <img src="{{ $reply->user->avatar }}" alt="User Avatar" class="rounded-circle" style="width: 30px; height: 30px;">
                                                @else
                                                    <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                                                @endif
                                            </a>
                                        </div>
                                        <div class="ps-2">
                                            <a href="{{ route('profile.show', ['id' => $reply->user->id]) }}" class="text-decoration-none text-dark fw-bold">{{ $reply->user->username }}</a>
                                        </div>
                                    </div>
                                    <small class="text-muted">{{ $reply->created_at->format('Y.m.d') }}</small>
                                </div>
                                <div class="mt-2 d-flex justify-content-between">
                                    <p class="mb-0 text-muted">{{ $reply->body }}</p>
                                    @if (Auth::id() === $reply->user_id)
                                        <form action="{{ route('comment.destroy', $reply->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-reply btn-sm r">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
function toggleReplyForm(commentId) {
    const replyForm = document.getElementById(`reply-form-${commentId}`);
    replyForm.style.display = replyForm.style.display === "none" ? "block" : "none";
}
</script>
