<?php 

namespace App\Controllers;
use Dompdf\Dompdf;
use App\Models\LogModel;
use App\Models\userModel;

class Pdf extends BaseController { 
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

        return view('templates/pdf_view');
    }

    function general() {
        if(!session('number')) {
            session()->setFlashdata('error', 'Login first!');
            return redirect()->to('/');
        }

        $data = [
            'logs' => $this->logModel->getLogForGeneral(session()->id, 0),
            'filename' => 'Logs Report_'. session()->fullname,
            'user_session' => $this->userModel->where(['id' => session()->id])->first()
        ];

        $dompdf = new Dompdf(); 

        $dompdf->loadHtml(
            view('templates/pdf_view', $data)
        );
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        ob_clean();
        $dompdf->stream($data['filename'], array("Attachment" => false));
        exit();
    }

    public function admin() {
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
            'logs' => $this->logModel->PDFForAdmin(),
            'filename' => 'Logs Report',
            'user_session' => $this->userModel->where(['id' => session()->id])->first()
        ];

        $dompdf = new Dompdf(); 

        $dompdf->loadHtml(
            view('templates/pdf_admin', $data)
        );
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        ob_clean();
        $dompdf->stream($data['filename'], array("Attachment" => false));
        exit();
    }
}