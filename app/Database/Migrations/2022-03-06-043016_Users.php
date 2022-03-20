<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration {
    public function up() {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'number' => [
                'type'           => 'INT',
                'constraint'     => 255,
                'unsigned'       => true,
            ],
            'fullname' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'password' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'photo' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'default'       => 'original.jpg'
            ],
            'role' => [
                'type'          => 'ENUM',
                'constraint'    => array('admin','general'),
                'default'       => "general",
                'null'          => true,
            ],
            'created_at' => [
                'type'          => 'DATETIME',
                'null'          => true,
            ],
            'updated_at' => [
                'type'          => 'DATETIME',
                'null'          => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down() {
        $this->forge->dropTable('users');
    }
}
