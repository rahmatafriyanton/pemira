<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_fakultas extends CI_Model {

	public function get_fakultas() {
		return $this->db->get('fakultas')->result_array();
	}

}

/* End of file M_fakultas.php */
/* Location: ./application/models/M_fakultas.php */