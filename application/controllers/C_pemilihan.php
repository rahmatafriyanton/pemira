<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pemilihan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->c_folder = $this->class = str_replace("C_", "", $this->router->fetch_class());
		$this->load->model('M_pemilihan', 'pemilihan');
	}

	// Datatable
	public function index() {
		$data['url']           	 	= base_url($this->class);
		$data['master_pemilihan'] = $this->pemilihan->get_acara_pemilihan([]);
    $data['contents'] 				= $this->class.'/index';
		$this->load->view('master', $data);
	}

	public function detail() {
		$params['id'] = $this->uri->segment(3);
		$cek = $this->pemilihan->get_acara_pemilihan($params)[0];

		if ($cek != null) {
			$data['url']           	 	= base_url($this->class);
			$data['data_pemilihan'] 	= $cek;
			$data['data_peserta'] 		= $this->pemilihan->get_peserta($params);
			// echo json_encode($data['data_peserta']); die();

			$now = date('Y-m-d H:i:s');

			if ($cek['tanggal_selesai'] < $now) {
				$data['total_pemilih'] = $this->pemilihan->get_total_pemilih($params);
				$data['total_memilih'] = $this->pemilihan->get_total_memilih($params);
			}
	    $data['contents'] 				= $this->class.'/detail';
			$this->load->view('master', $data);
		} else {
			echo "Tidak ada akses";
		}
	}

	public function proses_pemilihan() {
		$data = array('success' => false, 'alert' => true, 'message' => array());

		$this->form_validation->set_rules('peserta_id', 'ID Peserta', 'required');
		$this->form_validation->set_rules('token', 'Token', 'required|exact_length[6]|alpha');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback text-danger">', '</div>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['message'][$key] = form_error($key);
				$data['alert'] = false;
			}
		} else {
			$cek = $this->pemilihan->get_acara_pemilihan(['id' => $this->input->post('pemilihan_id')])[0];
			$now = date('Y-m-d H:i:s');
			if ($cek != null) {
				if ($cek['tanggal_mulai'] < $now && $cek['tanggal_selesai'] > $now) {
					if ($cek['token'] == $this->input->post('token')) {
						if ($cek['tanggal_memilih'] == null) {
							$this->pemilihan->proses_pemilihan($this->input->post());
							$data['success'] 	= true;
							$data['message']	= "Pemilihan Berhasil";
							$data['alert']		= false;
						} else {
							$data['message']	= "Anda Sudah Menggunakan Hak Pilih";
						}
					} else {
						$data['message']	= "Token tidak valid";
					}
				} else {
					$data['message']	= "Waktu pemilihan belum dimulai atau sudah berakhir";
				}
			} else {
				$data['message']	= "Anda tidak terdaftar pada pemilihan ini";
			}
						
		}

		echo json_encode($data);
	}


	public function list_acara_saya(){
		$data['url']           	 	= base_url($this->class);
		$data['master_pemilihan'] = $this->pemilihan->get_acara_pemilihan_saya();
    $data['contents'] 				= $this->class.'/list_acara_saya';
		$this->load->view('master', $data);
	}

	public function get_form_lengkapi_data() {
		$params = $this->input->post();
		// echo json_encode($params); die();
		$data['visi_misi'] = $this->pemilihan->get_visi_misi($params);
		$data['peserta']	 = $this->pemilihan->get_peserta($params)[0];
		$this->load->view('pemilihan/form_lengkapi_data', $data);
	}

	public function get_visi_misi() {
		$params = $this->input->post();
		$data['visi_misi'] = $this->pemilihan->get_visi_misi($params);
		$data['peserta']	 = $this->pemilihan->get_peserta($params)[0];
		$this->load->view('pemilihan/visi_misi', $data);
	}

	public function proses_lengkapi_data() {
		$data = array('success' => false, 'message' => array());

		$this->form_validation->set_rules('visi', 'Visi', 'required');
		$this->form_validation->set_rules('misi', 'misi', 'required');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback text-danger">', '</div>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['message'][$key] = form_error($key);
			}
		} else {
			// Visi Misi
			$params['visi'] 				= $this->input->post('visi');
			$params['misi'] 				= $this->input->post('misi');
			$params['pemilihan_id']	= $this->input->post('pemilihan_id');
			$params['peserta_id']		= $this->input->post('peserta_id');

			$this->pemilihan->set_visi_misi($params);
			$params = [];
			$params = $this->input->post();
			foreach ($params['photo'] as $key => $value) {
				$profil = [];
				$foto = $value;
				$profil['photo'] = '';

				if ($foto != '') {
					list($type, $foto) = explode(';', $foto);
					list(, $foto)      = explode(',', $foto);
					$foto = base64_decode($foto);

					$profil['photo'] = './assets/images/profil_peserta/'.date('Ymdhis').'.png';
					file_put_contents($profil['photo'], $foto);
				}

				$profil['nim'] 	= $params['nim'][$key];
				$profil['is_a']	= $params['is_a'][$key];
				$profil['pemilihan_id'] = $params['pemilihan_id'];

				$this->pemilihan->update_peserta($profil);
				$foto = '';
			}

			$data['success'] 	= true;
			$data['msg']		 	= 'Data Berhasil Disimpan';
			// $data['redirect'] = base_url('ormawa');
		}

		echo json_encode($data);
	}

}

/* End of file C_pemilihan.php */
/* Location: ./application/controllers/C_pemilihan.php */