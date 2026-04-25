<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AksesModel;
use CodeIgniter\HTTP\ResponseInterface;

class AksesController extends BaseController
{
    private $aksesModel;


    public function __construct()
    {
        //Do your magic here
        $this->aksesModel = new AksesModel();
    }


    public function index()
    {
        $data = [
            'akses' => $this->aksesModel->findAll()
        ];
        return view('akses/index', $data);
    }

    public function tambah()
    {
        $data = [
            'aksesSidebar' => 'active'
        ];

        return view('akses/tambah', $data);
    }

    public function simpan()
    {
        $data = [
            'ket_akses' => $this->request->getPost('ket_akses')
        ];

        $rules = [
            'ket_akses' => [
                'rules'  => 'required|is_unique[tb_akses.ket_akses]',
                'errors' => [
                    'required' => 'Keterangan Harus Diisi!',
                    'is_unique' => 'Keterangan Sudah Ada!'
                ],
            ],
        ];

        if (!$this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->aksesModel->insert($data);
        return redirect()->to('/akses')->with('berhasil', 'Berhasil Menambah Data!');
    }

    public function edit($id_akses)
    {
        $data = [
            'aksesSidebar' => 'active',
            'akses' => $this->aksesModel->find($id_akses)
        ];

        return view('akses/edit', $data);
    }

    public function update($id_akses)
    {
        $data = [
            'ket_akses' => $this->request->getPost('ket_akses')
        ];

        $rules = [
            'ket_akses' => [
                'rules'  => 'required|is_unique[tb_akses.ket_akses]',
                'errors' => [
                    'required' => 'Keterangan Harus Diisi!',
                    'is_unique' => 'Keterangan Sudah Ada!'
                ],
            ],
        ];

        if (!$this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->aksesModel->update($id_akses, $data);
        return redirect()->to('/akses')->with('berhasil', 'Berhasil Mengubah Data!');
    }

    public function toggle($id_akses)
    {
        $akses = $this->aksesModel->find($id_akses);

        $statusBaru = ($akses['status_akses'] == 1) ? 0 : 1;

        $this->aksesModel->update($id_akses, [
            'status_akses' => $statusBaru
        ]);

        return redirect()->to('/akses')->with(
            'berhasil',
            'Status Berhasil Diubah!'
        );
    }
}
