<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pemilihan extends CI_Model {

	public function get_acara_pemilihan($params) {

		if (isset($params['id']) && $params['id'] != '') {
			$this->db->where('master_pemilihan.id', $params['id']);
		}

		$this->db->select('fakultas.nama_fakultas, ormawa.nama_ormawa, master_pemilihan.*, master_pemilihan_pemilih.nama_lengkap, master_pemilihan_pemilih.token, master_pemilihan_pemilih.tanggal_memilih');
		$this->db->join('master_pemilihan_pemilih', 'master_pemilihan.id = master_pemilihan_pemilih.pemilihan_id', 'left');
		$this->db->join('ormawa', 'ormawa.id = master_pemilihan.ormawa_id', 'left');
		$this->db->join('fakultas', 'fakultas.id = master_pemilihan.fakultas_id', 'left');
		// $this->db->join('users', 'users.id = master_pemilihan.user_id', 'left');
		$this->db->where('master_pemilihan_pemilih.user_id', $this->session->userdata('id'));
		$this->db->group_by('master_pemilihan.id');
		return $this->db->get('master_pemilihan')->result_array();
	}

	public function get_acara_pemilihan_saya() {
		$this->db->select('fakultas.nama_fakultas, ormawa.nama_ormawa, master_pemilihan.*, 
			master_pemilihan_peserta.peserta_id,
			master_pemilihan_peserta.pemilihan_id,
			master_pemilihan_peserta.nim,
			master_pemilihan_peserta.nama_lengkap,
			master_pemilihan_peserta.email,
			master_pemilihan_peserta.fakultas,
			master_pemilihan_peserta.jurusan,
			master_pemilihan_peserta.photo,
			master_pemilihan_peserta.is_a
			');

		$this->db->join('master_pemilihan_pemilih', 'master_pemilihan.id = master_pemilihan_pemilih.pemilihan_id', 'left');
		$this->db->join('ormawa', 'ormawa.id = master_pemilihan.ormawa_id', 'left');
		$this->db->join('fakultas', 'fakultas.id = master_pemilihan.fakultas_id', 'left');
		$this->db->join('master_pemilihan_peserta', 'master_pemilihan_peserta.pemilihan_id = master_pemilihan.id', 'left');
		// $this->db->join('users', 'users.id = master_pemilihan.user_id', 'left');
		$this->db->where('master_pemilihan_peserta.nim', $this->session->userdata('nim'));
		$this->db->group_by('master_pemilihan.id');
		return $this->db->get('master_pemilihan')->result_array();
	}

	public function get_visi_misi($params) {
		if (isset($params['peserta_id']) && $params['peserta_id'] != null) {
			$this->db->where('peserta_id', $params['peserta_id']);
		}

		if (isset($params['pemilihan_id']) && $params['pemilihan_id'] != null) {
			$this->db->where('pemilihan_id', $params['pemilihan_id']);
		}

		return $this->db->get('master_pemilihan_visi_misi')->result_array();
	}

	public function update_peserta($params) {
		$this->db->where('nim', $params['nim']);
		$this->db->where('pemilihan_id', $params['pemilihan_id']);
		return $this->db->update('master_pemilihan_peserta', $params);
	}


	public function get_peserta($params) {
		if (isset($params['peserta_id']) && $params['peserta_id'] != null) {
			$this->db->where('peserta_id', $params['peserta_id']);
		}

		if (isset($params['pemilihan_id']) && $params['pemilihan_id'] != null) {
			$this->db->where('pemilihan_id', $params['pemilihan_id']);
		}

		if (isset($params['id']) && $params['id'] != null) {
			$this->db->where('pemilihan_id', $params['id']);
		}

		$data = $this->db->get('master_pemilihan_peserta')->result_array();
		$i = 0;
		$j = 0;
		$init = $data[0]['peserta_id'];
		$result = [];
		foreach ($data as $key => $value) {
			if ($value['peserta_id'] != $init) {
				$i++;
				$j = 0;
			}
			$result[$i][$j] = $value;
			$init = $value['peserta_id'];
			$j++;
		}
		return $result;
	}


	public function proses_pemilihan($params) {
		$this->update_pemilih($params);

		$params['pemilih_id'] = $this->session->userdata('id');
		unset($params['token']);
		return $this->db->insert('hasil_pemilihan', $params);
	}

	public function update_pemilih($params) {
		$params['sudah_memilih'] = 1;
		$params['tanggal_memilih'] = date('Y-m-d H:i:s');
		$params['user_id'] = $this->session->userdata('id');
		$this->db->where('user_id', $params['user_id']);
		unset($params['peserta_id']);
		return $this->db->update('master_pemilihan_pemilih', $params);
	}

	public function get_total_pemilih($params) {
		return $this->db->get_where('master_pemilihan_pemilih', ['pemilihan_id' => $params['id']])->num_rows();
	}

	public function get_total_memilih($params) {
		return $this->db->get_where('hasil_pemilihan', ['pemilihan_id' => $params['id']])->num_rows();
	}

	public function get_hasil_pemilihan($params) {
		return $this->db->get_where('hasil_pemilihan', $params)->num_rows();
	}

	private function hapus_visi_misi($params) {
		$this->db->where('pemilihan_id', $params['pemilihan_id']);
		$this->db->where('peserta_id', $params['peserta_id']);
		return $this->db->delete('master_pemilihan_visi_misi');
	}

	public function set_visi_misi($params) {
		$this->hapus_visi_misi($params);
		return $this->db->insert('master_pemilihan_visi_misi', $params);
	}

}

/* End of file M_pemilihan.php */
/* Location: ./application/models/M_pemilihan.php */