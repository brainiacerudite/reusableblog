<!-- Begin Sidebar (default right) -->
<div class="sidebar-wrapper">
    <aside class="sidebar">

        {{-- <div class="widget widget_bouplay_wp_subscribe">
            <h3 class="title">Feedburner</h3>
            <div class="title-home-circle"><i class="fas fa-circle"></i></div>
            <div class="clear"></div>
            <div class="feed-info">
                <div class="img-zoom-in"><img class="userimage" src="{{ asset('dummyuser.png') }}" width="75"
                        height="75" alt="User image"></div>
                I bring you all you need to know about <strong>everything that matters</strong>! I cover
                everything. <i class="fa fa-plane" aria-hidden="true"></i>
            </div>

            <form action="#" method="get" target="popupwindow"
                onsubmit="window.open('{{ route('homepage') }}', 'popupwindow', 'scrollbars=yes,width=600,height=560');return true"
                id="newsletter-form">
                <input name="email" class="newsletter" placeholder="Enter your e-mail address" type="text">
                <input type="hidden" value="TheRiverCurrent" name="uri" />
                <input class="newsletter-btn" value="Subscribe" type="submit">
            </form>
        </div> --}}

        <div class="widget widget_bouplay_wp_300px">
            <h3 class="title">Advertise with us</h3>
            <div class="img-300">
                <a href="{{ $adsbanner1->adurl ?? '#' }}" target="_blank"><img
                        src="{{ asset($adsbanner1->image) ?? asset('bouimg.png') }}" alt="img" /></a>
            </div>
        </div>

        <div class="widget widget_bouplay_wp_topposts">
            <h3 class="title">Top Posts</h3>
            <div class="title-home-circle"><i class="fas fa-circle"></i></div>
            <div class="clear"></div>
            <ul class="article_list">
                @foreach ($popularPosts as $p)
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
            <div class="clear"></div>
        </div>

        <div class="widget widget_bouplay_wp_social">
            <h3 class="title">Follow us</h3>
            <div class="title-home-circle"><i class="fas fa-circle"></i></div>
            <div class="clear"></div>
            <ul class="social-widget">
                <li><a class="fbbutton" target="_blank" href="{{ config('settings.social_facebook') }}"><i
                            class="fab fa-facebook-f"></i>
                        <span>Like</span></a></li>
                <li><a class="twbutton" target="_blank" href="{{ config('settings.social_twitter') }}"><i
                            class="fab fa-twitter"></i>
                        <span>Follow</span></a></li>
                {{-- <li><a class="ytbutton" target="_blank" href="#"><i class="fab fa-youtube"></i>
                        <span>Subscribe</span></a></li> --}}
            </ul><!-- end .social-widget -->
            <div class="clear"></div>
        </div>

        <div class="widget widget_bouplay_wp_social">
            <h3 class="title">Categories</h3>
            <div class="title-home-circle"><i class="fas fa-circle"></i></div>
            <div class="clear"></div>
            <ul class="social-widget">
                @foreach ($categories as $c)
                    <li style="border-bottom: 1px dashed {{ config('settings.secondary_color') }}">
                        <a href="{{ route('category', $c->slug) }}">
                            {{ ucwords($c->name) }}
                            <span>{{ $c->posts->count() }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="clear"></div>
        </div>

    </aside>
</div>
<!-- end #sidebar (default right) -->
