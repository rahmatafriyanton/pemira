<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('M_auth_model', 'auth');

		include_once FCPATH . "/vendor/autoload.php";
		$this->google_client = new Google_Client();

		$this->google_client->setClientId('846407134613-plc8i619ldooluvkudnm1po690qtufvq.apps.googleusercontent.com'); //Define your ClientID
		$this->google_client->setClientSecret('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'); //Define your Client Secret Key
		$this->google_client->setRedirectUri('http://localhost/pemira/auth/login'); //Define your Redirect Uri
		$this->google_client->addScope('email');
		$this->google_client->addScope('profile');	
	}

	public function index() {
		if ($this->session->userdata('email') == '') {
			$data['login_button'] = $this->google_client->createAuthUrl();
			$this->load->view('auth/login', $data);
		} else {
			redirect('auth/login');
		}
	}

	public function auth_login() {
		$data = array('success' => false, 'message' => array());

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback text-danger">', '</div>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['message'][$key] = form_error($key);
			}
		} else {
			$params 								= $this->input->post();
			$params['password']			= md5(sha1($params['password']));

			$cek = $this->auth->get_user_data($params);
			if ($cek != null) {
				$cek = $cek[0];
				if ($cek['password'] == $params['password']) {
					unset($cek['password']);
					$this->session->set_userdata($cek);
					$data['success'] 	= true;
					$data['message'] 	= 'Berhasil Login';
					$data['redirect']	= base_url('dashboard');
				} else {
					$data['error'] 	= 'Password salah!';
				}	
			} else {
				$data['error'] 	= 'Akun tidak ditemukan';
			}
		}
		
		echo json_encode($data);
	}

	public function login() {
		$email = $this->session->userdata('email');

		if(isset($_GET["code"])) {
				$token = $this->google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

				if(!isset($token["error"])) {
					$this->google_client->setAccessToken($token['access_token']);
					$google_service = new Google_Service_Oauth2($this->google_client);
					$data = $google_service->userinfo->get();
					$email = $data->email;
				}
			}

			if (substr($email, strpos($email, "@") + 1) != "mahasiswa.upnvj.ac.id") {
				$this->session->set_flashdata('warning', 'Harap Gunakan Email UPNVJ Saat Masuk!');
				redirect('auth');
			}

			$cek = $this->auth->get_user_data(['email' => $email]);
			if ($cek == null) {
				$params['email']			 		= $data->email;
				$params['nama_lengkap'] 	= $data->name;
				$params['jenis_kelamin']	= $data->gender;

				$this->auth->insert_user_data($params);
				$cek = $this->auth->get_user_data(['email' => $data->email]);
			}

			$cek = $cek[0];
			unset($cek['password']);
			$this->session->set_userdata($cek);
			if ($cek['is_activated'] == 1) {
				redirect(base_url('dashboard'));
			} else {
				redirect('auth/lengkapi_user_data');
			}
	}

	public function lengkapi_user_data() {
		if ($this->session->userdata('email') == '') {
			$this->session->set_flashdata('warning', 'Silahkan Masuk Untuk Memulai!');
			redirect('auth');
		}
		$this->load->view('auth/form_data_user');
	}

	public function set_user_data() {
		$data = array('success' => false, 'message' => array());

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('nim', 'nim', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback text-danger">', '</div>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['message'][$key] = form_error($key);
			}
		} else {
			$params 								= $this->input->post();
			$params['password']			= md5(sha1($params['password']));
			$params['is_activated'] = 1;
			if ($this->auth->update_user_data($params)) {
				// session_destroy();
				$this->session->set_userdata($params);
				$data['success'] 	= true;
				$data['message'] 	= 'Data berhasil disimpan';
				$data['redirect']	= base_url('dashboard');
			}
		}
		
		echo json_encode($data);
	}

	public function logout() {
		session_destroy();
		$this->session->flashdata('warning', 'Berhasil Keluar');
		redirect('auth');
	}

}

/* End of file C_auth.php */
/* Location: ./application/controllers/C_auth.php */