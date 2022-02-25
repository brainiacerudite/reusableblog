<ol class="breadcrumb m-0">
    <li class="breadcrumb-item">
        <i class="ti ti-home"></i>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>

    @for ($i = 2; $i <= count(Request::segments()); $i++)
        <li class="breadcrumb-item">
            <a href="{{ URL::to(implode('/', array_slice(Request::segments(), 0, $i, true))) }}">
                {{ ucwords(Request::segment($i)) }}
            </a>
        </li>
    @endfor
</ol>
