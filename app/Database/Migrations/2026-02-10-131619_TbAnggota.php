<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbAnggota extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_anggota' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_siswa' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_kelompok' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('id_anggota', true);
        $this->forge->addKey('id_siswa');
        $this->forge->addKey('id_kelompok');
        $this->forge->createTable('tb_anggota');
    }

    public function down()
    {
        $this->forge->dropTable('tb_anggota');
    }
}
