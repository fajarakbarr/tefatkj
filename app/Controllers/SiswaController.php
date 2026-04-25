<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;
use App\Models\SiswaModel;
use App\Models\TahunAjaranModel;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

use function PHPUnit\Framework\returnSelf;

class SiswaController extends BaseController
{
    protected $siswaModel, $penggunaModel, $tahunAjaranModel;

    public function __construct()
    {
        //Do your magic here
        $this->siswaModel = new SiswaModel();
        $this->penggunaModel = new PenggunaModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
    }


    public function index()
    {
        $tahun = $this->request->getGet('id_tahun_ajaran');
        $builder = $this->siswaModel->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran=tb_siswa.id_tahun_ajaran')->orderBy('tb_siswa.id_tahun_ajaran', 'DESC');

        if (empty($tahun) || $tahun === 'all') {
            $tahun = 'all';
            $siswa = $builder->findAll();
        } elseif (ctype_digit((string) $tahun)) {
            $siswa = $builder->where('tb_siswa.id_tahun_ajaran', $tahun)->findAll();
        } else {
            $siswa = [];
        }

        $data = [
            'siswa' => $siswa,
            'tahunAktif' => $tahun,
            'siswaSidebar' => 'active',
            'tahunAjaran' => $this->tahunAjaranModel->orderBy('tahun_ajaran', 'DESC')->findAll(),
        ];

        return view('siswa/index', $data);
    }

    public function tambah()
    {
        $data = [
            'tahun_ajaran' => $this->tahunAjaranModel->orderBy('tahun_ajaran', 'DESC')->findAll(),
            'siswaSidebar' => 'active'
        ];

        return view('siswa/tambah', $data);
    }

    public function simpan()
    {
        $password = $this->request->getPost('password_siswa');
        if ($password) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $password = '';
        };

        $data = [
            'nis' => $this->request->getPost('nis'),
            'nama_siswa' => $this->request->getPost('nama_siswa'),
            'kelas' => $this->request->getPost('kelas'),
            'password_siswa' => $password,
            'id_tahun_ajaran' => $this->request->getPost('id_tahun_ajaran'),
            'id_akses' => $this->request->getPost('id_akses')
        ];

        $oldPengguna = $this->penggunaModel->where('kode_pengguna', $data['nis'])->first();
        $oldSiswa = $this->siswaModel->where('nis', $data['nis'])->findAll();
        $idTahunAjaranList = array_column($oldSiswa, 'id_tahun_ajaran');
        if (in_array($data['id_tahun_ajaran'], $idTahunAjaranList)) {
            $old = true;
        }

