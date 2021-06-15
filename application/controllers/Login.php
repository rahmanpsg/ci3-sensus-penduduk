<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->db->query("SET sql_mode = '' ");
		$this->load->library('session');

		if ($this->session->has_userdata('hasLogin')) {
			$level = $this->session->userdata('level');
			redirect($level . '/');
		}
	}
	public function index()
	{
		$this->load->view('login/index');
	}
}
