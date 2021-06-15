<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kepala extends CI_Controller
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
        if ($this->session->userdata('level') !== 'kepala') {
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

        $this->load->view('kepala/index', $data);
    }

    public function laporan()
    {
        $this->load->view('kepala/laporan');
    }
}
