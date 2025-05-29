<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;



class BarangController extends Controller
{
    public function index()
    {
        $kategori = KategoriModel::all();

        $breadcrumbs = [
            'title' => 'Daftar Barang',
            'list' => ['home', 'Barang']
        ];

        $page = (object) [
            'title' => "Daftar Barang"
        ];

        $activeMenu = 'barang';

        return view('barang.index', [
            'kategori' => $kategori,
            'breadcrumbs' => $breadcrumbs,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $data = BarangModel::query()->with('kategori');

        if ($request->kategori_id) {
            $data->where('kategori_id', $request->kategori_id);
        }

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('kategori_nama', function ($row) {
                return $row->kategori ? $row->kategori->kategori_nama : '-';
            })
            ->addColumn('aksi', function ($row) {
                return '
                    <a href="javascript:void(0)" onclick="modalAction(\''.url('fasilitas/detail/'.$row->barang_id).'\')" class="btn btn-sm btn-info">Detail</a>
                    <a href="javascript:void(0)" onclick="modalAction(\''.url('fasilitas/edit/'.$row->barang_id).'\')" class="btn btn-sm btn-warning">Edit</a>
                    <a href="javascript:void(0)" onclick="modalAction(\''.url('fasilitas/delete/'.$row->barang_id).'\')" class="btn btn-sm btn-danger">Hapus</a>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}