@extends('admin.layouts.app')
@section('title') {{ $pageTitle }} @endsection
@section('addCSS')
    <link href="{{ asset('admin/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('addJS')
    <script src="{{ asset('admin/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/parsleyjs/parsley.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".custom-validation").parsley();
            $(".select2").select2();
        });

        /**
         * Set Variables
         */
        var $m_link_type = $('#m_link_type'),
            $m_url_type = $('#m_url_type'),
            $m_route_type = $('#m_route_type');

        /**
         * Toggle Form Menu Type
         */
         if ($m_link_type.val() == 'route') {
            $m_url_type.hide();
            $m_route_type.show();
        } else {
            $m_url_type.show();
            $m_route_type.hide();
        }

        $m_link_type.on('change', function(e) {
            if ($m_link_type.val() == 'route') {
                $m_url_type.hide();
                $m_route_type.show();
            } else {
                $m_url_type.show();
                $m_route_type.hide();
            }
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
                                action="{{ $formType === 'edit' ? route('admin.menus.update', $data->id) : route('admin.menus.store') }}">
                                @if ($formType === 'edit')
                                    @method('PUT')
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input name="title" type="text" class="form-control" required
                                                placeholder="Title" value="{{ $data->title ?? old('title') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Type</label>
                                            <select name="type" id="m_link_type" class="select2 form-control"
                                                data-placeholder="target" required>
                                                <option value="url"
                                                    {{ isset($data->url) && !empty($data->url) ? __('selected') : '' }}>
                                                    static</option>
                                                <option value="route"
                                                    {{ isset($data->route) && !empty($data->route) ? __('selected') : '' }}>
                                                    dynamic</option>
                                            </select>
                                        </div>
                                        <div class="mb-3" id="m_url_type">
                                            <label class="form-label">URL</label>
                                            <small class="mt-2 text-facebook">
                                                Enter full url Eg. <b>https://example.com/style/fashion</b>
                                            </small>
                                            <input name="url" type="url" class="form-control"
                                                placeholder="Full URL https://example.com/style/fashion" value="{{ $data->url ?? old('url') }}">
                                        </div>
                                        <div class="row" id="m_route_type">
                                            <label class="form-label">Dynamic Route</label>
                                            <small class="mt-2 text-facebook text-danger">
                                                *Please use only if you are sure of what you are doing.*
                                            </small>
                                            <div class="col-6 mb-3">
                                                <label class="form-label">Route Name</label>
                                                <input name="route" type="text" class="form-control"
                                                    placeholder="Route Name" value="{{ $data->route ?? old('route') }}">
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label class="form-label">Parameters</label>
                                                <small class="mt-2 text-facebook">
                                                    {{ json_encode(['key' => 'value'], JSON_PRETTY_PRINT) }}
                                                </small>
                                                {{--  <input name="route" type="text" class="form-control"
                                                    placeholder="Route Name" value="{{ old('route') }}">  --}}
                                                    <textarea rows="3" class="form-control" id="m_parameters" name="parameters" placeholder="{{ json_encode(['key' => 'value'], JSON_PRETTY_PRINT) }}">{{ $data->parameters ?? old('parameters') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Target</label>
                                            <select name="target" class="select2 form-control" data-placeholder="target"
                                                required>
                                                <option value="_self"
                                                    {{ isset($data->target) && $data->target === '_self' ? __('selected') : (old('target') == '_self' ? __('selected') : __('')) }}>
                                                    _self</option>
                                                <option value="_blank"
                                                    {{ isset($data->target) && $data->target === '_blank' ? __('selected') : (old('target') == '_blank' ? __('selected') : __('')) }}>
                                                    _blank</option>
                                            </select>
                                        </div>

                                        <div class="col-12 mt-5">
                                            <button class="btn btn-primary" type="submit"><i class="ti ti-save"></i>
                                                Save</button>
                                        </div>
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
