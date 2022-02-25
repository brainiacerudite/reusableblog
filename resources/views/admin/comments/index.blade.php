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
                            {{--  @can('add comments')
                                <a class="btn btn-success waves-effect waves-light" href="{{ route('admin.comments.create') }}"
                                    role="button"><i class="ti ti-plus"></i> Add</a>
                            @endcan  --}}
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
                                        <th>Author</th>
                                        <th>Comment</th>
                                        <th>In response to</th>
                                        <th>Submitted On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ ucwords($data->name) }}</td>
                                            <td>
                                                @if (isset($data->parent->name))
                                                    <small class="mt-2 text-facebook">
                                                        In reply to <a target="_blank"
                                                            href="{{ route('singlePost', $data->post->slug) }}#comment-{{ $data->id }}">{{ $data->parent->name }}</a>
                                                    </small>
                                                    <br>
                                                @endif
                                                {{ $data->comment }}
                                            </td>
                                            <td>
                                                {{ $data->post->title }}
                                                <br>
                                                <small class="mt-2 text-facebook">
                                                    <a href="{{ route('singlePost', $data->post->slug) }}"
                                                        target="_blank">View Post</a>
                                                </small>
                                            </td>
                                            <td>
                                                <span>{{ $data->created_at->format('d/m/Y') }},</span>
                                                <br>
                                                <span>{{ $data->created_at->format('h:m a') }}</span>
                                            </td>
                                            <td style="white-space: nowrap;">
                                                @can('edit comments')
                                                    @if ($data->approved == 1)
                                                        <button type="button" class="btn btn-sm btn-warning aprBtn"
                                                            data-bs-toggle="modal" data-bs-target="#aprModal"
                                                            data-aprTitle="unapprove {{ ucwords($data->name) }}'s comment"
                                                            data-aprAction="{{ route('admin.comments.unapprove', $data->id) }}">Unapprove</button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-success aprBtn"
                                                            data-bs-toggle="modal" data-bs-target="#aprModal"
                                                            data-aprTitle="approve {{ ucwords($data->name) }}'s comment"
                                                            data-aprAction="{{ route('admin.comments.approve', $data->id) }}">Approve</button>
                                                    @endif
                                                    <button type="button" class="btn btn-sm btn-primary replyBtn"
                                                        data-bs-toggle="modal" data-bs-target="#replyModal"
                                                        data-replyTitle="{{ ucwords($data->name) }}"
                                                        data-replyAction="{{ route('admin.comments.reply', $data->id) }}"
                                                        data-replyID="{{ $data->id }}"
                                                        data-replyPostID="{{ $data->post->id }}">Reply</button>
                                                    <br>
                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ route('admin.comments.edit', $data->id) }}"
                                                        role="button">Edit</a>
                                                @endcan
                                                @can('delete comments')
                                                    <button type="button" class="btn btn-sm btn-danger delBtn"
                                                        data-bs-toggle="modal" data-bs-target="#delModal"
                                                        data-delTitle="{{ ucwords($data->name) }}'s comment"
                                                        data-delAction="{{ route('admin.comments.destroy', $data->id) }}">Delete</button>
                                                @endcan
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
