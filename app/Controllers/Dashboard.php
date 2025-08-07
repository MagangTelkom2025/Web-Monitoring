<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard - Telkom Monitor',
            'username' => session()->get('username') ?? 'User'
        ];

        // Ubah cara merender view agar menggunakan template utama dengan benar
        // return view('dashboard/index', $data);
        return view('layout/sidebar', $data);
    }
}
