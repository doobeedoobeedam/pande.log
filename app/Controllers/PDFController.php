<?php 

namespace App\Controllers;
use Dompdf\Dompdf;
use App\Models\LogModel;

class PdfController extends BaseController { 
    protected $logModel, $userModel;
    public function __construct() {        
        $this->logModel = new LogModel();
        // $this->userModel = new userModel();  

        if(!session('number')) {
            session()->setFlashdata('error', 'Login first!');
            return redirect()->to('/');
        }
    }

    public function index() {
        return view('templates/pdf_view');
    }

    function htmlToPDF() {
        $data = [
            'logs' => $this->logModel->getLogForGeneral(session()->id, 0),
            'filename' => 'Laporan Logs'
        ];

        $dompdf = new Dompdf(); 

        $dompdf->loadHtml(
            view('templates/pdf_view', $data)
        );
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($data['filename'], array("Attachment" => false));

    }
}