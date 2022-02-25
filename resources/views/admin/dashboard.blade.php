@extends('admin.layouts.app')
{{-- @section('title') {{ $pageTitle }} @endsection --}}
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Dashboard</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Welcome to {{ config('settings.site_name') }} Dashboard</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-cog me-2"></i> Settings
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('admin.settings.index') }}">Profile</a>
                                    <div class="dropdown-divider"></div>
                                    @can('read settings')
                                        <a class="dropdown-item" href="{{ route('admin.settings.index') }}#site">Settings</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-start mini-stat-img me-4">
                                    <i class="ti-files"></i>
                                </div>
                                <h5 class="font-size-16 text-uppercase text-white-50">Posts</h5>
                                <h4 class="fw-medium font-size-24">{{ $countPost }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-start mini-stat-img me-4">
                                    <i class="ti-comments"></i>
                                </div>
                                <h5 class="font-size-16 text-uppercase text-white-50">Comments</h5>
                                <h4 class="fw-medium font-size-24">{{ $countComment }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-start mini-stat-img me-4">
                                    <i class="ti-layout-column2"></i>
                                </div>
                                <h5 class="font-size-16 text-uppercase text-white-50">Pages</h5>
                                <h4 class="fw-medium font-size-24">{{ $countPage }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-start mini-stat-img me-4">
                                    <i class="fa fa-users"></i>
                                </div>
                                <h5 class="font-size-16 text-uppercase text-white-50">Users</h5>
                                <h4 class="fw-medium font-size-24">{{ $countUser }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
