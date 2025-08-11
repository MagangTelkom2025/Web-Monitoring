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

        return view('absen', $data);
    }
    public function uploadForm()
    {
        return view('absen/uploadaux');
    }
}
