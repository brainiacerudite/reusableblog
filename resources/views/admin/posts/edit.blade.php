@extends('admin.layouts.app')
@section('title') {{ $pageTitle }} @endsection
@section('addCSS')
    <!-- Required css -->
    {{-- <link href="{{ asset('admin/assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('admin/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        .image-upload .thumb .profilePicPreview {
            width: 100%;
            height: 310px;
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
@endsection

@section('addJS')
    <!-- Required js -->
    {{-- <script src="{{ asset('admin/assets/libs/dropzone/min/dropzone.min.js') }}"></script> --}}
    <script src="{{ asset('admin/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.1/tinymce.min.js"></script>
    <script src="{{ asset('admin/assets/libs/parsleyjs/parsley.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".custom-validation").parsley();
            $(".select2").select2();
            $('.select2tag').select2({
                tags: true,
                tokenSeparators: [',', ' '],
                createTag: function(newTag) {
                    return {
                        id: 'new:' + newTag.term,
                        text: newTag.term + ' *'
                    };
                }
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
            $(this).parents(".profilePicPreview").css('background-image',
                "url({{ isset($data->image) ? asset($data->image->image) : asset('preview-img.jpg') }})");
            $(this).parents(".profilePicPreview").removeClass('has-image');
            $(this).parents(".thumb").find('input[type=file]').val('');
        });
    </script>
    @include('admin.layouts.autoslugjs')
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
                            <a class="btn btn-warning waves-effect waves-light" href="{{ URL::previous() }}"
                                role="button"><i class="ti ti-back-left"></i> Back</a>
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

                            <form class="custom-validation" method="POST" enctype="multipart/form-data"
                                action="{{ $formType === 'edit' ? route('admin.posts.update', $data->id) : route('admin.posts.store') }}">
                                @if ($formType === 'edit')
                                    @method('PUT')
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input name="title" id="display_name" type="text" class="form-control"
                                                required placeholder="Title" value="{{ $data->title ?? old('title') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Slug</label>
                                            <input name="slug" id="slug" type="text" class="form-control" required
                                                placeholder="Slug" value="{{ $data->slug ?? old('slug') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Category</label>
                                            <select name="category" class="select2 form-control"
                                                data-placeholder="Select Post Category" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @if (isset($data->categories))
                                                        @foreach ($data->categories as $c)
                                                            @if ($c->id === $category->id)
                                                                selected
                                                            @endif
                                                        @endforeach
                                                @endif>
                                                {{ ucwords($category->name) }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tags</label>
                                            <small class="mt-2 text-facebook">
                                                enter new tags and press <code>space</code> to create new.
                                            </small>
                                            <select name="tags[]" class="select2tag form-control select2-multiple"
                                                multiple="multiple" multiple data-placeholder="Tags">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}" @if (isset($data->tags))
                                                        @foreach ($data->tags as $t)
                                                            @if ($t->id === $tag->id)
                                                                selected
                                                            @endif
                                                        @endforeach
                                                @endif>
                                                {{ $tag->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @can('publish posts')
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="select2 form-control"
                                                    data-placeholder="Post Status" required>
                                                    <option value="DRAFT"
                                                        {{ isset($data->status) && $data->status === 'DRAFT' ? __('selected') : (old('status') == 'DRAFT' ? __('selected') : __('')) }}>
                                                        DRAFT</option>
                                                    <option value="PUBLISHED"
                                                        {{ isset($data->status) && $data->status === 'PUBLISHED' ? __('selected') : (old('status') == 'PUBLISHED' ? __('selected') : __('')) }}>
                                                        PUBLISHED</option>
                                                    <option value="PENDING"
                                                        {{ isset($data->status) && $data->status === 'PENDING' ? __('selected') : (old('status') == 'PENDING' ? __('selected') : __('')) }}>
                                                        PENDING</option>
                                                </select>
                                            </div>
                                        @endcan
                                        {{-- <div class="mb-3">
                                            <label class="form-label">Downloadable File</label>

                                            <div class="dropzone">
                                                <div class="fallback">
                                                    <input name="file" type="file" multiple="multiple">
                                                </div>

                                                <div class="dz-message needsclick">
                                                    <div class="mb-3">
                                                        <i class="mdi mdi-cloud-upload display-4 text-muted"></i>
                                                    </div>

                                                    <h4>Drop files here or click to upload.</h4>
                                                </div>
                                            </div>

                                        </div> --}}
                                    </div>

                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label class="form-label">Featured Image</label>
                                            <div class="image-upload">
                                                <div class="thumb">
                                                    <div class="avatar-preview">
                                                        <div class="profilePicPreview"
                                                            style="background-image: url({{ isset($data->image) ? asset($data->image->image) : asset('preview-img.jpg') }})">
                                                            <button type="button" class="remove-image"><i
                                                                    class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-edit">
                                                        <input name="image" type="file" class="profilePicUpload"
                                                            id="profilePicUpload0"
                                                            accept=".png, .jpg, .jpeg, .webp, .gif, .svg"
                                                            value="{{ old('image') }}"
                                                            {{ $formType === 'edit' ? __('') : __('required') }}>
                                                        <label for="profilePicUpload0"
                                                            class="form-label bg-purple text-white">Upload Image</label>
                                                        <small class="mt-2 text-facebook">
                                                            Supported files: <b>jpeg, jpg, png, webp, gif, svg.</b>
                                                            Will be resized to: <b>770x340 px & 370x230 px.</b>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Keywords</label>
                                            <small class="mt-2 text-facebook">
                                                Enter each meta keywords sepeated with <code><q>,</q></code>
                                            </small>
                                            <input name="meta_keywords" type="text" class="form-control"
                                                placeholder="keyword1, keyword2, keyword3"
                                                value="{{ $data->meta_keywords ?? old('meta_keywords') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Meta Description</label>
                                            <textarea name="meta_description" id="textarea" class="form-control"
                                                maxlength="250" rows="5"
                                                placeholder="Meta description of post">{{ $data->meta_description ?? old('meta_description') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Body</label>
                                            <textarea id="elm1" name="body">{{ $data->body ?? old('body') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <button class="btn btn-primary" type="submit"><i class="ti ti-save"></i>
                                            Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
