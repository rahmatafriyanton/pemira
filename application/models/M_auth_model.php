<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth_model extends CI_Model {

	public function get_user_data($params) {
		if (isset($params['id']) && $params['id'] != '') {
			$this->db->where('id', $params['id']);
		}

		if (isset($params['email']) && $params['email'] != '') {
			$this->db->where('email', $params['email']);
		}

		return $this->db->get('users')->result_array();
	}

	public function get_user_role_data($params) {
		$this->db->select('role_id as role');
		$this->db->where('user_id', $params['id']);

		$data = $this->db->get('user_roles')->result_array();
		$result = [];

		foreach ($data as $key => $row) {
			$result[$key] = $row['role'];
		}
		return $result;
	}

	public function insert_user_data($params) {
		return $this->db->insert('users', $params);
	}

	public function insert_user_role_data($params) {
		$this->delete_user_role_data($params);

		$data['user_id'] = $params['id'];
		foreach ($params['roles'] as $row) {
			$data['role_id'] = $row;
			$this->db->insert('user_roles', $data);
		}

		return true;
	}

	public function delete_user_role_data($params) {
		$this->db->where('user_id', $params['id']);
		return $this->db->delete('user_roles');
	}

	public function update_user_data($params) {
		$this->insert_user_role_data($params);

		unset($params['roles']);
		$params['updated_at'] = date('Y-m-d H-i-s');
		$this->db->where('email', $params['email']);
		return $this->db->update('users', $params);
	}

	public function get_fakultas() {
		return $this->db->get('fakultas')->result_array();
	}

	public function get_jurusan($params) {
		$this->db->where($params);
		// echo $this->db->get_compiled_select('jurusan'); die();
		return $this->db->get('jurusan')->result_array();
	}

}

/* End of file M_auth_model.php */
/* Location: ./application/models/M_auth_model.php */