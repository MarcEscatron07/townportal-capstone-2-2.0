<header class="bg-secondary">
    <nav class="topnav navbar-dark d-flex justify-content-between h-100">
        <div class="d-flex nav-title justify-content-center align-items-center text-white">
            <a href="{{ url('/home') }}" class="text-white text-decoration-none"><h1 class="m-0"><i class="fas fa-scroll fa-lg"></i> Town Portal</h1></a>
        </div>
        <div class="d-flex align-items-center">
            <a class="p-2 mx-1 text-decoration-none tooltip-test" title="Maintenance Log" href="{{ url('/maintenancelog') }}"><div class="position-relative clearfix">           
                <i class="fas fa-clipboard-list text-white fa-lg"></i>
                @if(session('maintenancecount') != 0)
                    <span class="maintenance-count count-badge rounded-border badge badge-danger">{{ session()->get('maintenancecount') }}</span>
                @else
                    <span class="maintenance-count count-badge rounded-border badge badge-danger" hidden></span>
                @endif
            </div></a>
            <a class="p-2 mx-1 text-decoration-none tooltip-test" title="Disposal Archive" href="{{ url('/disposalarchive') }}"><div class="position-relative clearfix">                
                <i class="fas fa-archive text-white fa-lg"></i>
                @if(session('disposalcount') != 0)
                    <span class="disposal-count count-badge rounded-border badge badge-danger">{{ session()->get('disposalcount') }}</span>
                @else
                    <span class="disposal-count count-badge rounded-border badge badge-danger" hidden></span>
                @endif
            </div></a>

            {{-- <a class="p-2 mx-1 text-decoration-none tooltip-test" title="Software Subscriptions" href="{{ url('#') }}"><div class="position-relative clearfix">                
                <i class="fas fa-file-invoice text-white fa-lg"></i>
                @if(session('subscriptioncount') != 0)
                    <span class="subscription-count count-badge rounded-border badge badge-danger">{{ session()->get('subscriptioncount') }}</span>
                @else
                    <span class="subscription-count count-badge rounded-border badge badge-danger" hidden></span>
                @endif
            </div></a>
            <a class="p-2 mx-1 text-decoration-none tooltip-test" title="Network Log" href="{{ url('#') }}"><div class="position-relative clearfix">               
                <i class="fas fa-server text-white fa-lg"></i>
                @if(session('networkcount') != 0)
                    <span class="network-count count-badge rounded-border badge badge-danger">{{ session()->get('networkcount') }}</span>
                @else
                    <span class="network-count count-badge rounded-border badge badge-danger" hidden></span>
                @endif
            </div></a> --}}

            {{-- <form class="h-100 ml-3" id="logout-form" action="{{ route('logout') }}" method="POST"> --}}
            <form class="h-100 ml-3" id="logout-form" action="" method="POST">
                @csrf

                <button class="btn btn-dark h-100 rounded-0"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button>
            </form>
        </div>
    </nav>
