<ul class="grid_list">
    @foreach ($posts as $post)
        <li class="img-zoom-in post-{{ $loop->index + 1 }} post type-post status-publish format-standard has-post-thumbnail hentry category-technology tag-headphone tag-ipad tag-tablet"
            id="post-{{ $loop->index + 1 }}">
            <div class="post-views">
                @foreach ($post->categories as $categ)
                    <span><a href="{{ route('category', $categ->slug) }}">{{ $categ->name }}</a></span>
                @endforeach
            </div>
            <ul class="meta-icons-home">
            </ul>
            <div class="clear"></div>
            <a href="{{ route('singlePost', $post->slug) }}"><img width="283" height="200"
                    src="{{ asset($post->image->image_thumb_small) }}"
                    class="attachment-bouplay-wp-thumbnail-blog-grid size-bouplay-wp-thumbnail-blog-grid wp-post-image"
                    alt="{{ $post->title }}" title="{{ $post->title }}" /></a>


            <div class="content-grid">
                <a href="{{ route('singlePost', $post->slug) }}" title="{{ $post->title }}">
                    <h2>{{ Str::limit($post->title, 55) }}</h2>
                </a>
                <div class="clear"></div>
                <span class="anpostdate">{{ $post->created_at->format('M d, Y.') }}</span>
                <div class="home-data">
                    <span class="anviews"><i class="fa fa-eye" title="Views!"></i>
                        {{ $post->reads }}</span>
                    <span class="comm"><i class="fas fa-comment-dots"></i> <a
                            href="{{ route('singlePost', $post->slug) }}#comments">{{ $post->comments->count() }}</a></span>
                </div>
            </div><!-- end .content-grid -->
        </li>
    @endforeach
</ul>

<!-- Pagination -->
<div class='wp-pagenavi'>
    @if ($posts instanceof \Illuminate\Pagination\Paginator || $posts instanceof Illuminate\Pagination\LengthAwarePaginator)
        {!! $posts->links('vendor.pagination.custom') !!}
    @endif
</div>
<!-- pagination -->

{{-- <!-- Pagination -->
<div class='wp-pagenavi'>
    <span class='pages'>Page 1 of 2</span>
    <span class='current'>1</span>
    <a class="page larger" title="Page 2" href="page/2/index.html">2</a>
    <a class="nextpostslink" rel="next" href="page/2/index.html">»</a>
</div>
<!-- pagination --> --}}
