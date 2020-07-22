<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

    <div class="navbar-header">
        <div class="navbar-brand navbar-brand-center active" data-toggle="gridmenu" aria-expanded="true">
            <a class="text-white text-decoration-none" href="{{ route(HOME) }}">
                <img class="navbar-brand-logo" src="{{ asset('assets/media/logo.png') }}">
                <span class="navbar-brand-text hidden-xs-down"> The Common Home</span>
            </a>
        </div>
    </div>

    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="nav-item hidden-float" id="toggleMenubar">
                    <a class="nav-link" data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>
            </ul>
            <!-- End Navbar Toolbar -->

            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
{{--                <li class="nav-item dropdown">--}}
{{--                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up" aria-expanded="false" role="button">--}}
{{--                        <span class="flag-icon flag-icon-us"></span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu" role="menu">--}}
{{--                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">--}}
{{--                            <span class="flag-icon flag-icon-gb"></span> English</a>--}}
{{--                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">--}}
{{--                            <span class="flag-icon flag-icon-fr"></span> French</a>--}}
{{--                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">--}}
{{--                            <span class="flag-icon flag-icon-cn"></span> Chinese</a>--}}
{{--                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">--}}
{{--                            <span class="flag-icon flag-icon-de"></span> German</a>--}}
{{--                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">--}}
{{--                            <span class="flag-icon flag-icon-nl"></span> Dutch</a>--}}
{{--                    </div>--}}
{{--                </li>--}}
                <li class="nav-item dropdown">
                    <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button">
                <span class="avatar avatar-online">
                  <img src="{{ asset('assets/media/profile.png') }}" alt="...">
                  <i></i>
                </span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profile</a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-payment" aria-hidden="true"></i> Billing</a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> Settings</a>
                        <div class="dropdown-divider" role="presentation"></div>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
                    </div>
                </li>

            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->

    </div>
</nav>
