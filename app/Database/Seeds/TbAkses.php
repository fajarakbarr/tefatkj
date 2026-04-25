<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TbAkses extends Seeder
{
    public function run()
    {
        $data = [
            [
                'ket_akses' => 'guru'
            ],
            [
                'ket_akses' => 'ketua'
            ],
            [
                'ket_akses' => 'anggota'
            ]
        ];

        // Using Query Builder
        $this->db->table('tb_akses')->insertBatch($data);
    }
}
