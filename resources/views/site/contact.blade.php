@extends('site.layouts.app')

@section('content')
    <!-- Begin Main Home Content -->
    <div class="wrap-content">

        <article>
            <div class="post-80 page type-page status-publish hentry" id="post-80">

                <div class="entry">
                    <h1 class="page-title">Contact Us</h1>

                    <div class="comment-respond">
                        <h3 class="comment-reply-title">
                            Leave a Message
                        </h3>

                        <form action="{{ route('postContact') }}" method="POST" id="commentform"
                            class="comment-form">
                            @csrf

                            <p class="comment-notes"><span id="email-notes">
                                    Your email address will not be published.</span>Required fields are marked <span
                                    class="required">*</span>
                            </p>
                            <p class="comment-form-comment">
                                <label for="comment">Message <span class="required">*</span></label>
                                <textarea id="comment" name="message" cols="45" rows="8" maxlength="65525"
                                    required="required"></textarea>
                            </p>

                            <p class="comment-form-author">
                                <label for="author">Name <span class="required">*</span></label>
                                <input id="author" name="name" type="text" value="" size="30" maxlength="245"
                                    required="required">
                            </p>
                            <p class="comment-form-email">
                                <label for="email">Email <span class="required">*</span></label>
                                <input id="email" name="email" type="text" value="" size="30" maxlength="100"
                                    aria-describedby="email-notes" required="required">
                            </p>
                            <p class="comment-form-cookies-consent">
                                <input id="wp-comment-cookies-consent" name="remember" type="checkbox" value="1">
                                <label for="wp-comment-cookies-consent">Save my name and email in this browser for the next
                                    time
                                    I comment.</label>
                            </p>
                            <p class="form-submit">
                                <input name="submit" type="submit" id="submit" class="submit" value="Submit">
                            </p>
                        </form>
                    </div>
                    <div class="clear"></div>
                </div><!-- end #entry -->
            </div><!-- end .post -->
        </article>
        <div class="clear"></div>


        {{-- includes recommededPosts --}}
        @include('site.layouts.recommend')

    </div>
    <!-- end .wrap-content -->
@endsection
