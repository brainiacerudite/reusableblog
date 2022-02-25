<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta Tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Mobile Device Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset(config('settings.site_favicon')) }}" type="image/png">
    <title>{{ config('settings.site_name') }} - @yield('title', config('settings.seo_meta_title'))</title>
    <meta name="keywords" content="@yield('meta_keywords', config('settings.seo_meta_keywords'))">
    <meta name="description" content="@yield('meta_description', config('settings.seo_meta_description'))">
    <meta name="author" content="Brainiac Hades">
    <link rel="canonical" href="{{ url()->current() }}" />

    <link rel='stylesheet' id='style-css' href='{{ asset('site/css/style.css') }}' type='text/css' media='all' />
    <link rel='stylesheet' id='default-css'
        href='{{ asset('site/css/colors/default.php') }}?primary={{ urlencode(config('settings.base_color')) }}&secondary={{ urlencode(config('settings.secondary_color')) }}'
        type='text/css' media='all' />
    <link rel='stylesheet' id='responsive-css' href='{{ asset('site/css/responsive.css') }}' type='text/css'
        media='all' />
    <link rel='stylesheet' id='fontawesome-css'
        href='{{ asset('site/css/fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css') }}'
        type='text/css' media='all' />
    {{-- <link rel='stylesheet' id='icofont-css' href='{{ asset('site/css/icofont/css/icofont') }}' type='text/css'
        media='all' /> --}}
    <link rel='stylesheet' id='fonts-css'
        href='http://fonts.googleapis.com/css?family=Ruda%3A400%2C700%2C900%7COswald%3A700&amp;ver=1.0.0'
        type='text/css' media='all' />

    <script type='text/javascript' src='{{ asset('site/js/jquery/jquery.js') }}'></script>
    <script type='text/javascript' src='{{ asset('site/js/jquery/jquery-migrate.min.js') }}'></script>

    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ config('settings.site_name') }}" />
    <meta property="og:title" content="@yield('title', config('settings.seo_meta_title'))" />
    <meta property="og:description" content="@yield('meta_description', config('settings.seo_meta_description'))" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset(config('settings.site_logo')) }}" />
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
</head>

<body>
    <!-- Begin Header -->
    <header>
        <!-- Top bar colors -->
        <div class="main-header">
            <!-- Logo -->
            <a href="{{ route('homepage') }}"><img class="logo"
                    src="{{ asset(config('settings.site_logo')) }}"
                    alt="{{ config('settings.site_name') }}-logo" /></a>

            <!-- search form get_search_form(); -->
            <form id="searchform2" class="header-search" method="POST" action="{{ route('search') }}">
                @csrf
                <div class="triangle-search"></div>
                <input placeholder="Find something ..." type="text" name="s" id="s" />
                <button type="submit" class="buttonicon">&#xf002;</button>
            </form>
            <!-- Navigation Menu -->
            <nav>
                <!-- Menu Toggle btn-->
                <div class="menu-toggle">
                    <button type="button" id="menu-btn">
                        <span class="icon-bar"></span><span class="icon-bar"></span><span
                            class="icon-bar"></span>
                    </button>
                </div>
                <ul id="respMenu" class="ant-responsive-menu" data-menu-style="horizontal">
                    <li id="menu-item-1"
                        class="menu-item {{ Route::currentRouteName() == 'homepage' ? 'current-menu-item' : '' }}"><a
                            href="{{ route('homepage') }}">Home</a></li>
                    @include('site.layouts.menu')
                    <li id="menu-item-1"
                        class="menu-item {{ Route::currentRouteName() == 'contact' ? 'current-menu-item' : '' }}"><a
                            href="{{ route('contact') }}">Contact</a></li>
                    {{-- Right side menu --}}
                    @guest
                        @if (Route::has('register'))
                            <li class="right menu-item menu-item">
                                <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i>
                                    {{ __('Register') }}</a>
                            </li>
                        @endif

                        @if (Route::has('login'))
                            <li class="right menu-item menu-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in-alt"></i>
                                    {{ __('Login') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="right menu-item menu-item">
                            <a class="nav-link" href="#"><i class="fas fa-user"></i>
                                {{ Auth::user()->name }}</a>

                            <ul class="sub-menu">
                                <li class="menu-item menu-item">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out-alt"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none" style="display: none !important">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                    {{-- <li id="menu-item-2" class="right menu-item menu-item"><a target="_blank" rel="noopener noreferrer"
                            href="#"><i class="fas fa-shopping-bag"></i> Buy
                            Now</a></li> --}}
                </ul>
            </nav>

            <div class="clear"></div>
        </div><!-- end .main-header -->
    </header>
    <!-- end #header -->

    <ul class="top-social">
        <li><a href="{{ config('settings.social_facebook') }}"><i class="fab fa-facebook-f"></i></a></li>
        <li><a href="{{ config('settings.social_twitter') }}"><i class="fab fa-twitter"></i></a></li>
        <li><a href="{{ config('settings.social_instagram') }}"><i class="fab fa-instagram"></i></a></li>
        <li><a href="{{ config('settings.social_linkedin') }}"><i class="fab fa-linkedin"
                    style="color: rgb(81, 81, 210);"></i></a></li>
    </ul>
    <!-- end .top-social -->

    <!-- Begin Wrap Content -->
    <div class="wrap-fullwidth">

        @section('content')
        @show

        @include('site.layouts.sidebar')

        <div class="clear"></div>
    </div>
    <!-- end .wrap-fullwidth -->

    <!-- Begin Footer -->
    <footer>

        <div class="top-footer-section" style="padding: 10px 0px">
            {{-- <div class="top-entry"> --}}
            <img src="{{ asset(config('settings.site_logo')) }}" alt="config('settings.site_name')-logo">
            {{-- </div> --}}
            <!-- end .top-entry -->
        </div>
        <!-- end .top-footer-section -->

        <div class="wrap-middle">
            <div class="sleft">
                {!! config('settings.footer_copyright_text') !!}
            </div>
            <!-- end .sleft -->

            <div class="sright">
                <ul class="bottom-social">
                    <li><a href="{{ config('settings.social_facebook') }}"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="{{ config('settings.social_twitter') }}"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="{{ config('settings.social_instagram') }}"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="{{ config('settings.social_linkedin') }}"><i class="fab fa-linkedin"
                                style="color: rgb(81, 81, 210);"></i></a></li>
                </ul>

            </div><!-- end .sright -->
            <div class="clear"></div>
        </div><!-- end .wrap-middle -->


        <!-- Go to TOP -->
        <p id="back-top"><a href="#top">
                <span><i class="fas fa-chevron-up"></i></span></a>
        </p><!-- end #back-top -->
    </footer>
    <!-- end #footer -->

    <script type='text/javascript' src='{{ asset('site/js/custom.js') }}'></script>
    <script type='text/javascript' src='{{ asset('site/js/jquery.sticky-kit.js') }}'></script>
    <script type='text/javascript' src='{{ asset('site/js/comment-reply.min.js') }}'></script>
</body>

</html>
