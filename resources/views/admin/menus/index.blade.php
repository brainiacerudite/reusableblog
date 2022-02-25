@extends('admin.layouts.app')
@section('title') {{ $pageTitle }} @endsection
@section('addCSS')
    <style>
        .dd .item_actions {
            z-index: 9;
            position: relative;
            top: -47px;
            right: 20px;
        }

        .dd .item_actions .delete,
        .dd .item_actions .edit {
            cursor: pointer
        }

        .dd .item_actions .edit {
            margin-right: 5px
        }

        .dd .dd-handle .url {
            font-weight: 400;
            margin-left: 10px
        }

        .dd {
            font-size: 13px;
            line-height: 20px
        }

        .dd,
        .dd-list {
            position: relative;
            display: block;
            margin: 0;
            padding: 0;
            list-style: none
        }

        .dd-list .dd-list {
            padding-left: 30px
        }

        .dd-collapsed .dd-list {
            display: none
        }

        .dd-empty,
        .dd-item,
        .dd-placeholder {
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            min-height: 20px;
            font-size: 13px;
            line-height: 20px
        }

        .dd-handle {
            display: block;
            height: 50px;
            margin: 5px 0;
            padding: 14px 25px;
            color: #333;
            text-decoration: none;
            font-weight: 700;
            border: 1px solid #ccc;
            background: #fafafa;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box
        }

        .dd-handle:hover {
            color: #2ea8e5;
            background: #fff
        }

        .dd-item>button {
            display: block;
            position: relative;
            cursor: pointer;
            float: left;
            width: 40px;
            height: 37px;
            margin: 5px 0;
            padding: 0;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            border: 0;
            background: transparent;
            font-size: 12px;
            line-height: 1;
            text-align: center;
            font-weight: 700
        }

        .dd-item>button:before {
            content: "+";
            display: block;
            position: absolute;
            width: 100%;
            text-align: center;
            text-indent: 0
        }

        .dd-item>button[data-action=collapse]:before {
            content: "-"
        }

        .dd-empty,
        .dd-placeholder {
            margin: 5px 0;
            padding: 0;
            min-height: 30px;
            background: #f2fbff;
            border: 1px dashed #b6bcbf;
            box-sizing: border-box;
            -moz-box-sizing: border-box
        }

        .dd-empty {
            border: 1px dashed #bbb;
            min-height: 100px;
            background-color: #e5e5e5;
            background-image: linear-gradient(45deg, #fff 25%, transparent 0, transparent 75%, #fff 0, #fff), linear-gradient(45deg, #fff 25%, transparent 0, transparent 75%, #fff 0, #fff);
            background-size: 60px 60px;
            background-position: 0 0, 30px 30px
        }

        .dd-dragel {
            position: absolute;
            pointer-events: none;
            z-index: 9999
        }

        .dd-dragel>.dd-item .dd-handle {
            margin-top: 0
        }

        .dd-dragel .dd-handle {
            box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1)
        }

        .nestable-lists {
            display: block;
            clear: both;
            padding: 30px 0;
            width: 100%;
            border: 0;
            border-top: 2px solid #ddd;
            border-bottom: 2px solid #ddd
        }

        #nestable-menu {
            padding: 0;
            margin: 20px 0
        }

        #nestable2-output,
        #nestable-output {
            width: 100%;
            height: 7em;
            font-size: .75em;
            line-height: 1.333333em;
            font-family: Consolas, monospace;
            padding: 5px;
            box-sizing: border-box;
            -moz-box-sizing: border-box
        }

        #nestable2 .dd-handle {
            color: #fff;
            border: 1px solid #999;
            background: #bbb;
            background: linear-gradient(180deg, #bbb 0, #999)
        }

        .menus .table>tbody>tr>td {
            line-height: 44px
        }

        #nestable2 .dd-handle:hover {
            background: #bbb
        }

        #nestable2 .dd-item>button:before {
            color: #fff
        }

        @media only screen and (min-width:700px) {
            .dd {
                float: left;
                width: 100%
            }

            .dd+.dd {
                margin-left: 2%
            }
        }

        .dd-hover>.dd-handle {
            background: #2ea8e5 !important
        }

        .dd3-content {
            display: block;
            height: 30px;
            margin: 5px 0;
            padding: 5px 10px 5px 40px;
            color: #333;
            text-decoration: none;
            font-weight: 700;
            border: 1px solid #ccc;
            background: #fafafa;
            background: linear-gradient(180deg, #fafafa 0, #eee);
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box
        }

        .dd3-content:hover {
            color: #2ea8e5;
            background: #fff
        }

        .dd-dragel>.dd3-item>.dd3-content {
            margin: 0
        }

        .dd3-item>button {
            margin-left: 30px
        }

        .dd3-handle {
            position: absolute;
            margin: 0;
            left: 0;
            top: 0;
            cursor: pointer;
            width: 30px;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            border: 1px solid #aaa;
            background: #ddd;
            background: linear-gradient(180deg, #ddd 0, #bbb);
            border-top-right-radius: 0;
            border-bottom-right-radius: 0
        }

        .dd3-handle:before {
            content: "≡";
            display: block;
            position: absolute;
            left: 0;
            top: 3px;
            width: 100%;
            text-align: center;
            text-indent: 0;
            color: #fff;
            font-size: 20px;
            font-weight: 400
        }

        .dd3-handle:hover {
            background: #ddd
        }

    </style>
@endsection

@section('addJS')
    <script src="{{ asset('admin/assets/libs/jquery/jquery.nestable.js') }}"></script>
    <script>
        $('.dd').nestable({
            expandBtnHTML: '',
            collapseBtnHTML: '',
            maxDepth: 2
        });
    </script>
    <script>
        $(document).ready(function() {
            /**
             * Reorder items
             */
            $('.dd').on('change', function() {
                $.post('{{ route('admin.menus.order') }}', {
                    order: JSON.stringify($('.dd').nestable('serialize')),
                    _token: '{{ csrf_token() }}'
                }, function(data) {
                    alert('successful');
                });
            });
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
                            @can('add menus')
                                <a class="btn btn-success waves-effect waves-light" href="{{ route('admin.menus.create') }}"
                                    role="button"><i class="ti ti-plus"></i> Add</a>
                            @endcan
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
                            <div class="dd">
                                <ol class="dd-list">
                                    @foreach ($datas as $data)
                                        @can('edit menus')
                                            <li class="dd-item" data-id="{{ $data->id }}">
                                                <div class="dd-handle">
                                                    {{ $data->title }}
                                                    <small class="text-blue-grey">{{ $data->link() }}</small>
                                                </div>
                                                <div class="float-end item_actions">
                                                    <a class="btn btn-sm btn-info edit"
                                                        href="{{ route('admin.menus.edit', $data->id) }}"
                                                        role="button">Edit</a>
                                                    @can('delete menus')
                                                        <button type="button" class="btn btn-sm btn-danger delBtn"
                                                            data-bs-toggle="modal" data-bs-target="#delModal"
                                                            data-delTitle="{{ $data->title }}"
                                                            data-delAction="{{ route('admin.menus.destroy', $data->id) }}">Delete</button>
                                                    @endcan
                                                </div>
                                                {{-- {{ dd($data->children) }} --}}
                                                @if ($data->children != null)
                                                    <ol class="dd-list">
                                                        @foreach ($data->children as $child)

                                                            @can('edit menus')
                                                                <li class="dd-item" data-id="{{ $child->id }}">
                                                                    <div class="dd-handle">
                                                                        {{ $child->title }}
                                                                        <small
                                                                            class="text-blue-grey">{{ $child->link() }}</small>
                                                                    </div>
                                                                    <div class="float-end item_actions">
                                                                        <a class="btn btn-sm btn-info edit"
                                                                            href="{{ route('admin.menus.edit', $child->id) }}"
                                                                            role="button">Edit</a>
                                                                        @can('delete menus')
                                                                            <button type="button" class="btn btn-sm btn-danger delBtn"
                                                                                data-bs-toggle="modal" data-bs-target="#delModal"
                                                                                data-delTitle="{{ $child->title }}"
                                                                                data-delAction="{{ route('admin.menus.destroy', $child->id) }}">Delete</button>
                                                                        @endcan
                                                                    </div>
                                                                </li>
                                                            @endcan
                                                        @endforeach
                                                    </ol>
                                                @endif
                                            </li>
                                        @endcan
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('admin.layouts.modal')
@endsection
