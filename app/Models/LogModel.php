<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model {
    protected $table            = 'logs';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'user_id', 'date', 'time', 'location', 'temperature'
    ];
    protected $useTimestamps = true;

    public function getLog($id = false) {
        if ($id == false) {
            return $this->orderBy('date', "DESC")->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }

    public function getLogForGeneral($user_id = false, $limit = 0) {
        if ($user_id !== false) {
            if($limit > 0) {
                return $this->where(['user_id' => $user_id])->orderBy('date', "DESC")->where('MONTHNAME(date)', date("F"))->findAll($limit);
            }
            return $this->where(['user_id' => $user_id])->orderBy('date', "DESC")->findAll();
        }
    }

    public function getLogForAdmin($limit) {
        if($limit > 0) {
            $result = $this->select('*')
            ->join('users', 'users.id = logs.user_id', 'left')
            ->orderBy('date', "DESC")
            ->where('MONTHNAME(date)', date("F"))
            // ->get();
            ->findAll($limit);
            return $result;
        }
        
        return $this->orderBy('date', "DESC")->findAll();
    }

    public function chartForAdmin($year) {
        $result = $this->select('count(id) as total_logs, MONTHNAME(date) as month')
        // ->join('users', 'users.id = logs.user_id', 'left')
        ->groupBy('MONTHNAME(date)')
        ->orderBy('MONTH(date)', 'ASC')
        ->where('YEAR(date)', $year)
        ->get();
        return $result->getResult();
    }

    public function chartForGeneral($user_id, $month) {
        $result = $this->select('count(id) as total_user_logs, DAY(date) as day')
        // ->where('date >= DATE(NOW()) - INTERVAL 7 DAY')
        ->groupBy('DAY(date)')
        ->where('user_id', $user_id)
        ->where('MONTHNAME(date)', $month)
        ->get();
        return $result->getResult();
    }

    public function PDFForAdmin() {
        $result = $this->select('logs.*, users.fullname, users.number')
        ->join('users', 'users.id = logs.user_id', 'left')
        // ->groupBy('MONTHNAME(date)')
        ->orderBy('fullname', 'ASC')
        ->orderBy('date', 'ASC')
        ->get();
        return $result->getResult();
    }
}
