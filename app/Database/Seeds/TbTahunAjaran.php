<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TbTahunAjaran extends Seeder
{
    public function run()
    {
        $data = [
            'tahun_ajaran' => '2024/2025'
        ];

        $this->db->table('tb_tahun_ajaran')->insertBatch($data);
    }
}
