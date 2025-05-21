<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanModel;
use App\Models\GedungModel;
use App\Models\LantaiModel;
use App\Models\RuangModel;
use App\Models\SaranaModel;
use App\Models\UserModel;
use App\Models\TeknisiModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

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
        $laporan = LaporanModel::with(['gedung', 'lantai', 'ruang', 'sarana', 'user', 'teknisi']);
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
                $btn = '<button onclick="modalAction(\''.url('/laporan/' . $row->laporan_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button>';
                $btn = '<button onclick="modalAction(\''.url('/laporan/' . $row->laporan_id . '/edit_ajax').'\')" class="btn btn-info btn-sm">Detail</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax() {
        $gedung = GedungModel::all();
        $lantai = LantaiModel::all();
        $ruang = RuangModel::all();
        $sarana = SaranaModel::all();

        return view('laporan.create_ajax', [
            'gedung' => $gedung,
            'lantai' => $lantai,
            'ruang' => $ruang,
            'sarana' => $sarana
        ]);
    }
    public function store(Request $request)
    {
        $validator = $request->validate([
            'user_id' => 'required|exists:m_users,user_id',
            'gedung_id' => 'required|exists:m_gedung,gedung_id',
            'lantai_id' => 'required|exists:m_lantai,lantai_id',
            'ruang_id' => 'required|exists:m_ruang,ruang_id',
            'sarana_id' => 'required|exists:m_sarana,sarana_id',
            'laporan_judul' => 'required|string|max:100',
            'laporan_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tingkat_kerusakan' => 'required|in:rendah,sedang,tinggi',
            'tingkat_urgensi' => 'required|in:rendah,sedang,tinggi,kritis',
            'frekuensi_penggunaan' => 'required|in:harian,mingguan,bulanan,tahunan',
            'tanggal_operasional' => 'required|date',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('laporan_foto')) {
            $path = $request->file('laporan_foto')->store('laporan', 'public');
            $validator['laporan_foto'] = $path;
        }

        $laporan = LaporanModel::create([
            ...$validator,
            'tanggal_operasional' => strtotime($validator['tanggal_operasional']),
        ]);

        return response()->json([
            'message' => 'Laporan berhasil ditambahkan',
            'data' => $laporan
        ]);
    }


    public function getLantai($gedung_id)
    {
        $lantai = LantaiModel::where('gedung_id', $gedung_id)->get();
        return response()->json($lantai);
    }

    public function getRuang($lantai_id)
    {
        $ruang = RuangModel::where('lantai_id', $lantai_id)->get();
        return response()->json($ruang);
    }

    public function getSarana($ruang_id)
    {
        $sarana = SaranaModel::where('ruang_id', $ruang_id)->get();
        return response()->json($sarana);
    }
}
