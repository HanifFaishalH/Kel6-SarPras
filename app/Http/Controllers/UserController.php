<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
       public function index()
    {
        $user = UserModel::all();
        $level=LevelModel::all();
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

    public function list(Request $request) {
        $data = UserModel::select(
            'user_id',
            'username',
            'password',
            'nama', 
            'level_id',
            'foto',
            'no_induk',
        )->with('level')->get();
        if ($request->user_id) {
            $data->where('user_id', $request->user_id);
        }

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $btn  = '<button onclick="modalAction(\''.url('/user/' . $row->user_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/user/' . $row->user_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/user/' . $row->user_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
