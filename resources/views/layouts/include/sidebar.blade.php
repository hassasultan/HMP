<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header mb-3">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" {{ route('home') }}" target="_blank">
            <img src="{{ asset('assets/img/unnamed.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">HMP</span>
            <p class="text-white">Hydrant Management Portal</p>
        </a>

    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white @if (Route::is('home') || Route::is('hydrant.home')) active  bg-gradient-primary @endif"
                    href=" {{ route('home') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->role == 1)
                {{-- @role('Admin') --}}
                    <li class="nav-item">
                        <a class="nav-link text-white @if (Route::is('user-management.index')) active bg-gradient-primary @endif"
                            href="{{ route('user-management.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="nav-link-text ms-1">User Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white @if (Route::is('roles.index')) active bg-gradient-primary @endif"
                            href="{{ route('roles.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="nav-link-text ms-1">Roles Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white @if (Route::is('permissions.index')) active bg-gradient-primary @endif"
                            href="{{ route('permissions.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="nav-link-text ms-1">Permissions Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white @if (Route::is('register-truck.index')) active bg-gradient-primary @endif"
                            href="{{ route('register-truck.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="nav-link-text ms-1">Register Trucks For Trcking</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white @if (Route::is('track.truck.list')) active bg-gradient-primary @endif"
                            href="{{ route('track.truck.list') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="nav-link-text ms-1">Tracking Truck</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white @if (Route::is('areas.index')) active bg-gradient-primary @endif"
                            href="{{ route('areas.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="nav-link-text ms-1">Areas</span>
                        </a>
                    </li>
                {{-- @endrole --}}
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('truck_type.list')) active  bg-gradient-primary @endif"
                        href="{{ route('truck_type.list') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-truck me-2"></i><i class="fas fa-bar-chart" aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Water Tanker Capacity</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('truck.list')) active bg-gradient-primary @endif"
                        href="{{ route('truck.list') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-truck"></i>
                        </div>
                        <span class="nav-link-text ms-1">Water Tanker</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('driver.list')) active bg-gradient-primary @endif"
                        href="{{ route('driver.list') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-truck me-2"></i><i class="fas fa-user" aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Drivers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('customer-management.index')) active bg-gradient-primary @endif"
                        href="{{ route('customer-management.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-users" aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Customer Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('order.list')) active bg-gradient-primary @endif"
                        href="{{ route('order.list') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-brands fa-first-order"></i>
                        </div>
                        <span class="nav-link-text ms-1">Order</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('order.create')) active bg-gradient-primary @endif"
                        href="{{ route('order.create') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-brands fa-first-order"></i>
                        </div>
                        <span class="nav-link-text ms-1">Create Order</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('ots.order.list')) active bg-gradient-primary @endif "
                        href="{{ route('ots.order.list') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ots Order</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('billing.list')) active bg-gradient-primary @endif "
                        href="{{ route('billing.list') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <span class="nav-link-text ms-1">Billing</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('hydrant.list')) active bg-gradient-primary @endif"
                        href="{{ route('hydrant.list') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-list"></i>
                        </div>
                        <span class="nav-link-text ms-1">Hydrants List</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->role != 1)
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('customer-management.index')) active bg-gradient-primary @endif"
                        href="{{ route('customer-management.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-users" aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Customer Management</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('hydrant.truck.list')) bg-gradient-primary active @endif"
                        href="{{ route('hydrant.truck.list') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-truck"></i>
                        </div>
                        <span class="nav-link-text ms-1">Water Tanker</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('hydrant.order.list')) active bg-gradient-primary @endif"
                        href="{{ route('hydrant.order.list') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-brands fa-first-order"></i>
                        </div>
                        <span class="nav-link-text ms-1">Order</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('order.create')) active bg-gradient-primary @endif"
                        href="{{ route('order.create') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-brands fa-first-order"></i>
                        </div>
                        <span class="nav-link-text ms-1">Create Order</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('ots.order.list')) active bg-gradient-primary @endif "
                        href="{{ route('ots.order.list') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ots Order</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('hydrant.billing.list')) active bg-gradient-primary @endif "
                        href="{{ route('hydrant.billing.list') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <span class="nav-link-text ms-1">Billing</span>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link text-white @if (Route::is('reports')) active bg-gradient-primary @endif "
                    href="{{ route('reports') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-file"></i>
                    </div>
                    <span class="nav-link-text ms-1">Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white @if (Route::is('profile.update')) active  bg-gradient-primary @endif"
                    href=" {{ route('profile.update') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    Log Out</a>
                <form sytle='display:none;' id="logout-form" action="{{ route('logout') }}" method="POST"
                    class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            {{-- <a class="btn bg-gradient-primary mt-4 w-100" href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a> --}}
        </div>
    </div>
</aside>
