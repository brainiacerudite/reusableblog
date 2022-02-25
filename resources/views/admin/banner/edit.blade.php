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

                            <form class="custom-validation" method="POST"
                                action="{{ $formType === 'edit' ? route('admin.banner.update', $data->id) : route('admin.banner.store') }}"
                                enctype="multipart/form-data">
                                @if ($formType === 'edit')
                                    @method('PUT')
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input name="name" id="display_name" type="text" class="form-control" required
                                                placeholder="name" value="{{ $data->name ?? old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Ad Url (optional)</label>
                                            <input name="adurl" id="adurl" type="text" class="form-control"
                                                placeholder="ad url" value="{{ $data->adurl ?? old('adurl') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <div class="ml-5">
                                                <input class="form-check form-switch" type="checkbox" name="status"
                                                    id="status" switch="success"
                                                    {{ $data->status ?? old('status') == 1 || old('status') == 'on' ? __('checked') : __('') }}>
                                                <label class="form-label" for="status" data-on-label="On"
                                                    data-off-label="Off"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Ad Banner</label>
                                            <small class="mt-2 text-facebook">
                                                <span>[Image will be resize to 300x250]</span>
                                                @if ($formType === 'edit')
                                                <br>
                                                <span>[<code>Select Image to change.</code>]</span>
                                                @endif
                                             </small>
                                            @if ($formType === 'edit')
                                                <img style="width: 100px; border: 1px solid rgb(165, 165, 165); margin: 5px 20px"
                                                    src="{{ asset($data->image) }}" alt="{{ $data->name }}">
                                            @endif
                                            <input type="file" name="image" id="image" class="form-control"
                                                {{ $formType === 'add' ? 'required' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-5">
                                    <button class="btn btn-primary" type="submit"><i class="ti ti-save"></i>
                                        Save</button>
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
