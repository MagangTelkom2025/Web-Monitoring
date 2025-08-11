<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        // Jika sudah login, langsung redirect
        if (session()->get('logged_in')) {
            return redirect()->to('/ticket');
        }

        return view('auth/login');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password_hash'])) {
            $session->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'role'      => $user['role'],
                'logged_in' => true
            ]);
            return redirect()->to('/ticket');

        } else {
            $session->setFlashdata('error', 'Username atau password salah.');
            return redirect()->to('/login')->withInput();
        }
        dd([
    'input_username' => $username,
    'user_from_db' => $user,
    'password_input' => $password,
    'password_db' => $user['password_hash'] ?? 'not found',
    'verify' => isset($user) ? password_verify($password, $user['password_hash']) : false,
]);

    }

    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('message', 'You have been successfully logged out.');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerProcess()
    {
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $role     = $this->request->getPost('role');

        $data = [
            'username'      => $username,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role'          => $role
        ];

        $model->insert($data);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
