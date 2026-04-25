<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AksesModel;
use App\Models\PenggunaModel;
use App\Models\TahunAjaranModel;
use CodeIgniter\HTTP\ResponseInterface;

use function PHPUnit\Framework\returnSelf;

class AuthController extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $penggunaModel = new PenggunaModel();
        $tahunAjaranModel = new TahunAjaranModel();

        if ($this->request->getMethod() == 'POST') {
            $kode =  $this->request->getPost('kode_pengguna');
            $kode_pengguna = htmlspecialchars($kode);
            $password = $this->request->getPost('password_pengguna');
            $password_pengguna = htmlspecialchars($password);

            $tahunAjaran = $tahunAjaranModel->orderBy('id_tahun_ajaran', 'DESC')->first();

            // cek apakah ada pengguna
            $pengguna = $penggunaModel->join('tb_akses', 'tb_akses.id_akses=tb_pengguna.id_akses')->where('kode_pengguna', $kode_pengguna)->first();

            // cek password pengguna
            if ($pengguna && password_verify($password_pengguna, $pengguna['password_pengguna'])) {
                // cek status pengguna
                if ($pengguna['status_pengguna'] == 0) {
                    return redirect()->to('/auth')->with('gagal', 'Pengguna Sudah Tidak Aktif!');
                }

                session()->set([
                    'id_pengguna' => $pengguna['id_pengguna'],
                    'kode_pengguna' => $pengguna['kode_pengguna'],
                    'nama_pengguna' => $pengguna['nama_pengguna'],
                    'id_akses' => $pengguna['id_akses'],
                    'akses' => $pengguna['ket_akses'],
                    'id_tahun_ajaran' => $tahunAjaran['id_tahun_ajaran'],
                    'isLoggedIn' => true
                ]);

                $cache = \Config\Services::cache();
                $cache->delete('login_attempt_' . md5($this->request->getIPAddress()));
                return redirect()->to('/index');
            }

            return redirect()->to('/auth')->with('gagal', 'Kode User Atau Password Salah!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth');
    }
}
