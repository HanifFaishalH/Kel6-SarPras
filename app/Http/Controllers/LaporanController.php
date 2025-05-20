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
        $data = LaporanModel::query();

        if ($request->laporan_id) {
            $data->where('laporan_id', $request->laporan_id);
        }

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '
                    <a href="javascript:void(0)" onclick="modalAction(\'' . url('laporan/edit/' . $row->laporan_id) . '\')" class="btn btn-sm btn-warning">Edit</a>
                    <a href="javascript:void(0)" onclick="modalAction(\'' . url('laporan/delete/' . $row->laporan_id) . '\')" class="btn btn-sm btn-danger">Hapus</a>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax() {
        $gedung = GedungModel::all();
        $lantai = LantaiModel::all();
        $ruang = RuangModel::all();
        $sarana = SaranaModel::all();
        $user = UserModel::all();
        $teknisi = TeknisiModel::all();
        return view('laporan.create_ajax', [
            'gedung' => $gedung,
            'lantai' => $lantai,
            'ruang' => $ruang,
            'sarana' => $sarana,
            'user' => $user,
            'teknisi' => $teknisi
        ]);
    }

    public function store_ajax(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'gedung_id' => 'required|exists:gedung,id',
            'lantai_id' => 'required|exists:lantai,id',
            'ruang_id' => 'required|exists:ruang,id',
            'sarana_id' => 'required|exists:sarana,id',
            'laporan_judul' => 'required|string|max:255',
            'laporan_deskripsi' => 'required|string',
        ]);

        $laporan = LaporanModel::create([
            'user_id' => $request->user_id,
            'gedung_id' => $request->gedung_id,
            'lantai_id' => $request->lantai_id,
            'ruang_id' => $request->ruang_id,
            'sarana_id' => $request->sarana_id,
            'teknisi_id' => null,
            'laporan_kode' => 'LAP-' . str_pad(LaporanModel::count() + 1, 4, '0', STR_PAD_LEFT),
            'laporan_judul' => $request->laporan_judul,
            'laporan_deskripsi' => $request->laporan_deskripsi,
            'laporan_status' => 'Menunggu',
            'laporan_tanggal' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Laporan berhasil dikirim.', 'data' => $laporan]);
    }
}
