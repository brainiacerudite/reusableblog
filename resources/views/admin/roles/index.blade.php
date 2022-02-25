@extends('admin.layouts.app')
@section('title') {{ $pageTitle }} @endsection
@section('addCSS')
    <!-- DataTables -->
    {{-- <link href="{{ asset('admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css">
<link href="{{ asset('admin/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/datatables.min.css" />
@endsection

@section('addJS')
    <!-- Required datatable js -->
    {{-- <script src="{{ asset('admin/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script> --}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/r-2.2.9/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable();
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
                            @if ($rType === 'role')
                                @can('add roles')
                                    <a class="btn btn-success waves-effect waves-light"
                                        href="{{ route('admin.roles.create') }}" role="button"><i class="ti ti-plus"></i>
                                        Add</a>
                                @endcan
                            @endif
                            @if ($rType === 'permission')
                                @can('add permissions')
                                    <a class="btn btn-success waves-effect waves-light"
                                        href="{{ route('admin.permissions.create') }}" role="button"><i
                                            class="ti ti-plus"></i>
                                        Add</a>
                                @endcan
                            @endif
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
                            <table id="datatable" class="table table-striped table-bordered dt-responsive"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td style="white-space: nowrap">
                                                @if ($rType === 'role')
                                                    @can('edit roles')
                                                        <a class="btn btn-sm btn-info"
                                                            href="{{ route('admin.roles.edit', $data->id) }}"
                                                            role="button">Edit</a>
                                                    @endcan
                                                    @can('delete roles')
                                                        <button type="button" class="btn btn-sm btn-danger delBtn"
                                                            data-bs-toggle="modal" data-bs-target="#delModal"
                                                            data-delTitle="{{ $data->name }}"
                                                            data-delAction="{{ route('admin.roles.destroy', $data->id) }}">Delete</button>
                                                    @endcan
                                                @endif
                                                @if ($rType === 'permission')
                                                    @can('edit permissions')
                                                        <a class="btn btn-sm btn-info"
                                                            href="{{ route('admin.permissions.edit', $data->id) }}"
                                                            role="button">Edit</a>
                                                    @endcan
                                                    @can('delete permissions')
                                                        <button type="button" class="btn btn-sm btn-danger delBtn"
                                                            data-bs-toggle="modal" data-bs-target="#delModal"
                                                            data-delTitle="{{ $data->name }}"
                                                            data-delAction="{{ route('admin.permissions.destroy', $data->id) }}">Delete</button>
                                                    @endcan
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('admin.layouts.modal')
@endsection
