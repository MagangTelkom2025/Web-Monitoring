<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        // Check if user is already logged in
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function authenticate()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // For demonstration purposes - replace with actual database authentication
        // In a real application, you would check against a database
        // and use proper password hashing
        if ($username === 'admin' && $password === 'admin123') {
            $userData = [
                'username' => $username,
                'isLoggedIn' => true,
                // Add any other user data you want to store in the session
            ];

            $session->set($userData);
            return redirect()->to('/dashboard');
        } else {
            $session->setFlashdata('error', 'Username or Password is incorrect.');
            return redirect()->to('/login')->withInput();
        }
    }

    public function forgotPassword()
    {
        // This would be implemented in a real application
        return view('auth/forgot_password'); // You would need to create this view
    }

    public function logout()
    {
        // Destroy the session
        session()->destroy();

        // Redirect to login page with a success message
        return redirect()->to('/login')->with('message', 'You have been successfully logged out.');
    }
}
