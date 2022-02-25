@extends('site.layouts.app')

@section('title', $post->title)
@section('meta_keywords', $post->meta_keywords)
@section('meta_description', $post->meta_description)

@section('content')
    <div class="single-content">
        <div class="entry-top">
            <h1 class="article-title entry-title">{{ $post->title }}</h1>
            <ul class="meta-entry-top">
                <li><a href="#"><img alt="" src="{{ asset('dummyuser.png') }}" class="avatar avatar-25 photo" height="25"
                            width="25"></a>
                </li>
                <li class="vcard author"><span class="fn"><a href="#"
                            title="Posts by {{ strtoupper($post->user->name) }}"
                            rel="author">{{ strtoupper($post->user->name) }}</a></span> on <span
                        class="updated">{{ $post->created_at->format('M d, Y.') }}</span></li>
                <li>
                    <ul class="single-share">
                        <li><a class="fbbutton" target="_blank" href="#"
                                onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=700');return false;"><i
                                    class="fab fa-facebook-f" aria-hidden="true"></i> <span>Share on Facebook</span></a>
                        </li>
                        <li><a class="twbutton" target="_blank" href="#"
                                onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=700');return false;"><i
                                    class="fab fa-twitter"></i></a></li>
                        <li><a class="pinbutton" target="_blank" href="#"
                                onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=700');return false;"><i
                                    class="fab fa-pinterest-p"></i></a></li>
                        <li><a class="googlebutton" target="_blank" href="#"
                                onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=700');return false;"><i
                                    class="fab fa-google-plus-g" aria-hidden="true"></i></a></li>
                    </ul>
                    <!-- end .single-share -->
                </li>
            </ul>
            <div class="clear"></div>
        </div>
        <!-- end .entry-top -->

        <article>
            <div class="post post-1 type-post status-publish format-standard has-post-thumbnail hentry category-dessert category-travel tag-breakfast tag-food tag-pancake"
                id="post-1">

                <div class="entry">
                    <!-- excerpt -->
                    <p>{{ $post->meta_description }}</p>
                </div>

                <div class="media-single-content">
                    <img width="950" height="573" src="{{ asset($post->image->image_thumb_display) }}"
                        class="attachment-bouplay-wp-thumbnail-single-image size-bouplay-wp-thumbnail-single-image wp-post-image"
                        alt="{{ $post->title }}">
                </div>
                <!-- end .media-single-content -->

                <div class="entry">

                    <!-- entry content -->
                    {!! $post->body !!}
                    <div class="clear"></div>
                    <div class="clear"></div>

                    <div class="tags-cats">
                        <!-- views -->
                        <div class="ct-size">
                            <div class="entry-btn">Views:</div><i class="icofont icofont-fire-burn"></i>
                            {{ $post->reads }}
                        </div>
                        <div class="clear"></div>
                        <!-- tags -->
                        <div class="ct-size">
                            <div class="entry-btn">Post Tags:</div>
                            @foreach ($post->tags as $t)
                                <i class="fas fa-tags"></i><a href="{{ route('tag', $t->slug) }}"
                                    rel="tag">{{ $t->name }}</a>
                            @endforeach
                        </div>
                        <div class="clear"></div>
                        <!-- categories -->
                        <div class="ct-size">
                            <div class="entry-btn">Post Categories:</div>
                            @foreach ($post->categories as $c)
                                <i class="fa fa-folder"></i><a href="{{ route('category', $c->slug) }}"
                                    rel="category tag">{{ $c->name }}</a>
                            @endforeach
                        </div>
                        <div class="clear"></div>
                    </div><!-- end .tags-cats -->

                    <div class="clear"></div>
                </div><!-- end .entry -->
                <div class="clear"></div>
            </div><!-- end #post -->
        </article><!-- end article -->


        @include('site.layouts.recommend')


        <!-- Comments -->
        <div class="entry-bottom">
            <h3 class="title"> All Comments</h3>

            <!-- Comments -->
            <div id="comments" class="comments">
                <ul class="comment">
                    @if ($post->comments->count() > 0)
                        @include('site.layouts.comment', ['comments' => $post->comments])
                    @else
                        <li class="comment byuser comment-author-anthemes bypostauthor even thread-even depth-1"
                            id="li-comment-empty">
                            <div id="comment-empty">

                                <div class="comment-body">
                                    <p>Be the first to comment!</p>
                                </div>
                                <div class="clear"></div>
                            </div><!-- #comment-empty -->

                        </li><!-- #comment-empty## -->
                    @endif
                </ul>
                <div class="clear"></div>


                <div id="respond" class="comment-respond">
                    <h3 id="reply-title" class="comment-reply-title">
                        Leave a Reply <small><a rel="nofollow" id="cancel-comment-reply-link"
                                href="{{ route('singlePost', $post->slug) }}#respond" style="display:none;">Cancel
                                reply</a></small>
                    </h3>

                    <form action="{{ route('postComment') }}" method="POST" id="commentform" class="comment-form">
                        @csrf
                        <p class="comment-notes"><span id="email-notes">
                                Your email address will not be published.</span>Required fields are marked <span
                                class="required">*</span>
                        </p>
                        <p class="comment-form-comment">
                            <label for="comment">Comment</label>
                            <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525"
                                required="required">{{ old('comment') }}</textarea>
                        </p>
                        {{-- {{ dd(session()->get('commenter')['name']) }} --}}
                        <p class="comment-form-author">
                            <label for="author">Name <span class="required">*</span></label>
                            <input id="author" name="name" type="text"
                                value="{{ isset(session()->get('commenter')['name']) ? session()->get('commenter')['name'] : old('name') }}"
                                size="30" maxlength="245" required="required">
                        </p>
                        <p class="comment-form-email">
                            <label for="email">Email <span class="required">*</span></label>
                            <input id="email" name="email" type="text"
                                value="{{ isset(session()->get('commenter')['email']) ? session()->get('commenter')['email'] : old('email') }}"
                                size="30" maxlength="100" aria-describedby="email-notes" required="required">
                        </p>
                        <p class="comment-form-cookies-consent">
                            <input id="wp-comment-cookies-consent" name="remember" type="checkbox" value="1">
                            <label for="wp-comment-cookies-consent">Save my name and email in this browser for the next time
                                I comment.</label>
                        </p>
                        <p class="form-submit">
                            <input name="submit" type="submit" id="submit" class="submit" value="Post Comment">
                            <input type="hidden" name="comment_post_ID" value="{{ $post->id }}" id="comment_post_ID">
                            <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                        </p>
                    </form>
                </div><!-- #respond -->
            </div>
            <div class="clear"></div>
        </div><!-- end .entry-bottom -->

    </div>
@endsection
