<?php

namespace App\Controllers;

use App\Models\UserModel;

class auth extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function signin()
    {
        if (session('number')) {
            session()->setFlashdata('error', 'Anda sudah login!');
            return redirect()->to('home');
        }

        $data = [
            'title' => 'Sign In',
            'validation' => \Config\Services::Validation(),
        ];
        return view('auth/signin', $data);
    }

    public function signup()
    {
        if (session('number')) {
            session()->setFlashdata('error', 'Anda sudah login!');
            return redirect()->to('home');
        }

        $data = [
            'title' => 'Sign Up',
            'validation' => \Config\Services::Validation(),
        ];
        return view('auth/signup', $data);
    }

    public function login()
    {
        if (!$this->validate([
            'number' => 'required|trim',
            'fullname' => 'required',
            'password' => 'required',
        ], [   // Errors
            'number' => [
                'required' => 'The NIK field is required.',
            ]
        ])) {
            session()->setFlashdata('error', 'Unable to login');
            $validation = \Config\Services::Validation();
            return redirect()->to('auth/signin')->withInput()->with('validation', $validation);
        }

        $number = $this->request->getVar('number');
        $fullname = $this->request->getVar('fullname');
        $password = $this->request->getVar('password');
        $array = ['number' => $number, 'fullname' => $fullname];
        $user = $this->userModel->where($array)->first();

        // jika usernya ada
        if ($user) {
            // cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'id' => $user['id'],
                    'number' => $user['number'],
                    'fullname' => $user['fullname'],
                    'photo' => $user['photo'],
                    'role' => $user['role'],
                    'title' => 'Home'
                ];
                session()->set($data);
                return redirect()->to('home');
            } else {
                session()->setFlashdata('error', 'Wrong password!');
                $validation = \Config\Services::Validation();
                return redirect()->to('auth/signin')->withInput()->with('validation', $validation);
            }
        } else {
            session()->setFlashdata('error', 'Please check your credentials and try again!');
            $validation = \Config\Services::Validation();
            return redirect()->to('auth/signin')->withInput()->with('validation', $validation);
        }
    }

    public function logout()
    {
        $dataSession = ['number', 'role'];
        // session()->remove($dataSession);
        session()->destroy();
        session()->setFlashdata('success', 'You have been logout!');
        return redirect()->to('auth/signin');
    }

    public function registration()
    {
        if (!$this->validate(
            [
                'number' => 'required|trim|is_unique[users.number]|min_length[16]',
                'fullname' => 'required',
                'password1' => 'required|trim|matches[password2]|min_length[6]',
                'password2' => 'required|trim|matches[password1]',
            ],
            [   // Errors
                'number' => [
                    'required' => 'The NIK field is required.',
                    'is_unique' => 'A user with the same NIK already exists. Specify another NIK.',
                    'min_length' => 'The NIK field must be at least 16 characters in length.'
                ],
                'password1' => [
                    'matches' => 'The password field does not match the re-password field.',
                    'required' => 'The password field is required',
                    'min_length' => 'The password field must be at least 6 characters in length.'
                ],
                'password2' => [
                    'matches' => 'The re-password field does not match the password field.',
                    'required' => 'The re-password field is required',
                ],
            ]
        )) {
            session()->setFlashdata('error', 'Something went wrong');
            $validation = \Config\Services::Validation();
            return redirect()->to('auth/signup')->withInput()->with('validation', $validation);
        }

        $saved = $this->userModel->save([
            'number' => htmlspecialchars($this->request->getVar('number')),
            'fullname' => htmlspecialchars($this->request->getVar('fullname')),
            'password' => password_hash($this->request->getVar('password1'), PASSWORD_DEFAULT),
            'photo' => 'original.jpg',
            'role' => 'general',
        ]);

        $number = htmlspecialchars($this->request->getVar('number'));
        $fullname = htmlspecialchars($this->request->getVar('fullname'));

        helper("filesystem");
        $file_content = "$number - $fullname".PHP_EOL;

        // Type#1 - This file will be created inside /public folder
        write_file("config.txt", $file_content, 'a');

        if ($saved) {
            session()->setFlashdata('success', 'Thanks for signing up. You can now login your account!');
        } else {
            session()->setFlashdata('error', 'A problem has been occurred while submitting your data');
        }

        return redirect()->to('auth/signin');
    }
}
