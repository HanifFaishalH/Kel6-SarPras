<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\LaporanKerusakan;
use App\Models\BarangModel;
use App\Models\KategoriModel;

class LaporanKerusakanController extends Controller
{
    public function index()
    {
        try {
            // Debug: Cek apakah model bisa diakses
            Log::info('Attempting to load BarangModel');
            
            // Coba query sederhana dulu
            $barangList = BarangModel::select('barang_id as id', 'barang_nama as nama', 'kategori_id')
                ->orderBy('barang_nama')
                ->get();

            Log::info('BarangModel loaded successfully', ['count' => $barangList->count()]);

            return view('laporan.periode', [
                'barangList' => $barangList,
                'activeMenu' => 'kelola-periode'
            ]);
        } catch (\Exception $e) {
            Log::error('Error in LaporanKerusakanController@index: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'Gagal memuat halaman kelola periode: ' . $e->getMessage());
        }
    }

    public function getData(Request $request)
    {
        try {
            Log::info('getData called with params:', $request->all());

            // Validasi input
            $request->validate([
                'tahun' => 'nullable|integer|min:2020|max:' . (now()->year + 1),
                'bulan' => 'nullable|integer|min:1|max:12',
                'barang' => 'nullable|integer|exists:m_barang,barang_id'
            ]);

            $tahun = $request->tahun;
            $bulan = $request->bulan;
            $barang = $request->barang;

            Log::info('Filters applied:', compact('tahun', 'bulan', 'barang'));

            // Cek apakah tabel t_laporan_kerusakan ada dan memiliki data
            $tableExists = DB::select("SHOW TABLES LIKE 't_laporan_kerusakan'");
            if (empty($tableExists)) {
                throw new \Exception('Tabel t_laporan_kerusakan tidak ditemukan');
            }

            // Cek struktur tabel
            $columns = DB::select("DESCRIBE t_laporan_kerusakan");
            Log::info('Table structure:', ['columns' => collect($columns)->pluck('Field')->toArray()]);

            // Query sederhana untuk testing
            $totalRecords = DB::table('t_laporan_kerusakan')->count();
            Log::info('Total records in t_laporan_kerusakan:', ['count' => $totalRecords]);

            // Jika tidak ada data sama sekali
            if ($totalRecords == 0) {
                return response()->json([
                    'success' => true,
                    'statistik_html' => $this->generateEmptyStatistikHtml(),
                    'tabel' => [],
                    'statistik_per_barang' => [],
                    'summary' => [
                        'total_laporan' => 0,
                        'total_periode' => 0,
                        'filter_applied' => [
                            'tahun' => $tahun,
                            'bulan' => $bulan,
                            'barang' => $barang,
                            'barang_info' => null
                        ]
                    ]
                ]);
            }

            // Query menggunakan Query Builder untuk debugging
            $query = DB::table('t_laporan_kerusakan')
                ->whereNotNull('tanggal_diproses');

            if ($tahun) {
                $query->whereYear('tanggal_diproses', $tahun);
            }

            if ($bulan) {
                $query->whereMonth('tanggal_diproses', $bulan);
            }

            if ($barang) {
                $query->where('barang_id', $barang);
            }

            // Ambil data dengan grouping
            if ($barang) {
                $data = $query->selectRaw('YEAR(tanggal_diproses) as tahun, MONTH(tanggal_diproses) as bulan, COUNT(*) as jumlah, barang_id')
                    ->groupByRaw('YEAR(tanggal_diproses), MONTH(tanggal_diproses), barang_id')
                    ->orderByRaw('YEAR(tanggal_diproses) DESC, MONTH(tanggal_diproses) DESC')
                    ->get();
            } else {
                $data = $query->selectRaw('YEAR(tanggal_diproses) as tahun, MONTH(tanggal_diproses) as bulan, COUNT(*) as jumlah')
                    ->groupByRaw('YEAR(tanggal_diproses), MONTH(tanggal_diproses)')
                    ->orderByRaw('YEAR(tanggal_diproses) DESC, MONTH(tanggal_diproses) DESC')
                    ->get();
            }

            Log::info('Query result:', ['data_count' => $data->count()]);

            // Statistik total laporan
            $total = $data->sum('jumlah');
            
            // Get selected barang info menggunakan Query Builder
            $barangInfo = null;
            if ($barang) {
                $barangInfo = DB::table('m_barang')
                    ->leftJoin('m_kategori', 'm_barang.kategori_id', '=', 'm_kategori.kategori_id')
                    ->where('m_barang.barang_id', $barang)
                    ->select('m_barang.*', 'm_kategori.kategori_nama')
                    ->first();
            }

            // Create statistics HTML
            $statistik_html = $this->generateStatistikHtml($total, $data, $tahun, $bulan, $barangInfo);

            // Format data tabel
            $tabel = $data->map(function($item) use ($barang) {
                $result = [
                    'tahun' => $item->tahun,
                    'bulan' => Carbon::create()->month($item->bulan)->translatedFormat('F'),
                    'jumlah' => $item->jumlah
                ];

                // Tambahkan info barang jika ada filter barang
                if ($barang && isset($item->barang_id)) {
                    $barangData = DB::table('m_barang')->where('barang_id', $item->barang_id)->first();
                    $result['barang_nama'] = $barangData ? $barangData->barang_nama : 'Unknown';
                }

                return $result;
            });

            // Statistik per barang menggunakan Query Builder
            $statistikPerBarang = $this->getStatistikPerBarangSimple($tahun, $bulan);

            Log::info('Response prepared successfully', [
                'total_laporan' => $total,
                'total_periode' => $tabel->count()
            ]);

            return response()->json([
                'success' => true,
                'statistik_html' => $statistik_html,
                'tabel' => $tabel,
                'statistik_per_barang' => $statistikPerBarang,
                'summary' => [
                    'total_laporan' => $total,
                    'total_periode' => $tabel->count(),
                    'filter_applied' => [
                        'tahun' => $tahun,
                        'bulan' => $bulan,
                        'barang' => $barang,
                        'barang_info' => $barangInfo ? [
                            'id' => $barangInfo->barang_id,
                            'nama' => $barangInfo->barang_nama,
                            'kategori' => $barangInfo->kategori_nama ?? 'Unknown'
                        ] : null
                    ]
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Data filter tidak valid.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error in LaporanKerusakanController@getData: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            Log::error('Request data: ', $request->all());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data: ' . $e->getMessage(),
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    private function getStatistikPerBarangSimple($tahun = null, $bulan = null)
    {
        try {
            $query = DB::table('t_laporan_kerusakan')
                ->leftJoin('m_barang', 't_laporan_kerusakan.barang_id', '=', 'm_barang.barang_id')
                ->leftJoin('m_kategori', 'm_barang.kategori_id', '=', 'm_kategori.kategori_id')
                ->whereNotNull('t_laporan_kerusakan.tanggal_diproses');

            if ($tahun) {
                $query->whereYear('t_laporan_kerusakan.tanggal_diproses', $tahun);
            }

            if ($bulan) {
                $query->whereMonth('t_laporan_kerusakan.tanggal_diproses', $bulan);
            }

            return $query->select(
                    't_laporan_kerusakan.barang_id',
                    'm_barang.barang_nama',
                    'm_kategori.kategori_nama',
                    DB::raw('COUNT(*) as jumlah')
                )
                ->groupBy('t_laporan_kerusakan.barang_id', 'm_barang.barang_nama', 'm_kategori.kategori_nama')
                ->orderByRaw('COUNT(*) DESC')
                ->limit(10)
                ->get()
                ->map(function($item) {
                    return [
                        'barang_id' => $item->barang_id,
                        'barang_nama' => $item->barang_nama ?? 'Unknown',
                        'kategori_nama' => $item->kategori_nama ?? 'Unknown',
                        'jumlah' => $item->jumlah
                    ];
                });
        } catch (\Exception $e) {
            Log::error('Error in getStatistikPerBarangSimple: ' . $e->getMessage());
            return collect([]);
        }
    }

    private function generateEmptyStatistikHtml()
    {
        return '<div class="row">
            <div class="col-md-12">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> Tidak ada data laporan kerusakan yang tersedia.
                </div>
            </div>
        </div>';
    }

    private function generateStatistikHtml($total, $data, $tahun, $bulan, $barangInfo)
    {
        $html = '<div class="row">';
        
        // Total Laporan Card
        $html .= '<div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h3 class="card-title">' . number_format($total) . '</h3>
                            <p class="card-text">Total Laporan</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-file-text fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

        // Periode Aktif Card
        $periodeCount = is_countable($data) ? count($data) : $data->count();
        $html .= '<div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h3 class="card-title">' . $periodeCount . '</h3>
                            <p class="card-text">Periode Aktif</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-calendar fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

        // Rata-rata per Periode
        $rataRata = $periodeCount > 0 ? round($total / $periodeCount, 1) : 0;
        $html .= '<div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h3 class="card-title">' . number_format($rataRata, 1) . '</h3>
                            <p class="card-text">Rata-rata per Periode</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-bar-chart fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

        // Periode Tertinggi
        $tertinggi = $periodeCount > 0 ? max(array_column($data->toArray(), 'jumlah')) : 0;
        
        $html .= '<div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h3 class="card-title">' . $tertinggi . '</h3>
                            <p class="card-text">Periode Tertinggi</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fa fa-arrow-up fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

        $html .= '</div>'; // Close row

        // Filter Information
        if ($tahun || $bulan || $barangInfo) {
            $html .= '<div class="alert alert-info mt-3">
                <i class="fa fa-filter"></i> <strong>Filter Aktif:</strong> ';
            
            $filters = [];
            if ($tahun) $filters[] = "Tahun: $tahun";
            if ($bulan) $filters[] = "Bulan: " . Carbon::create()->month($bulan)->translatedFormat('F');
            if ($barangInfo) {
                $kategori = $barangInfo->kategori_nama ?? 'Unknown';
                $filters[] = "Barang: {$barangInfo->barang_nama} (Kategori: {$kategori})";
            }
            
            $html .= implode(' | ', $filters);
            $html .= '</div>';
        }

        return $html;
    }

    public function getChartData(Request $request)
    {
        try {
            $tahun = $request->tahun;
            $bulan = $request->bulan;

            // Data untuk line chart bulanan menggunakan Query Builder
            $monthlyQuery = DB::table('t_laporan_kerusakan')
                ->whereNotNull('tanggal_diproses');

            if ($tahun) {
                $monthlyQuery->whereYear('tanggal_diproses', $tahun);
            }

            $monthlyData = $monthlyQuery->selectRaw('MONTH(tanggal_diproses) as bulan, COUNT(*) as jumlah')
                ->groupByRaw('MONTH(tanggal_diproses)')
                ->orderByRaw('MONTH(tanggal_diproses)')
                ->get()
                ->map(function($item) {
                    return [
                        'bulan' => Carbon::create()->month($item->bulan)->translatedFormat('F'),
                        'jumlah' => $item->jumlah
                    ];
                });

            // Data untuk pie chart per kategori barang
            $kategoriQuery = DB::table('t_laporan_kerusakan')
                ->leftJoin('m_barang', 't_laporan_kerusakan.barang_id', '=', 'm_barang.barang_id')
                ->leftJoin('m_kategori', 'm_barang.kategori_id', '=', 'm_kategori.kategori_id')
                ->whereNotNull('t_laporan_kerusakan.tanggal_diproses');

            if ($tahun) {
                $kategoriQuery->whereYear('t_laporan_kerusakan.tanggal_diproses', $tahun);
            }

            if ($bulan) {
                $kategoriQuery->whereMonth('t_laporan_kerusakan.tanggal_diproses', $bulan);
            }

            $kategoriData = $kategoriQuery->select('m_kategori.kategori_nama', DB::raw('COUNT(*) as jumlah'))
                ->groupBy('m_kategori.kategori_nama')
                ->get()
                ->map(function($item) {
                    return [
                        'kategori' => $item->kategori_nama ?? 'Unknown',
                        'jumlah' => $item->jumlah
                    ];
                });

            return response()->json([
                'success' => true,
                'monthly_data' => $monthlyData,
                'kategori_data' => $kategoriData
            ]);

        } catch (\Exception $e) {
            Log::error('Error in getChartData: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data chart: ' . $e->getMessage()
            ], 500);
        }
    }
}