<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master_acara extends CI_Model {


	public function get_data_pemilihan() {

		$this->db->select('fakultas.nama_fakultas, ormawa.nama_ormawa, users.nama_lengkap, master_pemilihan.*');
		$this->db->join('ormawa', 'ormawa.id = master_pemilihan.ormawa_id', 'left');
		$this->db->join('fakultas', 'fakultas.id = master_pemilihan.fakultas_id', 'left');
		$this->db->join('users', 'users.id = master_pemilihan.user_id', 'left');
		return $this->db->get('master_pemilihan')->result_array();
	}

	public function get_data_calon($params) {
		$this->db->select('users.*, fakultas.nama_fakultas, jurusan.nama_jurusan');
		$this->db->where('users.nim', $params['nim']);

		if ($params['fakultas_id'] != 8) {
			$this->db->where('users.fakultas_id', $params['fakultas_id']);
		}
		$this->db->join('fakultas', 'fakultas.id = users.fakultas_id', 'left');
		$this->db->join('jurusan', 'jurusan.id = users.jurusan_id', 'left');
		return $this->db->get('users')->row_array();
	}

	public function get_data_pemilih($params) {
		// var_dump($params); die();
		$this->db->select('users.*, fakultas.nama_fakultas, jurusan.nama_jurusan');

		if (isset($params['fakultas_id']) && $params['fakultas_id'] != 8) {
			$this->db->where('users.fakultas_id', $params['fakultas_id']);
		}

		if (isset($params['user_id']) && $params['user_id'] != '') {
			$this->db->where('users.id', $params['user_id']);
		}

		$this->db->join('fakultas', 'fakultas.id = users.fakultas_id', 'left');
		$this->db->join('jurusan', 'jurusan.id = users.jurusan_id', 'left');
		return $this->db->get('users')->result_array();
	}


	public function add_proccess($params) {
		$params['pemilihan_id'] = $this->insert_master_pemilihan($params);

		$this->insert_data_peserta($params);
		$this->insert_data_pemilih($params);
	}

	public function insert_master_pemilihan($params) {
		$data['user_id']		 = $this->session->userdata('id');
		$data['fakultas_id'] = $params['fakultas_id'];
		$data['ormawa_id']	 = $params['ormawa_id'];
		$data['nama_acara']  = $params['nama_acara'];

		$tanggal = explode(" s/d ",$params['tanggal']);
		$data['tanggal_mulai'] = $tanggal[0];
		$data['tanggal_selesai'] = $tanggal[1];
		$this->db->insert('master_pemilihan', $data);
		return $this->db->insert_id();
	}

		private function init_data_peserta($params) {
		$result = [];
		foreach ($params['peserta']['ketua'] as $key => $value) {
			foreach ($value as $k => $v) {
				$result['ketua'][$k][$key] = $v;
			}
		}
		foreach ($params['peserta']['wakil_ketua'] as $key => $value) {
			foreach ($value as $k => $v) {
				$result['wakil_ketua'][$k][$key] = $v;
			}
		}
		return $result;
	}

	public function insert_data_peserta($params) {
		$peserta = $this->init_data_peserta($params);

		foreach ($peserta['ketua'] as $key => $value) {

			$ketua['pemilihan_id'] = $params['pemilihan_id'];
			$ketua['peserta_id'] 	 = strtolower(random_string('alnum', 99));
			$ketua['nim']					 = $value['nim'];
			$ketua['nama_lengkap'] = $value['nama_lengkap'];
			$ketua['fakultas']		 = $value['fakultas'];
			$ketua['jurusan']			 = $value['jurusan'];
			$ketua['is_a']			 	 = 'ketua';

			$wakil_ketua['pemilihan_id'] = $params['pemilihan_id'];
			$wakil_ketua['peserta_id'] 	 = $ketua['peserta_id'];
			$wakil_ketua['nim']					 = $peserta['wakil_ketua'][$key]['nim'];
			$wakil_ketua['nama_lengkap'] = $peserta['wakil_ketua'][$key]['nama_lengkap'];
			$wakil_ketua['fakultas']		 = $peserta['wakil_ketua'][$key]['fakultas'];
			$wakil_ketua['jurusan']			 = $peserta['wakil_ketua'][$key]['jurusan'];
			$wakil_ketua['is_a']			 	 = 'wakil_ketua';

			// $this->insert_master_pemilihan_peserta($ketua);
			// $this->insert_master_pemilihan_peserta($wakil_ketua);

			$this->db->insert('master_pemilihan_peserta', $ketua);
			$this->db->insert('master_pemilihan_peserta', $wakil_ketua);
		}
	}


	public function insert_data_pemilih($params) {
		foreach ($params['pemilih_id'] as $row) {
			$pemilih = $this->get_data_pemilih(['user_id'  => $row])[0];
			$token = strtolower(random_string('alpha', 6));
			$data = [];
			$data['pemilihan_id']		= $params['pemilihan_id'];
			$data['user_id']				= $pemilih['id'];
			$data['nim']						= $pemilih['nim'];
			$data['nama_lengkap']		= $pemilih['nama_lengkap'];
			$data['email']					= $pemilih['email'];
			$data['nim']						= $pemilih['nim'];
			$data['fakultas']				= $pemilih['nama_fakultas'];
			$data['jurusan']				= $pemilih['nama_jurusan'];
			$data['token']					= $token;

			$this->db->insert('master_pemilihan_pemilih', $data);

			$data['nama_acara'] = $params['nama_acara'];
			$this->sent_email($data);
		}
	}

	public function sent_email($params) {	
		$config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => 'lokailmu.id@gmail.com',
      'smtp_pass' => 'lokailmu2021',
      'mailtype'  => 'html', 
      'charset'   => 'iso-8859-1'
    );

		$isi = "<p>Halo, {$params['nama_lengkap']}<p>";
		$isi .= "<p>Kamu terdaftar pada aplikasi Pemira dan terdaftar pada acara {$params['nama_acara']} <p>";

		$isi .= "<p>Ini adalah token untuk akses ke pemilihan: <p>";
		$isi .= "<b>{$params['token']}</b>";
		$isi .= "<p>Token hanya berlaku satu kali</p>";

    $this->email->initialize($config);
    $this->email->from('lokailmu.id@gmail.com', 'Konfirmasi Acara Pemilihan');
    $this->email->to($params['email']);
    $this->email->subject('Konfirmasi Token Pemilihan UPNVJ');
    $this->email->message($isi); 

    $this->email->set_newline("\r\n");
    $this->email->send();
    return true;
	}


}

/* End of file M_master_acara.php */
/* Location: ./application/models/M_master_acara.php */