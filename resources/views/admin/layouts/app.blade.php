<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('settings.site_name') }} | @yield('title', config('settings.site_name'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ config('settings.meta_description') }}" name="description">
    <meta content="Brainiac Hades" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset(config('settings.site_favicon')) }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css">
    <!-- Icons Css -->
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ asset('admin/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">
    <!-- Alert css -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @section('addCSS')
    @show
</head>

<body data-sidebar="colored">

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('admin.layouts.navbar')

        @include('admin.layouts.sidebar')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            @section('content')
            @show

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> {{ config('settings.site_name') }}<span class="d-none d-sm-inline-block"> -
                                Crafted with <i class="mdi mdi-heart text-danger"></i> by Brainiac.</span>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/pages/dashboard.init.js') }}"></script>

    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    @section('addJS')
    @show

    <script>
        $(document).ready(function() {
            // deleting
            $('.delBtn').on('click', function(e) {
                var $delTitle = $(this).attr('data-delTitle');
                $('.delTitle').html($delTitle);
            });
            $('#delModal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                $('#deleteForm').attr('action', button.attr('data-delAction'));
            });

            // approving
            $('.aprBtn').on('click', function(e) {
                var $aprTitle = $(this).attr('data-aprTitle');
                $('.aprTitle').html($aprTitle);
            });
            $('#aprModal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                $('#approvingForm').attr('action', button.attr('data-aprAction'));
            });

            // reply
            $('.replyBtn').on('click', function(e) {
                var $replyTitle = $(this).attr('data-replyTitle');
                $('.replyTitle').html($replyTitle);
                var $replyID = $(this).attr('data-replyID');
                $('#comment_parent').val($replyID);
                var $replyPostID = $(this).attr('data-replyPostID');
                $('#comment_post_ID').val($replyPostID);
            });
            $('#replyModal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                $('#replyForm').attr('action', button.attr('data-replyAction'));
            });
        });
    </script>
    <!-- alert js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if (Session::has('success'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.success("{{ session('success') }}");
        @endif
        @if (Session::has('warning'))ide
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
        @if (Session::has('error'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.error("{{ session('error') }}");
        @endif
    </script>
</body>

</html>
