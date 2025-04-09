<!-- Navbar Header -->
<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
    style="background-color: #1A2035">
    <div class="container-fluid">
        @if (Request::is('projects*'))
        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pe-1">
                        <i class="fa fa-search search-icon"></i>
                    </button>
                </div>
                <form action="/projects">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by project name" class="form-control" />
                </form>
            </div>
        </nav>
        @endif

        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                @if (Request::is('projects*'))
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false" aria-haspopup="true">
                    <i class="fa fa-search"></i>
                </a>
                <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form action="/projects" class="navbar-left navbar-form nav-search">
                        <div class="input-group">
                            <input type="text" placeholder="Search by project name" class="form-control"
                            name="search" value="{{ request('search') }}" />
                        </div>
                    </form>
                </ul>
                @endif
            </li>
            <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="{{ asset('assets/img/profilblank.png') }}" alt="..."
                            class="avatar-img rounded-circle" />
                    </div>
                    <span class="profile-username"style="color: white;">
                        <span class="op-7-bold" style="color: white;">Hi,</span>
                        <span class="fw-bold" style="color: white;">{{ auth()->user()->name }}</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg">
                                    <img src="{{ asset('assets/img/profilblank.png') }}" alt="image profile"
                                        class="avatar-img rounded" />
                                </div>
                                <div class="u-text">
                                    <h4>{{ auth()->user()->name }}</h4>
                                    <p class="text-muted">{{ auth()->user()->email }}</p>
                                    <div class="row">
                                        <div class="col-8">
                                            <a href="/profile" class="btn btn-xs btn-secondary btn-sm"
                                                style="width: 85px; margin-right: 10px;">View Profile
                                            </a>
                                        </div>
                                    
                                        <div class="col-4" style="margin-right: -100px">
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <button class="btn btn-xs btn-danger btn-sm" type="submit" style="margin-left: 10px">
                                                    Logout</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!-- End Navbar -->