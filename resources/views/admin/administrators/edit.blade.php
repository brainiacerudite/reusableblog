@extends('admin.layouts.app')
@section('title') {{ $pageTitle }} @endsection
@section('addCSS')
    <link href="{{ asset('admin/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('addJS')
    <!-- Required js -->
    <script src="{{ asset('admin/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/parsleyjs/parsley.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".custom-validation").parsley();
            $(".select2").select2();
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

                            @if ($rType === 'admin')
                                <form method="POST" class="custom-validation"
                                    action="{{ $formType === 'edit' ? route('admin.administrators.update', $data->id) : route('admin.administrators.store') }}">
                            @endif
                            @if ($rType === 'user')
                                <form method="POST" class="custom-validation"
                                    action="{{ $formType === 'edit' ? route('admin.users.update', $data->id) : route('admin.users.store') }}">
                            @endif
                            @if ($formType === 'edit')
                                @method('PUT')
                            @endif
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input name="name" id="name" type="text" class="form-control" required
                                            placeholder="Name" value="{{ $data->name ?? old('name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input name="email" id="email" type="text" class="form-control" required
                                            placeholder="Email" value="{{ $data->email ?? old('email') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">{{ __('Password') }}</label>
                                            @if ($formType === 'edit')
                                            <small class="mt-2 text-facebook">
                                               [Leave empty: <code>This will forcefully change user password if not empty</code>]
                                            </small>
                                            @endif
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password-confirm"
                                            class="form-label">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" autocomplete="new-password">
                                    </div>
                                </div>
                                @if ($rType === 'admin')
                                    <div class="mb-3">
                                        <label class="form-label">Assign Role</label>
                                        <select name="roles[]" class="select2 form-control" data-placeholder="Assign Role"
                                            required>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" @if (isset($data->roles))
                                                    @foreach ($data->roles as $c)
                                                        @if ($c->id === $role->id)
                                                            selected
                                                        @endif
                                                    @endforeach
                                            @endif>
                                            {{ ucwords($role->name) }}
                                            </option>
                                @endforeach
                                </select>
                            </div>
                            @endif
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
