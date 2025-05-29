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
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link {{ $activeMenu == 'home' ? 'active' : '' }}">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Kelola -->
                    <li class="nav-item has-submenu {{ in_array($activeMenu, ['level', 'kelola-periode', 'kelola-pengguna', 'kelola-prioritas']) ? 'mm-active' : '' }}">
                        <a href="javascript:void(0)" class="nav-link section-title">
                            <i class="fa fa-gear"></i>
                            <span>Kelola</span>
                        </a>
                        <ul class="nav nav-second-level collapse {{ in_array($activeMenu, ['level', 'kelola-periode', 'kelola-pengguna', 'kelola-prioritas']) ? 'in' : '' }}">
                            <li><a href="{{ url('/level') }}" class="nav-link {{ $activeMenu == 'level' ? 'active' : '' }}"><i class="fa fa-list"></i> Level</a></li>
                            <li><a href="{{ url('/periode') }}" class="nav-link {{ $activeMenu == 'kelola-periode' ? 'active' : '' }}"><i class="fa fa-calendar"></i> Kelola Periode</a></li>
                            <li><a href="{{ url('/user') }}" class="nav-link {{ $activeMenu == 'kelola-pengguna' ? 'active' : '' }}"><i class="fa fa-users"></i> Kelola Pengguna</a></li>
                            <li><a href="{{ url('/prioritas') }}" class="nav-link {{ $activeMenu == 'kelola-prioritas' ? 'active' : '' }}"><i class="fa fa-exclamation-circle"></i> Kelola Prioritas</a></li>
                        </ul>
                    </li>

                    <!-- Sarana Prasarana -->
                    <li class="nav-item has-submenu {{ in_array($activeMenu, ['sarana', 'gedung', 'barang']) ? 'mm-active' : '' }}">
                        <a href="javascript:void(0)" class="nav-link section-title">
                            <i class="fa fa-building"></i>
                            <span>Sarana Prasarana</span>
                        </a>
                        <ul class="nav nav-second-level collapse {{ in_array($activeMenu, ['sarana', 'gedung', 'barang']) ? 'in' : '' }}">
                            <li><a href="{{ url('/sarana') }}" class="nav-link {{ $activeMenu == 'sarana' ? 'active' : '' }}"><i class="fa fa-building"></i> Kelola Sarana</a></li>
                            <li><a href="{{ url('/gedung') }}" class="nav-link {{ $activeMenu == 'gedung' ? 'active' : '' }}"><i class="fa fa-university"></i> Kelola Gedung</a></li>
                            <li><a href="{{ url('/barang') }}" class="nav-link {{ $activeMenu == 'barang' ? 'active' : '' }}"><i class="fa fa-cube"></i> Kelola Barang</a></li>
                        </ul>
                    </li>

                    <!-- Laporan -->
                    <li class="nav-item has-submenu {{ in_array($activeMenu, ['laporan', 'kelola-laporan-kerusakan', 'lihat-riwayat-laporan']) ? 'mm-active' : '' }}">
                        <a href="javascript:void(0)" class="nav-link section-title">
                            <i class="fa fa-file-text"></i>
                            <span>Laporan</span>
                        </a>
                        <ul class="nav nav-second-level collapse {{ in_array($activeMenu, ['laporan', 'kelola-laporan-kerusakan', 'lihat-riwayat-laporan']) ? 'in' : '' }}">
                            <li><a href="{{ url('/laporan') }}" class="nav-link {{ $activeMenu == 'laporan' ? 'active' : '' }}"><i class="fa fa-file-text"></i> Buat Laporan</a></li>
                            <li><a href="{{ url('/laporan/kelola') }}" class="nav-link {{ $activeMenu == 'kelola-laporan-kerusakan' ? 'active' : '' }}"><i class="fa fa-wrench"></i> Kelola Laporan</a></li>
                            <li><a href="{{ url('/riwayat-laporan') }}" class="nav-link {{ $activeMenu == 'lihat-riwayat-laporan' ? 'active' : '' }}"><i class="fa fa-history"></i> Riwayat Laporan</a></li>
                        </ul>
                    </li>

                    <!-- Umpan Balik -->
                    <li class="nav-item">
                        <a href="{{ url('/feedback') }}" class="nav-link {{ $activeMenu == 'berikan-umpan-balik' ? 'active' : '' }}">
                            <i class="fa fa-comment"></i>
                            <span>Berikan Umpan Balik</span>
                        </a>
                    </li>

                    <!-- Statistik -->
                    <li class="nav-item has-submenu {{ in_array($activeMenu, ['laporan-tahunan', 'laporan-bulanan']) ? 'mm-active' : '' }}">
                        <a href="javascript:void(0)" class="nav-link section-title">
                            <i class="fa fa-bar-chart"></i>
                            <span>Kelola Statistik</span>
                        </a>
                        <ul class="nav nav-second-level collapse {{ in_array($activeMenu, ['laporan-tahunan', 'laporan-bulanan']) ? 'in' : '' }}">
                            <li><a href="{{ url('/laporan/per_tahun') }}" class="nav-link {{ $activeMenu == 'laporan-tahunan' ? 'active' : '' }}"><i class="fa fa-calendar"></i> Laporan per Tahun</a></li>
                            <li><a href="{{ url('/laporan/per_bulan') }}" class="nav-link {{ $activeMenu == 'laporan-bulanan' ? 'active' : '' }}"><i class="fa fa-calendar-o"></i> Laporan per Bulan</a></li>
                        </ul>
                    </li>

                    <!-- Riwayat Perbaikan -->
                    <li class="nav-item">
                        <a href="{{ url('/riwayat-perbaikan') }}" class="nav-link {{ $activeMenu == 'riwayat-perbaikan' ? 'active' : '' }}">
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

<!-- STYLE -->
<style>
    .sidebar-menu {
        position: fixed;
        width: 250px;
        height: 100%;
        background: #2f4050;
        color: #a7b1c2;
    }

    .nav-link {
        color: #a7b1c2;
        padding: 12px 20px;
        display: block;
        transition: all 0.3s ease;
    }

    .nav-link:hover,
    .nav-link:focus {
        color: #fff;
        background: #293846;
        text-decoration: none;
    }

    .nav-link.active {
        color: #fff;
        background: #293846;
        border-left: 4px solid #19aa8d;
    }

    .nav-second-level {
        background: #293846;
        padding-left: 0;
    }

    .nav-second-level>li>a {
        padding: 10px 20px 10px 40px;
    }
</style>

<!-- SCRIPT -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.9/metisMenu.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.9/metisMenu.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script>
    $(document).ready(function () {
        $('#menu').metisMenu();
    });
</script>
