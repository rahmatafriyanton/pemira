<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ormawa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_ormawa', 'ormawa');
	}

	public function index() {
		// Test
	}

	public function tambah_ormawa() {    
    // Panggil Tampilan DI sini
    $data['contents'] 			= 'ormawa/index';

		$this->load->view('master', $data);

	}

	public function proses_tambah_ormawa() {
		$params = $this->input->post();
		$this->ormawa->insert_ormawa($params);
	}



}

/* End of file Ormawa.php */
/* Location: ./application/controllers/Ormawa.php */