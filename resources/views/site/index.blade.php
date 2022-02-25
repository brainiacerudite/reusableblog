@extends('site.layouts.app')

@section('content')
    <!-- Begin Main Home Content -->
    <div class="wrap-content">

        {{--  <!-- Home Modules (Widgets) -->
        <div class="content-modules">

            <div class="widget widget_bouplay_wp_728px">
                <div class="module-ad">
                    <h3 class="title-homepage">Responsive AD</h3>
                    <a href="#"><img src="{{ asset('responsive-img.png') }}" alt="img"></a>
                    <div class="clear"></div>
                </div>
            </div>

        </div>
        <!-- End. Home Modules -->  --}}



        <div class="clear"></div>
        <h3 class="title-homepage">Latest Posts</h3>

        @include('site.layouts.posts', ['posts'=>$posts])
        <div class="clear"></div>



        {{--  includes recommededPosts  --}}
        @include('site.layouts.recommend')




        <div class="clear"></div>
        <h3 class="title-homepage">Popular Posts</h3>

        @include('site.layouts.posts', ['posts'=>$popularPostsAll])

    </div>
    <!-- end .wrap-content -->
@endsection
