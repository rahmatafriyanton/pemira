<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ormawa extends CI_Model {

	public function insert_ormawa($params) {
		return $this->db->insert('ormawa', $params);
	}

}

/* End of file M_ormawa.php */
/* Location: ./application/models/M_ormawa.php */