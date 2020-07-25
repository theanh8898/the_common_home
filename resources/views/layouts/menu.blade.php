<div class="site-menubar">
    <div class="site-menubar-body scrollable scrollable-inverse scrollable-vertical hoverscorll-disabled is-enabled is-hovering" style="position: relative;">
        <div class="scrollable-container" style="height: 795.984px; width: 275px;">
            <div class="scrollable-content" style="width: 260px;">
                <ul class="site-menu" data-plugin="menu" style="transform: translate3d(0px, 0px, 0px);">
                    <li class="site-menu-category">General</li>
                    <li class="site-menu-item has-sub  {{ Request::is('categories') || Request::is('categories/*') ? 'active open' : '' }}">
                        <a href="javascript:void(0)" >
                            <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                            <span class="site-menu-title">Manage Categories</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub" style="">
                            <li class="site-menu-item {{ Request::is('categories/create') ? 'active' : '' }}">
                                <a class="animsition-link" href="{{ route(CREATE_CATEGORY) }}">
                                    <span class="site-menu-title">Create Categories</span>
                                </a>
                            </li>
                            <li class="site-menu-item {{ Request::is('categories') ? 'active' : '' }}">
                                <a class="animsition-link" href="{{ route(LIST_CATEGORY) }}">
                                    <span class="site-menu-title">Category List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub {{ Request::is('articles') || Request::is('articles/*') ? 'active open' : '' }}">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon fa-newspaper-o" aria-hidden="true"></i>
                            <span class="site-menu-title">Manage Articles</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item {{ Request::is('articles/create') ? 'active' : '' }}">
                                <a class="animsition-link" href="{{ route(CREATE_ARTICLE) }}">
                                    <span class="site-menu-title">Create Article</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="scrollable-bar scrollable-bar-vertical is-disabled" draggable="false"><div class="scrollable-bar-handle"></div></div></div>

    <div class="site-menubar-footer">
        <a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip" data-original-title="Settings">
            <span class="icon wb-settings" aria-hidden="true"></span>
        </a>
        <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">
            <span class="icon wb-eye-close" aria-hidden="true"></span>
        </a>
        <a href="#" class="user-logout"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
            data-placement="top" data-toggle="tooltip" data-original-title="Logout">
            <span class="icon wb-power" aria-hidden="true"></span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div></div>
