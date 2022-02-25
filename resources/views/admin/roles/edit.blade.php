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

                            @if ($rType === 'role')
                                <form method="POST" class="custom-validation"
                                    action="{{ $formType === 'edit' ? route('admin.roles.update', $data->id) : route('admin.roles.store') }}">
                            @endif
                            @if ($rType === 'permission')
                                <form method="POST" class="custom-validation"
                                    action="{{ $formType === 'edit' ? route('admin.permissions.update', $data->id) : route('admin.permissions.store') }}">
                            @endif
                            @if ($formType === 'edit')
                                @method('PUT')
                            @endif
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        @if ($formType === 'edit')
                                            <input name="name" id="name" type="text" class="form-control" required
                                                placeholder="Name" value="{{ $data->name ?? old('name') }}"
                                                {{ $data->name === 'superadmin' || $data->name === 'normaluser' ? 'disabled readonly' : '' }}>
                                        @else
                                            <input name="name" id="name" type="text" class="form-control" required
                                                placeholder="Name" value="{{ $data->name ?? old('name') }}">
                                        @endif
                                    </div>
                                </div>
                                @if ($rType === 'permission')
                                    @if ($formType === 'add')
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Give Permission To (Role)</label>
                                                <div>
                                                    @foreach ($roles as $role)
                                                        <div class="form-check m-2">
                                                            <input class="form-check-input" type="checkbox" name="roles[]"
                                                                id="roleId-{{ $role->id }}" value="{{ $role->id }}"
                                                                {{ $role->name === 'superadmin' ? 'checked disabled' : ($role->name === 'normaluser' ? 'disabled ' : '') }}>
                                                            <label class="form-check-label"
                                                                for="roleId-{{ $role->id }}">
                                                                {{ $role->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if ($rType === 'role')
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Permissions</label>
                                            <div>
                                                @if ($formType === 'edit')
                                                    <div class="row">
                                                        @foreach ($permissions as $key => $groupedPermissions)
                                                            <div class="col-md-3 col-sm-4 mb-3">
                                                                <div class="mb-1" style="font-weight: 600">
                                                                    {{ ucfirst($key) }}
                                                                </div>
                                                                @foreach ($groupedPermissions as $permission)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="permissions[]"
                                                                            id="permissionId-{{ $permission->id }}"
                                                                            value="{{ $permission->id }}"
                                                                            {{ $data->hasPermissionTo($permission->id) || (is_array(old('permissions')) && in_array($permission->id, old('permissions'))) == $permission->id ? __('checked') : __('') }}
                                                                            {{ $data->name === 'superadmin' || $data->name === 'normaluser' ? 'disabled' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="permissionId-{{ $permission->id }}">
                                                                            {{ $permission->name }}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        @foreach ($permissions as $key => $groupedPermissions)
                                                            <div class="col-md-3 col-sm-4 mb-3">
                                                                <div class="mb-1" style="font-weight: 600">
                                                                    {{ ucfirst($key) }}
                                                                </div>
                                                                @foreach ($groupedPermissions as $permission)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="permissions[]"
                                                                            id="permissionId-{{ $permission->id }}"
                                                                            value="{{ $permission->id }}"
                                                                            {{ (is_array(old('permissions')) && in_array($permission->id, old('permissions'))) == $permission->id ? __('checked') : __('') }}>
                                                                        <label class="form-check-label"
                                                                            for="permissionId-{{ $permission->id }}">
                                                                            {{ $permission->name }}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
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
