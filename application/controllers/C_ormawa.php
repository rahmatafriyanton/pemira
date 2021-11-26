<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_ormawa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->c_folder = $this->class = str_replace("C_", "", $this->router->fetch_class());
		$this->load->model('M_ormawa', 'ormawa');
		$this->load->model('M_fakultas', 'fakultas');
		$this->load->model('M_auth', 'auth');

		if (!is_login()) {
			redirect(base_url('auth'));
		}

		if (!is_moderator() || !is_admin()) {
			redirect('dashboard');
		}
	}

	// Datatable
	public function index() {
		$data['url']            = base_url($this->class);
    $data['contents'] 			= $this->class.'/index';
		$this->load->view('master', $data);
	}

	public function json(){
		$value = $this->_postvalue();
		$json = [
			'draw'              => $this->input->post('draw'),
			'recordsTotal'      => $value['data']['total_record'],
			'recordsFiltered'   => $value['data']['total_filtered']
		];

		$data = array();

		$i = $_POST['start'];
		foreach ($value['data']['result'] as $k => $v) {
			$i++;
			$row = array();
			$row[] = $i;
			$row[] = "<img src='{$v['logo']}' class='img-fluid' width='100px'>";
			$row[] = $v['nama_ormawa'];
			
			if ($v['nama_fakultas'] == '' || $v['nama_fakultas'] == null) {
				$row[] = 'Ormawa Universitas';
			} else {
				$row[] = $v['nama_fakultas'];
			}
			$row[] = $v['nama_lengkap'];
			$data[] = $row;
		}

		$json['data'] = $data;

		echo json_encode($json);
	}

	private function _postvalue($paging = TRUE) {
		$params = [
			'offset'    => $this->input->post('start'),
			'limit'     => $this->input->post('length'),
			'search'    => $this->input->post('search')['value'],
		];

		if (!$paging) {
			unset($params['offset']);
			unset($params['limit']);
		}

		if ($_POST['order']['0']['column']) {
			$params['order_column'] = $_POST['order']['0']['column'] ? $_POST['order']['0']['column'] : '2';
		}

		if ($_POST['order']['0']['dir']) {
			$params['order_dir'] = $_POST['order']['0']['dir'] ? $_POST['order']['0']['dir'] : 'asc';
		}
		return $this->ormawa->get_serverside($params);
	}

	private function _getvalue($paging = TRUE) {
		$params = [
			'offset'    => $this->input->get('start'),
			'limit'     => $this->input->get('length'),
			'search'    => $this->input->get('search')['value'],
		];

		if (!$paging) {
			unset($params['offset']);
			unset($params['limit']);
		}

		return $this->ormawa->get_serverside($params);
	}
	// ./Datatable

	// Tambah
	public function add() {
		$data['url']            = base_url($this->class);
		$data['fakultas']				= $this->fakultas->get_fakultas();
    $data['contents'] 			= $this->class.'/add';
		$this->load->view('master', $data);
	}

	public function add_proccess() {
		$data = array('success' => false, 'message' => array());

		$this->form_validation->set_rules('nama_ormawa', 'Nama Ormawa', 'required');
		$this->form_validation->set_rules('fakultas_id', 'Fakultas', 'required');
		$this->form_validation->set_rules('user_id', 'Pengurus', 'required');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback text-danger">', '</div>');

		if ($this->form_validation->run() == FALSE) {
			foreach ($_POST as $key => $value) {
				$data['message'][$key] = form_error($key);
			}
		} else {
			$params = $this->input->post();

			$foto = $this->input->post('photo');
			$params['logo'] = '';

			if ($foto != '') {
				list($type, $foto) = explode(';', $foto);
				list(, $foto)      = explode(',', $foto);
				$foto = base64_decode($foto);

				$params['logo'] = './assets/images/logo_ormawa/'.date('Ymdhis').'.png';
				file_put_contents($params['logo'], $foto);
			}
			unset($params['photo']);
			$this->ormawa->add_proccess($params);

			$cek_role_pengurus = $this->auth->get_user_role_data(['id' => $params['user_id']]);
			if (!in_array(2, $cek_role_pengurus)) {
				array_push($cek_role_pengurus, 2);
				$pengurus['id'] 	= $params['user_id'];
				$pengurus['roles'] = $cek_role_pengurus;

				$this->auth->insert_user_role_data($pengurus); 
			}

			$data['success'] 	= true;
			$data['msg']		 	= 'Data Berhasil Disimpan';
			$data['redirect'] = base_url('ormawa');
		}

		echo json_encode($data);
	}

	public function get_users() {
		$users = $this->ormawa->get_pengurus_select2($this->input->post());
    $result = [
      'results'     => $users,
      'pagination'  => [
        'more'  => true
      ],
      'count_filtered' => count($users)
    ];
    echo json_encode($result);
	}

}

/* End of file C_ormawa.php */
/* Location: ./application/controllers/C_ormawa.php */