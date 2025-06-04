<?php

namespace App\Http\Controllers;

use App\Models\RuangModel;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function index() {
        $ruang = RuangModel::all();

        $breadcrumbs = [
            'title' => 'Daftar ruang',
            'list' => ['home', 'ruang']
        ];
        $page = (object) [
            'title' => "Daftar Laporan"
        ];
        $activeMenu = 'ruang';
        return view('laporan.index', [
            'ruang' => $ruang,
            'breadcrumbs' => $breadcrumbs,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $user = $request->user();

        // Query builder with eager loading
        $query = RuangModel::with('lantai');

        // Filter berdasarkan lantai jika ada
        if ($request->filled('lantai_id')) {
            $query->where('lantai_id', $request->lantai_id);
        }

        return datatables()->eloquent($query)
            ->addColumn('lantai', function ($row) {
                return $row->lantai->lantai_nama ?? '-';
            })
            ->addColumn('action', function ($row) use ($user) {
                $edit = '';
                if ($user->hasPermission('admin')) {
                    $edit = '<a href="'.route('ruang.edit', $row->ruang_id).'" class="btn btn-sm btn-primary">Edit</a>';
                }
                return $edit;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
