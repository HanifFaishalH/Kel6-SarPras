<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanKerusakanController extends Controller
{
    // Laporan Kerusakan per Tahun
    public function laporanPerTahun()
    {
        $activeMenu = 'laporan-tahunan';

        $laporan = DB::table('t_laporan_kerusakan')
            ->select(DB::raw('YEAR(created_at) as tahun'), DB::raw('count(*) as jumlah_laporan'))
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->get();

        return view('laporan.per_tahun', compact('laporan', 'activeMenu'));
    }

    // Laporan Kerusakan per Bulan
    public function laporanPerBulan()
    {
        $activeMenu = 'laporan-bulanan';

        $laporan = DB::table('t_laporan_kerusakan')
            ->select(
                DB::raw('YEAR(created_at) as tahun'),
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('count(*) as jumlah_laporan')
            )
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderByRaw('tahun, bulan')
            ->get();

        return view('laporan.per_bulan', compact('laporan', 'activeMenu'));
    }
}
