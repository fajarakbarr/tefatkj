<?php

namespace App\Controllers;

use App\Models\KegiatanModel;
use App\Models\PenggunaModel;
use App\Models\SiswaModel;
use App\Models\TahunAjaranModel;

class Home extends BaseController
{
    protected $kegiatanModel, $siswaModel, $db, $tahunAjaranModel;


    public function __construct()
    {
        $this->kegiatanModel = new KegiatanModel();
        $this->siswaModel = new SiswaModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('main/dashboard');
    }

    public function ubahPassword($id_pengguna)
    {
        $penggunaModel = new PenggunaModel();
        $data = [
            'password_baru' => password_hash($this->request->getPost('password_baru'), PASSWORD_DEFAULT)
        ];

        $penggunaModel->update($id_pengguna, ['password_pengguna' => $data]);
        return redirect()->to('/')->with('berhasil', 'Berhasil Mengubah Password');
    }

    public function cms()
    {
        $data = [
            'kegiatan' => $this->db->table('tb_kegiatan')->countAll(),
            'siswa' =>  $this->db->table('tb_siswa')->countAll(),
            'portofolio_total' => $this->kegiatanModel->orderBy('id_kegiatan', 'DESC')->findAll(8),
            'tahunAjaran' => $this->tahunAjaranModel->orderBy('tahun_ajaran', 'DESC')->findAll()
        ];

        return view('cms/dashboard', $data);
    }


    public function portofolio()
    {
        $tahun = $this->request->getGet('tahun');
        $builder = $this->kegiatanModel->orderBy('id_kegiatan', 'DESC');

        if (empty($tahun) || $tahun === 'all') {
            $tahun = 'all';
            $portofolio = $builder->findAll(20);
        } elseif (ctype_digit((string) $tahun)) {
            $portofolio = $builder->where('id_tahun_ajaran', $tahun)->findAll(20);
        } else {
            $portofolio = [];
        }

        $data = [
            'portofolio_total' => $portofolio,
            'tahunAjaran' => $this->tahunAjaranModel->orderBy('tahun_ajaran', 'DESC')->findAll(),
            'tahun' => $tahun
        ];

        return view('cms/portofolio', $data);
    }

    public function portofolioByTahun()
    {
        $tahun = $this->request->getPost('portofolio');

        if (empty($tahun) || $tahun === 'all') {
            return redirect()->to('/portofolioDetail');
        }

        if (!ctype_digit((string) $tahun)) {
            return redirect()->to('/portofolioDetail?tahun=invalid');
        }

        return redirect()->to('/portofolioDetail?tahun=' . $tahun);
    }
}
