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

	public function insert_user_data($params) {
		return $this->db->insert('users', $params);
	}

	public function update_user_data($params) {
		$this->db->where('email', $params['email']);
		return $this->db->update('users', $params);
	}

}

/* End of file M_auth_model.php */
/* Location: ./application/models/M_auth_model.php */