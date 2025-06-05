<?php

namespace App\Http\Controllers;

use App\Models\SaranaModel;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\RuangModel;
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
                    <a href="javascript:void(0)" onclick="modalAction(\'' . url('sarana/detail/' . $row->sarana_id) . '\')" class="btn btn-sm btn-info">Detail</a>
                    <a href="javascript:void(0)" onclick="modalAction(\'' . url('sarana/edit/' . $row->sarana_id) . '\')" class="btn btn-sm btn-warning">Edit</a>
                    <a href="javascript:void(0)" onclick="modalAction(\'' . url('sarana/delete/' . $row->sarana_id) . '\')" class="btn btn-sm btn-danger">Hapus</a>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
