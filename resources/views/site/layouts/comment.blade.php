@foreach ($comments as $comment)
    <li class="comment byuser comment-author-anthemes bypostauthor even thread-even depth-1"
        id="li-comment-{{ $comment->id }}">
        <div id="comment-{{ $comment->id }}">

            <div class="comment-body">
                <p>{{ $comment->comment }}</p>
            </div>
            <span class="comm-avatar"><img alt="" src="{{ asset('dummyuser.png') }}"
                    srcset="{{ asset('dummyuser.png') }}" class="avatar avatar-20 photo" height="20" width="20"></span>
            <span class="comment-author">{{ $comment->name }}</span>
            <span class="comment-date">{{ $comment->created_at->format('M D, Y. h:i a') }}</span>
            <span class="comment-reply-button">
                <a rel="nofollow" class="comment-reply-link"
                    href="{{ route('singlePost', $comment->post->slug) }}#respond"
                    data-commentid="{{ $comment->id }}" data-postid="{{ $comment->post->id }}"
                    data-belowelement="comment-{{ $comment->id }}" data-respondelement="respond"
                    aria-label="Reply to {{ $comment->name }}">
                    Reply
                </a>
            </span>
            <div class="clear"></div>
        </div>
        <!-- #comment- -->
        <ul class="children">
            @include('site.layouts.comment', ['comments' => $comment->replies])
        </ul>
        <!-- .children -->
    </li>
    <!-- #comment-## -->
@endforeach
