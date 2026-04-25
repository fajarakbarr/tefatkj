<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\KelompokModel;
use App\Models\PenggunaModel;
use App\Models\SiswaModel;
use App\Models\TahunAjaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class AnggotaController extends BaseController
{
    protected $anggotaModel, $kelompokModel, $siswaModel, $penggunaModel, $tahunAjaranModel;

    public function __construct()
    {
        //Do your magic here
        $this->anggotaModel = new AnggotaModel();
        $this->kelompokModel = new KelompokModel();
        $this->siswaModel = new SiswaModel();
        $this->penggunaModel = new PenggunaModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
    }

    public function index()
    {
        $tahun = $this->request->getGet('id_tahun_ajaran');
        $builder = $this->kelompokModel->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran=tb_kelompok.id_tahun_ajaran')->orderBy('tb_kelompok.id_tahun_ajaran', 'DESC')->orderBy('nama_kelompok', 'ASC');

        if (empty($tahun) || $tahun === 'all') {
            $tahun = 'all';
            $kelompok = $builder->findAll();
        } elseif (ctype_digit((string) $tahun)) {
            $kelompok = $builder->where('tb_kelompok.id_tahun_ajaran', $tahun)->findAll();
        } else {
            $kelompok = [];
        }

        $admin = session()->get('id_akses') == 1;
        $guru = session()->get('id_akses') == 2;
        if ($admin || $guru) {
            $data = [
                'kelompok' => $kelompok,
                'tahunAktif' => $tahun,
                'anggotaSidebar' => 'active',
                'tahunAjaran' => $this->tahunAjaranModel->orderBy('tahun_ajaran', 'DESC')->findAll(),
            ];
        } else {
            $data = [
                'kelompok' => '',
                'tahunAktif' => $tahun,
                'anggotaSidebar' => 'active',
                'tahunAjaran' => $this->tahunAjaranModel->orderBy('tahun_ajaran', 'DESC')->findAll(),
            ];
        }

        return view('anggota/index', $data);
    }

    public function kelola($id_kelompok)
    {
        $kelompok = $this->kelompokModel->find($id_kelompok);
        $admin = session()->get('id_akses') == 1;
        $guru = session()->get('id_akses') == 2;
        if ($admin || $guru) {
            $anggota = $this->anggotaModel->where('id_kelompok', $id_kelompok)->first();
            if ($anggota) {
                $data = [
                    'anggotaSidebar' => 'active',
                    'kelompok' => $this->kelompokModel->find($id_kelompok),
                    'ketua' => $this->penggunaModel->join('tb_siswa', 'tb_siswa.nis=tb_pengguna.kode_pengguna')->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran=tb_siswa.id_tahun_ajaran')->where(['id_akses' => 3, 'tb_siswa.id_tahun_ajaran' => $kelompok['id_tahun_ajaran']])->orderBy('tb_siswa.id_tahun_ajaran', 'DESC')->findAll(),
                    'anggota' => $this->penggunaModel->join('tb_siswa', 'tb_siswa.nis=tb_pengguna.kode_pengguna')->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran=tb_siswa.id_tahun_ajaran')->where(['id_akses' => 4, 'tb_siswa.id_tahun_ajaran' => $kelompok['id_tahun_ajaran']])->orderBy('tb_siswa.id_tahun_ajaran', 'DESC')->orderBy('tb_siswa.nama_siswa', 'ASC')->findAll(),
                    'ketuaReal' => $this->anggotaModel->where(['id_akses' => 3, 'id_kelompok' => $id_kelompok])->findAll(),
                    'anggotaReal' => $this->anggotaModel->where(['id_akses' => 4, 'id_kelompok' => $id_kelompok])->findAll()
                ];
                return view('anggota/kelolaupdate', $data);
            }
            $data = [
                'anggotaSidebar' => 'active',
                'kelompok' => $this->kelompokModel->find($id_kelompok),
                'ketua' => $this->penggunaModel->join('tb_siswa', 'tb_siswa.nis=tb_pengguna.kode_pengguna')->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran=tb_siswa.id_tahun_ajaran')->where(['id_akses' => 3, 'tb_siswa.id_tahun_ajaran' => $kelompok['id_tahun_ajaran']])->orderBy('tb_siswa.id_tahun_ajaran', 'DESC')->findAll(),
                'anggota' => $this->penggunaModel->join('tb_siswa', 'tb_siswa.nis=tb_pengguna.kode_pengguna')->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran=tb_siswa.id_tahun_ajaran')->where(['id_akses' => 4, 'tb_siswa.id_tahun_ajaran' => $kelompok['id_tahun_ajaran']])->orderBy('tb_siswa.id_tahun_ajaran', 'DESC')->orderBy('tb_siswa.nama_siswa', 'ASC')->findAll()
            ];
            return view('anggota/kelola', $data);
        }
    }

    public function simpan($id_kelompok)
    {
        $siswa = $this->request->getPost('id_siswa');
        $akses = $this->request->getPost('id_akses');
        $jumlah = count(array_filter($siswa));
        $data = [];
        for ($i = 0; $i < $jumlah; $i++) {
            $data[] = [
                'id_siswa' => $siswa[$i],
                'id_kelompok' => $id_kelompok,
                'id_akses' => $akses[$i]
            ];
        }

        if ($siswa[0] == null) {
            return redirect()->back()->with('error', 'Ketua Masih Kosong, Harap Pilih Ketua Kelompok!');
        }

        $this->anggotaModel->insertBatch($data);
        return redirect()->to('/anggota')->with('berhasil', 'Berhasil Menambah Data Anggota');
    }

    public function update($id_kelompok)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $siswa = $this->request->getPost('id_siswa');
        $akses = $this->request->getPost('id_akses');
        $siswaReal = $this->request->getPost('siswaReal');
        $jumlah = count(array_filter($siswa));
        $data = [];
        for ($i = 0; $i < $jumlah; $i++) {
            $data = [
                'id_anggota' => $siswaReal[$i] ?? null,
                'id_siswa' => $siswa[$i],
                'id_kelompok' => $id_kelompok,
                'id_akses' => $akses[$i]
            ];
            if ($siswa[0] == null) {
                return redirect()->back()->with('error', 'Ketua Masih Kosong, Harap Pilih Ketua Kelompok!');
            }
            $this->anggotaModel->save($data);
        }
        $db->transComplete();
        return redirect()->back()->with('berhasil', 'Berhasil Mengupdate Data Anggota!');
    }
}
