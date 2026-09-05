<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }


    public function store()
    {
        $rules = [
            'name' => 'required|min_length[2]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {

            return redirect()
                ->to('/register')
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }


        $userModel = new UserModel();

        $userModel->insert([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            )
        ]);


        return redirect()
            ->to('/login')
            ->with(
                'success',
                'Account created successfully. Please login.'
            );
    }


    public function login()
    {
        return view('auth/login');
    }


    public function authenticate()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];


        if (!$this->validate($rules)) {

            return redirect()
                ->to('/login')
                ->withInput()
                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }


        $userModel = new UserModel();

        $user = $userModel
            ->where(
                'email',
                $this->request->getPost('email')
            )
            ->first();


        if (!$user) {

            return redirect()
                ->to('/login')
                ->withInput()
                ->with(
                    'error',
                    'Invalid email or password.'
                );
        }


        if (
            !password_verify(
                $this->request->getPost('password'),
                $user['password']
            )
        ) {

            return redirect()
                ->to('/login')
                ->withInput()
                ->with(
                    'error',
                    'Invalid email or password.'
                );
        }


        session()->set([
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'user_email' => $user['email'],
            'isLoggedIn' => true
        ]);


        return redirect()->to('/dashboard');
    }


    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}