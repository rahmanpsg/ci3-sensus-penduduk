<?php
class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model');
        $this->load->library('Pdf');
        $this->db->query("SET sql_mode = '' ");
    }

    public function penduduk()
    {
        $this->db->select("nik, nama, alamat, jenis_kelamin, agama, pendidikan, pekerjaan, status, CONCAT(tempat_lahir, ', ', DATE_FORMAT(tanggal_lahir, '%d-%c-%Y')) ttl");
        $data = $this->db->get('tbl_penduduk')->result();

        $pdf = new Pdf('L', 'mm', 'LEGAL');

        $pdf->createHeader($pdf, 'LAPORAN DAFTAR PENDUDUK');


        $pdf->SetFont('Times', 'B', 12);

        $pdf->Cell(10, 11, 'NO', 1, 0, 'C');
        $pdf->Cell(40, 11, 'NIK', 1, 0, 'C');
        $pdf->cell(55, 11, 'NAMA', 1, 0, 'C');
        $pdf->cell(70, 11, 'ALAMAT', 1, 0, 'C');
        $pdf->Cell(40, 11, 'JENIS KELAMIN', 1, 0, 'C');
        $pdf->Cell(60, 11, 'TEMPAT, TANGGAL LAHIR', 1, 0, 'C');
        $pdf->Cell(30, 11, 'AGAMA', 1, 0, 'C');
        $pdf->Cell(30, 11, 'STATUS', 1, 1, 'C');

        $no = 1;

        $pdf->SetFont('Times', '', 12);
        foreach ($data as  $val) {
            $pdf->Cell(10, 11, $no++, 1, 0, 'C');
            $pdf->Cell(40, 11, $val->nik, 1, 0, 'C');
            $pdf->cell(55, 11, ucwords($val->nama), 1, 0);
            $pdf->cell(70, 11, $val->alamat, 1, 0);
            $pdf->cell(40, 11, $val->jenis_kelamin, 1, 0);
            $pdf->cell(60, 11, $val->ttl, 1, 0);
            $pdf->cell(30, 11, $val->agama, 1, 0);
            $pdf->cell(30, 11, $val->status, 1, 1);
        }

        $pdf->Output("Daftar Penduduk", 'I');
    }

    public function kk()
    {
        $this->db->select('a.kk, a.kepala_keluarga, a.istri, a.anak, b.nama nama_kepala, c.nama nama_istri');
        $this->db->join('tbl_penduduk b', 'a.kepala_keluarga = b.nik', 'left');
        $this->db->join('tbl_penduduk c', 'a.istri = c.nik', 'left');

        $get = $this->db->get('tbl_kk a')->result();

        $data = array_map(function ($v) {
            $v->anak = $this->Model->createDataAnak($v->anak);
            return $v;
        }, $get);

        $pdf = new Pdf('L', 'mm', 'LEGAL');

        $pdf->createHeader($pdf, 'LAPORAN DAFTAR KARTU KELUARGA');


        $pdf->SetFont('Times', 'B', 12);

        $pdf->Cell(10, 11, 'NO', 1, 0, 'C');
        $pdf->Cell(70, 11, 'NOMOR KARTU KELUARGA', 1, 0, 'C');
        $pdf->cell(65, 11, 'NIK KEPALA KELUARGA', 1, 0, 'C');
        $pdf->cell(70, 11, 'NAMA KEPALA KELUARGA', 1, 0, 'C');
        $pdf->cell(50, 11, 'NIK ISTRI', 1, 0, 'C');
        $pdf->cell(70, 11, 'NAMA ISTRI', 1, 1, 'C');

        $no = 1;

        $pdf->SetFont('Times', '', 12);
        foreach ($data as  $val) {
            $pdf->Cell(10, 11, $no++, 1, 0, 'C');
            $pdf->Cell(70, 11, $val->kk, 1, 0, 'C');
            $pdf->Cell(65, 11, $val->kepala_keluarga, 1, 0, 'C');
            $pdf->cell(70, 11, ucwords($val->nama_kepala), 1, 0);
            $pdf->cell(50, 11, $val->istri, 1, 0, 'C');
            $pdf->cell(70, 11, ucwords($val->nama_istri), 1, 1);

            // var_dump($val->anak);

            if ($val->anak) {
                $pdf->SetFont('Times', '', 10);

                foreach ($val->anak as $key => $value) {
                    $pdf->Cell(10, 11, '', 1, 0, 'C', true);
                    $pdf->Cell(325, 11, 'Anak Ke-' . ($key + 1) . ' : ' . $value['nik'] . ', ' . $value['nama'], 1, 1);
                }
            }
        }

        $pdf->Output("Daftar KK", 'I');
    }

    public function kelahiran()
    {
        $this->db->select("a.id, a.kk, a.nama, a.jenis_kelamin, CONCAT(a.tempat_lahir, ', ', DATE_FORMAT(a.tanggal_lahir, '%d-%c-%Y')) ttl, c.nama ayah, d.nama ibu");
        $this->db->join('tbl_kk b', 'a.kk = b.kk', 'left');
        $this->db->join('tbl_penduduk c', 'b.kepala_keluarga = c.nik', 'left');
        $this->db->join('tbl_penduduk d', 'b.istri = d.nik', 'left');
        $data = $this->db->get('tbl_kelahiran a')->result();

        $pdf = new Pdf('L', 'mm', 'LEGAL');

        $pdf->createHeader($pdf, 'LAPORAN DAFTAR KELAHIRAN');


        $pdf->SetFont('Times', 'B', 12);

        $pdf->Cell(10, 11, 'NO', 1, 0, 'C');
        $pdf->cell(55, 11, 'NAMA', 1, 0, 'C');
        $pdf->Cell(40, 11, 'JENIS KELAMIN', 1, 0, 'C');
        $pdf->Cell(60, 11, 'TEMPAT, TANGGAL LAHIR', 1, 0, 'C');
        $pdf->cell(55, 11, 'NAMA AYAH', 1, 0, 'C');
        $pdf->cell(55, 11, 'NAMA IBU', 1, 0, 'C');
        $pdf->cell(55, 11, 'Nomor KK', 1, 1, 'C');

        $no = 1;

        $pdf->SetFont('Times', '', 12);
        foreach ($data as  $val) {
            $pdf->Cell(10, 11, $no++, 1, 0, 'C');
            $pdf->cell(55, 11, ucwords($val->nama), 1, 0);
            $pdf->cell(40, 11, $val->jenis_kelamin, 1, 0);
            $pdf->cell(60, 11, $val->ttl, 1, 0);
            $pdf->cell(55, 11, ucwords($val->ayah), 1, 0);
            $pdf->cell(55, 11, ucwords($val->ibu), 1, 0);
            $pdf->cell(55, 11, $val->kk, 1, 1);
        }

        $pdf->Output("Daftar Kelahiran", 'I');
    }

    public function kematian()
    {
        $this->db->select("a.*, DATE_FORMAT(a.tanggal, '%d-%c-%Y') tanggal , b.nama");
        $this->db->join('tbl_penduduk b', 'a.nik = b.nik', 'left');
        $data = $this->db->get('tbl_kematian a')->result();

        $pdf = new Pdf('L', 'mm', 'LEGAL');

        $pdf->createHeader($pdf, 'LAPORAN DAFTAR KEMATIAN');


        $pdf->SetFont('Times', 'B', 12);

        $pdf->cell(10);
        $pdf->Cell(10, 11, 'NO', 1, 0, 'C');
        $pdf->cell(55, 11, 'NIK', 1, 0, 'C');
        $pdf->cell(55, 11, 'NAMA', 1, 0, 'C');
        $pdf->Cell(60, 11, 'TANGGAL KEMATIAN', 1, 0, 'C');
        $pdf->cell(65, 11, 'TEMPAT', 1, 0, 'C');
        $pdf->cell(65, 11, 'PENYEBAB', 1, 1, 'C');

        $no = 1;

        $pdf->SetFont('Times', '', 12);
        foreach ($data as  $val) {
            $pdf->cell(10);
            $pdf->Cell(10, 11, $no++, 1, 0, 'C');
            $pdf->cell(55, 11, $val->nik, 1, 0);
            $pdf->cell(55, 11, ucwords($val->nama), 1, 0);
            $pdf->cell(60, 11, $val->tanggal, 1, 0);
            $pdf->cell(65, 11, $val->tempat, 1, 0);
            $pdf->cell(65, 11, $val->penyebab, 1, 1);
        }

        $pdf->Output("Daftar Kematian", 'I');
    }

    public function pendatang()
    {
        $this->db->select("a.*, DATE_FORMAT(a.tanggal, '%d-%c-%Y') tanggal, b.nama");
        $this->db->join('tbl_penduduk b', 'a.nik = b.nik', 'left');
        $data = $this->db->get('tbl_pendatang a')->result();

        $pdf = new Pdf('L', 'mm', 'LEGAL');

        $pdf->createHeader($pdf, 'LAPORAN DAFTAR PENDATANG');


        $pdf->SetFont('Times', 'B', 12);

        $pdf->cell(10);
        $pdf->Cell(10, 11, 'NO', 1, 0, 'C');
        $pdf->cell(55, 11, 'NIK', 1, 0, 'C');
        $pdf->cell(55, 11, 'NAMA', 1, 0, 'C');
        $pdf->Cell(60, 11, 'TANGGAL PINDAH', 1, 0, 'C');
        $pdf->cell(65, 11, 'ALAMAT ASAL', 1, 0, 'C');
        $pdf->cell(65, 11, 'ALASAN PINDAH', 1, 1, 'C');

        $no = 1;

        $pdf->SetFont('Times', '', 12);
        foreach ($data as  $val) {
            $pdf->cell(10);
            $pdf->Cell(10, 11, $no++, 1, 0, 'C');
            $pdf->cell(55, 11, $val->nik, 1, 0);
            $pdf->cell(55, 11, ucwords($val->nama), 1, 0);
            $pdf->cell(60, 11, $val->tanggal, 1, 0);
            $pdf->cell(65, 11, $val->alamat, 1, 0);
            $pdf->cell(65, 11, $val->alasan, 1, 1);
        }

        $pdf->Output("Daftar Pendatang", 'I');
    }

    public function pindah()
    {
        $this->db->select("a.*, DATE_FORMAT(a.tanggal, '%d-%c-%Y') tanggal, b.nama");
        $this->db->join('tbl_penduduk b', 'a.nik = b.nik', 'left');
        $data = $this->db->get('tbl_pindah a')->result();

        $pdf = new Pdf('L', 'mm', 'LEGAL');

        $pdf->createHeader($pdf, 'LAPORAN DAFTAR PINDAH');


        $pdf->SetFont('Times', 'B', 12);

        $pdf->cell(10);
        $pdf->Cell(10, 11, 'NO', 1, 0, 'C');
        $pdf->cell(55, 11, 'NIK', 1, 0, 'C');
        $pdf->cell(55, 11, 'NAMA', 1, 0, 'C');
        $pdf->Cell(60, 11, 'TANGGAL PINDAH', 1, 0, 'C');
        $pdf->cell(65, 11, 'TUJUAN PINDAH', 1, 0, 'C');
        $pdf->cell(65, 11, 'ALASAN PINDAH', 1, 1, 'C');

        $no = 1;

        $pdf->SetFont('Times', '', 12);
        foreach ($data as  $val) {
            $pdf->cell(10);
            $pdf->Cell(10, 11, $no++, 1, 0, 'C');
            $pdf->cell(55, 11, $val->nik, 1, 0);
            $pdf->cell(55, 11, ucwords($val->nama), 1, 0);
            $pdf->cell(60, 11, $val->tanggal, 1, 0);
            $pdf->cell(65, 11, $val->tujuan, 1, 0);
            $pdf->cell(65, 11, $val->alasan, 1, 1);
        }

        $pdf->Output("Daftar Pindah", 'I');
    }
}