</header>
<aside class="sidebar-nav bg-dark">
    <nav class="sidenav navbar-dark">
        <div class="profile-container nav-border position-relative clearfix">
            <div class="d-flex justify-content-center align-items-center py-4 px-2">    
                {{-- <img id="profile_image" class="rounded-border mr-2 img-fluid" src="{{ asset(Auth::user()->image) }}" alt="user-profile"> --}}
                <img id="profile_image" class="rounded-border mr-2 img-fluid" src="{{ asset('images/profile/default.png') }}" alt="user-profile">
                <div class="profile-details ml-2 text-white text-center d-inline-block">
                    {{-- <h1 class="font-weight-bold m-0">{{ ucfirst(Auth::user()->username) }}</h1> --}}
                    <h1 class="font-weight-bold m-0">USERNAME</h1>
                    {{-- <h2 class="m-0">{{ ucfirst(Auth::user()->userRole->name) }}</h2> --}}
                    <h2 class="m-0">ROLE</h2>
                </div>
            </div>          
            <a class="view-profile text-center text-white text-decoration-none" href="{{ url('/profile') }}" hidden>View Profile</a>              
        </div>  
        <sub class="text-secondary font-weight-bold">GENERAL</sub>      
        <ul class="navbar-nav list-group">
            <li class="list-group-item">
                <a href="{{ url('/home') }}" class="text-decoration-none">
                    <div class="text-white py-3">
                        <div class="nav-icon d-inline-block text-center">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <div class="d-inline-block">
                            Dashboard
                        </div>
                    </div>
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ url('/computers') }}" class="text-decoration-none">
                    <div class="text-white py-3">
                        <div class="nav-icon d-inline-block text-center">
                            <i class="fas fa-desktop"></i>
                        </div>
                        <div class="d-inline-block">
                            Computers
                        </div>
                    </div>
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ url('/desktops') }}" class="text-decoration-none">
                    <div class="text-white py-3">
                        <div class="nav-icon d-inline-block text-center">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="d-inline-block">
                            Desktops
                        </div>
                    </div>
                </a>
            </li>
            <li class="list-group-item">
                <a href="#peripheralsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-decoration-none">
                    <div class="text-white py-3">
                        <div class="nav-icon d-inline-block text-center">
                            <i class="fas fa-mouse"></i>
                        </div>
                        <div class="d-inline-block">
                            Peripherals
                        </div>
                    </div>
                </a>
                <ul id="peripheralsSubmenu" class="list-unstyled navmenu-list text-left text-white collapse">
                    <li><a href="{{ url('/peripherals') }}">All</a></li>
                    <li><a href="{{ url('/peripherals/monitor/') }}">Monitor</a></li>
                    <li><a href="{{ url('/peripherals/keyboard/') }}">Keyboard</a></li>
                    <li><a href="{{ url('/peripherals/mouse/') }}">Mouse</a></li>
                    <li><a href="{{ url('/peripherals/headset/') }}">Headset</a></li>
                </ul>
            </li>
            {{-- <li class="list-group-item">
                <a href="#" class="text-decoration-none">
                    <div class="text-white py-3">
                        <div class="nav-icon d-inline-block text-center">
                            <i class="fas fa-link"></i>
                        </div>
                        <div class="d-inline-block">
                            Other Links
                        </div>
                    </div>
                </a>
            </li> --}}
        </ul>
        <div class="nav-border p-1"></div>
        <sub class="text-secondary font-weight-bold">OTHERS</sub>
        <ul class="navbar-nav list-group">
            <li class="list-group-item">
                {{-- @if(Auth::user()->userRole->name == "Owner" || Auth::user()->userRole->name == "Manager") --}}
                <a href="#usersSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-decoration-none">
                    <div class="text-white py-3">
                        <div class="nav-icon d-inline-block text-center">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="d-inline-block">
                            Users
                        </div>
                    </div>
                </a>
                <ul id="usersSubmenu" class="list-unstyled navmenu-list text-left text-white collapse">
                    <li><a href="{{ url('/users') }}">All</a></li>      
                    <li><a href="{{ url('/users/deactivated/') }}">Deactivated</a></li>      
                </ul>
                {{-- @else --}}
                {{-- <a href="/users" class="text-decoration-none">
                    <div class="text-white py-3">
                        <div class="nav-icon d-inline-block text-center">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="d-inline-block">
                            Users
                        </div>
                    </div>
                </a> --}}
                {{-- @endif --}}
            </li>      
            {{-- <li class="list-group-item">
                <a href="#" class="text-decoration-none">
                    <div class="text-white py-3">
                        <div class="nav-icon d-inline-block text-center">
                            <i class="fas fa-link"></i>
                        </div>
                        <div class="d-inline-block">
                            Other Links
                        </div>
                    </div>
                </a>
            </li>    --}}
        </ul>
    </nav>
</aside>
