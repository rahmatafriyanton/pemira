<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->c_folder = $this->class = str_replace("C_", "", $this->router->fetch_class());
	}

	public function index() {
		$data['url']            = base_url($this->class);
    $data['contents'] 			= $this->class.'/index';
		$this->load->view('master', $data);
	}

}

/* End of file C_dashboard.php */
/* Location: ./application/controllers/C_dashboard.php */