<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\SaranaModel;

class LaporanKerusakanController extends Controller
{
    // Laporan Kerusakan per Tahun
    public function laporanPerTahun()
    {
        $activeMenu = 'laporan-tahunan';

        $laporan = DB::table('t_laporan_kerusakan')
            ->selectRaw('YEAR(tanggal_operasional) as tahun, COUNT(*) as jumlah_laporan')
            ->whereNotNull('tanggal_operasional')
            ->groupByRaw('YEAR(tanggal_operasional)')
            ->orderByRaw('YEAR(tanggal_operasional)')
            ->get();

        return view('laporan.per_tahun', compact('laporan', 'activeMenu'));
    }

    // Laporan Kerusakan per Bulan
    public function laporanPerBulan()
    {
        $activeMenu = 'laporan-bulanan';

        $laporan = DB::table('t_laporan_kerusakan')
            ->selectRaw('YEAR(tanggal_operasional) as tahun, MONTH(tanggal_operasional) as bulan, COUNT(*) as jumlah_laporan')
            ->whereNotNull('tanggal_operasional')
            ->groupByRaw('YEAR(tanggal_operasional), MONTH(tanggal_operasional)')
            ->orderByRaw('YEAR(tanggal_operasional), MONTH(tanggal_operasional)')
            ->get();

        // Persiapan data untuk chart
        $labels = [];
        $data = [];

        foreach ($laporan as $item) {
            $bulanNama = Carbon::create()->month($item->bulan)->translatedFormat('F');
            $labels[] = $bulanNama . ' ' . $item->tahun;
            $data[] = $item->jumlah_laporan;
        }

        return view('laporan.per_bulan', compact('laporan', 'labels', 'data', 'activeMenu'));
    }


    public function laporanPerBarang()
    {
        $activeMenu = 'laporan-per-barang';

        $barang = SaranaModel::selectRaw('m_barang.barang_nama, SUM(m_sarana.jumlah_laporan) as total_laporan')
            ->join('m_barang', 'm_sarana.barang_id', '=', 'm_barang.barang_id')
            ->groupBy('m_sarana.barang_id', 'm_barang.barang_nama')
            ->orderByDesc('total_laporan')
            ->take(10) // ambil 10 barang teratas
            ->get();

        return view('laporan.per_barang', [
            'barang' => $barang,
            'activeMenu' => $activeMenu,
            'page' => (object) [
                'title' => "Laporan Kerusakan per Barang"
            ],
            'breadcrumbs' => [
                'title' => 'Laporan Kerusakan per Barang',
                'list' => ['home', 'Laporan Kerusakan', 'Per Barang']
            ]
        ]);
    }

}
