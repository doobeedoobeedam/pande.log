<?php

namespace App\Controllers;

use App\Models\userModel;

class auth extends BaseController
{
    protected $userModel;
    public function __construct() {
        $this->userModel = new userModel();        
    }

    public function signin()
    {
        if(session('number')) {
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
        if(session('number')) {
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
        ], [   // Errors
            'number' => [
                'required' => 'The NIK field is required.',
            ]
        ])) {
            session()->setFlashdata('error', 'Unable to login');
            $validation = \Config\Services::Validation();
            return redirect()->to('auth/signin')->withInput()->with('validation', $validation);
        }

        $fullname = $this->request->getVar('fullname');
        $number = $this->request->getVar('number');
        $array = ['number' => $number, 'fullname' => $fullname];
        $user = $this->userModel->where($array)->first();
        if ($user) {
            $data = [
                'id' => $user['id'],
                'fullname' => $user['fullname'],
                'number' => $user['number'],
                'photo' => $user['photo'],
                'role' => $user['role'],
                'title' => 'Home'
            ];
            session()->set($data);
            return redirect()->to('home');
        } else {
            session()->setFlashdata('error', 'Please check your credentials and try again!');
            return redirect()->to('auth/signin');
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
                'number1' => 'required|trim|is_unique[users.number]|matches[number2]',
                'number2' => 'required|trim|matches[number1]',
                'fullname' => 'required',
            ],
            [   // Errors
                'number1' => [
                    'matches' => 'The NIK field does not match the re-NIK field.',
                    'is_unique' => 'This NIK is already in use by another account. Specify another NIK.',
                    'required' => 'The NIK field is required',
                ],
                'number2' => [
                    'matches' => 'The re-NIK field does not match the NIK field.',
                    'required' => 'The re-NIK field is required',
                ],
            ]
        )) {
            session()->setFlashdata('error', 'Something went wrong');
            $validation = \Config\Services::Validation();
            return redirect()->to('auth/signup')->withInput()->with('validation', $validation);
        }

        $saved = $this->userModel->save([
            'number' => htmlspecialchars($this->request->getVar('number1')),
            'fullname' => htmlspecialchars($this->request->getVar('fullname')),
            'photo' => 'original.jpg',
            'role' => 'general',
        ]);

        if ($saved) {
            session()->setFlashdata('success', 'Thanks for signing up. You can now login your account!');
        } else {
            session()->setFlashdata('error', 'A problem has been occurred while submitting your data');
        }

        return redirect()->to('auth/signin');
    }
}
