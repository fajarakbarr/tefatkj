<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KegiatanModel;
use App\Models\KelompokModel;
use App\Models\SiswaModel;
use App\Models\TahunAjaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class TahunAjaranController extends BaseController
{
    private $tahunAjaranModel, $siswaModel, $kelompokModel, $kegiatanModel;


    public function __construct()
    {
        //Do your magic here
        $this->tahunAjaranModel = new TahunAjaranModel();
        $this->siswaModel = new SiswaModel();
        $this->kelompokModel = new KelompokModel();
        $this->kegiatanModel = new KegiatanModel();
    }

    public function index()
    {
        $data = [
            'tahun_ajaran' => $this->tahunAjaranModel->orderBy('tahun_ajaran', 'DESC')->findAll()
        ];

        return view('tahun_ajaran/index', $data);
    }

    public function tambah()
    {
        $data = [
            'tahunAjaranSidebar' => 'active'
        ];

        return view('tahun_ajaran/tambah', $data);
    }

    public function simpan()
    {
        $data = [
            'tahun_ajaran' => $this->request->getPost('tahun_ajaran')
        ];

        $rules = [
            'tahun_ajaran' => [
                'rules'  => 'required|is_unique[tb_tahun_ajaran.tahun_ajaran]|exact_length[9]',
                'errors' => [
                    'required' => 'Tahun Ajaran Harus Diisi!',
                    'is_unique' => 'Tahun Ajaran Sudah Ada!',
                    'exact_length' => 'Tahun Ajaran Harus Berjumlah 9'
                ],
            ],
        ];

        if (!$this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->tahunAjaranModel->insert($data);
        return redirect()->to('/tahunAjaran')->with('berhasil', 'Berhasil Menambah Data!');
    }

    public function edit($id_tahun_ajaran)
    {
        $data = [
            'tahunAjaranSidebar' => 'active',
            'tahun_ajaran' => $this->tahunAjaranModel->find($id_tahun_ajaran)
        ];

        return view('tahun_ajaran/edit', $data);
    }

    public function update($id_tahun_ajaran)
    {
        $data = [
            'tahun_ajaran' => $this->request->getPost('tahun_ajaran')
        ];

        $rules = [
            'tahun_ajaran' => [
                'rules'  => 'required|is_unique[tb_tahun_ajaran.tahun_ajaran]|exact_length[9]',
                'errors' => [
                    'required' => 'Tahun Ajaran Harus Diisi!',
                    'is_unique' => 'Tahun Ajaran Sudah Ada!',
                    'exact_length' => 'Tahun Ajaran Harus Berjumlah 9'
                ],
            ],
        ];

        if (!$this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->tahunAjaranModel->update($id_tahun_ajaran, $data);
        return redirect()->to('/tahunAjaran')->with('berhasil', 'Berhasil Mengubah Data!');
    }

    // public function toggle($id_tahun_ajaran)
    // {
    //     $tahun_ajaran = $this->tahunAjaranModel->find($id_tahun_ajaran);

    //     $statusBaru = ($tahun_ajaran['status_tahun_ajaran'] == 1) ? 0 : 1;

    //     $this->tahunAjaranModel->update($id_tahun_ajaran, [
    //         'status_tahun_ajaran' => $statusBaru
    //     ]);

    //     return redirect()->to('/tahunAjaran')->with(
    //         'berhasil',
    //         'Status Berhasil Diubah!'
    //     );
    // }

    public function hapus($id_tahun_ajaran)
    {
        // validasi pengguna
        $siswa = $this->siswaModel->where('id_tahun_ajaran', $id_tahun_ajaran)->first();
        // validasi kelompok
        $kelompok = $this->kelompokModel->where('id_tahun_ajaran', $id_tahun_ajaran)->first();
        // validasi kegiatan
        $kegiatan = $this->kegiatanModel->where('id_tahun_ajaran', $id_tahun_ajaran)->first();

        if ($siswa == true) {
            return redirect()->back()->with('gagal', 'Terdapat Data Siswa Dengan Tahun Ajaran Ini!');
        };

        if ($kelompok == true) {
            return redirect()->back()->with('gagal', 'Terdapat Data Kelompok Dengan Tahun Ajaran Ini!');
        };

        if ($kegiatan == true) {
            return redirect()->back()->with('gagal', 'Terdapat Data Kegiatan Dengan Tahun Ajaran Ini!');
        };

        $this->tahunAjaranModel->delete($id_tahun_ajaran);
        return redirect()->back()->with(
            'berhasil',
            'Berhasil Menghapus Data'
        );
    }
}
