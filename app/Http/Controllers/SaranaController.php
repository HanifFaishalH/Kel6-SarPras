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
                    <a href="javascript:void(0)" onclick="modalAction(\'' . url('sarana/edit_ajax/' . $row->sarana_id) . '\')" class="btn btn-sm btn-warning">Edit</a>
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
        $ruang_list = RuangModel::all();
        $kategori_list = KategoriModel::all();
        $barang_list = BarangModel::all();

        return view('sarana.create_ajax', [
            'ruang_list' => $ruang_list,
            'kategori_list' => $kategori_list,
            'barang_list' => $barang_list
        ]);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Generate sarana_kode otomatis sebelum validasi
            $last_id = SaranaModel::max('sarana_id') ?? 0;
            $next_number = $last_id + 1;
            $sarana_kode = 'SARANA-' . $next_number;

            $validator = Validator::make(array_merge($request->all(), ['sarana_kode' => $sarana_kode]), [
                'sarana_kode' => 'required|string|max:50|unique:m_sarana,sarana_kode',
                'ruang_id' => 'required|exists:m_ruang,ruang_id',
                'kategori_id' => 'required|exists:m_kategori,kategori_id',
                'barang_id' => 'required|exists:m_barang,barang_id',
                'frekuensi_penggunaan' => 'required|string|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();
            SaranaModel::create($data);

            return response()->json(['success' => true, 'message' => 'Sarana created successfully']);
        }

        return redirect('/sarana');
    }

    public function edit_ajax($id)
    {
        $sarana = SaranaModel::findOrFail($id);
        $ruang_list = RuangModel::all();

        return view('sarana.edit_ajax', [
            'sarana' => $sarana,
            'ruang_list' => $ruang_list
        ]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $validator = Validator::make($request->all(), [
                'ruang_id' => 'required|exists:m_ruang,ruang_id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();
            $sarana = SaranaModel::findOrFail($id);
            $sarana->update($data);

            return response()->json(['success' => true, 'message' => 'Sarana updated successfully']);
        }

        return redirect('/sarana');
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
            $sarana->delete();

            return response()->json(['success' => true, 'message' => 'Sarana deleted successfully']);
        }

        return redirect('/sarana');
    }
}
