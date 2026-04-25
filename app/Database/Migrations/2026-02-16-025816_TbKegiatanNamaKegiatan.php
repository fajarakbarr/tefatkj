<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbKegiatanNamaKegiatan extends Migration
{
    public function up()
    {
        //
        $fields = [
            'nama_kegiatan' => [
                'type'        => 'VARCHAR',
                'constraint'  => 100,
                'after'       => 'id_kegiatan'
            ]
        ];
        $this->forge->addColumn('tb_kegiatan', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_kegiatan', 'nama_kegiatan');
    }
}
