<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (request()->ajax() || request()->wantsJson()) {
            $user = UserModel::find(auth()->id());
            if (!$user->hasPermission('admin')) {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
        }
        
        $user = UserModel::all();
        $level = LevelModel::all();
        $breadcrumbs = [
            'title' => 'Daftar User',
            'list' => ['home', 'user']
        ];

        $page = (object) [
            'title' => "Daftar User"
        ];

        $activeMenu = 'user';

        return view('user.index', [
            'user' => $user,
            'level' => $level,
            'breadcrumbs' => $breadcrumbs,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $data = UserModel::select(
            'user_id',
            'no_induk',
            'username',
            'password',
            'nama',
            'level_id',
            'foto',
        )->with('level')->get();


        if ($request->level_id) {
            $data = $data->where('level_id', $request->level_id);
        }

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('level_nama', function ($row) {
                return $row->level ? $row->level->level_nama : '-';
            })
            ->addColumn('no_induk', function ($row) {
                return $row->no_induk ? $row->no_induk : '-';
            })
            ->addColumn('username', function ($row) {
                return $row->username ? $row->username : '-';
            })
            ->addColumn('nama', function ($row) {
                return $row->nama ? $row->nama : '-';
            })
            ->addColumn('foto', function ($row) {
                return $row->foto ? '<img src="' . asset('storage/' . $row->foto) . '" class="img-thumbnail" style="width: 50px; height: 50px;">' : '-';
            })
            ->addColumn('aksi', function ($row) {
                $btn  = '<button onclick="modalAction(\'' . url('/user/' . $row->user_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $row->user_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $row->user_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}