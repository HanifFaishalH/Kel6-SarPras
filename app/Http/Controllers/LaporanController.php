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
        $laporan = LaporanModel::with(['gedung', 'lantai', 'ruang', 'sarana', 'user', 'teknisi'])
            ->where('user_id', Auth::user()->user_id);

        if ($request->laporan_id) {
            $laporan->where('laporan_id', $request->laporan_id);
        }

        return datatables()->of($laporan)
            ->addIndexColumn()
            ->addColumn('gedung', function ($row) {
                return $row->gedung->gedung_nama;
            })
            ->addColumn('lantai', function ($row) {
                return $row->lantai->lantai_nama;
            })
            ->addColumn('ruang', function ($row) {
                return $row->ruang->ruang_nama;
            })
            ->addColumn('sarana', function ($row) {
                return $row->sarana->sarana_nama;
            })
            ->addColumn('user', function ($row) {
                return $row->user->name;
            })
            ->addColumn('teknisi', function ($row) {
                return $row->teknisi ? $row->teknisi->name : '-';
            })
            ->addColumn('aksi', function ($row) {
                $btn = '<button onclick="modalAction(\''.url('/laporan/' . $row->laporan_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/laporan/' . $row->laporan_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax() {
        $gedung = GedungModel::find(1);
        return view('laporan.create_ajax', [
            'gedung' => $gedung,
            'lantai' => [],
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

    public function show_ajax($id)
    {
        $laporan = LaporanModel::with([
            'gedung',
            'lantai',
            'ruang',
            'sarana.kategori',
            'user',
            'teknisi.user'
        ])->findOrFail($id);

        return view('laporan.show_ajax', [
            'laporan' => $laporan,
            'breadcrumbs' => [
                'title' => 'Detail Laporan',
                'list' => ['home', 'laporan', 'detail']
            ],
            'page' => (object) [
                'title' => "Detail Laporan"
            ],
            'activeMenu' => 'laporan'
        ]);
    }


    public function getGedung()
    {
        return response()->json(GedungModel::all());
    }

    public function getLantai($gedung_id)
    {
        return response()->json(LantaiModel::where('gedung_id', $gedung_id)->get());
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
                'sarana_nama' => $item->barang->barang_nama ?? 'Sarana #' . $item->sarana_id,
            ];
        });

        return response()->json([
            'ruang' => $ruang,
            'sarana' => $saranaFormatted
        ]);
    }
}
