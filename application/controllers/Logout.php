<?php
class Logout extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    public function index()
    {
        session_destroy();
        redirect('/login', 'refresh');
    }
}
