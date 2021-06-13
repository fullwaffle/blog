@foreach($comments as $comment)
        <div class="d-flex {{ $margin }}">
            <!-- Parent comment-->
            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
            <div class="ms-3">
                <div class="fw-bold">{{ $comment->user->login }}</div>
                {{ $comment->body }}
                @auth
                    <form method="post" action="{{ route('reply.add') }}">
                        @csrf
                        <div class="form-group mb-1">
                            <input type="text" name="comment_body" class="form-control" />
                            <input type="hidden" name="post_id" value="{{ $post_id }}" />
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-warning" value="Reply" />
                        </div>
                    </form>
                @endauth
                @include('partials.comment_replies', ['comments' => $comment->replies, 'margin' => 'mt-4'])
            </div>
        </div>
@endforeach
