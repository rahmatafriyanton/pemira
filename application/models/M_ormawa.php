<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ormawa extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->table  = "ormawa";
	}

	// Datatable
	public function get_serverside($params) {
		$params['column_order']     = ['nama_fakultas', 'nama_fakultas', 'nama_lengkap'];
		$params['column_search']    = ['nama_fakultas', 'nama_fakultas', 'nama_lengkap'];
		$params['order']            = ['id' => 'asc'];

		$this->db->select('ormawa.*, users.nama_lengkap, fakultas.nama_fakultas');

		$this->db->join('fakultas', 'fakultas.id = ormawa.fakultas_id', 'left');
		$this->db->join('users', 'users.id = ormawa.user_id', 'left');
		$this->db->from($this->table);

		if (isset($params['id'])) {
			$this->db->where('id', $params['id']);
		}

		if (!isset($params['offset'])) {
			$params['offset'] = '0';
		}

		if (isset($params['limit']) && $params['limit'] > 0) {
			$this->db->limit($params['limit'], $params['offset']);
		}

		$this->dataTables($params);

		$sql = $this->db->get();
		$result = $sql->result_array();

		$res['status']  = '200';
		$res['message'] = 'Berhasil Mendapatkan data';
		$res['data']    = [
			'total_record'      => $this->total_record(),
			'total_filtered'    => $this->total_filtered($params),
			'result'            => $result
		];
		return $res;
	}

	private function dataTables($params) {
		$i = 0;
		if (isset($params['search']) && $params['search'] != null) {
			$this->db->group_start();
			foreach ($params['column_search'] as $key => $items) {
				if ($i == 0) {
					$this->db->like($items, $params['search']);
				} else {
					$this->db->or_like($items, $params['search']);
				}
				$i++;
			}
			$this->db->group_end();
		}
		
		if (!empty($params['search'])) {
			$this->db->group_start();
			foreach ($params['column_search'] as $item) {
				if ($i == 0) {
					$this->db->like($item, $params['search']);
				} else {
					$this->db->or_like($item, $params['search']);
				}
				$i++;
			}
			$this->db->group_end();
		}


		if (isset($params['order_column'])) {
			if ($params['order_column'] == 0) {
				$column_order_ui = 0;
			} else {
				$column_order_ui = $params['order_column'] - 2;
			}

			if (isset($params['order_column'])) {
				$this->db->order_by($params['column_order'][$column_order_ui], $params['order_dir']);
			} else {
				$this->db->order_by(key($params['order']), $params['order'][key($params['order'])]);
			}
		}
	

		if (isset($params['sort_column'])) {
			$this->db->order_by($params['column_order'][$column_ui], $params['sort_type']);
		} elseif (isset($params['order'])) {
			$this->db->order_by(key($params['order']), $params['order'][key($params['order'])]);
		}
	}

	public function total_record() {
		$this->db->select('ormawa.id');
		$this->db->from($this->table);

		if (!isset($params['offset'])) {
			$params['offset'] = '0';
		}
		return $this->db->get()->num_rows();
	}

	public function total_filtered($params) {
		$params['column_order']     = ['nama_fakultas', 'nama_fakultas', 'nama_lengkap'];
		$params['column_search']    = ['nama_fakultas', 'nama_fakultas', 'nama_lengkap'];
		$params['order']            = ['id' => 'asc'];

		$this->db->select('ormawa.id');
		$this->db->from($this->table);

		if (isset($params['id'])) {
			$this->db->where('id', $params['id']);
		}
		if (!isset($params['offset'])) {
			$params['offset'] = '0';
		}

		$this->dataTables($params);

		return $this->db->get()->num_rows();
	}
	// ./Datatable


  // CRUD
  public function add_proccess($params) {
		return $this->db->insert('ormawa', $params);
	}


	// Data
	public function get_pengurus_select2($params) {
		// var_dump($params); die();

		if (isset($params['fakultas_id']) && $params['fakultas_id'] != 8) {
			$this->db->where('fakultas_id', $params['fakultas_id']);
		}

		if (isset($params['search']) && $params['search'] != '') {
			$cari = $params['search'];
      $this->db->where("( nama_lengkap LIKE '%{$cari}%' or nim LIKE '%{$cari}%' )");
		}

		if (isset($params['page']) && $params['page']) {
			$this->db->limit(10, $params['page'] * 10);
		} else {
			$this->db->limit(10, 0);
		}
		// echo $this->db->get_compiled_select('users'); die();

    $query = $this->db->get('users')->result_array();

    // Initialize array data with fetched data
    $resp = [];
    foreach ($query as $k => $v) {
        $resp[$k]['id']                = $v['id'];
        $resp[$k]['text']              = $v['nim'].' - '.$v['nama_lengkap'];
    }

    return $resp;
  }

  public function get_ormawa($params) {
  	if (isset($params['user_id']) && $params['user_id'] != '') {
  		$this->db->where('ormawa.user_id', $params['user_id']);
  	}

  	$this->db->select('fakultas.nama_fakultas, fakultas.id as fakultas_id, ormawa.*');
  	$this->db->join('fakultas', 'ormawa.fakultas_id = fakultas.id', 'left');
  	// echo $this->db->get_compiled_select('ormawa'); die();
  	return $this->db->get('ormawa')->result_array();
  }

}

/* End of file M_ormawa.php */
/* Location: ./application/models/M_ormawa.php */