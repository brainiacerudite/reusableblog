@extends('site.layouts.app')

@section('content')
    <!-- Begin Main Home Content -->
    <div class="wrap-content">
        <h3 class="index-title">{{ $pT }}: {{ $pC }}</h3>
        <div class="title-home-circle"><i class="fas fa-circle"></i></div>

        @if ($posts->count() > 0)
            @include('site.layouts.posts', ['posts'=>$posts])
            <div style="clear: both;margin-bottom: 70px;"></div>
        @else
            <h3 class="index-title" style="border-bottom: none !important;">0 result found.</h3>
            <div style="clear: both;margin-bottom: 180px;"></div>
        @endif



        <div class="clear"></div>
        {{--  includes recommededPosts  --}}
        @include('site.layouts.recommend')


        

        <h3 class="title-homepage">Popular Posts</h3>
        @include('site.layouts.posts', ['posts'=>$popularPostsAll])

    </div>
    <!-- end .wrap-content -->
@endsection
