<!-- Recommended Articles -->
<div class="single-related">
    <div class="single-related-wrap">
        <div class="one_half_sr">
            <h3 class="title">Advertise with us</h3>
            <a href="{{ $adsbanner2->adurl ?? '#' }}" target="_blank"><img
                src="{{ asset($adsbanner2->image) ?? asset('bouimg.png') }}" alt="img" /></a>
        </div>

        <div class="one_half_last_sr">
            <h3>Recommended</h3>
            <div class="title-home-circle"><i class="fas fa-circle"></i></div>
            <div class="clear"></div>
            <ul class="article_list">
                @foreach ($recommendedPosts as $p)
                    <li class="img-zoom-in">
                        <div class="post-nr">{{ $loop->index + 1 }}</div>
                        <a href="{{ route('singlePost', $p->slug) }}">
                            <img width="75" height="75" src="{{ asset($p->image->image_thumb_medium) }}"
                                class="attachment-bouplay-wp-thumbnail-widget-small size-bouplay-wp-thumbnail-widget-small wp-post-image"
                                alt="{{ $p->title }}" /></a>
                        <div class="an-widget-title" style="margin-left:90px;">
                            <a href="{{ route('singlePost', $p->slug) }}">
                                <h4 class="article-title">{{ Str::limit($p->title, 60) }}</h4>
                            </a>
                            <span class="anviews"><i class="fa fa-eye" title="Views!"></i>
                                {{ $p->reads }}</span>
                            <span class="comm"><i class="fas fa-comment-dots"></i> <a
                                    href="{{ route('singlePost', $p->slug) }}#comments">{{ $p->comments->count() }}</a></span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="clear"></div>
    </div>
    <!-- end .single-related-wrap -->
</div>
<!-- end .single.related -->
