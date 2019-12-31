<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand">
                    <div class="brand-logo" style="background:url('@asset($app_logo)');background-position:-65px -54px"></div>
                    <h2 class="brand-text mb-0">{{ $app_name }}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                    <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item @active('admin.dashboard')">
                <a href="@route('admin.dashboard')">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="Beranda">Beranda</span>
                </a>
            </li>
            <li class="navigation-header"><span>Lainnya</span></li>
            <li class="nav-item @active('admin/account','prefix')">
                <a href="@route('admin.account')">
                    <i class="feather icon-user"></i>
                    <span class="menu-title" data-i18n="Akun">Akun</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0)">
                    <i class="feather icon-users"></i>
                    <span class="menu-title" data-i18n="Kelola Pengguna">Kelola Pengguna</span>
                </a>
                <ul class="menu-content">
                    @can('user.view')
                        <li>
                            <a href="">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="Pengguna">Pengguna</span>
                            </a>
                        </li>
                    @endcan
                    @can('role.view')
                        <li>
                            <a href="">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="Peran">Peran</span>
                            </a>
                        </li>
                    @endcan
                    @can('permission.view')
                        <li>
                            <a href="">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="Izin">Izin</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            @can('setting_group.view')
                <li class="nav-item">
                    <a href="">
                        <i class="feather icon-settings"></i>
                        <span class="menu-title" data-i18n="Pengaturan">Pengaturan</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
