@extends('site.layouts.app')

@section('content')
    <!-- Begin Main Home Content -->
    <div class="wrap-content">

        <article>
            <div class="post-80 page type-page status-publish hentry" id="post-80">

                <div class="entry">
                    <h1 class="page-title">{{ ucwords($data->title) }}</h1>
                    <div>
                        {!! $data->body !!}
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
