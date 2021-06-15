<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model');
        $this->load->library('session');
        $this->db->query("SET sql_mode = '' ");

        if (!$this->session->has_userdata('hasLogin')) {
            redirect('login');
        } else
        if ($this->session->userdata('level') !== 'admin') {
            $level = $this->session->userdata('level');
            redirect("$level/");
        }
    }

    public function index()
    {
        $data['totalPenduduk'] = $this->Model->getTotalData('tbl_penduduk');
        $data['totalLaki'] = $this->Model->getTotalData('tbl_penduduk', ['jenis_kelamin' => 'Laki-laki']);
        $data['totalPerempuan'] = $this->Model->getTotalData('tbl_penduduk', ['jenis_kelamin' => 'Perempuan']);
        $data['totalKeluarga'] = $this->Model->getTotalData('tbl_kk');
        // $data['karakteristik'] = [
        //     'Umur' => ['17-23 Tahun', '24-29 Tahun', '30-40 Tahun', 'Diatas 40 Tahun'],
        //     'Jenis Kelamin' => ['Laki-laki', 'Perempuan'],
        //     'Pendidikan' => ['SD', 'SMP', 'SMA/SMK', 'Diploma', 'S1', 'S2 keatas'],
        //     'Pekerjaan' => ['PNS/TNI/POLRI', 'Pegawai Swasta', 'Wiraswasta/Usahawan', 'Petani/Buruh', 'Pelajar/Mahasiswa', 'Lainnya']
        // ];

        $this->load->view('admin/index', $data);
    }

    public function geolokasi()
    {
        $data['TBL_URL'] = base_url('api/geolokasi');
        $this->load->view('admin/geolokasi', $data);
    }

    public function penduduk()
    {
        $data['TBL_URL'] = base_url('api/penduduk');
        $this->load->view('admin/penduduk', $data);
    }

    public function kk()
    {
        $data['TBL_URL'] = base_url('api/kk');
        $this->load->view('admin/kk', $data);
    }

    public function kelahiran()
    {
        $data['TBL_URL'] = base_url('api/kelahiran');
        $this->load->view('admin/kelahiran', $data);
    }

    public function kematian()
    {
        $data['TBL_URL'] = base_url('api/kematian');
        $this->load->view('admin/kematian', $data);
    }

    public function pendatang()
    {
        $data['TBL_URL'] = base_url('api/pendatang');
        $this->load->view('admin/pendatang', $data);
    }

    public function pindah()
    {
        $data['TBL_URL'] = base_url('api/pindah');
        $this->load->view('admin/pindah', $data);
    }

    public function laporan()
    {
        $this->load->view('admin/laporan');
    }
}
