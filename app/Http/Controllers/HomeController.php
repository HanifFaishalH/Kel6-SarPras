<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanModel;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $total = LaporanModel::where('user_id', $user->user_id)->count();
        
        $pending = LaporanModel::where('user_id', $user->user_id)
                    ->where('status_laporan', 'pending')->count();
        $diproses = LaporanModel::where('user_id', $user->user_id)
                    ->where('status_laporan', 'diproses')->count();
        $dikerjakan = LaporanModel::where('user_id', $user->user_id)
                    ->where('status_laporan', 'dikerjakan')->count();
        $selesai = LaporanModel::where('user_id', $user->user_id)
                    ->where('status_laporan', 'selesai')->count();
        $ditolak = LaporanModel::where('user_id', $user->user_id)
                    ->where('status_laporan', 'ditolak')->count();

        $breadcrumbs = [
            'title' => 'Dashboard',
            'list' => ['home']
        ];

        $page = (object) [
            'title' => "Dashboard"
        ];

        $activeMenu = 'home';

        return view('layout.welcome', [
            'breadcrumbs' => $breadcrumbs,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'user' => $user,
            'total' => $total,
            'pending' => $pending,
            'diproses' => $diproses,
            'dikerjakan' => $dikerjakan,
            'selesai' => $selesai,
            'ditolak' => $ditolak,
        ]);
    }
}