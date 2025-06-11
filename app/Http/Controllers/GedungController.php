<?php

namespace App\Http\Controllers;

use App\Models\GedungModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Detail

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

    // Create

    public function create_ajax()
    {
        return response()->json([
            'status' => 'success',
            'html' => view('gedung.create_ajax')->render()
        ]);
    }

    public function store(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Generate gedung_kode otomatis (misal berdasarkan last_id)
            $last_id = GedungModel::max('gedung_id') ?? 0;
            $next_number = $last_id + 1;
            $gedung_kode = 'GDG-' . $next_number;

            $validator = Validator::make(array_merge($request->all(), ['gedung_kode' => $gedung_kode]), [
                'gedung_nama' => 'required|string|max:255',
                'gedung_kode' => 'required|string|max:50|unique:m_gedung,gedung_kode',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();
            GedungModel::create([
                'gedung_nama' => $data['gedung_nama'],
                'gedung_kode' => $gedung_kode,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Gedung berhasil ditambahkan'
            ]);
        }

        return redirect('/gedung');
    }

    // Edit

    public function edit($id)
    {
        $gedung = GedungModel::findOrFail($id);
        $html = view('gedung.edit', compact('gedung'))->render();
        return response()->json([
            'status' => 'success',
            'html' => $html,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gedung_nama' => 'required|string|max:255',
            'gedung_kode' => 'required|string|max:50|unique:m_gedung,gedung_kode,' . $id . ',gedung_id',
        ]);

        $gedung = GedungModel::findOrFail($id);
        $gedung->update($request->only(['gedung_nama', 'gedung_kode']));

        return response()->json([
            'status' => 'success',
            'message' => 'Data gedung berhasil diperbarui!',
        ]);
    }
}
