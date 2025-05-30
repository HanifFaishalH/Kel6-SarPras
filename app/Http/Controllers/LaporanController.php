<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanModel;
use App\Models\GedungModel;
use App\Models\LantaiModel;
use App\Models\RuangModel;
use App\Models\SaranaModel;
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
            ->addColumn('role', function($row) {
                return strtoupper($row->role);
            })
            ->addColumn('sarana', function($row) {
                return $row->sarana->barang->barang_nama ?? '-';
            })
            ->addColumn('teknisi', function($row) {
                return $row->teknisi ? $row->teknisi->user->name : '-';
            })
            ->addColumn('status_laporan', function($row) {
                return ucfirst($row->status_laporan);
            })
            ->addColumn('status_admin', function($row) {
                return ucfirst($row->status_admin);
            })
            ->addColumn('status_sarpras', function($row) {
                return ucfirst($row->status_sarpras);
            })
            ->addColumn('aksi', function($row) {
                $btn = '<button class="btn btn-info btn-sm" onclick="modalAction(\'' . url('/laporan/show_ajax/' . $row->laporan_id) . '\')">Detail</button> ';
                $btn .= '<button class="btn btn-warning btn-sm" onclick="modalAction(\'' . url('/laporan/edit_ajax/' . $row->laporan_id) . '\')">Edit</button>';
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
        $laporan = LaporanModel::with(['gedung', 'lantai', 'ruang', 'sarana', 'user', 'teknisi']);

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
            ->addColumn('lantai.lantai_nama', function ($row) {
                return optional($row->lantai)->lantai_nama ?? '-';
            })
            ->addColumn('ruang.ruang_nama', function ($row) {
                return optional($row->ruang)->ruang_nama ?? '-';
            })
            ->addColumn('sarana.sarana_nama', function ($row) {
                return $row->sarana->barang->barang_nama ?? '-';
            })
            ->addColumn('status', function ($row) {
                return ucfirst($row->status); // Misalnya: 'Pending', 'Proses'
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('d-m-Y H:i');
            })
            ->addColumn('aksi', function ($row) {
                $btn = '<button onclick="modalAction(\'' . url('/laporan/show_kelola_ajax/' . $row->laporan_id) . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/laporan/edit_ajax/' . $row->laporan_id) . '\')" class="btn btn-warning btn-sm">Edit</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

        
    public function show_ajax($id)
    {
        $laporan = LaporanModel::with([
            'gedung',
            'lantai',
            'ruang',
            'sarana',
            'user',
            'teknisi'
        ])->findOrFail($id);

        return view('laporan.show_ajax', [
            'laporan' => $laporan
        ]);
    }

    public function show_kelola($id)
    {
        $laporan = LaporanModel::with([
            'gedung',
            'lantai',
            'ruang',
            'sarana',
            'user',
            'teknisi'
        ])->findOrFail($id);

        return view('laporan.show_kelola_detail', [
            'laporan' => $laporan
        ]);
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
                'frekuensi_penggunaan' => 'required|in:harian,mingguan,bulanan,tahunan',
                'dampak_kerusakan' => 'required|in:minor,kecil,sedang,besar',
                'tanggal_operasional' => 'required|date',
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

            return response()->json([
                'status' => 'success',
                'message' => 'Laporan berhasil dibuat',
                'data' => $laporan
            ], 200);
        }

        return view('/laporan');
    }

    public function edit_ajax($id)
    {
        try {
            $laporan = LaporanModel::with(['gedung', 'lantai', 'ruang', 'sarana'])
                ->where('laporan_id', $id)
                ->where('user_id', Auth::user()->user_id)
                ->firstOrFail();

            $gedung = GedungModel::all();
            $lantai = LantaiModel::where('gedung_id', $laporan->gedung_id)->get();
            $ruang = RuangModel::where('lantai_id', $laporan->lantai_id)->get();
            $sarana = SaranaModel::where('ruang_id', $laporan->ruang_id)->with('barang')->get();

            return view('laporan.edit', [
                'laporan' => $laporan,
                'gedung' => $gedung,
                'lantai' => $lantai,
                'ruang' => $ruang,
                'sarana' => $sarana
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Laporan tidak ditemukan atau Anda tidak memiliki akses.'
            ], 404);
        }
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
                    'tingkat_urgensi' => 'required|in:rendah,sedang,tinggi,kritis',
                    'frekuensi_penggunaan' => 'required|in:harian,mingguan,bulanan,tahunan',
                    'tanggal_operasional' => 'required|date'
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => 'error',
                        'errors' => $validator->errors()
                    ], 422);
                }

                $data = $validator->validated();

                if ($request->hasFile('laporan_foto')) {
                    if ($laporan->laporan_foto && Storage::exists('public/' . $laporan->laporan_foto)) {
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