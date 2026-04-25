<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\KegiatanModel;
use App\Models\KelompokModel;
use App\Models\TahunAjaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class KelompokController extends BaseController
{
    protected $kelompokModel, $tahunAjaranModel, $kegiatanModel, $anggotaModel;


    public function __construct()
    {
        //Do your magic here
        $this->kelompokModel = new KelompokModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
        $this->anggotaModel = new AnggotaModel();
        $this->kegiatanModel = new KegiatanModel();
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
                'kelompokSidebar' => 'active',
                'tahunAktif' => $tahun,
                'tahunAjaran' => $this->tahunAjaranModel->orderBy('tahun_ajaran', 'DESC')->findAll(),
            ];
        } else {
            $data = [
                'kelompok' => '',
                'kelompokSidebar' => 'active',
                'tahunAktif' => $tahun,
                'tahunAjaran' => $this->tahunAjaranModel->orderBy('tahun_ajaran', 'DESC')->findAll(),
            ];
        }

        return view('kelompok/index', $data);
    }

    public function tambah()
    {
        $admin = session()->get('id_akses') == 1;
        $guru = session()->get('id_akses') == 2;
        if ($admin || $guru) {
            $data = [
                'kelompokSidebar' => 'active',
                'tahun_ajaran' => $this->tahunAjaranModel->orderBy('tahun_ajaran', 'DESC')->findAll()
            ];
        } else {
            $data = [
                'kelompokSidebar' => 'active',
                'tahun_ajaran' => ''
            ];
        }

        return view('kelompok/tambah', $data);
    }

    public function simpan()
    {
        $data = [
            'nama_kelompok' => $this->request->getPost('nama_kelompok'),
            'id_tahun_ajaran' => $this->request->getPost('id_tahun_ajaran'),
        ];

        $rules = [
            'nama_kelompok' => [
                'rules'  => 'required|max_length[11]',
                'errors' => [
                    'required' => 'Nama Kelompok Harus Diisi!',
                    'max_length' => 'Nama Kelompok Maximal Berjumlah 11'
                ],
            ],
            'id_tahun_ajaran' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tahun Ajaran Harus Diisi!',
                ],
            ],
        ];

        if (!$this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $oldData = $this->kelompokModel->where(['nama_kelompok' => $data['nama_kelompok'], 'id_tahun_ajaran' => $data['id_tahun_ajaran']])->first();
        if ($oldData) {
            return redirect()->back()->withInput()->with('error', 'Sudah ada data yang sama pada tahun ajaran tersebut');
        }

        $this->kelompokModel->insert($data);
        return redirect()->to('/kelompok')->with('berhasil', 'Berhasil Menambahkan Data');
    }

    public function edit($id_kelompok)
    {
        $admin = session()->get('id_akses') == 1;
        $guru = session()->get('id_akses') == 2;
        if ($admin || $guru) {
            $data = [
                'kelompokSidebar' => 'active',
                'kelompok' => $this->kelompokModel->find($id_kelompok),
                'tahun_ajaran' => $this->tahunAjaranModel->orderBy('tahun_ajaran', 'DESC')->findAll()
            ];
        } else {
            $data = [
                'kelompokSidebar' => 'active',
                'kelompok' => '',
                'tahun_ajaran' => ''
            ];
        }
        return view('kelompok/edit', $data);
    }

    public function update($id_kelompok)
    {
        $data = [
            'nama_kelompok' => $this->request->getPost('nama_kelompok'),
            'id_tahun_ajaran' => $this->request->getPost('id_tahun_ajaran'),
        ];

        $rules = [
            'nama_kelompok' => [
                'rules'  => 'required|max_length[11]',
                'errors' => [
                    'required' => 'Nama Kelompok Harus Diisi!',
                    'max_length' => 'Nama Kelompok Maximal Berjumlah 11'
                ],
            ],
            'id_tahun_ajaran' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tahun Ajaran Harus Diisi!',
                ],
            ],
        ];

        if (!$this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $oldData = $this->kelompokModel->where(['nama_kelompok' => $data['nama_kelompok'], 'id_tahun_ajaran' => $data['id_tahun_ajaran']])->first();
        if ($oldData) {
            return redirect()->back()->withInput()->with('error', 'Sudah ada data yang sama pada tahun ajaran tersebut');
        }

        $this->kelompokModel->update($id_kelompok, $data);
        return redirect()->to('/kelompok')->with('berhasil', 'Berhasil Mengubah Data');
    }

    public function hapus($id_kelompok)
    {
        // validasi anggota
        $anggota = $this->anggotaModel->where('id_kelompok', $id_kelompok)->first();
        if ($anggota == true) {
            return redirect()->back()->with('gagal', 'Terdapat Data Aggota Yang Menggunakan Data Kelompok Ini!');
        }
        // validasi kegiatan
        $kegiatan = $this->kegiatanModel->where('id_kelompok', $id_kelompok)->first();
        if ($kegiatan == true) {
            return redirect()->back()->with('gagal', 'Terdapat Data Kegiatan Yang Menggunakan Data Kelompok Ini!');
        }

        $this->kelompokModel->delete($id_kelompok);
        return redirect()->back()->with('berhasil', 'Berhasil Menghapus Data');
    }
}
