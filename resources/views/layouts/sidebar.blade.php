@php
    // route for using active
    $currentRoute = Route::currentRouteName();
@endphp

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="submenu">
                <li>
                    <a href="{{ route('dashboard') }}"><i
                            class="la la-dashboard {{ $currentRoute == 'dashboard' ? 'active' : '' }}"></i>
                        <span>Dashboard</span></a>
                </li>
                </li>

                <li class="menu-title">
                    <span>Pages</span>
                </li>
                <li class="submenu">
                <li>
                    <a href="{{ route('items.index') }}"><i
                            class="la la-file-text {{ $currentRoute == 'items.index' ? 'active' : '' }}"></i>
                        <span>Items</span></a>
                </li>
                <li>
                    <a href="{{ route('movements.index') }}"><i
                            class="la la-file-text {{ $currentRoute == 'movements.index' ? 'active' : '' }}"></i>
                        <span>Movements</span></a>
                </li>
                <li>
                    <a href="{{ route('warehouses.index') }}"><i
                            class="la la-file-text {{ $currentRoute == 'warehouses.index' ? 'active' : '' }}"></i>
                        <span>Warehouses</span></a>
                </li>
                <li>
                    <a href="{{ route('suppliers.index') }}"><i
                            class="la la-file-text {{ $currentRoute == 'suppliers.index' ? 'active' : '' }}"></i>
                        <span>Suppliers</span></a>
                </li>

                </li>

                <li class="menu-title">
                    <span>General</span>
                </li>
                <li class="submenu">
                <li>
                    <a href="{{ route('users.index') }}"><i class="la la-users"></i> <span>Users</span></a>
                </li>
                <li>
                    <a href="{{ route('settings.index') }}"><i class="la la-cog"></i> <span>Settings</span></a>
                </li>
                </li>




            </ul>
        </div>
    </div>
</div>
