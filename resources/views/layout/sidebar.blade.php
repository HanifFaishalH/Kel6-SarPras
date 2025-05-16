<!-- area menu sidebar dimulai -->
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('logo.png') }}" alt="logo" class="img-fluid" style="max-height: 100px;">
            </a>
        </div>
    </div>

    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <!-- Bagian Kelola -->
                    <li class="menu-section mt-2">
                        <h4 class="text-white pl-3">Kelola</h4>
                    </li>

                    <li class="nav-item mt-3">
                        <a href="{{ url('/') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                            <i class="fa fa-dashboard"></i>
                            <span>Dasbor</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/level') }}" class="nav-link {{ $activeMenu == 'level' ? 'active' : '' }}">
                            <i class="fa fa-list"></i>
                            <span>Level</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/periode') }}"
                            class="nav-link {{ $activeMenu == 'kelola-periode' ? 'active' : '' }}"
                            aria-expanded="false">
                            <i class="fa fa-calendar"></i>
                            <span>Kelola Periode</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/user') }}"
                            class="nav-link {{ $activeMenu == 'kelola-pengguna' ? 'active' : '' }}"
                            aria-expanded="false">
                            <i class="fa fa-users"></i>
                            <span>Kelola Pengguna</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/prioritas') }}"
                            class="nav-link {{ $activeMenu == 'kelola-prioritas' ? 'active' : '' }}"
                            aria-expanded="false">
                            <i class="fa fa-exclamation-circle"></i>
                            <span>Kelola Prioritas</span>
                        </a>
                    </li>

                    <!-- Bagian Sarana Prasarana -->
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
                        <a href="{{ url('/gedung') }}"
                            class="nav-link {{ $activeMenu == 'kelola-gedung' ? 'active' : '' }}"
                            aria-expanded="false">
                            <i class="fa fa-university"></i>
                            <span>Kelola Gedung</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/fasilitas') }}"
                            class="nav-link {{ $activeMenu == 'kelola-fasilitas' ? 'active' : '' }}"
                            aria-expanded="false">
                            <i class="fa fa-cogs"></i>
                            <span>Kelola Fasilitas</span>
                        </a>
                    </li>

                    <!-- Bagian Laporan -->
                    <li class="menu-section mt-4">
                        <h4 class="text-white pl-3">Laporan</h4>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/laporan') }}"
                            class="nav-link {{ $activeMenu == 'buat-laporan' ? 'active' : '' }}" aria-expanded="false">
                            <i class="fa fa-file-text"></i>
                            <span>Buat Laporan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/pratinjau-laporan') }}"
                            class="nav-link {{ $activeMenu == 'lihat-laporan' ? 'active' : '' }}"
                            aria-expanded="false">
                            <i class="fa fa-eye"></i>
                            <span>Lihat Laporan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/kelola-laporan') }}"
                            class="nav-link {{ $activeMenu == 'kelola-laporan-kerusakan' ? 'active' : '' }}"
                            aria-expanded="false">
                            <i class="fa fa-wrench"></i>
                            <span>Kelola Laporan Kerusakan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/riwayat-laporan') }}"
                            class="nav-link {{ $activeMenu == 'lihat-riwayat-laporan' ? 'active' : '' }}"
                            aria-expanded="false">
                            <i class="fa fa-history"></i>
                            <span>Lihat Riwayat Laporan</span>
                        </a>
                    </li>

                    <!-- Bagian Umpan Balik -->
                    <li class="menu-section mt-4">
                        <h4 class="text-white pl-3">Umpan Balik</h4>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/feedback') }}"
                            class="nav-link {{ $activeMenu == 'berikan-umpan-balik' ? 'active' : '' }}"
                            aria-expanded="false">
                            <i class="fa fa-comment"></i>
                            <span>Berikan Umpan Balik</span>
                        </a>
                    </li>

                    <!-- Bagian Statistik -->
                    <li class="menu-section mt-4">
                        <h4 class="text-white pl-3">Statistik</h4>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/statistik') }}"
                            class="nav-link {{ $activeMenu == 'kelola-statistik' ? 'active' : '' }}"
                            aria-expanded="false">
                            <i class="fa fa-bar-chart"></i>
                            <span>Kelola Statistik</span>
                        </a>
                    </li>

                    <!-- Bagian Perbaikan -->
                    <li class="menu-section mt-4">
                        <h4 class="text-white pl-3">Perbaikan</h4>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/riwayat-perbaikan') }}"
                            class="nav-link {{ $activeMenu == 'riwayat-perbaikan' ? 'active' : '' }}"
                            aria-expanded="false">
                            <i class="fa fa-wrench"></i>
                            <span>Riwayat Perbaikan</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- area menu sidebar selesai -->
