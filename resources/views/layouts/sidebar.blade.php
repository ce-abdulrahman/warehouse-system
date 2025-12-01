<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ $settings['logo'] }}" alt="" height="22">
                        <span class="text-center">{{ $settings['system_name'] }}</span>

                    </span>
                    <span class="logo-lg">
                        <img src="{{ $settings['logo'] }}" alt="" height="24">
                        <span class="text-center">{{ $settings['system_name'] }}</span>

                    </span>
                </a>
                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ $settings['logo'] }}" alt="" height="22">
                        <span class="text-center">{{ $settings['system_name'] }}</span>

                    </span>
                    <span class="logo-lg">
                        <img src="{{ $settings['logo'] }}" alt="" height="24">
                        <span class="text-center">{{ $settings['system_name'] }}</span>

                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Menu</li>

                @php
                    // route for using active
                    $currentRoute = Route::currentRouteName();
                @endphp

                <li>
                    <a href="{{ route('dashboard') }}"
                        class="tp-link {{ $currentRoute == 'dashboard' ? 'active' : '' }}">
                        <i data-feather="home"></i>
                        <span> Home </span>
                    </a>
                </li>

                <!-- <li>
                                <a href="landing.html" target="_blank">
                                    <i data-feather="globe"></i>
                                    <span> Landing </span>
                                </a>
                            </li> -->

                <li class="menu-title">Pages</li>

                <li>
                    <a href="{{ route('items.index') }}"
                        class="tp-link {{ $currentRoute == 'items.index' ? 'active' : '' }}">
                        <i data-feather="shopping-cart"></i>
                        <span> Items </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('warehouses.index') }}"
                        class="tp-link {{ $currentRoute == 'warehouses.index' ? 'active' : '' }}">
                        <i data-feather="truck"></i>
                        <span> Warehouse </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('movements.index') }}"
                        class="tp-link {{ $currentRoute == 'movements.index' ? 'active' : '' }}">
                        <i data-feather="repeat"></i>
                        <span> Movements </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('suppliers.index') }}"
                        class="tp-link {{ $currentRoute == 'suppliers.index' ? 'active' : '' }}">
                        <i data-feather="users"></i>
                        <span> Suppliers </span>
                    </a>
                </li>

                <li class="menu-title mt-2">General</li>

                <li>
                    <a href="{{ route('users.index') }}"
                        class="tp-link {{ $currentRoute == 'users.index' ? 'active' : '' }}">
                        <i data-feather="user-plus"></i>
                        <span> Users </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('settings.index') }}"
                        class="tp-link {{ $currentRoute == 'settings.index' ? 'active' : '' }}">
                        <i data-feather="settings"></i>
                        <span> Settings </span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
