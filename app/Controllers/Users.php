<?php

namespace App\Controllers;
use App\Models\userModel;

class users extends BaseController {
    protected $userModel;
    public function __construct() {        
        $this->userModel = new userModel();

        if(!session('number')) {
            session()->setFlashdata('error', 'Login first!');
            return redirect()->to('/');
        }
    }

    public function index() {  
        if(!session('number')) {
            session()->setFlashdata('error', 'Login first!');
            return redirect()->to('/');
        }

        if (session()->get('role') !== "admin") {
            // echo 'Access denied';
            // exit;
            session()->setFlashdata('error', 'Access Denied');
            return redirect()->to('home');
        }

        $data = [
            'title' => 'User',
            'request' => \Config\Services::request(),
            'users' => $this->userModel->getUser(),
            'validation' => \Config\Services::Validation(),
            'user_session' => $this->userModel->where(['id' => session()->id])->first()
        ];
        return view('users/index', $data);
    }

    public function create() {
        if(!session('number')) {
            session()->setFlashdata('error', 'Login first!');
            return redirect()->to('/');
        }

        if (session()->get('role') !== "admin") {
            // echo 'Access denied';
            // exit;
            session()->setFlashdata('error', 'Access Denied');
            return redirect()->to('home');
        }

        $data = [
            'title' => 'User | Create',
            'request' => \Config\Services::request(),
            'validation' => \Config\Services::Validation(),
            'user_session' => $this->userModel->where(['id' => session()->id])->first()
        ];
        return view('users/add', $data);
    }

    public function store() {
        $dataRules = [
            'number' => 'required|trim',
            'fullname' => 'required',
            'photo' => 'max_size[photo,1024]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
            'role' => 'required'
        ];

        if(!$this->validate($dataRules)) {
            session()->setFlashdata('error', 'Something went wrong');
            $validation = \Config\Services::Validation();
            return redirect()->to('users/create')->withInput()->with('validation', $validation);
        }

        $file = $this->request->getFile('photo');

        if($file->getError() == 4) {
            $photoName = 'original.jpg';
        } else {
            // generate name file
            $photoName = $file->getRandomName();
            $file->move('img', $photoName);
        }

        $saved = $this->userModel->save([
            'number' => $this->request->getVar('number'),
            'fullname' => $this->request->getVar('fullname'),
            'photo' => $photoName,
            'role' => $this->request->getVar('role'),
        ]);

        if($saved) {
            session()->setFlashdata('success', 'Everything worked!');
        } else {
            session()->setFlashdata('error', 'A problem has been occurred while submitting data');
        }

        return redirect()->to('users');
    }

    public function edit($id) {
        // $tes = $this->userModel->where(['id' => session()->id])->first();
        // dd($tes['role']);
        
        if(!session('number')) {
            session()->setFlashdata('error', 'Login first!');
            return redirect()->to('/');
        }

        $data = [
            'title' => 'User | Edit',
            'request' => \Config\Services::request(),
            'validation' => \Config\Services::Validation(),
            'user' => $this->userModel->getUser($id),
            'user_session' => $this->userModel->where(['id' => session()->id])->first()
        ];

        return view('users/edit', $data);
    }

    public function update($id) {
        if(!$this->validate([
            'number' => 'required|trim',
            'fullname' => 'required',
            'role' => 'required',
            'photo' => 'max_size[photo,1024]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]'
        ], 
        )) {
            session()->setFlashdata('error', 'Something went wrong');
            $user_session = $this->userModel->where(['id' => session()->id])->first();
            return redirect()->to('users/edit/' . $id)->withInput()->with('user_session', $user_session);
        }

        $file = $this->request->getFile('photo');
        $oldPhotoName = $this->request->getVar('oldPhoto');

        // cek jika gambar tidak berubah
        if($file->getError() == 4) {
            $photoName = $oldPhotoName;
        } else {
            // generate name file
            $photoName = $file->getRandomName();
            $file->move('img', $photoName);
            // hapus photo lama

            if($oldPhotoName != 'original.jpg') {
                unlink('img/' . $oldPhotoName);
            }
        }

        $saved = $this->userModel->save([
            'id' => $id,
            'number' => $this->request->getVar('number'),
            'fullname' => $this->request->getVar('fullname'),
            'photo' => $photoName,
            'role' => $this->request->getVar('role'),
        ]);

        if($saved) {
            session()->setFlashdata('success', 'Changes has beed saved successfully!');
        } else {
            session()->setFlashdata('error', 'A problem has been occurred while changing the user');
        }
        
        if(session()->role == 'general') {
            return redirect()->to('users/detail/' . $id);
        } else {
            return redirect()->to('users');
        }
    }

    public function editPassword($id) {
        if(!session('number')) {
            session()->setFlashdata('error', 'Login first!');
            return redirect()->to('/');
        }

        if(!$this->validate(
            [
                'current-password' => 'required|trim',
                'new-password' => 'required|trim|matches[repeat-password]',
                'repeat-password' => 'required|trim|matches[new-password]',
            ],
            [   // Errors
                'new-password' => [
                    'matches' => 'The password field does not match the repeat-password field.',
                    'required' => 'The new password field is required',
                ],
                'repeat-password' => [
                    'matches' => 'The repeat password field does not match the new password field.',
                    'required' => 'The repeat password field is required',
                ],
            ]
        )) {
            session()->setFlashdata('error', 'Something went wrong');
            $validation = \Config\Services::Validation();
            return redirect()->to('users/edit/' . $id)->withInput()->with('validation', $validation);
        }

        $user = $this->userModel->getUser($id);
        $current = $this->request->getVar('current-password');
        $new = $this->request->getVar('new-password');

        if(!password_verify($current, $user['password'])) {
            session()->setFlashdata('error', 'Wrong password!');
            return redirect()->to('users/edit/' . $id);
        } else {
            if($current == $new) {
                session()->setFlashdata('error', 'New password cannot be the same as current password!');
                return redirect()->to('users/edit/' . $id);
            } else {
                $saved = $this->userModel->save([
                    'id' => $id,
                    'password' => password_hash($new, PASSWORD_DEFAULT),
                ]);
            }
        }

        if ($saved) {
            session()->setFlashdata('success', 'The password has been updated!');
        } else {
            session()->setFlashdata('error', 'A problem has been occurred while submitting your data');
        }

        return redirect()->to('users/edit/' . $id);
    }

    public function detail($id) {
        $data = [
            'title' => 'User',
            'request' => \Config\Services::request(),
            'user_session' => $this->userModel->where(['id' => session()->id])->first(),
            'user' => $this->userModel->getUser($id),
        ];
        return view('templates/profile', $data);
    }

    public function destroy($id) {
        if(!session('number')) {
            session()->setFlashdata('error', 'Login first!');
            return redirect()->to('/');
        }

        if (session()->get('role') !== "admin") {
            // echo 'Access denied';
            // exit;
            session()->setFlashdata('error', 'Access Denied');
            return redirect()->to('home');
        }

        // cari photo by id
        $user = $this->userModel->find($id);

        if($user['photo'] != 'original.jpg') {
            unlink('img/' . $user['photo']);
        }

        $deleted = $this->userModel->delete($id);

        if($deleted) {
            session()->setFlashdata('success', 'User deleted successfully');
        } else {
            session()->setFlashdata('error', 'A problem has been occurred while deleting the user');
        }
        return redirect()->to('users');
    }
}
