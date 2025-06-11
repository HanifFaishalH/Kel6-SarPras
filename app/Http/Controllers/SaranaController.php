<?php

namespace App\Http\Controllers;

use App\Models\SaranaModel;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\LantaiModel;
use App\Models\RuangModel;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SaranaController extends Controller
{
    public function index()
    {
        $sarana = SaranaModel::all();
        $kategori = KategoriModel::all();
        $barang = BarangModel::all();
        $ruang = RuangModel::all();
        $lantai = LantaiModel::all();

        $breadcrumbs = [
            'title' => 'Daftar Sarana',
            'list' => ['home', 'Sarana']
        ];

        $page = (object) [
            'title' => "Daftar Sarana"
        ];

        $activeMenu = 'sarana';

        return view('sarana.index', [
            'sarana' => $sarana,
            'kategori' => $kategori,
            'barang' => $barang,
            'ruang' => $ruang,
            'lantai' => $lantai,
            'breadrumbs' => $breadcrumbs,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $data = SaranaModel::with(['kategori', 'barang', 'ruang.lantai']);


        if ($request->kategori_id) {
            $data->where('kategori_id', $request->kategori_id);
        }

        if ($request->lantai_id) {
            $data->whereHas('ruang', function ($query) use ($request) {
                $query->where('lantai_id', $request->lantai_id);
            });
        }


        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('sarana_kode', fn($row) => $row->sarana_kode)
            ->addColumn('kategori_nama', fn($row) => $row->kategori->kategori_nama ?? '-')
            ->addColumn('barang_nama', fn($row) => $row->barang->barang_nama ?? '-')
            ->addColumn('ruang_nama', fn($row) => $row->ruang->ruang_nama ?? '-')
            ->addColumn('lantai_nama', fn($row) => $row->ruang->lantai->lantai_nama ?? '-')
            ->addColumn('nomor_urut', fn($row) => $row->nomor_urut ?? '-')
            ->addColumn('aksi', function ($row) {
                return '
                    <a href="javascript:void(0)" onclick="modalAction(\'' . url('sarana/show/' . $row->sarana_id) . '\')" class="btn btn-sm btn-info">Detail</a>
                    <a href="javascript:void(0)" onclick="modalAction(\'' . url('sarana/delete_ajax/' . $row->sarana_id) . '\')" class="btn btn-sm btn-danger">Hapus</a>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function show($id)
    {
        $sarana = SaranaModel::with(['ruang.lantai', 'kategori', 'barang'])->findOrFail($id);
        return view('sarana.show', compact('sarana'));
    }

    public function create_ajax()
    {
        $lantai_list = LantaiModel::all();
        $ruang_list = RuangModel::all(); // Akan digantikan oleh AJAX
        $kategori_list = KategoriModel::all(); // Akan digantikan oleh AJAX
        $barang_list = BarangModel::all(); // Akan digantikan oleh AJAX

        return view('sarana.create_ajax', [
            'lantai_list' => $lantai_list,
            'ruang_list' => $ruang_list,
            'kategori_list' => $kategori_list,
            'barang_list' => $barang_list,
            'sarana_kode' => 'SAR-' . (SaranaModel::max('sarana_id') + 1 ?? 1) // Generate kode otomatis
        ]);
    }

    public function getRuangByLantai($lantai_id)
    {
        $ruang = RuangModel::where('lantai_id', $lantai_id)->get();
        return response()->json($ruang);
    }

    public function getKategoriByRuang($ruang_id)
    {
        $kategori = KategoriModel::whereHas('sarana', function ($query) use ($ruang_id) {
            $query->where('ruang_id', $ruang_id);
        })->get();

        return response()->json($kategori);
    }

    public function getBarangByKategori($kategori_id)
    {
        $barang = BarangModel::where('kategori_id', $kategori_id)->get();
        return response()->json($barang);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $total_entries = SaranaModel::count();
            $next_number = $total_entries + 1;
            $sarana_kode = 'SAR-' . $next_number;

            $validator = Validator::make(array_merge($request->all(), ['sarana_kode' => $sarana_kode]), [
                'sarana_kode' => 'required|string|max:50|unique:m_sarana,sarana_kode',
                'ruang_id' => 'required|exists:m_ruang,ruang_id',
                'kategori_id' => 'required|exists:m_kategori,kategori_id',
                'barang_id' => 'required|exists:m_barang,barang_id',
                'frekuensi_penggunaan' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();

            // Hitung nomor_urut berdasarkan barang_id dan ruang_id yang sudah ada
            $existingCount = SaranaModel::where('ruang_id', $data['ruang_id'])
                ->where('barang_id', $data['barang_id'])
                ->count();
            $data['nomor_urut'] = $existingCount + 1;

            $data['jumlah_laporan'] = 0;
            $data['tanggal_operasional'] = now();
            $data['tingkat_kerusakan_tertinggi'] = null;
            $data['skor_prioritas'] = 0;
            $data['sarana_kode'] = $sarana_kode;

            SaranaModel::create($data);

            return response()->json(['success' => true, 'message' => 'Sarana berhasil ditambahkan']);
        }
    }


    public function delete_ajax($id)
    {
        $sarana = SaranaModel::with('ruang')->findOrFail($id);
        return view('sarana.delete_confirm_ajax', [
            'sarana' => $sarana
        ]);
    }

    public function destroy_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $sarana = SaranaModel::findOrFail($id);

            $maxIdBefore = SaranaModel::max('sarana_id');

            $sarana->delete();

            $maxIdAfter = SaranaModel::max('sarana_id');

            if ($maxIdBefore !== null && $maxIdAfter !== null && $maxIdBefore > $maxIdAfter) {
                $newAutoIncrement = $maxIdAfter + 1;
                DB::statement("ALTER TABLE m_sarana AUTO_INCREMENT = $newAutoIncrement");
            } elseif ($maxIdAfter === null) {
                DB::statement("ALTER TABLE m_sarana AUTO_INCREMENT = 1");
            }

            return response()->json(['success' => true, 'message' => 'Sarana deleted successfully']);
        }

        return redirect('/sarana');
    }
}
