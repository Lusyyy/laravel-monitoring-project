<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="white">
            <a href="/dashboard" class="logo">
                <img src="{{ asset('assets/img/imsc.png') }}" alt="navbar brand" class="navbar-brand" height="37" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="/dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('projects') ? 'active' : '' }}">
                    <a href="/projects">
                        <i class="fas fa-file"></i>
                        <p>Projects</p>
                    </a>
                </li>
                @can('admin')
                    <li class="nav-item {{ request()->is('members') ? 'active' : '' }}">
                        <a href="/members">
                            <i class="fas fa-user-friends"></i>
                            <p>Members</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
