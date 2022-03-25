<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\LogModel;

class Home extends BaseController {
    protected $userModel, $logModel;
    public function __construct() {        
        $this->userModel = new UserModel();  
        $this->logModel = new LogModel();
    }
    
    public function index() {
        $data = [
            'title' => 'Home',
            'request' => \Config\Services::request(),
            'user_session' => $this->userModel->where(['id' => session()->id])->first(),
            'admin_log' => $this->logModel->getLogForAdmin(6),
            'user_log' => $this->logModel->getLogForGeneral(session()->id, 6),
            'chartAdmin' => $this->logModel->chartForAdmin(date("Y")),
            'chartGeneral' => $this->logModel->chartForGeneral(session()->id, date("F")),
        ];

        // dd(session()->id);
        return view('templates/home', $data);
    }
}
