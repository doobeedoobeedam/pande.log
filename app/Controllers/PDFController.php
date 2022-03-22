<?php 

namespace App\Controllers;
use Dompdf\Dompdf;
use App\Models\LogModel;
use App\Models\userModel;

class PdfController extends BaseController { 
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
        return view('templates/pdf_view');
    }

    function htmlToPDF() {
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
        $dompdf->stream($data['filename'], array("Attachment" => false));
    }

    public function PDFForAdmin() {
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
        $dompdf->stream($data['filename'], array("Attachment" => false));
    }
}