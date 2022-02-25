@extends('admin.layouts.app')
@section('title') {{ $pageTitle }} @endsection
@section('addCSS')
    <!-- Required css -->
    <link href="{{ asset('admin/assets/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        .image-upload .thumb .profilePicPreview {
            width: 100%;
            height: 270px;
            display: block;
            border: 3px solid #f1f1f1;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.25);
            border-radius: 10px;
            background-size: cover !important;
            background-position: top;
            background-repeat: no-repeat;
            position: relative;
            overflow: hidden;
        }

        .image-upload .thumb .profilePicPreview.logoPicPrev {
            background-size: contain !important;
            background-position: center;
        }

        .image-upload .thumb .profilePicUpload {
            font-size: 0;
            opacity: 0;
        }

        .image-upload .thumb .avatar-edit label {
            text-align: center;
            line-height: 45px;
            font-size: 18px;
            cursor: pointer;
            padding: 2px 25px;
            width: 100%;
            border-radius: 5px;
            box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.16);
            transition: all 0.3s;
        }

        .image-upload .thumb .avatar-edit label:hover {
            transform: translateY(-3px);
        }

        .image-upload .thumb .profilePicPreview .remove-image {
            position: absolute;
            top: -9px;
            right: -9px;
            text-align: center;
            width: 55px;
            height: 55px;
            font-size: 24px;
            border-radius: 50%;
            background-color: #df1c1c;
            color: #fff;
            display: none;
        }

        .image-upload .thumb .profilePicPreview.has-image .remove-image {
            display: block;
        }

    </style>
    <style>
        .logoPrev {
            background-size: 100%;
        }

        .iconPrev {
            background-size: 100%;
        }

    </style>
    <style>
        .sp-original-input-container .sp-add-on {
            width: 40px !important;
        }

    </style>
@endsection

