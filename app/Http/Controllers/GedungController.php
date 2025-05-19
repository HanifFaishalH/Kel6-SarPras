<?php

namespace App\Http\Controllers;

use App\Models\GedungModel;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    public function index()
    {
        $gedung = GedungModel::all();

        $breadcrumbs = [
            'title' => 'Daftar Gedung',
            'list' => ['home', 'gedung']
        ];

        $page = (object) [
            'title' => "Daftar Gedung"
        ];

        $activeMenu = 'gedung';

        return view('gedung.index', [
            'gedung' => $gedung,
            'breadcrumbs' => $breadcrumbs,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $data = GedungModel::query();

        if ($request->gedung_id) {
            $data->where('gedung_id', $request->gedung_id);
        }

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '
                    <a href="javascript:void(0)" onclick="modalAction(\'' . url('gedung/edit/' . $row->gedung_id) . '\')" class="btn btn-sm btn-warning">Edit</a>
                    <a href="javascript:void(0)" onclick="modalAction(\'' . url('gedung/delete/' . $row->gedung_id) . '\')" class="btn btn-sm btn-danger">Hapus</a>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
