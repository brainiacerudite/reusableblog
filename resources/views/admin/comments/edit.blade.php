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
                                action="{{ $formType === 'edit' ? route('admin.comments.update', $comment->id) : route('admin.comments.store') }}">
                                @if ($formType === 'edit')
                                    @method('PUT')
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input name="name" id="name" type="text" class="form-control" readonly
                                                placeholder="Name" value="{{ $comment->name ?? old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input name="email" id="email" type="text" class="form-control" readonly
                                                placeholder="Email" value="{{ $comment->email ?? old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Comment</label>
                                            <textarea id="comment" class="form-control" name="comment" rows="8"
                                                maxlength="65525"
                                                required="required">{{ $comment->comment ?? old('comment') }}</textarea>
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
