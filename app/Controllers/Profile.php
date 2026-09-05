<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $userId = session()->get('user_id');

        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()
                ->to('/login')
                ->with('error', 'User not found.');
        }

        return view('profile/index', [
            'user' => $user
        ]);
    }

    public function edit()
    {
        $userModel = new UserModel();

        $userId = session()->get('user_id');

        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()
                ->to('/login')
                ->with('error', 'User not found.');
        }

        return view('profile/edit', [
            'user' => $user
        ]);
    }

    public function update()
    {
        $userModel = new UserModel();

        $userId = session()->get('user_id');

        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()
                ->to('/login')
                ->with('error', 'User not found.');
        }

        $rules = [
            'name' => 'required|min_length[2]',
            'email' => "required|valid_email|is_unique[users.email,id,{$userId}]"
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->to('/profile/edit')
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel->update($userId, [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email')
        ]);

        session()->set([
            'user_name' => $this->request->getPost('name'),
            'user_email' => $this->request->getPost('email')
        ]);

        return redirect()
            ->to('/profile')
            ->with('success', 'Profile updated successfully.');
    }
    public function password()
{
    return view('profile/password');
}

public function updatePassword()
{
    $userModel = new UserModel();

    $userId = session()->get('user_id');

    $user = $userModel->find($userId);

    if (!$user) {
        return redirect()
            ->to('/login')
            ->with('error', 'User not found.');
    }

    $rules = [
        'current_password' => 'required',
        'new_password' => 'required|min_length[8]',
        'password_confirm' => 'required|matches[new_password]'
    ];

    if (!$this->validate($rules)) {
        return redirect()
            ->to('/profile/password')
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    if (!password_verify(
        $this->request->getPost('current_password'),
        $user['password']
    )) {
        return redirect()
            ->to('/profile/password')
            ->withInput()
            ->with('error', 'Current password is incorrect.');
    }

    $userModel->update($userId, [
        'password' => password_hash(
            $this->request->getPost('new_password'),
            PASSWORD_DEFAULT
        )
    ]);

    return redirect()
        ->to('/profile')
        ->with('success', 'Password changed successfully.');
}
}