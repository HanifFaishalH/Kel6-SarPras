<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            ->addColumn('aksi', function ($row) {
                $btn  = '<button onclick="modalAction(\'' . url('/user/' . $row->user_id . '/show') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $row->user_id . '/edit') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button class="btn btn-danger btn-sm btn-hapus" data-id="' . $row->user_id . '">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show(string $id)
    {
        $user = UserModel::find($id);

        if (!$user) {
            abort(404, 'User tidak ditemukan');
        }

        return view('user.show', compact('user'));
    }


    // Edit

    public function edit($id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        if (!$user) {
            abort(404, 'User tidak ditemukan');
        }

        return view('user.edit', compact('user', 'level'));
    }


    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $request->validate([
            'username' => 'required|string|max:50',
            'no_induk' => 'required|string|max:50|unique:m_users,no_induk,' . $id . ',user_id',
            'nama' => 'required|string|max:50',
            'level_id' => 'required|exists:m_level,level_id',
            'password' => 'nullable|min:5',
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request['password']);
        }

        $user = UserModel::findOrFail($id);
        $user->update($request->only(['username', 'no_induk', 'nama', 'level_id']));

        return back()->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = UserModel::find($id);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan.'], 404);
        }

        try {
            $user->delete();
            return response()->json(['message' => 'User berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus user.'], 500);
        }
    }

    public function create_ajax(Request $request)
    {
        $level = LevelModel::all();
        return view('user.create_ajax', compact('level'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_id' => 'required|exists:m_level,level_id',
            'username' => 'required|unique:m_users,username',
            'password' => 'required|min:6',
            'nama' => 'required',
            'no_induk' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_user', 'public');
        }

        UserModel::create([
            'level_id' => $request->level_id,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'nama' => $request->nama,
            'no_induk' => $request->no_induk,
            'foto' => $fotoPath,
        ]);

        return response()->json(['status' => 'success']);
    }
}