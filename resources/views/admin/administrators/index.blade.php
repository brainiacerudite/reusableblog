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
                            @if ($rType === 'admin')
                                @can('add administrators')
                                    <a class="btn btn-success waves-effect waves-light"
                                        href="{{ route('admin.administrators.create') }}" role="button"><i
                                            class="ti ti-plus"></i> Add</a>
                                @endcan
                            @endif
                            @if ($rType === 'user')
                                @can('add users')
                                    <a class="btn btn-success waves-effect waves-light"
                                        href="{{ route('admin.users.create') }}" role="button"><i class="ti ti-plus"></i>
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
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ ucwords($data->name) }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->roles()->pluck('name')->implode(' ') }}</td>
                                            <td style="white-space: nowrap">
                                                @if ($rType === 'admin')
                                                    @can('edit administrators')
                                                        <a class="btn btn-sm btn-info"
                                                            href="{{ route('admin.administrators.edit', $data->id) }}"
                                                            role="button">Edit</a>
                                                    @endcan
                                                    @can('delete administrators')
                                                        <button type="button" class="btn btn-sm btn-danger delBtn"
                                                            data-bs-toggle="modal" data-bs-target="#delModal"
                                                            data-delTitle="{{ $data->name }}"
                                                            data-delAction="{{ route('admin.administrators.destroy', $data->id) }}">Delete</button>
                                                    @endcan
                                                @endif
                                                @if ($rType === 'user')
                                                    @can('edit users')
                                                        <a class="btn btn-sm btn-info"
                                                            href="{{ route('admin.users.edit', $data->id) }}"
                                                            role="button">Edit</a>
                                                    @endcan
                                                    @can('delete users')
                                                        <button type="button" class="btn btn-sm btn-danger delBtn"
                                                            data-bs-toggle="modal" data-bs-target="#delModal"
                                                            data-delTitle="{{ $data->name }}"
                                                            data-delAction="{{ route('admin.users.destroy', $data->id) }}">Delete</button>
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
