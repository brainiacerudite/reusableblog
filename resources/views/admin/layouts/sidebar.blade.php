<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title">Components</li>
                @can('browse posts')
                    <li>
                        <a href="{{ route('admin.posts.index') }}" class="waves-effect">
                            <i class="ti-files"></i>
                            <span>Posts</span>
                        </a>
                    </li>
                @endcan
                @can('browse categories')
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="waves-effect">
                            <i class="ti-layers-alt"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                @endcan
                @can('browse tags')
                    <li>
                        <a href="{{ route('admin.tags.index') }}" class="waves-effect">
                            <i class="ti-tag"></i>
                            <span>Tags</span>
                        </a>
                    </li>
                @endcan
                @can('browse comments')
                    <li>
                        <a href="{{ route('admin.comments.index') }}" class="waves-effect">
                            <i class="ti-comments"></i>
                            <span>Comments</span>
                        </a>
                    </li>
                @endcan

                {{-- <li class="menu-title">Media</li>
                @can('browse media')
                <li>
                    <a href="#" class="waves-effect">
                        <i class="ti-folder"></i>
                        <span>Media</span>
                    </a>
                </li>
                @endcan --}}

                <li class="menu-title">Frontends</li>
                @can('browse pages')
                    <li>
                        <a href="{{ route('admin.pages.index') }}" class="waves-effect">
                            <i class="ti-layout-column2"></i>
                            <span>Pages</span>
                        </a>
                    </li>
                @endcan
                @can('browse menus')
                    <li>
                        <a href="{{ route('admin.menus.index') }}" class="waves-effect">
                            <i class="ti-menu"></i>
                            <span>Menu</span>
                        </a>
                    </li>
                @endcan
                @can('browse banners')
                    <li>
                        <a href="{{ route('admin.banner.index') }}" class="waves-effect">
                            <i class="ti-clipboard"></i>
                            <span>Ads Banner</span>
                        </a>
                    </li>
                @endcan

                <li class="menu-title">Panel</li>
                @can('browse users')
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="waves-effect">
                            <i class="fa fa-users"></i>
                            <span>Users</span>
                        </a>
                    </li>
                @endcan
                @can('browse administrators')
                    <li>
                        <a href="{{ route('admin.administrators.index') }}" class="waves-effect">
                            <i class="ti-id-badge"></i>
                            <span>Administrators</span>
                        </a>
                    </li>
                @endcan
                @can('browse roles')
                    <li>
                        <a href="{{ route('admin.roles.index') }}" class="waves-effect">
                            <i class="ti-medall"></i>
                            <span>Roles</span>
                        </a>
                    </li>
                @endcan
                {{--  @can('browse permissions')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}" class="waves-effect">
                            <i class="ti-medall-alt"></i>
                            <span>Permissions</span>
                        </a>
                    </li>
                @endcan  --}}

                <li class="menu-title">Manage</li>
                {{--  @can('browse settings')  --}}
                    <li>
                        <a href="{{ route('admin.settings.index') }}" class="waves-effect">
                            <i class="ti-user"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                {{--  @endcan  --}}
                @can('browse settings')
                    <li>
                        <a href="{{ route('admin.settings.index') }}#site" class="waves-effect">
                            <i class="ti-settings"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                @endcan

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
