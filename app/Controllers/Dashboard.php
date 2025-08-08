<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard - Telkom Web Monitoring',
            'username' => session()->get('username') ?? 'User',
            'current_time' => date('H:i'),
            'current_date' => date('l, d F Y')
        ];

        // Render halaman utama dengan template layout
        return view('dashboard/index', $data);
    }

    public function absen()
    {
        $data = [
            'title' => 'Absen - Telkom Monitor',
            'username' => session()->get('username') ?? 'User'
        ];

        return view('absen', $data);
    }
}
