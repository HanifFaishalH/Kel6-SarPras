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

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($gedung) {
                $btn  = '<button onclick="modalAction(\'' . url('/gedung/' . $gedung->gedung_id . '/show') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/gedung/' . $gedung->gedung_id . '/edit') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/gedung/' . $gedung->gedung_id . '/delete') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show(string $id)
    {
        $gedung = GedungModel::find($id);

        if (!$gedung) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gedung dengan ID ' . $id . ' tidak ditemukan'
            ], 404);
        }

        $html = view('gedung.show', compact('gedung'))->render();

        return response()->json([
            'status' => 'success',
            'html' => $html
        ]);
    }
}
