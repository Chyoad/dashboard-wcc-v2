<ul>
    @if(!in_array(request()->route()->getName(), ['dashboard.show', 'hotspot.showUser', 'hotspot.showActive', 'server.index']))
        <!-- Bagian Dashboard Mitra -->
        <!-- Dashboard Link -->
        <li class="nav-item @if(request()->routeIs('home')) active @endif">
            <a href="{{ route('home') }}">
                <span class="icon">
                <i class="fa-solid fa-house"></i>
                </span>
                <span class="text">{{ __('Dashboard') }}</span>
            </a>
        </li>

        <!-- Pengguna Link -->
        <li class="nav-item @if(request()->routeIs('about')) active @endif">
            <a href="{{ route('about') }}">
                <span class="icon">
                <i class="fa-solid fa-users"></i>
                </span>
                <span class="text">{{ __('Pengguna') }}</span>
            </a>
        </li>

        <!-- Report Link -->
        <li class="nav-item @if(request()->routeIs('about')) active @endif">
            <a href="{{ route('about') }}">
                <span class="icon">
                <i class="fa-solid fa-inbox"></i>
                </span>
                <span class="text">{{ __('Report') }}</span>
            </a>
        </li>

        <!-- Setting Link -->
        <li class="nav-item @if(request()->routeIs('profile.show')) active @endif">
            <a href="{{ route('profile.show') }}">
                <span class="icon">
                <i class="fa-solid fa-gear"></i>
                </span>
                <span class="text">{{ __('Setting') }}</span>
            </a>
        </li>

    @else
        <!-- Bagian Dashboard IP -->

        <!-- Dashboard Link -->
        <li class="nav-item @if(request()->routeIs('dashboard.show', $id)) active @endif">
            <a href="{{ route('dashboard.show', $id) }}">
                <span class="icon">
                <i class="fa-solid fa-house"></i>
                </span>
                <span class="text">{{ __('Dashboard') }}</span>
            </a>
        </li>

        <!-- Hotspot Link -->
        <li class="nav-item nav-item-has-children">
            <a class="collapsed" href="#0" data-bs-toggle="collapse" data-bs-target="#ddmenu_1"
               aria-controls="ddmenu_1" aria-expanded="true" aria-label="Toggle navigation">
               <span class="icon">
                    <i class="fa-solid fa-users"></i>
                </span>
                <span class="text">Hotspot</span>
            </a>
            <ul id="ddmenu_1" class="dropdown-nav collapse">
                <li>
                    <a href="{{ route('hotspot.showUser', $id) }}">All User</a>
                </li>
                <li>
                    <a href="{{ route('hotspot.showActive', $id) }}">User Active</a>
                </li>
            </ul>
        </li>

        <!-- Traffic Link -->
        <li class="nav-item @if(request()->routeIs('server.index')) active @endif">
            <a href="{{ route('server.index') }}">
                <span class="icon">
                <i class="fa-solid fa-wifi"></i>
                </span>
                <span class="text">{{ __('Traffic') }}</span>
            </a>
        </li>

        <!-- Report Link -->
        <li class="nav-item @if(request()->routeIs('server.index')) active @endif">
            <a href="{{ route('server.index') }}">
                <span class="icon">
                <i class="fa-solid fa-inbox"></i>
                </span>
                <span class="text">{{ __('Report') }}</span>
            </a>
        </li>
    @endif
</ul>