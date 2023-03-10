<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class Absensi extends BaseController
{
    public function index()
    {
        $data = [
            'isi'   => 'admin/absensi/v_list',
            'tg_awal' => '',
            'tg_akhir' => '',
            'title' => 'DAFTAR KEHADIRAN MENGAJAR DOSEN',
            'dosens'    => $this->ModelUser->getDosen(),
            'validation'    => $this->validation,
        ];
        $data['dos']['id_user'] = '';
        // dd($this->ModelAbsensi->get_dari_tanggal());

        $data['tg_akhir'] = isset($_GET['tg_akhir']) ? $_GET['tg_akhir'] : '';
        if (isset($_GET['tg_akhir'])) {
            $data['tg_akhir'] = $_GET['tg_akhir'];
            $data['tg_awal'] = $_GET['tg_awal'];
            if (isset($_GET['dosen_id'])) {
                $data['dosen_id'] = $_GET['dosen_id'];
                $data['dos'] = $this->db->query("SELECT * FROM `user` WHERE id_user = " . $data['dosen_id'] . "")->getRowArray();
                $data['absensi'] = $this->ModelAbsensi->get_rekap_per_dosen($data['tg_awal'], $data['tg_akhir'], $data['dosen_id']);
            } else {
                $data['absensi'] = $this->ModelAbsensi->get_dari_tanggal($data['tg_awal'], $data['tg_akhir']);
            }
            // $data['absensi'] = $this->ModelAbsensi->get_dari_tanggal($data['tg_awal'], $data['tg_akhir']);
            // dd($this->ModelAbsensi->get_dari_tanggal($data['tg_awal'], $tg_akhir));
        } else {
            $data['absensi'] = $this->ModelAbsensi->getAbsensi();
        }

        return view('layout/v_wrapper', $data);
    }

    public function simpan()
    {
        $validation  = $this->validate([
            'bukti'         => [
                'rules'     => 'uploaded[bukti]|max_size[bukti,10000]|mime_in[bukti,image/jpg,image/jpeg,image/gif,image/png,application/pdf]',
                'errors' => [
                    'uploaded'  => 'Pilih file terlebih dulu',
                    'mime_in'   => 'format file tidak sesuai',
                    'max_size'  => 'Ukuran gambar maximal 5 MB'
                ]
            ]
        ]);

        if (!$validation) {
            $fileBukti = $this->request->getFile('bukti');
            // dd($this->validate('uploaded'));
            return redirect()->to(base_url('Dosen/Absensi/add/' . session()->get('id_user')))->withInput()->with('validation', $validation);
        } else {
            $file_string = $this->request->getVar('signed');
            $image = explode(";base64,", $file_string);
            $image_type = explode("image/", $image[0]);
            $image_type_png = $image_type[1];
            $image_base64 = base64_decode($image[1]);

            $folderPath = ROOTPATH . 'assets/uploads/ttd_admin/';
            $file_ttd = uniqid();
            $file = $folderPath . $file_ttd . '.' . $image_type_png;
            $session = session();
            file_put_contents($file, $image_base64);

            // file bukti
            $fileBukti = $this->request->getFile('bukti');
            $fileBukti->move('assets/uploads/bukti_mengajar/');
            // Ambil nama file
            $namaBukti = $fileBukti->getName();

            $data = [
                'admin_id' => session()->get('id_user'),
                'ta_id' => $this->request->getPost('ta_id'),
                'semester' => $this->request->getPost('semester'),
                'makul_id' => $this->request->getPost('makul_id'),
                'kelas_id' => $this->request->getPost('kelas_id'),
                'tanggal' => $this->request->getPost('tanggal'),
                'waktu_selesai' => $this->request->getPost('waktu_selesai'),
                'admin_nama' => $this->request->getPost('admin_nama'),
                'laboran' => $this->request->getPost('laboran'),
                'mhs_pembantu' => $this->request->getPost('mhs_pembantu'),
                'topik' => $this->request->getPost('topik'),
                'metode' => $this->request->getPost('metode'),
                'bukti' => $namaBukti,
                'ttd' => $file_ttd . ".png",
            ];

            // dd($data);
            $this->ModelAbsensi->tambah($data);
            set_notifikasi_swal('success', 'Berhasil', 'Pendaftaran Berhasil!');
            return redirect()->to(base_url('Dosen/Dashboard'));
        }
    }

    public function delete($id_absensi)
    {
        $absensi = $this->db->table('absensi')->where('id_absensi', $id_absensi)->get()->getRowArray();
        // dd($absensi['bukti']);
        if (file_exists('./assets/uploads/ttd_dosen/' . $absensi['ttd'])) {
            unlink('./assets/uploads/ttd_dosen/' . $absensi['ttd']);
        }
        if (file_exists('./assets/uploads/bukti_mengajar/' . $absensi['bukti'])) {
            unlink('./assets/uploads/bukti_mengajar/' . $absensi['bukti']);
        }

        $this->ModelAbsensi->hapus($id_absensi);
        set_notifikasi_swal('success', 'Berhasil', 'Absensi telah dihapus!');
        return redirect()->to(base_url('Admin/Absensi'));
    }

    public function export_excel($tg_awal = false, $tg_akhir = false, $dosen_id = false)
    {
        if ($dosen_id == false) {
            $absensi = $this->ModelAbsensi->get_dari_tanggal($tg_awal, $tg_akhir);
        } else {
            $absensi = $this->ModelAbsensi->get_rekap_per_dosen($tg_awal, $tg_akhir, $dosen_id);
        }

        // dd($absensi);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NO')
            ->setCellValue('B1', 'NAMA')
            ->setCellValue('C1', 'TANGGAL')
            ->setCellValue('D1', 'SEMESTER')
            ->setCellValue('E1', 'KELAS')
            ->setCellValue('F1', 'MULAI')
            ->setCellValue('G1', 'SELESAI');
        $column = 2;

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A1')->applyFromArray($style_col);
        $sheet->getStyle('B1')->applyFromArray($style_col);
        $sheet->getStyle('C1')->applyFromArray($style_col);
        $sheet->getStyle('D1')->applyFromArray($style_col);
        $sheet->getStyle('E1')->applyFromArray($style_col);
        $sheet->getStyle('F1')->applyFromArray($style_col);
        $sheet->getStyle('G1')->applyFromArray($style_col);

        // Set height baris ke 1, 2, 3 dan 4
        $sheet->getRowDimension('1')->setRowHeight(20);
        $sheet->getRowDimension('2')->setRowHeight(20);
        $sheet->getRowDimension('3')->setRowHeight(20);
        $sheet->getRowDimension('4')->setRowHeight(20);

        // tulis data mobil ke cell
        $no = 1;
        foreach ($absensi as $p) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no++)
                ->setCellValue('B' . $column, $p['nama_user'])
                ->setCellValue('C' . $column, strftime("%d %b %Y", strtotime($p['tanggal'])))
                ->setCellValue('D' . $column, $p['semester'] . " - " . $p['ta'])
                ->setCellValue('E' . $column, $p['nama_kelas'] . " - " . $p['angkatan_kelas'])
                ->setCellValue('F' . $column, $p['waktu_mulai'])
                ->setCellValue('G' . $column, $p['waktu_selesai']);


            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $column)->applyFromArray($style_row);
            $sheet->getStyle('B' . $column)->applyFromArray($style_row);
            $sheet->getStyle('C' . $column)->applyFromArray($style_row);
            $sheet->getStyle('D' . $column)->applyFromArray($style_row);
            $sheet->getStyle('E' . $column)->applyFromArray($style_row);
            $sheet->getStyle('F' . $column)->applyFromArray($style_row);
            $sheet->getStyle('G' . $column)->applyFromArray($style_row);

            $sheet->getRowDimension($column)->setRowHeight(20);

            $column++;
        }


        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(40); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(20); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(20); // Set width kolom E
        $sheet->getColumnDimension('G')->setWidth(20); // Set width kolom E


        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d') . ' - Rekap Absen Dosen';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function export_pdf($tg_awal = false, $tg_akhir = false, $dosen_id = false)
    {
        if ($dosen_id == false) {
            $data['absensi'] = $this->ModelAbsensi->get_dari_tanggal($tg_awal, $tg_akhir);
        } else {
            $data['absensi'] = $this->ModelAbsensi->get_rekap_per_dosen($tg_awal, $tg_akhir, $dosen_id);
        }

        $data['tg_awal']    = $tg_awal;
        $data['tg_akhir']    = $tg_akhir;
        $data['dosen_id']    = $dosen_id;
        $data['title']    = 'PDF Absensi';

        return view('admin/absensi/v_print', $data);
    }
}