@section('addJS')
    <!-- Required js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.1/tinymce.min.js"></script>
    <script src="{{ asset('admin/assets/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".custom-validation").parsley();
            $(".colorpicker-showinput-intial").spectrum({
                showInitial: !0,
                showInput: !0
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            0 < $("#elm1").length && tinymce.init({
                selector: "textarea#elm1",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [{
                    title: "Bold text",
                    inline: "b"
                }, {
                    title: "Red text",
                    inline: "span",
                    styles: {
                        color: "#ff0000"
                    }
                }, {
                    title: "Red header",
                    block: "h1",
                    styles: {
                        color: "#ff0000"
                    }
                }, {
                    title: "Example 1",
                    inline: "span",
                    classes: "example1"
                }, {
                    title: "Example 2",
                    inline: "span",
                    classes: "example2"
                }, {
                    title: "Table styles"
                }, {
                    title: "Table row 1",
                    selector: "tr",
                    classes: "tablerow1"
                }]
            })
        });
    </script>
    <script>
        function proPicURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var preview = $(input).parents('.thumb').find('.profilePicPreview');
                    $(preview).css('background-image', 'url(' + e.target.result + ')');
                    $(preview).addClass('has-image');
                    $(preview).hide();
                    $(preview).fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".profilePicUpload").on('change', function() {
            proPicURL(this);
        });

        $(".remove-image").on('click', function() {
            $(this).parents(".profilePicPreview").css('background-image', "url({{ asset('preview-img.jpg') }})");
            $(this).parents(".profilePicPreview").removeClass('has-image');
            $(this).parents(".thumb").find('input[type=file]').val('');
        });
    </script>
    <script>
        $(document).ready(function() {
            $('ul.nav.nav-pills a:first').tab('show'); // Select first tab
            $('ul.nav.nav-pills a[href="' + window.location.hash + '"]').tab(
                'show'); // Select tab by name if provided in location hash
            $('ul.nav.nav-pills a[data-toggle="tab"]').on('shown', function(
                event) { // Update the location hash to current tab
                window.location.hash = event.target.hash;
            })
        });
    </script>
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">{{ ucwords($pageTitle) }}</h6>
                        @include('admin.layouts.breadcrumb')
                    </div>

                    <div class="col-md-4">
                        <div class="float-end d-flex">

                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{ ucwords($pageTitle) }}</h4>

                            @include('admin.layouts.alert')

                            <!-- Nav tabs -->
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#profile" role="tab">
                                        <span class="d-none d-md-block">
                                            <i class="mdi mdi-account-cog h5"></i> Profile
                                        </span>
                                        <span class="d-block d-md-none"><i class="mdi mdi-account-cog h5"></i></span>
                                    </a>
                                </li>
                                @can('read settings')
                                    {{-- <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#general" role="tab">
                                        <span class="d-none d-md-block">
                                            <i class="mdi mdi-cogs h5"></i> General
                                        </span>
                                        <span class="d-block d-md-none"><i class="mdi mdi-cogs h5"></i></span>
                                    </a>
                                    </li> --}}
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#site" role="tab">
                                            <span class="d-none d-md-block">
                                                <i class="mdi mdi-application-cog h5"></i> Site
                                            </span>
                                            <span class="d-block d-md-none"><i class="mdi mdi-application-cog h5"></i></span>
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#social" role="tab">
                                            <span class="d-none d-md-block">
                                                <i class="mdi mdi-message-cog h5"></i> Social-Networks
                                            </span>
                                            <span class="d-block d-md-none"><i class="mdi mdi-message-cog h5"></i></span>
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#plugins" role="tab">
                                            <span class="d-none d-md-block">
                                                <i class="mdi mdi-cog-sync h5"></i> Plugins
                                            </span>
                                            <span class="d-block d-md-none"><i class="mdi mdi-cog-sync h5"></i></span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                            <hr>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active p-3" id="profile" role="tabpanel">
                                    <form class="custom-validation" method="POST"
                                        action="{{ route('admin.settings.profile') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-2">
                                                <h4>Profile Settings:</h4>
                                            </div>

                                            <div class="col-md-10">
                                                <div class="mb-3">
                                                    <label class="form-label">Full Name</label>
                                                    <input name="name" type="text" class="form-control" required
                                                        placeholder="Full Name"
                                                        value="{{ Auth::user()->name ?? old('name') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input name="email" type="email" class="form-control" readonly
                                                        placeholder="Email Address"
                                                        value="{{ Auth::user()->email ?? old('email') }}">
                                                </div>
                                                <div class="col-12 d-grid mt-5">
                                                    <button class="btn btn-primary" type="submit"><i
                                                            class="ti ti-save"></i>
                                                        Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form class="custom-validation" method="POST"
                                        action="{{ route('admin.settings.change') }}">
                                        @csrf
                                        <div class="row mt-5">
                                            <div class="col-md-2">
                                                <h4>Change Password:</h4>
                                                <small class="mt-2 text-facebook">
                                                    Please leave empty if you dont want to change pasword.
                                                </small>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="mb-3">
                                                    <label class="form-label">Current Password</label>
                                                    <input name="current_password" type="password" class="form-control"
                                                        required placeholder="Current Password">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">New Password</label>
                                                    <input name="password" type="password" class="form-control" required
                                                        placeholder="New Password">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Confirm Password</label>
                                                    <input name="password_confirmation" type="password"
                                                        class="form-control" required placeholder="Confirm Password">
                                                </div>
                                                <div class="col-12 d-grid mt-5">
                                                    <button class="btn btn-primary" type="submit"><i
                                                            class="ti ti-save"></i>
                                                        Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @can('read settings')
                                    {{-- <div class="tab-pane p-3" id="general" role="tabpanel">
                                    <p class="mb-0">
                                        General Settings.
                                    </p>
                                    </div> --}}
                                    <div class="tab-pane p-3" id="site" role="tabpanel">
                                        <form class="custom-validation" method="POST" enctype="multipart/form-data"
                                            action="{{ route('admin.settings.update') }}">
                                            @csrf
                                            <input type="hidden" name="stype" value="site">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <h4>Site Settings:</h4>
                                                </div>

                                                <div class="col-md-10">
                                                    <div class="mb-3">
                                                        <label class="form-label">Site Name</label>
                                                        <input name="site_name" type="text" class="form-control" required
                                                            placeholder="Site Name"
                                                            value="{{ config('settings.site_name') ?? old('site_name') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">SEO Meta Title</label>
                                                        <input name="seo_meta_title" type="text" class="form-control" required
                                                            placeholder="Seo Meta Title"
                                                            value="{{ config('settings.seo_meta_title') ?? old('seo_meta_title') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">SEO Meta Keywords</label>
                                                        <small class="mt-2 text-facebook">
                                                            Enter each meta keywords sepeated with <code><q>,</q></code>
                                                        </small>
                                                        <input name="seo_meta_keywords" type="text" class="form-control"
                                                            required
                                                            placeholder="Seo Meta Keywords (keyword 1, keyword 2, keyword 3)"
                                                            value="{{ config('settings.seo_meta_keywords') ?? old('seo_meta_keywords') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>SEO Meta Description</label>
                                                        <textarea name="seo_meta_description" id="textarea"
                                                            class="form-control" maxlength="250" rows="5"
                                                            placeholder="SEO Meta Description">{{ config('settings.seo_meta_description') ?? old('seo_meta_description') }}</textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Site Logo</label>
                                                                <div class="image-upload">
                                                                    <div class="thumb">
                                                                        <div class="avatar-preview">
                                                                            <div class="row">
                                                                                <div class="col-sm-8">
                                                                                    <div class="profilePicPreview logoPicPrev logoPrev"
                                                                                        style="background-image: url({{ config('settings.site_logo') ? asset(config('settings.site_logo')) : asset('preview-img.jpg') }})">
                                                                                        <button type="button"
                                                                                            class="remove-image"><i
                                                                                                class="fa fa-times"></i></button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-4"
                                                                                    style="margin-top: 200px">
                                                                                    <label>Resize to:</label>
                                                                                    <input type="text" name="resize_logo"
                                                                                        class="form-control"
                                                                                        value="{{ old('resize_logo') ?? __('348x81') }}"
                                                                                        placeholder="348x81">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="avatar-edit">
                                                                            <input type="file" class="profilePicUpload"
                                                                                id="profilePicUpload1"
                                                                                accept=".png, .jpg, .jpeg" name="site_logo">
                                                                            <label for="profilePicUpload1"
                                                                                class="bg-primary text-white">Select
                                                                                Logo</label>
                                                                            <small class="mt-2 text-facebook">
                                                                                Supported files: <b>jpeg, jpg, png.</b>
                                                                                {{-- Will be resized to: <b>348x81 pixels px.</b> --}}
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Site Icon</label>
                                                                <div class="image-upload">
                                                                    <div class="thumb">
                                                                        <div class="avatar-preview">

                                                                            <div class="row">
                                                                                <div class="col-sm-8">
                                                                                    <div class="profilePicPreview logoPicPrev iconPrev"
                                                                                        style="background-image: url({{ config('settings.site_favicon') ? asset(config('settings.site_favicon')) : asset('preview-img.jpg') }})">
                                                                                        <button type="button"
                                                                                            class="remove-image"><i
                                                                                                class="fa fa-times"></i></button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-4"
                                                                                    style="margin-top: 200px">
                                                                                    <label>Resize to:</label>
                                                                                    <input type="text" name="resize_icon"
                                                                                        class="form-control"
                                                                                        value="{{ old('resize_icon') ?? __('50x50') }}"
                                                                                        placeholder="50x50">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="avatar-edit">
                                                                            <input type="file" class="profilePicUpload"
                                                                                id="profilePicUpload2" accept=".png"
                                                                                name="site_favicon">
                                                                            <label for="profilePicUpload2"
                                                                                class="bg-primary text-white">Select
                                                                                Favicon</label>
                                                                            <small class="mt-2 text-facebook">
                                                                                Supported files: <b>png.</b>
                                                                                {{-- Will be resized to: <b>50x50 px.</b> --}}
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Site Email</label>
                                                        <input name="default_email_address" type="email" class="form-control"
                                                            required parsley-type="email"
                                                            placeholder="Site Email (siteemail@example.com)"
                                                            value="{{ config('settings.default_email_address') ?? old('default_email_address') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Footer Copyright Text</label>
                                                        <textarea name="footer_copyright_text" id="elm1" class="form-control"
                                                            maxlength="250" rows="3"
                                                            placeholder="Footer Copyright Text">{{ config('settings.footer_copyright_text') ?? old('footer_copyright_text') }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Base Color</label>
                                                        <input name="base_color" type="text"
                                                            class="form-control colorpicker-showinput-intial"
                                                            value="{{ config('settings.base_color') ?? old('base_color') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Secondary Color</label>
                                                        <input name="secondary_color" type="text"
                                                            class="form-control colorpicker-showinput-intial"
                                                            value="{{ config('settings.secondary_color') ?? old('secondary_color') }}">
                                                    </div>
                                                    <div class="col-12 d-grid mt-5">
                                                        <button class="btn btn-primary" type="submit"><i
                                                                class="ti ti-save"></i>
                                                            Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane p-3" id="social" role="tabpanel">
                                        <form class="custom-validation" method="POST"
                                            action="{{ route('admin.settings.update') }}">
                                            @csrf
                                            <input type="hidden" name="stype" value="social">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <h4>Social Settings:</h4>
                                                </div>

                                                <div class="col-md-10">
                                                    <div class="mb-3">
                                                        <label class="form-label">Facebook</label>
                                                        <input name="social_facebook" type="url" class="form-control"
                                                            required
                                                            placeholder="Full Facebook Address - https://facebook.com/[username]"
                                                            value="{{ config('settings.social_facebook') ?? old('social_facebook') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Twitter</label>
                                                        <input name="social_twitter" type="url" class="form-control" required
                                                            placeholder="Full Twitter Address - https://twitter.com/[username]"
                                                            value="{{ config('settings.social_twitter') ?? old('social_twitter') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Instagram</label>
                                                        <input name="social_instagram" type="url" class="form-control"
                                                            required
                                                            placeholder="Full Instagram Address - https://instagram.com/[username]"
                                                            value="{{ config('settings.social_instagram') ?? old('social_instagram') }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Linkedin</label>
                                                        <input name="social_linkedin" type="url" class="form-control"
                                                            required
                                                            placeholder="Full Linkin Address - https://linkedin.com/[username]"
                                                            value="{{ config('settings.social_linkedin') ?? old('social_linkedin') }}">
                                                    </div>
                                                    <div class="col-12 d-grid mt-5">
                                                        <button class="btn btn-primary" type="submit"><i
                                                                class="ti ti-save"></i>
                                                            Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane p-3" id="plugins" role="tabpanel">
                                        <form class="custom-validation" method="POST"
                                            action="{{ route('admin.settings.update') }}">
                                            @csrf
                                            <input type="hidden" name="stype" value="plugins">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <h4>Plugins Settings:</h4>
                                                </div>

                                                <div class="col-md-10">
                                                    <div class="mb-3">
                                                        <label class="form-label">Google Analytics</label>
                                                        <input name="google_analytics" type="text" class="form-control"
                                                            required placeholder="Google Analytics"
                                                            value="{{ config('settings.google_analytics') ?? old('google_analytics') }}">
                                                    </div>
                                                    <div class="col-12 d-grid mt-5">
                                                        <button class="btn btn-primary" type="submit"><i
                                                                class="ti ti-save"></i>
                                                            Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