        if ($oldPengguna && $old) {
            # ada data nis di tabel pengguna dengan tahun ajaran yang sama maka
            $rules = [
                'nis' => [
                    'rules'  => 'required|exact_length[5]|is_unique[tb_pengguna.kode_pengguna]',
                    'errors' => [
                        'required' => 'NIS harus diisi!',
                        'exact_length' => 'NIS harus berjumlah 5!',
                        'is_unique' => 'NIS sudah ada!'
                    ],
                ],
                'nama_siswa' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Nama siswa harus diisi!',
                    ],
                ],
                'kelas' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Kelas harus diisi!',
                    ],
                ],
                'password_siswa' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Password harus diisi!',
                    ],
                ],
                'id_tahun_ajaran' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Tahun ajaran harus diisi!',
                    ],
                ],
                'id_akses' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Akses harus diisi!',
                    ],
                ],
            ];
        } else {
            # tidak ada data nis di tabel pengguna maka
            $rules = [
                'nis' => [
                    'rules'  => 'required|exact_length[5]',
                    'errors' => [
                        'required' => 'NIS harus diisi!',
                        'exact_length' => 'NIS harus berjumlah 5!',
                    ],
                ],
                'nama_siswa' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Nama siswa harus diisi!',
                    ],
                ],
                'kelas' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Kelas harus diisi!',
                    ],
                ],
                'password_siswa' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Password harus diisi!',
                    ],
                ],
                'id_tahun_ajaran' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Tahun ajaran harus diisi!',
                    ],
                ],
                'id_akses' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Akses harus diisi!',
                    ],
                ],
            ];
        }

        if (!$this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->siswaModel->insert($data);

        if (!$oldPengguna) {
            $dataPengguna = [
                'kode_pengguna' => $data['nis'],
                'nama_pengguna' => $data['nama_siswa'],
                'password_pengguna' => $data['password_siswa'],
                'id_akses' => $data['id_akses']
            ];
            $this->penggunaModel->insert($dataPengguna);
        }

        return redirect()->to('/siswa')->with('berhasil', 'Berhasil Menambah Data!');
    }

    public function edit($id_siswa)
    {
        $siswa = $this->siswaModel->find($id_siswa);

        $data = [
            'siswaSidebar' => 'active',
            'siswa' => $siswa,
            'tahun_ajaran' => $this->tahunAjaranModel->findAll(),
            'pengguna' => $this->penggunaModel->where('kode_pengguna', $siswa['nis'])->first()
        ];

        return view('siswa/edit', $data);
    }

    public function update($id_siswa)
    {
        $siswa = $this->siswaModel->find($id_siswa);
        $pengguna = $this->penggunaModel->where('kode_pengguna', $siswa['nis'])->first();

        $password = $this->request->getPost('password_siswa');
        if ($password) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $password = $pengguna['password_pengguna'];
        }

        $data = [
            'nis' => $this->request->getPost('nis'),
            'nama_siswa' => $this->request->getPost('nama_siswa'),
            'kelas' => $this->request->getPost('kelas'),
            'password_siswa' => $password,
            'id_tahun_ajaran' => $this->request->getPost('id_tahun_ajaran'),
            'id_akses' => $this->request->getPost('id_akses')
        ];

        if ($siswa['nis'] == $data['nis']) {
            $rules = [
                'nis' => [
                    'rules'  => 'required|exact_length[5]',
                    'errors' => [
                        'required' => 'NIS harus diisi!',
                        'exact_length' => 'NIS harus berjumlah 5!',
                    ],
                ],
                'nama_siswa' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Nama siswa harus diisi!',
                    ],
                ],
                'kelas' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Kelas harus diisi!',
                    ],
                ],
                'id_tahun_ajaran' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Tahun ajaran harus diisi!',
                    ],
                ],
                'id_akses' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Akses harus diisi!',
                    ],
                ],
            ];
        } else {
            $rules = [
                'nis' => [
                    'rules'  => 'required|exact_length[5]|is_unique[tb_pengguna.kode_pengguna]',
                    'errors' => [
                        'required' => 'NIS harus diisi!',
                        'exact_length' => 'NIS harus berjumlah 5!',
                        'is_unique' => 'NIS sudah ada!'
                    ],
                ],
                'nama_siswa' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Nama siswa harus diisi!',
                    ],
                ],
                'kelas' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Kelas harus diisi!',
                    ],
                ],
                'id_tahun_ajaran' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Tahun ajaran harus diisi!',
                    ],
                ],
                'id_akses' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Akses harus diisi!',
                    ],
                ],
            ];
        }

        if (!$this->validateData($data, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->siswaModel->update($id_siswa, $data);

        $dataPengguna = [
            'kode_pengguna' => $data['nis'],
            'nama_pengguna' => $data['nama_siswa'],
            'password_pengguna' => $password,
            'id_akses' => $data['id_akses'],
        ];

        $this->penggunaModel->update($pengguna['id_pengguna'], $dataPengguna);
        return redirect()->to('/siswa')->with('berhasil', 'Berhasil Mengubah Data');
    }

    public function import()
    {
        $validationRule = [
            'excel_file' => [
                'rules' => 'uploaded[excel_file]|ext_in[excel_file,xls,xlsx]|max_size[excel_file,2048]',
                'errors' => [
                    'uploaded' => 'File harus diisi!',
                    'ext_in' => 'File harus berupa excel!',
                    'mas_size' => 'File harus dibawah 2MB!'
                ],
            ],
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('excel_file');

        $spreadsheet = IOFactory::load($file->getTempName());
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        // lakukan perulangan file untuk membuat arraynya
        foreach ($sheetData as $key => $row) {
            if ($key == 0) continue;
            if ($key == 1) continue;
            if ($row == 0) continue;

            // tangkap row[3] untuk mengubah karakter kelas menjadi enum
            $kelas = $row[3];
            if ($kelas == 'TKJ-1') {
                $kelas = 1;
            } else if ($kelas == 'TKJ-2') {
                $kelas = 2;
            } else {
                $kelas = '';
            }

            // tangkap row[4] untuk mengubah karakter tahun menjadi id tahun ajaran
            $tahun_ajaran = $this->tahunAjaranModel->where('tahun_ajaran', $row[4])->first();
            if ($tahun_ajaran) {
                $id_tahun_ajaran = $tahun_ajaran['id_tahun_ajaran'];
            } else {
                $id_tahun_ajaran = '';
            }

            // tangkap row[5] untuk mengubah karakter akses menjadi id akses
            if ($row[5] == 'KETUA') {
                $id_akses = 3;
            } else if ($row[5] == 'ANGGOTA') {
                $id_akses = 4;
            } else {
                $id_akses = '';
            }

            $data = [
                'nis'  => $row[1],
                'nama_siswa' => $row[2],
                'kelas' => $kelas,
                'id_tahun_ajaran' => $id_tahun_ajaran,
                'id_akses' => $id_akses
            ];

            $oldPengguna = $this->penggunaModel->where('kode_pengguna', $data['nis'])->first();
            $oldSiswa = $this->siswaModel->where('nis', $data['nis'])->findAll();
            $idTahunAjaranList = array_column($oldSiswa, 'id_tahun_ajaran');
            if (in_array($data['id_tahun_ajaran'], $idTahunAjaranList)) {
                $old = true;
            }

            if ($oldPengguna && $old) {
                # ada data nis di tabel pengguna dengan tahun ajaran yang sama maka
                $rules = [
                    'nis' => [
                        'rules'  => 'required|exact_length[5]|is_unique[tb_pengguna.kode_pengguna]',
                        'errors' => [
                            'required' => 'Baris nomor NIS harus diisi!',
                            'exact_length' => 'NIS harus berjumlah 5!',
                            'is_unique' => 'NIS sudah ada!'
                        ],
                    ],
                    'nama_siswa' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Nama siswa harus diisi!',
                        ],
                    ],
                    'kelas' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Kelas harus diisi!',
                        ],
                    ],
                    'id_tahun_ajaran' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Tahun ajaran harus diisi!',
                        ],
                    ],
                    'id_akses' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Akses harus diisi!',
                        ],
                    ],
                ];
            } else {
                # tidak ada data nis di tabel pengguna atau ada data tapi beda tahun ajaran maka
                $rules = [
                    'nis' => [
                        'rules'  => 'required|exact_length[5]',
                        'errors' => [
                            'required' => 'NIS harus diisi!',
                            'exact_length' => 'NIS harus berjumlah 5!',
                        ],
                    ],
                    'nama_siswa' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Nama siswa harus diisi!',
                        ],
                    ],
                    'kelas' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Kelas harus diisi!',
                        ],
                    ],
                    'id_tahun_ajaran' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Tahun ajaran harus diisi!',
                        ],
                    ],
                    'id_akses' => [
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'Akses harus diisi!',
                        ],
                    ],
                ];
            }

            // VALIDASI PER BARIS (CI4)
            if (!$this->validateData($data, $rules)) {
                foreach ($this->validator->getErrors() as $error) {
                    $errors = 'Baris ' . ($key - 1) . ' ' . $error;
                }
                return redirect()->back()->withInput()->with('errors', $errors);
            }

            $primaryKeys[] = $row[1];
            $duplikat = array_diff_assoc(
                $primaryKeys,
                array_unique($primaryKeys)
            );

            if (!empty($duplikat)) {
                return redirect()->back()->with(
                    'errors',
                    'Terdapat duplikasi NIS, silahkan cek kembali data anda!'
                );
            }

            // dd($errors);

            // $model->insert($data);
            $dataSiswa[] = [
                'nis' => $data['nis'],
                'nama_siswa' => $data['nama_siswa'],
                'kelas' => $data['kelas'],
                'id_tahun_ajaran' => $data['id_tahun_ajaran'],
            ];

            if (!$oldPengguna) {
                $dataPengguna[] = [
                    'kode_pengguna' => $data['nis'],
                    'nama_pengguna' => $data['nama_siswa'],
                    'password_pengguna' => password_hash($data['nis'], PASSWORD_DEFAULT),
                    'id_akses' => $data['id_akses']
                ];
            }
        }
        $this->siswaModel->insertBatch($dataSiswa);
        if (!$oldPengguna) {
            $this->penggunaModel->insertBatch($dataPengguna);
        }

        return redirect()->to('/siswa')->with('berhasil', 'Berhasil Mengimport Data');
    }
}
