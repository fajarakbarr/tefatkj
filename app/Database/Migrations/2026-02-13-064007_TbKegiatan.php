<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbKegiatan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kegiatan' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_kelompok' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'tanggal' => [
                'type'       => 'DATETIME',
            ],
            'tempat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'jenis_pelayanan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'dokumentasi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'hasil' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_tahun_ajaran' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('id_kegiatan', true);
        $this->forge->addKey('id_kelompok');
        $this->forge->addKey('id_tahun_ajaran');
        $this->forge->createTable('tb_kegiatan');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tb_kegiatan');
    }
}
