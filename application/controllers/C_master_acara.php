<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_master_acara extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->c_folder = $this->class = str_replace("C_", "", $this->router->fetch_class());
		$this->load->model('M_ormawa', 'ormawa');
		$this->load->model('M_fakultas', 'fakultas');
		$this->load->model('M_auth', 'auth');
		$this->load->model('M_master_acara', 'master_acara');

		if (!is_login()) {
			redirect(base_url('auth'));
		}

		// if (!is_moderator() || !is_admin()) {
		// 	redirect('dashboard');
		// }
	}

	// Datatable
	public function index() {
		$data['url']            	= base_url($this->class);
		$data['master_pemilihan'] = $this->master_acara->get_data_pemilihan();
    $data['contents'] 				= $this->class.'/index';
		$this->load->view('master', $data);
	}


	// Tambah
	public function add() {
		$data['url']            = base_url($this->class);
		$params['user_id']			= 
		$data['ormawa']					= $this->ormawa->get_ormawa(['user_id' => $this->session->userdata('id')]);
    $data['contents'] 			= $this->class.'/add';
		$this->load->view('master', $data);
	}

	public function add_proccess() {
		$data = array('success' => false, 'message' => array());
		$this->form_validation->set_rules('fakultas_id', 'Fakultas', 'required');
		$this->form_validation->set_rules('nama_acara', 'Nama Acara', 'required');
		$this->form_validation->set_rules('ormawa_id', 'Ormawa', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('pemilih_id[]', 'Data Pemilih', 'required');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback text-danger">', '</div>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['message'][$key] = form_error($key);
			}
		} else {

			$this->master_acara->add_proccess($this->input->post());

			$data['success'] 	= true;
			$data['msg']		 	= 'Data Berhasil Disimpan';
			$data['redirect'] = base_url('master_acara');
		}

		echo json_encode($data);
	}

	public function get_form_paslon() {
		$this->load->view('master_acara/form_single');
	}

	public function get_data_calon() {
		$data = array('success' => false, 'message' => '<div class="invalid-feedback text-danger">NIM tidak ditemukan</div>');
		$params = $this->input->post();

		$cek = $this->master_acara->get_data_calon($params);

		if ($cek != null) {
			$data['success'] 	= true;
			$data['message']	= 'Data Ditemukan';
			unset($cek['password']);
			$data['data'] = $cek;
		}

		echo json_encode($data);
	}

	public function get_data_pemilih() {
		$data = array('success' => false, 'message' => 'Data Tidak Ditemukan');
		$params = $this->input->post();

		$cek = $this->master_acara->get_data_pemilih($params);

		if ($cek != null) {
			$data['success'] 	= true;
			$data['message']	= 'Data Ditemukan';
			unset($cek['password']);
			$data['data'] = $cek;

			foreach($data['data'] as $key => $val) {
				$data['data'][$key]['checkbox'] = "<input type='checkbox' class='data_pemilih' name='pemilih_id[]' value='{$val['id']}'/>";
			}
		}

		echo json_encode($data);
	}


}

/* End of file C_master_acara.php */
/* Location: ./application/controllers/C_master_acara.php */