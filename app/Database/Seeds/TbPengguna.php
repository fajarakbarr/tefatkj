<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TbPengguna extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_pengguna' => '1234512345123456',
                'nama_pengguna' => 'admin',
                'password_pengguna' => password_hash('1234512345123456', PASSWORD_DEFAULT),
                'id_akses' => 1,
                'status_pengguna' => 1,
            ]
        ];

        // Using Query Builder
        $this->db->table('tb_pengguna')->insertBatch($data);
    }
}
