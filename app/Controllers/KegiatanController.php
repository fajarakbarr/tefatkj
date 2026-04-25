<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\KegiatanModel;
use App\Models\KelompokModel;
use App\Models\SiswaModel;
use App\Models\TahunAjaranModel;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Settings;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Psr16Cache;

class KegiatanController extends BaseController
{
    protected $kelompokModel, $tahunAjaranModel, $anggotaModel, $kegiatanModel, $siswaModel;

    public function __construct()
    {
        //Do your magic here
        $this->kelompokModel = new KelompokModel();
        $this->tahunAjaranModel = new TahunAjaranModel();
        $this->anggotaModel = new AnggotaModel();
        $this->kegiatanModel = new KegiatanModel();
        $this->siswaModel = new SiswaModel();
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
                'tahunAjaran' => $this->tahunAjaranModel->orderBy('tahun_ajaran', 'DESC')->findAll(),
                'tahunAktif' => $tahun,
                'kegiatanSidebar' => 'active',
            ];
        } else {
            $siswa = $this->siswaModel->where(['nis' => session()->get('kode_pengguna'), 'id_tahun_ajaran' => session()->get('id_tahun_ajaran')])->first();
            $anggota = $this->anggotaModel->where('id_siswa', $siswa['id_siswa'])->first();
            $data = [
                'kelompok' => $this->kelompokModel->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran=tb_kelompok.id_tahun_ajaran')->where(['tb_kelompok.id_tahun_ajaran' => session()->get('id_tahun_ajaran'), 'id_kelompok' => $anggota['id_kelompok']])->orderBy('tb_kelompok.id_tahun_ajaran', 'DESC')->orderBy('nama_kelompok', 'ASC')->findAll(),
                'kegiatanSidebar' => 'active',
            ];
        }
        return view('kegiatan/index', $data);
    }

    // public function tahun()
    // {
    //     $admin = session()->get('id_akses') == 1;
    //     $guru = session()->get('id_akses') == 2;
    //     $tahun = $this->request->getPost('id_tahun_ajaran');
    //     if ($tahun == 'all') {
    //         return redirect()->to('/kegiatan');
    //     }
    //     if ($admin || $guru) {
    //         $data = [
    //             'kelompok' => $this->kelompokModel->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran=tb_kelompok.id_tahun_ajaran')->where('tb_kelompok.id_tahun_ajaran', $tahun)->orderBy('nama_kelompok', 'ASC')->findAll(),
    //             'tahunAjaran' => $this->tahunAjaranModel->orderBy('tahun_ajaran', 'DESC')->findAll(),
    //             'tahunAktif' => $tahun
    //         ];
    //     } else {
    //         $siswa = $this->siswaModel->where(['nis' => session()->get('kode_pengguna'), 'id_tahun_ajaran' => session()->get('id_tahun_ajaran')])->first();
    //         $anggota = $this->anggotaModel->where('id_siswa', $siswa['id_siswa'])->first();
    //         $data = [
    //             'kelompok' => $this->kelompokModel->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran=tb_kelompok.id_tahun_ajaran')->where(['tb_kelompok.id_tahun_ajaran' => session()->get('id_tahun_ajaran'), 'id_kelompok' => $anggota['id_kelompok']])->orderBy('tb_kelompok.id_tahun_ajaran', 'DESC')->orderBy('nama_kelompok', 'ASC')->findAll()
    //         ];
    //     }
    //     return view('kegiatan/index', $data);
    // }

    public function daftar($id_kelompok)
    {
        $data = [
            'kegiatanSidebar' => 'active',
            'kegiatan' => $this->kegiatanModel->where('id_kelompok', $id_kelompok)->findAll(),
            'kelompok' => $this->kelompokModel->find($id_kelompok)
        ];


        return view('kegiatan/daftar', $data);
    }

    public function tambah($id_kelompok)
    {
        $admin = session()->get('id_akses') == 1;
        $kelompok = $this->kelompokModel->find($id_kelompok);
        if ($admin) {
            $data = [
                'kegiatanSidebar' => 'active',
                'kelompok' => $kelompok,
                'tahun_ajaran' => $this->tahunAjaranModel->where('id_tahun_ajaran', $kelompok['id_tahun_ajaran'])->findAll()
            ];
        } else {
            $data = [
                'kegiatanSidebar' => 'active',
                'kelompok' => $kelompok,
                'tahun_ajaran' => $this->tahunAjaranModel->where('id_tahun_ajaran', $kelompok['id_tahun_ajaran'])->findAll()
            ];
        }

        return view('kegiatan/tambah', $data);
    }

    public function simpan()
    {
        $rules = [
            'dokumentasi' => [
                'rules' => 'uploaded[dokumentasi]|ext_in[dokumentasi,jpg,jpeg,png]|mime_in[dokumentasi,image/png,image/jpeg,image/jpeg]|max_size[dokumentasi,2048]|is_image[dokumentasi]',
                'errors' => [
                    'uploaded' => 'File harus diisi!',
                    'ext_in' => 'File harus berekstensi JPG/JPEG/PNG!',
                    'mime_in' => 'File harus berupa JPG/JPEG/PNG!',
                    'is_image' => 'File harus berupa gambar',
                    'max_size' => 'File harus dibawah 2MB!'
                ],
            ],
            'nama_kegiatan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi!',
                ],
            ],
            'id_kelompok' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kelompok harus diisi!',
                ],
            ],
            'tanggal' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi!',
                ],
            ],
            'tempat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tempat harus diisi!',
                ],
            ],
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi!',
                ],
            ],
            'jenis_pelayanan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jenis pelayanan harus diisi!',
                ],
            ],
            'hasil' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Hasil harus diisi!',
                ],
            ],
            'id_tahun_ajaran' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tahun ajaran harus diisi!',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('dokumentasi');
        $dokumentasi = $file->getRandomName();
        $data = [
            'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
            'id_kelompok' => $this->request->getPost('id_kelompok'),
            'tanggal' => $this->request->getPost('tanggal'),
            'tempat' => $this->request->getPost('tempat'),
            'alamat' => $this->request->getPost('alamat'),
            'jenis_pelayanan' => $this->request->getPost('jenis_pelayanan'),
            'hasil' => $this->request->getPost('hasil'),
            'dokumentasi' => $dokumentasi,
            'id_tahun_ajaran' => $this->request->getPost('id_tahun_ajaran')
        ];

        $this->kegiatanModel->insert($data);
        $file->move('assets/images/dokumentasi', $dokumentasi);

        return redirect()->to('/kegiatan/daftar/' . $data['id_kelompok'])->with('berhasil', 'Berhasil Menambah Data');
    }

    public function edit($id_kegiatan)
    {
        $kegiatan = $this->kegiatanModel->join('tb_kelompok', 'tb_kelompok.id_kelompok=tb_kegiatan.id_kelompok')->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran=tb_kegiatan.id_tahun_ajaran')->find($id_kegiatan);
        $data = [
            'kegiatanSidebar' => 'active',
            'kegiatan' => $kegiatan,
            'tahun_ajaran' => $this->tahunAjaranModel->where('id_tahun_ajaran', $kegiatan['id_tahun_ajaran'])->findAll()
        ];

        return view('kegiatan/edit', $data);
    }

    public function update($id_kegiatan)
    {
        $rules = [
            'dokumentasi' => [
                'rules' => 'ext_in[dokumentasi,jpg,jpeg,png]|mime_in[dokumentasi,image/png,image/jpeg,image/jpeg]|max_size[dokumentasi,2048]|is_image[dokumentasi]',
                'errors' => [
                    'ext_in' => 'File harus berekstensi JPG/JPEG/PNG!',
                    'mime_in' => 'File harus berupa JPG/JPEG/PNG!',
                    'is_image' => 'File harus berupa gambar',
                    'max_size' => 'File harus dibawah 2MB!'
                ],
            ],
            'nama_kegiatan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi!',
                ],
            ],
            'id_kelompok' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kelompok harus diisi!',
                ],
            ],
            'tanggal' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi!',
                ],
            ],
            'tempat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tempat harus diisi!',
                ],
            ],
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi!',
                ],
            ],
            'jenis_pelayanan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jenis pelayanan harus diisi!',
                ],
            ],
            'hasil' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Hasil harus diisi!',
                ],
            ],
            'id_tahun_ajaran' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tahun ajaran harus diisi!',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $old = $this->kegiatanModel->find($id_kegiatan);
        $file = $this->request->getFile('dokumentasi');
        if ($file->getError() == 4) {
            $dokumentasi = $old['dokumentasi'];
        } else {
            $dokumentasi = $file->getRandomName();
        }

        $data = [
            'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
            'id_kelompok' => $this->request->getPost('id_kelompok'),
            'tanggal' => $this->request->getPost('tanggal'),
            'tempat' => $this->request->getPost('tempat'),
            'alamat' => $this->request->getPost('alamat'),
            'jenis_pelayanan' => $this->request->getPost('jenis_pelayanan'),
            'hasil' => $this->request->getPost('hasil'),
            'dokumentasi' => $dokumentasi,
            'id_tahun_ajaran' => $this->request->getPost('id_tahun_ajaran')
        ];

        $this->kegiatanModel->update($id_kegiatan, $data);
        if ($file->getError() != 4) {
            unlink('assets/images/dokumentasi/' . $old['dokumentasi']);
            $file->move('assets/images/dokumentasi', $dokumentasi);
        }

        return redirect()->to('/kegiatan/daftar/' . $data['id_kelompok'])->with('berhasil', 'Berhasil Mengubah Data');
    }

    public function detail($id_kegiatan)
    {
        $kegiatan = $this->kegiatanModel->join('tb_kelompok', 'tb_kelompok.id_kelompok=tb_kegiatan.id_kelompok')->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran=tb_kegiatan.id_tahun_ajaran')->find($id_kegiatan);
        $data = [
            'kegiatanSidebar' => 'active',
            'kegiatan' => $kegiatan,
            'tahun_ajaran' => $this->tahunAjaranModel->where('id_tahun_ajaran', $kegiatan['id_tahun_ajaran'])->findAll()
        ];

        return view('kegiatan/detail', $data);
    }

    public function hapus($id_kegiatan)
    {
        $old = $this->kegiatanModel->find($id_kegiatan);
        unlink('assets/images/dokumentasi/' . $old['dokumentasi']);
        $this->kegiatanModel->delete($id_kegiatan);
        return redirect()->back()->with('berhasil', 'Berhasil Menghapus Data');
    }

    public function export($id_kelompok)
    {
        // ==============================
        // SET CACHE (WAJIB sebelum Spreadsheet)
        // ==============================
        $pool = new FilesystemAdapter(
            'phpspreadsheet',
            0,
            WRITEPATH . 'cache'
        );

        $cache = new Psr16Cache($pool);
        Settings::setCache($cache);

        $data = $this->kegiatanModel->join('tb_kelompok', 'tb_kelompok.id_kelompok=tb_kegiatan.id_kelompok')->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran=tb_kelompok.id_tahun_ajaran')->where('tb_kegiatan.id_kelompok', $id_kelompok)->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Kegiatan');
        $sheet->setCellValue('C1', 'Kelompok');
        $sheet->setCellValue('D1', 'Anggota');
        $sheet->setCellValue('E1', 'Tanggal');
        $sheet->setCellValue('F1', 'Tempat');
        $sheet->setCellValue('G1', 'Jenis Pelayanan');
        $sheet->setCellValue('H1', 'Hasil');
        $sheet->setCellValue('I1', 'Tahun Ajaran');
        $sheet->setCellValue('J1', 'Dokumentasi');
        $sheet->getColumnDimension('J')->setWidth(20);

        $row = 2;
        $no = 1;

        foreach ($data as $d) {
            $anggota = $this->anggotaModel->where('id_kelompok', $d['id_kelompok'])->join('tb_siswa', 'tb_siswa.id_siswa=tb_anggota.id_siswa')->findAll();
            $anggotaList = array_column($anggota, 'nama_siswa');
            $anggotaString = implode("\n", $anggotaList);

            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $d['nama_kegiatan']);
            $sheet->setCellValue('C' . $row, $d['nama_kelompok']);
            $sheet->setCellValue('D' . $row, $anggotaString);
            $sheet->getStyle('D' . $row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue('E' . $row, $d['tanggal']);
            $sheet->setCellValue('F' . $row, $d['tempat']);
            $sheet->setCellValue('G' . $row, $d['jenis_pelayanan']);
            $sheet->setCellValue('H' . $row, $d['hasil']);
            $sheet->setCellValue('I' . $row, $d['tahun_ajaran']);

            $imagePath = 'assets/images/dokumentasi/' . $d['dokumentasi'];
            if (!empty($d['dokumentasi']) && file_exists($imagePath)) {
                $drawing = new Drawing();
                $drawing->setName('dokumentasi');
                $drawing->setDescription('dokumentasi');
                $drawing->setPath($imagePath);
                $drawing->setHeight(80);
                $drawing->setCoordinates('J' . $row);
                $drawing->setOffsetX(5);
                $drawing->setOffsetY(5);
                $drawing->setWorksheet($sheet);

                $sheet->getRowDimension($row)->setRowHeight(60);
            }
            $row++;
        }

        // Set header agar langsung download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data-kegiatan.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
