<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanModel;
use App\Models\GedungModel;
use App\Models\LantaiModel;
use App\Models\RuangModel;
use App\Models\SaranaModel;
use App\Models\TeknisiModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


use Exception;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = LaporanModel::all();

        $breadcrumbs = [
            'title' => 'Daftar Laporan',
            'list' => ['home', 'laporan']
        ];
        $page = (object) [
            'title' => "Daftar Laporan"
        ];
        $activeMenu = 'laporan';
        return view('laporan.index', [
            'laporan' => $laporan,
            'breadcrumbs' => $breadcrumbs,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $user = auth()->user();
        $statusFilter = $request->get('status');

        $query = LaporanModel::with(['user', 'teknisi', 'sarana.barang'])
            ->select('t_laporan_kerusakan.*');

        // Filter status jika ada
        if ($statusFilter) {
            $query->where('status_laporan', $statusFilter);
        }

        // Cek role user
        if ($user->level->level_name !== 'admin') {
            // Bukan admin, batasi hanya laporan milik user ini
            $query->where('user_id', $user->user_id);
        }
        // Jika admin, query tanpa filter user_id (lihat semua)

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('role', function ($row) {
                return strtoupper($row->role);
            })
            ->addColumn('sarana', function ($row) {
                return $row->sarana->barang->barang_nama ?? '-';
            })
            ->addColumn('teknisi', function ($row) {
                return $row->teknisi ? $row->teknisi->user->name : '-';
            })
            ->addColumn('status_laporan', function ($row) {
                return ucfirst($row->status_laporan);
            })
            ->addColumn('aksi', function ($row) {
                $btn = '<button onclick="modalAction(\'' . url('/laporan/show_ajax/' . $row->laporan_id) . '\')" class="btn btn-info btn-sm">Detail</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function kelola()
    {
        $laporan = LaporanModel::all();

        $breadcrumbs = [
            'title' => 'Daftar Laporan',
            'list' => ['home', 'kelola-laporan-kerusakan']
        ];
        $page = (object) [
            'title' => "Daftar Laporan"
        ];
        $activeMenu = 'kelola';
        return view('laporan.kelola', [
            'laporan' => $laporan,
            'breadcrumbs' => $breadcrumbs,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list_kelola(Request $request)
    {
        $laporan = LaporanModel::with(['gedung', 'lantai', 'ruang', 'sarana', 'user', 'teknisi'])
            ->where('status_laporan', '!=', 'ditolak');

        if ($request->laporan_id) {
            $laporan->where('laporan_id', $request->laporan_id);
        }

        if ($request->status) {
            $laporan->where('status', $request->status);
        }

        return datatables()->of($laporan)
            ->addIndexColumn()
            ->addColumn('laporan_judul', function ($row) {
                return $row->laporan_judul;
            })
            ->addColumn('sarana', function ($row) {
                return $row->sarana ? $row->sarana->barang->barang_nama ?? '-' : '-';
            })
            ->addColumn('status_laporan', function ($row) {
                return ucfirst($row->status_laporan);
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('d-m-Y H:i');
            })
            ->addColumn('bobot', function ($row) {
                return $row->bobot ?? '-'; // Handle null/undefined bobot
            })
            ->addColumn('aksi', function ($row) {
                $btn = '<button onclick="modalAction(\'' . url('/laporan/show_kelola_ajax/' . $row->laporan_id) . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="calculatePriority(' . $row->laporan_id . ')" class="btn btn-success btn-sm">Kalkulasi</button>';

                if ($row->status_laporan === 'diproses') {
                    $btn .= '<br><a href="' . url('/laporan/tugaskan_teknisi/' . $row->laporan_id) . '" class="btn btn-warning btn-sm mt-1" onclick="modalAction(this.href); return false;">Tugaskan Teknisi</a>';
                }

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->orderColumn('bobot', 'bobot $1')
            ->make(true);
    }

    public function tugaskan_teknisi($id, Request $request)
    {
        $laporan = LaporanModel::findOrFail($id);

        // Cek apakah user memiliki akses (misalnya hanya sarpras)
        if (Auth::user()->username !== 'sarpras') {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki akses untuk tindakan ini.'
            ], 403);
        }

        if ($request->isMethod('get')) {
            // Ambil daftar teknisi
            $teknisi = TeknisiModel::with('user')->get();

            // Render view untuk pop-up
            $html = view('laporan.tugaskan_teknisi', compact('laporan', 'teknisi'))->render();

            return response()->json([
                'status' => 'success',
                'html' => $html
            ]);
        }

        if ($request->isMethod('post')) {
            // Cek apakah laporan sudah dikerjakan
            if ($laporan->status_laporan === 'dikerjakan') {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Laporan sudah dalam status Dikerjakan. Tidak dapat menugaskan ulang teknisi.'
                ], 400);
            }

            // Validasi input
            $request->validate([
                'teknisi_id' => 'required|exists:m_teknisi,teknisi_id',
                'catatan' => 'nullable|string'
            ]);

            // Update laporan
            $laporan->update([
                'teknisi_id' => $request->teknisi_id,
                'status_laporan' => 'Dikerjakan',
                'tanggal_diproses' => now(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Teknisi berhasil ditugaskan.'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Metode tidak diizinkan.'
        ], 405);
    }


    // LaporanController.php - in kalkulasi method
    public function kalkulasi($id)
    {
        $laporan = LaporanModel::findOrFail($id);
        $sarana = SaranaModel::findOrFail($laporan->sarana_id); // Changed to use sarana_id from laporan

        // Map values to scores
        $kerusakanMap = ['rendah' => 1, 'sedang' => 2, 'tinggi' => 3, 'kritis' => 4];
        $urgensiMap = ['rendah' => 1, 'sedang' => 2, 'tinggi' => 3, 'kritis' => 4];
        $frekuensiMap = ['tahunan' => 1, 'bulanan' => 2, 'harian' => 3];
        $dampakMap = ['kecil' => 1, 'sedang' => 2, 'besar' => 3];


        $kerusakan = $kerusakanMap[strtolower($laporan->tingkat_kerusakan)] ?? 0;
        $urgensi = $urgensiMap[strtolower($laporan->tingkat_urgensi)] ?? 0;
        $frekuensi = $frekuensiMap[strtolower($sarana->frekuensi_penggunaan)] ?? 0;
        $dampak = $dampakMap[strtolower($laporan->dampak_kerusakan)] ?? 0;

        $jumlahLaporan = $sarana->jumlah_laporan ?? 1;
        $bobot = $kerusakan * $urgensi * $frekuensi * $dampak * $jumlahLaporan;

        // Save the bobot to the database
        $laporan->bobot = $bobot;
        $laporan->save();

        $html = view('laporan.calculate_result', [
            'laporan' => $laporan,
            'bobot' => $bobot,
            'factors' => [
                'Kerusakan' => ['value' => $laporan->tingkat_kerusakan, 'score' => $kerusakan],
                'Urgensi' => ['value' => $laporan->tingkat_urgensi, 'score' => $urgensi],
                'Frekuensi' => ['value' => $sarana->frekuensi_penggunaan, 'score' => $frekuensi],
                'Dampak' => ['value' => $laporan->dampak_kerusakan, 'score' => $dampak],
                'Jumlah Laporan' => ['value' => $jumlahLaporan, 'score' => $jumlahLaporan]
            ]
        ])->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
            'bobot' => $bobot,
            'message' => 'Perhitungan bobot berhasil'
        ]);
    }

    public function accept($id)
    {
        try {
            $laporan = LaporanModel::findOrFail($id);
            if ($laporan->status_laporan === 'diproses') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Laporan sudah dalam status Proses.'
                ], 400);
            } elseif ($laporan->status_laporan === 'dikerjakan') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Laporan sudah dalam status Dikerjakan.'
                ], 400);
            } elseif ($laporan->status_laporan === 'selesai') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Laporan sudah dalam status Selesai.'
                ], 400);
            }
            $laporan->status_laporan = 'Diproses';
            $laporan->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Laporan berhasil diterima, Laporan akan segera diproses.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui status laporan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function reject($id, Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda harus login terlebih dahulu.'
            ], 401);
        }

        $laporan = LaporanModel::findOrFail($id);

        // Cek apakah pengguna memiliki akses (misalnya hanya sarpras)
        if (Auth::user()->username !== 'sarpras') {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki akses untuk tindakan ini.'
            ], 403);
        }

        if ($laporan->status_laporan === 'diproses') {
            return response()->json([
                'status' => 'error',
                'message' => 'Laporan Tidak bisa ditolak karena sedang diproses!'
            ], 400);
        } elseif ($laporan->status_laporan === 'dikerjakan') {
            return response()->json([
                'status' => 'error',
                'message' => 'Laporan Tidak bisa ditolak karena sedang dikerjakan!'
            ], 400);
        } elseif ($laporan->status_laporan === 'selesai') {
            return response()->json([
                'status' => 'error',
                'message' => 'Laporan Tidak bisa ditolak karena sudah selesai!'
            ], 400);
        }

        // Proses penolakan laporan
        $laporan->update([
            'status_laporan' => 'ditolak',
            'tanggal_selesai' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Laporan berhasil ditolak.'
        ]);
    }

    public function show_ajax($id)
    {
        $laporan = LaporanModel::with([
            'gedung',
            'lantai',
            'ruang',
            'sarana',
            'sarana.barang',
            'user',
            'teknisi.user'
        ])->findOrFail($id);

        return view('laporan.show_ajax', [
            'laporan' => $laporan
        ]);
    }

    public function getLaporanFotoAttribute($value)
    {
        if (!$value) return null;

        // Hapus duplikasi path
        $filename = str_replace('laporan_files/', '', $value);

        // Path absolut di sistem
        $fullPath = public_path('laporan_files/' . $filename);
        if (file_exists($fullPath)) {
            return asset('laporan_files/' . $filename);
        }

        return null;
    }


    public function show_kelola($id)
    {
        try {
            $laporan = LaporanModel::findOrFail($id);
            $sarana = SaranaModel::findOrFail($id);

            $html = view('laporan.show_kelola_detail', [
                'laporan' => $laporan,
                'sarana' => $sarana
            ])->render();

            return response()->json([
                'status' => 'success',
                'html' => $html
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Laporan tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data laporan.'
            ], 500);
        }
    }

    public function create_ajax()
    {
        $gedung = GedungModel::first(); // Fetch the single building
        $lantai = $gedung ? LantaiModel::where('gedung_id', $gedung->gedung_id)->get() : [];
        return view('laporan.create_ajax', [
            'gedung' => $gedung,
            'lantai' => $lantai,
            'ruang' => [],
            'sarana' => [],
        ]);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $validator = Validator::make($request->all(), [
                'gedung_id' => 'required|exists:m_gedung,gedung_id',
                'lantai_id' => 'required|exists:m_lantai,lantai_id',
                'ruang_id' => 'required|exists:m_ruang,ruang_id',
                'sarana_id' => 'required|exists:m_sarana,sarana_id',
                'laporan_judul' => 'required|string|max:100',
                'laporan_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'tingkat_kerusakan' => 'required|in:rendah,sedang,tinggi,kritis',
                'tingkat_urgensi' => 'required|in:rendah,sedang,tinggi,kritis',
                'dampak_kerusakan' => 'required|in:kecil,sedang,besar',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();
            $data['user_id'] = Auth::user()->user_id;

            if ($request->hasFile('laporan_foto')) {
                $file = $request->file('laporan_foto');
                $path = 'laporan_files';
                $filename = 'LAP-' . Str::upper(Str::random(10)) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($path), $filename);
                $data['laporan_foto'] = $path . '/' . $filename;
            }

            $laporan = LaporanModel::create($data);

            if ($laporan->sarana_id) {
                SaranaModel::where('sarana_id', $laporan->sarana_id)
                    ->increment('jumlah_laporan');
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Laporan berhasil dibuat',
                'data' => $laporan
            ], 200);
        }

        return view('/laporan');
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            try {
                $laporan = LaporanModel::where('laporan_id', $id)
                    ->where('user_id', Auth::user()->user_id)
                    ->firstOrFail();

                $validator = Validator::make($request->all(), [
                    'gedung_id' => 'required|exists:m_gedung,gedung_id',
                    'lantai_id' => 'required|exists:m_lantai,lantai_id',
                    'ruang_id' => 'required|exists:m_ruang,ruang_id',
                    'sarana_id' => 'required|exists:m_sarana,sarana_id',
                    'laporan_judul' => 'required|string|max:100',
                    'laporan_foto' => 'nullable|image|max:2048',
                    'tingkat_kerusakan' => 'required|in:rendah,sedang,tinggi',
                    'tingkat_urgensi' => 'required|in:rendah,sedang,tinggi',
                    'dampak_kerusakan' => 'required|in:kecil,sedang,besar',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => 'error',
                        'errors' => $validator->errors()
                    ], 422);
                }

                $data = $validator->validated();

                if ($request->hasFile('laporan_foto')) {
                    if ($laporan->laporan_foto && Storage::exists('public/laporan_files/' . $laporan->laporan_foto)) {
                        Storage::delete('public/' . $laporan->laporan_foto);
                    }
                    $file = $request->file('laporan_foto');
                    $path = 'laporan_files';
                    $filename = 'LAP-' . Str::upper(Str::random(10)) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path($path), $filename);
                    $data['laporan_foto'] = $path . '/' . $filename;
                }

                $laporan->update($data);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Laporan berhasil diperbarui',
                    'data' => $laporan
                ], 200);
            } catch (Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Laporan tidak ditemukan atau Anda tidak memiliki akses.'
                ], 404);
            }
        }

        redirect('/laporan/kelola');
    }

    public function getGedung()
    {
        $gedung = GedungModel::all();
        return response()->json($gedung);
    }

    public function getLantai($gedung_id)
    {
        $lantai = LantaiModel::where('gedung_id', $gedung_id)->get();
        return response()->json($lantai);
    }

    public function getRuangDanSarana($lantai_id)
    {
        $ruang = RuangModel::where('lantai_id', $lantai_id)->get();
        $ruangIDs = $ruang->pluck('ruang_id');

        $sarana = SaranaModel::whereIn('ruang_id', $ruangIDs)->with('barang')->get();

        $saranaFormatted = $sarana->map(function ($item) {
            return [
                'sarana_id' => $item->sarana_id,
                'sarana_kode' => $item->barang->barang_kode ?? 'KODE-' . $item->sarana_id,
                'sarana_nama' => $item->barang->barang_nama ?? 'Sarana #' . $item->sarana_id
            ];
        });
        return response()->json([
            'ruang' => $ruang,
            'sarana' => $saranaFormatted
        ]);
    }
}
