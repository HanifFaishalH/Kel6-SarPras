<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
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
            'activeMenu' => $activeMenu
        ]);
    }
}