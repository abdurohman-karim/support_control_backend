<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('home') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/logo.svg') }}" alt="" height="22">
                    </span>
                        <span class="logo-lg">
                            <img src="{{ URL::asset('/assets/images/logo-dark.png') }}" alt="" height="17">
                        </span>
                </a>

                <a href="{{ route('home') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/logo-light.svg') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/logo-light.png') }}" alt="" height="19">
                    </span>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn" onclick="sidebarStatus()">
                <i class="fa fa-fw fa-bars"></i>
            </button>
    </div>

        <div class="d-flex">

            <div class="d-lg-block mt-4 mx-2">
                <input type="checkbox" id="switch1" switch="dark" {{ auth()->user()->theme != 'light' ? "checked":'' }}>
                <label for="switch1" data-on-label="☀️" data-off-label="🌙" onclick="switchTheme()"></label>
            </div>
            <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(auth()->user()->avatar)
                    <img class="rounded-circle avatar-xs" src="{{ auth()->user()->avatar }}" alt="">
                @else
                    <i class="avatar-xs fa-user fas font-size-24 rounded-circle text-center"></i>
                @endif

                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ucfirst(Auth::user()->name)}}</span>
                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                <a class="dropdown-item" href="{{ route('users.edit',auth()->id()) }}">
                    <i class="bx bx-user font-size-16 align-middle me-1"></i>
                    <span key="t-profile">
                        Профил
                    </span></a>
                <a class="dropdown-item text-danger" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                    <span key="t-logout">
                        Выход
                    </span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        </div>
    </div>
</header>
