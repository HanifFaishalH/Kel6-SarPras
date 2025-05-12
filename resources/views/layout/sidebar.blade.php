<!-- sidebar menu area start -->
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('srtdash/assets/images/icon/logo.png') }}" alt="logo">
            </a>
        </div>
    </div>

    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="menu-section mt-4">
                        <h4 class="text-white pl-3">Manage</h4>
                    </li>

                    <li class="nav-item mt-3">
                        <a href="{{ url('/') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/level') }}" class="nav-link {{ $activeMenu == 'level' ? 'active' : '' }}">
                            <i class="fa fa-list"></i>
                            <span>Level</span>
                        </a>
                    </li>

                    <li class="menu-section mt-4">
                        <h4 class="text-white pl-3">Sarana Prasarana</h4>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/sarana') }}" class="nav-link {{ $activeMenu == 'sarana' ? 'active' : '' }}">
                            <i class="fa fa-building"></i>
                            <span>Sarana</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/prasarana') }}" class="nav-link {{ $activeMenu == 'prasarana' ? 'active' : '' }}">
                            <i class="fa fa-cogs"></i>
                            <span>Prasarana</span>
                        </a>
                    </li>

                    <li class="menu-section mt-4">
                        <h4 class="text-white pl-3">Laporan</h4>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/laporan') }}" class="nav-link {{ $activeMenu == 'laporan' ? 'active' : '' }}">
                            <i class="fa fa-file-text"></i>
                            <span>Buat Laporan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/laporan/riwayat') }}" class="nav-link {{ $activeMenu == 'riwayat' ? 'active' : '' }}">
                            <i class="fa fa-history"></i>
                            <span>Riwayat Laporan</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->
