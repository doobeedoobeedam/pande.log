<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Logs extends Migration
{
    public function up() {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'date' => [
                'type'          => 'DATE',
                'null'          => true,
            ],
            'time' => [
                'type'          => 'TIME',
                'null'          => true,
            ],
            'location' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'temperature' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
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
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('logs');
    }

    public function down() {
        $this->forge->dropTable('logs');
    }
}
