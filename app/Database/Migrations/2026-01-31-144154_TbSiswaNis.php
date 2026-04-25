<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbSiswaNis extends Migration
{
    public function up()
    {
        $fields = [
            'nis' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'after'      => 'id_siswa' // Posisi setelah field tertentu
            ],
        ];
        $this->forge->addColumn('tb_siswa', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_siswa', 'nis');
    }
}
