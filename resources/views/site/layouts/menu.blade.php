@foreach ($menus as $menu)
    <li id="menu-item-{{ $loop->index + 1 }}"
        class="menu-item current_page_parent {{ $menu->children->count() > 0 ? __('menu-item-has-children') : __('') }} menu-item-{{ $loop->index + 1 }}">
        <a href="{{ $menu->link() }}" target="{{ $menu->target }}">{{ $menu->title }}</a>
        @if ($menu->children->count() > 0)
            <ul class="sub-menu">
                @foreach ($menu->children as $submenu)
                    <li id="menu-item-{{ $loop->index + 100 }}" class="menu-item menu-item-{{ $loop->index + 100 }}">
                        <a href="{{ $submenu->link() }}" target="{{ $submenu->target }}">{{ $submenu->title }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </li>
@endforeach
