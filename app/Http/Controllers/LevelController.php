<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;


class LevelController extends Controller
{
    public function index()
    {
        $level = LevelModel::all();

        $breadcrumbs = [
            'title' => 'Daftar Level',
            'list' => ['home', 'level']
        ];

        $page = (object) [
            'title' => "Daftar Level"
        ];

        $activeMenu = 'level';

        return view('level.index', [
            'level' => $level,
            'breadcrumbs' => $breadcrumbs,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request) {
        $data = LevelModel::query();

        if ($request->level_id) {
            $data->where('level_id', $request->level_id);
        }

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btn  = '<button onclick="modalAction(\''.url('/laporan/' . $row->laporan_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/laporan/' . $row->laporan_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/laporan/' . $row->laporan_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
