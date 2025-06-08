@extends('layout.template')

@section('content')
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{ $page->title }}</h4>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    {{-- Dashboard berdasarkan role --}}
                    @if ($user->level_id == 1)
                        {{-- ADMIN DASHBOARD --}}
                        <h5>Halo Admin, {{ $user->nama }}</h5>
                        <ul>
                            <li>Kelola Pengguna</li>
                            <li>Rekap Laporan Masuk</li>
                            <li>Statistik Kerusakan</li>
                        </ul>

                    @elseif ($user->level_id == 2 || $user->level_id == 3 || $user->level_id == 4)
                        {{-- USER DASHBOARD --}}
                        <h5>Halo, {{ $user->nama }}</h5>
                        <ul>
                            <li>Hitung Prioritas Laporan</li>
                            <li>Kelola Data Sarana</li>
                            <li>Monitoring Teknisi</li>
                        </ul>

                    @elseif ($user->level_id == 5)
                        {{-- TEKNISI DASHBOARD --}}
                        <h5>Halo Teknisi, {{ $user->nama }}</h5>
                        <ul>
                            <li>Lihat Tugas Perbaikan</li>
                            <li>Update Status Perbaikan</li>
                            <li>Riwayat Tugas</li>
                        </ul>

                    @else
                        <h5>Halo {{ $user->name }}</h5>
                        <p>Anda tidak memiliki role yang dikenali sistem.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
