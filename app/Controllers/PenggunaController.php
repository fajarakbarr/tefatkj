<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AksesModel;
use App\Models\GuruModel;
use App\Models\PenggunaModel;
use App\Models\SiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class PenggunaController extends BaseController
{
    protected $penggunaModel, $aksesModel, $siswaModel, $guruModel;


    public function __construct()
    {
        //Do your magic here
        $this->penggunaModel = new PenggunaModel();
        $this->aksesModel = new AksesModel();
        $this->siswaModel = new SiswaModel();
        $this->guruModel = new GuruModel();
    }


    public function index()
    {
        $data = [
            'pengguna' => $this->penggunaModel->join('tb_akses', 'tb_akses.id_akses=tb_pengguna.id_akses')->orderBy('tb_pengguna.id_akses', 'ASC')->orderBy('tb_pengguna.kode_pengguna', 'ASC')->findAll()
        ];

        return view('pengguna/index', $data);
    }

    public function tambah()
    {
        $data = [
            'penggunaSidebar' => 'active'
        ];

        return view('pengguna/tambah', $data);
    }

    public function simpan()
    {
        // tangkap password
        $password = $this->request->getPost('password_pengguna');
        if ($password) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $password = '';
        }

        $data = [
            'kode_pengguna' => $this->request->getPost('kode_pengguna'),
            'nama_pengguna' => $this->request->getPost('nama_pengguna'),
            'password_pengguna' => $password,
            'id_akses' => 1
        ];

        $rules = [
            'kode_pengguna' => [
                'rules'  => 'required|is_unique[tb_pengguna.kode_pengguna]|exact_length[16]',
                'errors' => [
                    'required' => 'Kode Pengguna Harus Diisi!',
                    'is_unique' => 'Kode Pengguna Sudah Ada!',
                    'exact_length' => 'Kode Pengguna Harus Berjumlah 16'
                ],
            ],
            'nama_pengguna' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama Pengguna Harus Diisi!',
                ],
            ],
            'password_pengguna' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password Pengguna Harus Diisi!',
                ],
            ],
        ];

        if (!$this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->penggunaModel->insert($data);
        return redirect()->to('/pengguna')->with('berhasil', 'Berhasil Menambah Data');
    }

    public function edit($id_pengguna)
    {
        $data = [
            'pengguna' => $this->penggunaModel->find($id_pengguna),
            'penggunaSidebar' => 'active'
        ];

        return view('pengguna/edit', $data);
    }

    public function update($id_pengguna)
    {
        // ambil data lama
        $oldData = $this->penggunaModel->find($id_pengguna);
        // tangkap password
        $password = $this->request->getPost('password_pengguna');
        if ($password) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $password = $oldData['password_pengguna'];
        }

        $data = [
            'kode_pengguna' => $this->request->getPost('kode_pengguna'),
            'nama_pengguna' => $this->request->getPost('nama_pengguna'),
            'password_pengguna' => $password,
            'id_akses' => 1
        ];

        if ($data['kode_pengguna'] == $oldData['kode_pengguna']) {
            $rules = [
                'kode_pengguna' => [
                    'rules'  => 'required|exact_length[16]',
                    'errors' => [
                        'required' => 'Kode Pengguna Harus Diisi!',
                        'exact_length' => 'Kode Pengguna Harus Berjumlah 16'
                    ],
                ],
                'nama_pengguna' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Nama Pengguna Harus Diisi!',
                    ],
                ],
                'password_pengguna' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Password Pengguna Harus Diisi!',
                    ],
                ],
            ];
        } else {
            $rules = [
                'kode_pengguna' => [
                    'rules'  => 'required|is_unique[tb_pengguna.kode_pengguna]|exact_length[16]',
                    'errors' => [
                        'required' => 'Kode Pengguna Harus Diisi!',
                        'is_unique' => 'Kode Pengguna Sudah Ada!',
                        'exact_length' => 'Kode Pengguna Harus Berjumlah 16'
                    ],
                ],
                'nama_pengguna' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Nama Pengguna Harus Diisi!',
                    ],
                ],
                'password_pengguna' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Password Pengguna Harus Diisi!',
                    ],
                ],
            ];
        }

        if (!$this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->penggunaModel->update($id_pengguna, $data);
        return redirect()->to('/pengguna')->with('berhasil', 'Berhasil Mengubah Data');
    }

    public function toggle($id_pengguna)
    {
        $oldData = $this->penggunaModel->find($id_pengguna);
        $statusBaru = ($oldData['status_pengguna'] == 1) ? 0 : 1;

        $this->penggunaModel->update($id_pengguna, [
            'status_pengguna' => $statusBaru
        ]);

        return redirect()->back()->with('berhasil', 'Berhasil Mengubah Status Data');
    }

    public function deleteMultiple()
    {
        $ids = $this->request->getVar('pengguna');

        foreach ($ids as $item) {
            $id = $item['id_pengguna'];
            $this->penggunaModel->delete($id);
        }

        return $this->response->setJSON([
            'status' => true,
            'csrfHash' => csrf_hash()
        ]);
    }

    public function statusMultiple()
    {
        $ids = $this->request->getVar('pengguna');

        foreach ($ids as $item) {
            $id = $item['id_pengguna']; // ✅ ambil id nya

            $oldData = $this->penggunaModel->find($id);

            if (!$oldData) continue; // optional, biar aman

            $statusBaru = ($oldData['status_pengguna'] == 1) ? 0 : 1;

            $this->penggunaModel->update($id, [
                'status_pengguna' => $statusBaru
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'csrfHash' => csrf_hash()
        ]);
    }

    public function hapus($id_pengguna)
    {
        $this->penggunaModel->delete($id_pengguna);
        return redirect()->back()->with('berhasil', 'Berhasil Menghapus Data');
    }
}
