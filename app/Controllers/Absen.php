<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Absen extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Absen - Telkom Monitor',
            'username' => session()->get('username') ?? 'User'
        ];

        return view('contents/absen/view', $data);
    }
    public function uploadForm()
    {
        $data = [
            'title' => 'Upload Absen',
            'user'  => session()->get('username')
        ];
        return view('contents/absen/upload', $data);
    }
}
