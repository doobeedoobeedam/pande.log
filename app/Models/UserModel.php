<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'number', 'fullname', 'password', 'photo', 'role',
    ];

    protected $useTimestamps = true;

    public function getUser($id = false) {
        if($id == false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}