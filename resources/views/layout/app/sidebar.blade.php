<div>
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-center">
            <a href="{{ route('admin.home') }}" class="text-nowrap logo-img">
                <img src="{{ asset('admin_dashbroad/assets/images/logos/logo.jpg') }}" width="240px" alt=""
                />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar mt-3">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
                    <span class="hide-menu text-white">Quản lý chung</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.home') }}" aria-expanded="false">
                        <span>
                            <i class="bi bi-speedometer"></i>
                        </span>
                        <span class="hide-menu">Báo cáo thống kê</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#">
                        <span>
                        <i class="bi bi-bar-chart-line-fill"></i>
                        </span>
                        <span class="hide-menu">Kiểm kê tài sản</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link"
                        href="#" aria-expanded="false">
                        <span>
                            <i class="bi bi-cart-plus-fill"></i>
                        </span>
                        <span class="hide-menu">Đề xuất mua hàng</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
                    <span class="hide-menu text-white">Quản lý danh mục</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('admin/user/*') ? 'active' : '' }}"
                        href="{{ route('admin.employee.list') }}" aria-expanded="false">
                            <span>
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <span class="hide-menu">Thông tin nhân viên</span>
                    </a>
                </li>
                <!-- <li class="sidebar-item">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <span>
                            <i class="bi bi-people-fill"></i>
                        </span>
                        <span class="hide-menu">Thông tin nhóm quyền</span>
                    </a>
                </li> -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('admin/suplier/*') ? 'active' : '' }}"
                        href="{{ route('admin.suplier.list') }}">
                        <span>
                            <i class="bi bi-archive-fill"></i>
                        </span>
                        <span class="hide-menu">Nhà cung cấp</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu text-white">Quản lý tài sản thiết bị</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('admin/asset-type/*') ? 'active' : '' }}"
                        href="{{ route('admin.asset_type.list') }}">
                        <span>
                            <i class="bi bi-bookmark-fill"></i>
                        </span>
                        <span class="hide-menu">Loại tài sản</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('admin/asset/*') ? 'active' : '' }}"
                        href="{{ route('admin.asset.list') }}">
                        <span>
                            <i class="bi bi-inboxes-fill"></i>
                        </span>
                        <span class="hide-menu">Tài sản</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu text-white">Quản lý sử dụng</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('admin/allocation/*') ? 'active' : '' }}"
                        href="{{ route('admin.allocation.list') }}">
                        <span>
                            <i class="bi bi-basket3-fill"></i>
                        </span>
                        <span class="hide-menu">Cấp phát tài sản</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#">
                        <span>
                            <i class="bi bi-gear-wide-connected"></i>
                        </span>
                        <span class="hide-menu">Sửa chữa tài sản</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#">
                        <span>
                            <i class="bi bi-tools"></i>
                        </span>
                        <span class="hide-menu">Bảo trì tài sản</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
