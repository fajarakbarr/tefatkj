<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\PenggunaModel;
use CodeIgniter\HTTP\ResponseInterface;

class GuruController extends BaseController
{
    protected $guruModel, $penggunaModel;

    public function __construct()
    {
        //Do your magic here
        $this->guruModel = new GuruModel();
        $this->penggunaModel = new PenggunaModel();
    }


    public function index()
    {
        $data = [
            'guru' => $this->guruModel->findAll()
        ];

        return view('guru/index', $data);
    }

    public function tambah()
    {
        $data = [
            'guruSidebar' => 'active'
        ];

        return view('guru/tambah', $data);
    }

    public function simpan()
    {
        $password = $this->request->getPost('password_guru');
        if ($password) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $password = '';
        }

        $data = [
            'nik' => $this->request->getPost('nik'),
            'nama_guru' => $this->request->getPost('nama_guru'),
            'password_guru' => $password,
        ];

        $rules = [
            'nik' => [
                'rules'  => 'required|exact_length[16]|is_unique[tb_guru.nik]',
                'errors' => [
                    'required' => 'NIK harus diisi!',
                    'exact_length' => 'NIK harus berjumlah 16!',
                    'is_unique' => 'NIK sudah ada!'
                ],
            ],
            'nama_guru' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi!',
                ],
            ],
            'password_guru' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password harus diisi!',
                ],
            ],
        ];

        if (!$this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->guruModel->insert($data);

        $dataPengguna = [
            'kode_pengguna' => $data['nik'],
            'nama_pengguna' => $data['nama_guru'],
            'password_pengguna' => $data['password_guru'],
            'id_akses' => 2,
        ];
        $this->penggunaModel->insert($dataPengguna);
        return redirect()->to('/guru')->with('berhasil', 'Berhasil Menambahkan Data');
    }

    public function edit($id_guru)
    {
        $guru = $this->guruModel->find($id_guru);
        $pengguna = $this->penggunaModel->where('kode_pengguna', $guru['nik'])->first();
        $data = [
            'guru' => $guru,
            'password_guru' => $pengguna['password_pengguna'],
            'guruSidebar' => 'active'
        ];
        return view('guru/edit', $data);
    }

    public function update($id_guru)
    {
        $guru = $this->guruModel->find($id_guru);
        $nik = $guru['nik'];
        $pengguna = $this->penggunaModel->where('kode_pengguna', $guru['nik'])->first();

        $password = $this->request->getPost('password_guru');
        if ($password) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $password = $pengguna['password_pengguna'];
        }

        $data = [
            'nik' => $this->request->getPost('nik'),
            'nama_guru' => $this->request->getPost('nama_guru'),
        ];

        if ($nik == $data['nik']) {
            $rules = [
                'nik' => [
                    'rules'  => 'required|exact_length[16]',
                    'errors' => [
                        'required' => 'NIK harus diisi!',
                        'exact_length' => 'NIK harus berjumlah 16!',
                    ],
                ],
                'nama_guru' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi!',
                    ],
                ],
            ];
        } else {
            $rules = [
                'nik' => [
                    'rules'  => 'required|exact_length[16]|is_unique[tb_guru.nik]',
                    'errors' => [
                        'required' => 'NIK harus diisi!',
                        'exact_length' => 'NIK harus berjumlah 16!',
                        'is_unique' => 'NIK sudah ada!'
                    ],
                ],
                'nama_guru' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi!',
                    ],
                ],
            ];
        }

        if (!$this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->guruModel->update($id_guru, $data);

        $dataPengguna = [
            'kode_pengguna' => $data['nik'],
            'nama_pengguna' => $data['nama_guru'],
            'password_pengguna' => $password
        ];

        $this->penggunaModel->update($pengguna['id_pengguna'], $dataPengguna);

        return redirect()->to('/guru')->with('berhasil', 'Berhasil Mengubah Data');
    }

    // public function hapus($id_guru)
    // {
    //     $guru = $this->guruModel->find($id_guru);
    //     $pengguna = $this->penggunaModel->where('kode_pengguna', $guru['nik'])->first();

    //     $this->penggunaModel->delete($pengguna['id_pengguna']);
    //     $this->guruModel->delete($id_guru);

    //     return redirect()->back()->with('berhasil', 'Berhasil Menghapus Pesan');
    // }
}
