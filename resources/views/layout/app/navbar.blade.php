<nav class="navbar navbar-expand-lg navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item d-block d-xl-none">
            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
            </a>
        </li>
        <li class="nav-item">
            <h6>{{ $title }}</h6>
        </li>
    </ul>
    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
            Xin chào
            @auth
                {{ Auth::user()->name }}
            @endauth
            <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="https://pyxis.nymag.com/v1/imgs/7aa/21a/c1de2c521f1519c6933fcf0d08e0a26fef-27-spongebob-squarepants.rsquare.w400.jpg"
                        alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                    <div class="message-body">
                        <!-- <div href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item" disabled>
                            <i class="ti ti-hand-stop fs-6"></i>
                            <p class="mb-0 fs-3">
                                Xin chào
                                @auth
                                    {{ Auth::user()->name }}
                                @endauth
                            </p>
                        </div> -->
                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ti ti-user fs-6"></i>
                            <p class="mb-0 fs-3">Tài khoản của tôi</p>
                        </a>
                        <a href="{{ route('auth.logout') }}" class="btn btn-outline-danger mx-3 mt-2 d-block">Đăng
                            xuất</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
