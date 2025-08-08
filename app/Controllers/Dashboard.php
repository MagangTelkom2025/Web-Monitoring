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
        return view('ticket', $data);
        // return view('layout/app/main', $data);
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
