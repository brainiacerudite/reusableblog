@extends('admin.layouts.app')
@section('title') {{ $pageTitle }} @endsection
@section('addJS')
    <!-- Required js -->
    <script src="{{ asset('admin/assets/libs/parsleyjs/parsley.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".custom-validation").parsley();
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

                            @if ($rType === 'category')
                                <form method="POST" class="custom-validation"
                                    action="{{ $formType === 'edit' ? route('admin.categories.update', $data->id) : route('admin.categories.store') }}">
                            @endif
                            @if ($rType === 'tag')
                                <form method="POST" class="custom-validation"
                                    action="{{ $formType === 'edit' ? route('admin.tags.update', $data->id) : route('admin.tags.store') }}">
                            @endif
                            @if ($formType === 'edit')
                                @method('PUT')
                            @endif
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input name="name" id="display_name" type="text" class="form-control" required
                                            placeholder="Name" value="{{ $data->name ?? old('name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Slug</label>
                                        <input name="slug" id="slug" type="text" class="form-control" required
                                            placeholder="Slug" value="{{ $data->slug ?? old('slug') }}">
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
