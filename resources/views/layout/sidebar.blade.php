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
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link {{ $activeMenu == 'home' ? 'active' : '' }}">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Bagian Kelola -->
                    <li class="nav-item has-submenu">
                        <a href="javascript:void(0)" class="nav-link section-title">
                            <i class="fa fa-gear"></i>
                            <span>Kelola</span>
                        </a>
                        <ul
                            class="nav nav-second-level collapse {{ in_array($activeMenu, ['level', 'kelola-periode', 'kelola-pengguna', 'kelola-prioritas']) ? 'in' : '' }}">
                            <li class="nav-item">
                                <a href="{{ url('/level') }}"
                                    class="nav-link {{ $activeMenu == 'level' ? 'active' : '' }}">
                                    <i class="fa fa-list"></i>
                                    <span>Level</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/periode') }}"
                                    class="nav-link {{ $activeMenu == 'kelola-periode' ? 'active' : '' }}">
                                    <i class="fa fa-calendar"></i>
                                    <span>Kelola Periode</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/user') }}"
                                    class="nav-link {{ $activeMenu == 'kelola-pengguna' ? 'active' : '' }}">
                                    <i class="fa fa-users"></i>
                                    <span>Kelola Pengguna</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/prioritas') }}"
                                    class="nav-link {{ $activeMenu == 'kelola-prioritas' ? 'active' : '' }}">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <span>Kelola Prioritas</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Bagian Sarana Prasarana -->
                    <li class="nav-item has-submenu">
                        <a href="javascript:void(0)" class="nav-link section-title">
                            <i class="fa fa-building"></i>
                            <span>Sarana Prasarana</span>
                        </a>
                        <ul
                            class="nav nav-second-level collapse {{ in_array($activeMenu, ['sarana', 'gedung', 'fasilitas']) ? 'in' : '' }}">
                            <li class="nav-item">
                                <a href="{{ url('/sarana') }}"
                                    class="nav-link {{ $activeMenu == 'sarana' ? 'active' : '' }}">
                                    <i class="fa fa-building"></i>
                                    <span>Sarana</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/gedung') }}"
                                    class="nav-link {{ $activeMenu == 'gedung' ? 'active' : '' }}">
                                    <i class="fa fa-university"></i>
                                    <span>Kelola Gedung</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/fasilitas') }}"
                                    class="nav-link {{ $activeMenu == 'fasilitas' ? 'active' : '' }}">
                                    <i class="fa fa-cogs"></i>
                                    <span>Kelola Fasilitas</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Bagian Laporan -->
                    <li class="nav-item has-submenu">
                        <a href="javascript:void(0)" class="nav-link section-title">
                            <i class="fa fa-file-text"></i>
                            <span>Laporan</span>
                        </a>
                        <ul
                            class="nav nav-second-level collapse {{ in_array($activeMenu, ['laporan', 'kelola-laporan-kerusakan', 'lihat-riwayat-laporan']) ? 'in' : '' }}">
                            <li class="nav-item">
                                <a href="{{ url('/laporan') }}"
                                    class="nav-link {{ $activeMenu == 'laporan' ? 'active' : '' }}">
                                    <i class="fa fa-file-text"></i>
                                    <span>Laporan</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/kelola-laporan') }}"
                                    class="nav-link {{ $activeMenu == 'kelola-laporan-kerusakan' ? 'active' : '' }}">
                                    <i class="fa fa-wrench"></i>
                                    <span>Kelola Laporan Kerusakan</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/riwayat-laporan') }}"
                                    class="nav-link {{ $activeMenu == 'lihat-riwayat-laporan' ? 'active' : '' }}">
                                    <i class="fa fa-history"></i>
                                    <span>Lihat Riwayat Laporan</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Bagian Umpan Balik -->
                    <li class="nav-item">
                        <a href="{{ url('/feedback') }}"
                            class="nav-link {{ $activeMenu == 'berikan-umpan-balik' ? 'active' : '' }}">
                            <i class="fa fa-comment"></i>
                            <span>Berikan Umpan Balik</span>
                        </a>
                    </li>

                    <!-- Bagian Statistik -->
                    <!-- Bagian Statistik -->
                    <li class="nav-item has-submenu">
                        <a href="javascript:void(0)" class="nav-link section-title">
                            <i class="fa fa-bar-chart"></i>
                            <span>Kelola Statistik</span>
                        </a>
                        <ul
                            class="nav nav-second-level collapse {{ in_array($activeMenu, ['laporan-tahunan', 'laporan-bulanan']) ? 'in' : '' }}">
                            <li class="nav-item">
                                <a href="{{ url('/laporan/per_tahun') }}"
                                    class="nav-link {{ $activeMenu == 'laporan-tahunan' ? 'active' : '' }}">
                                    <i class="fa fa-calendar"></i>
                                    <span>Laporan per Tahun</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/laporan/per_bulan') }}"
                                    class="nav-link {{ $activeMenu == 'laporan-bulanan' ? 'active' : '' }}">
                                    <i class="fa fa-calendar-o"></i>
                                    <span>Laporan per Bulan</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Bagian Perbaikan -->
                    <li class="nav-item">
                        <a href="{{ url('/riwayat-perbaikan') }}"
                            class="nav-link {{ $activeMenu == 'riwayat-perbaikan' ? 'active' : '' }}">
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

<style>
    /* Main sidebar styles */
    .sidebar-menu {
        position: fixed;
        width: 250px;
        height: 100%;
        background: #2f4050;
        color: #a7b1c2;
    }

    /* Menu item styles */
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

    /* Submenu styles */
    .nav-second-level {
        background: #293846;
        padding-left: 0;
        transition: all 0.3s ease;
    }

    .nav-second-level>li>a {
        padding: 10px 20px 10px 40px;
        transition: all 0.3s ease;
    }

    /* Animation for dropdown */
    .nav-second-level.collapse {
        display: none;
        height: 0;
        overflow: hidden;
        transition: height 0.35s ease;
    }

    .nav-second-level.collapse.in {
        display: block;
        height: auto;
        transition: height 0.35s ease;
    }

    .nav-second-level.collapsing {
        position: relative;
        height: 0;
        overflow: hidden;
        transition: height 0.35s ease;
    }
</style>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.9/metisMenu.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.9/metisMenu.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script>
    $(document).ready(function () {
        // Initialize MetisMenu
        $('#menu').metisMenu({
            toggle: true,
            doubleTapToGo: true,
            preventDefault: true
        });

        // Keep dropdowns open when navigating
        $(document).on('click', '.nav-second-level a', function (e) {
            e.stopPropagation();
        });

        // Automatically open parent dropdown when child is active
        $('.nav-second-level .nav-link.active').each(function () {
            $(this).closest('.nav-second-level').addClass('in').css('display', 'block');
            $(this).closest('.has-submenu').addClass('active');
        });

        // Collapse the current active sub-menu when another menu item is clicked
        $('.nav-item.has-submenu > a').click(function () {
            // Close all other sub-menus
            $('.nav-item.has-submenu').removeClass('active');
            $('.nav-second-level').removeClass('in').css('display', 'none').css('height', '0');

            // Open the clicked sub-menu
            var $submenu = $(this).next('.nav-second-level');
            $submenu.css('display', 'block').css('height', 'auto');
            $(this).parent().addClass('active');
            $submenu.addClass('in');
        });
    });
</script>