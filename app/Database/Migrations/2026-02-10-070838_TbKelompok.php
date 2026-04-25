<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbKelompok extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kelompok' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kelompok' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_tahun_ajaran' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('id_kelompok', true);
        $this->forge->addKey('id_tahun_ajaran');
        $this->forge->createTable('tb_kelompok');
    }

    public function down()
    {
        $this->forge->dropTable('tb_kelompok');
    }
}
