<?php

namespace App\Controllers;
use App\Models\LogModel;
use App\Models\userModel;
use \CodeIgniter\Controller;
use \Hermawan\DataTables\DataTable;
use CodeIgniter\HTTP\RequestInterface;

class logs extends BaseController {
    protected $logModel, $userModel;
    public function __construct() {        
        $this->logModel = new LogModel();
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

        $data = [
            'title' => 'Log',
            'request' => \Config\Services::request(),
            'logs' => $this->logModel->getLogForGeneral(session()->id, 0),
            'validation' => \Config\Services::Validation(),
            'user_session' => $this->userModel->where(['id' => session()->id])->first()
        ];
        // var_dump(session()->id); die;
        return view('logs/index', $data);
    }

    public function create() {
        if(!session('number')) {
            session()->setFlashdata('error', 'Login first!');
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Log | Create',
            'request' => \Config\Services::request(),
            'validation' => \Config\Services::Validation(),
            'user_session' => $this->userModel->where(['id' => session()->id])->first()
        ];
        return view('logs/add', $data);
    }

    public function store() {
        if(!$this->validate([
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
            'temperature' => 'required|trim'
        ])) {
            session()->setFlashdata('error', 'Something went wrong');
            $validation = \Config\Services::Validation();
            return redirect()->to('logs/create')->withInput()->with('validation', $validation);
        }

        $saved = $this->logModel->save([
            'user_id' => session()->id,
            'date' => $this->request->getVar('date'),
            'time' => $this->request->getVar('time'),
            'location' => $this->request->getVar('location'),
            'temperature' => $this->request->getVar('temperature'),
        ]);

        if($saved) {
            session()->setFlashdata('success', 'Yay! Everything worked!');
        } else {
            session()->setFlashdata('error', 'A problem has been occurred while submitting your log');
        }

        return redirect()->to('logs');
    }

    public function edit($id) {
        if(!session('number')) {
            session()->setFlashdata('error', 'Login first!');
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Log | Edit',
            'request' => \Config\Services::request(),
            'logs' => $this->logModel->findAll(),
            'validation' => \Config\Services::Validation(),
            'log' => $this->logModel->getLog($id, false),
            'user_session' => $this->userModel->where(['id' => session()->id])->first()
        ];

        return view('logs/edit', $data);
    }

    public function update($id) {
        if(!$this->validate([
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
            'temperature' => 'required|trim'
        ])) {
            session()->setFlashdata('error', 'Something went wrong');
            $validation = \Config\Services::Validation();
            return redirect()->to('logs/edit/' . $id)->withInput()->with('validation', $validation);
        }

        $saved = $this->logModel->save([
            'id' => $id,
            'user_id' => session()->id,
            'date' => $this->request->getVar('date'),
            'time' => $this->request->getVar('time'),
            'location' => $this->request->getVar('location'),
            'temperature' => $this->request->getVar('temperature'),
        ]);

        if($saved) {
            session()->setFlashdata('success', 'Changes has beed saved successfully!');
        } else {
            session()->setFlashdata('error', 'A problem has been occurred while changing the log');
        }

        return redirect()->to('logs');
    }

    public function destroy($id) {
        if(!session('number')) {
            session()->setFlashdata('error', 'Login first!');
            return redirect()->to('/');
        }

        $deleted = $this->logModel->delete($id);
        if($deleted) {
            session()->setFlashdata('success', 'Your log has been deleted successfully');
        } else {
            session()->setFlashdata('error', 'A problem has been occurred while deleting your log');
        }
        return redirect()->to('logs');
    }
}
