<div class="logo-container">
    <a href="/home" class="logo">
        <img src="{{ asset('/assets/img/logo-modern.png') }}" class="logo-image" alt="PinkAd" /><img src="{{ asset('/assets/img/logo-default.png') }}" class="logo-image-mobile" width="90" height="41" alt="PinkAd" />
    </a>
    <button class="btn header-btn-collapse-nav d-lg-none" data-bs-toggle="collapse" data-bs-target=".header-nav">
        <i class="fas fa-bars"></i>
    </button>

    <div class="header-nav collapse">
        <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 header-nav-main-square d-lg-none" >
            <nav>
                <ul class="nav nav-pills" id="mainNav">
                    <li class="">
                        <a class="nav-link" href="home">
                            Home
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#">
                            Users
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="nav-link" href="/user_roles">
                                    User Roles
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="/users">
                                    All Users
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a class="nav-link" href="{{ route('salesman-management.index') }}">
                            Salesman
                        </a>
                    </li>

                    <li class="">
                        <a class="nav-link" href="{{ route('visitor-management.index') }}">
                            Visitors
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#">
                            Seller
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="nav-link" href="/seller-management">
                                    Sellers List
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="/seller-shops">
                                    Sellers Shops
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#">
                            Location
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="nav-link" href="/province-management">
                                    Provinces
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="/city-management">
                                    Cities
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="/area-management">
                                    Areas
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#">
                            Offers
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="nav-link" href="/offer-categories">
                                    Categories
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="/offer-sub-categories">
                                    Sub Categories
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="/offer-management">
                                    Offers
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#">
                            Premium
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="nav-link" href="/packages">
                                    Packages
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="/banners">
                                    Banners
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="dropdown dropdown-mega">
                        <a class="nav-link dropdown-toggle" href="#">Reports</a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="dropdown-mega-content">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <ul class="dropdown-mega-sub-nav">
                                                <li>
                                                    <a class="nav-link" href="ui-elements-typography.html">
                                                        Typography
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="#">
                                                        Icons <span class="mega-sub-nav-toggle toggled float-end" data-toggle="collapse" data-target=".mega-sub-nav-sub-menu-1"></span>
                                                    </a>
                                                    <ul class="dropdown-mega-sub-nav mega-sub-nav-sub-menu-1 collapse in">
                                                        <li>
                                                            <a class="nav-link" href="ui-elements-icons-elusive.html">
                                                                Elusive
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="nav-link" href="ui-elements-icons-font-awesome.html">
                                                                Font Awesome
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="nav-link" href="ui-elements-icons-line-icons.html">
                                                                Line Icons
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="nav-link" href="ui-elements-icons-meteocons.html">
                                                                Meteocons
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="nav-link" href="ui-elements-icons-box-icons.html">
                                                                Box Icons
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-tabs.html">
                                                        Tabs
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-cards.html">
                                                        Cards
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-3">
                                            <ul class="dropdown-mega-sub-nav">
                                                <li>
                                                    <a class="nav-link" href="ui-elements-widgets.html">
                                                        Widgets
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-portlets.html">
                                                        Portlets
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-buttons.html">
                                                        Buttons
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-alerts.html">
                                                        Alerts
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-notifications.html">
                                                        Notifications
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-modals.html">
                                                        Modals
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-lightbox.html">
                                                        Lightbox
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-progressbars.html">
                                                        Progress Bars
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-3">
                                            <ul class="dropdown-mega-sub-nav">
                                                <li>
                                                    <a class="nav-link" href="ui-elements-sliders.html">
                                                        Sliders
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-carousels.html">
                                                        Carousels
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-accordions.html">
                                                        Accordions
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-toggles.html">
                                                        Toggles
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-nestable.html">
                                                        Nestable
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-tree-view.html">
                                                        Tree View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-scrollable.html">
                                                        Scrollable
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-grid-system.html">
                                                        Grid System
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-3">
                                            <ul class="dropdown-mega-sub-nav">
                                                <li>
                                                    <a class="nav-link" href="ui-elements-charts.html">
                                                        Charts
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="#">
                                                        Animations <span class="mega-sub-nav-toggle toggled float-end" data-toggle="collapse" data-target=".mega-sub-nav-sub-menu-2"></span>
                                                    </a>
                                                    <ul class="dropdown-mega-sub-nav mega-sub-nav-sub-menu-2 collapse">
                                                        <li>
                                                            <a class="nav-link" href="ui-elements-animations-appear.html">
                                                                Appear
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="nav-link" href="ui-elements-animations-hover.html">
                                                                Hover
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="#">
                                                        Loading <span class="mega-sub-nav-toggle toggled float-end" data-toggle="collapse" data-target=".mega-sub-nav-sub-menu-3"></span>
                                                    </a>
                                                    <ul class="dropdown-mega-sub-nav mega-sub-nav-sub-menu-3 collapse">
                                                        <li>
                                                            <a class="nav-link" href="ui-elements-loading-overlay.html">
                                                                Overlay
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="nav-link" href="ui-elements-loading-progress.html">
                                                                Progress
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="ui-elements-extra.html">
                                                        Extra
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
    </div>

</div>

<!-- start: search & user box -->
<div class="header-right">


    <ul class="notifications">

        <li>
            <a href="/settings" class="notification-icon">
                <i class="bx bx-cog"></i>
            </a>
        </li>

        <li>
            <a href="#" class="dropdown-toggle notification-icon" data-bs-toggle="dropdown">
                <i class="bx bx-envelope"></i>
                <span class="badge">4</span>
            </a>

            <div class="dropdown-menu notification-menu">
                <div class="notification-title">
                    <span class="float-end badge badge-default">230</span>
                    Messages
                </div>

                <div class="content">
                    <hr />

                    <div class="text-end">
                        <a href="#" class="view-more">View All</a>
                    </div>
                </div>
            </div>
        </li>

    </ul>

    <span class="separator"></span>

    <div id="userbox" class="userbox">
        <a href="#" data-bs-toggle="dropdown">
            <span class="profile-picture profile-picture-as-text">JD</span>
        </a>

        <div class="dropdown-menu">
            <ul class="list-unstyled">
                <li>
                    <a role="menuitem" tabindex="-1" href="#"><i class="bx bx-user"></i> My Profile</a>
                </li>
                <li>
                    <a role="menuitem" tabindex="-1" href="lock" ><i class="bx bx-lock-open-alt"></i> Lock Screen</a>
                </li>
                <li>
                    <a role="menuitem" tabindex="-1" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="bx bx-log-out"></i> Logout</a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
