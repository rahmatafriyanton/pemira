<?php 

	function is_admin() {
		$ci = get_instance();
    if (in_array(3, $ci->session->userdata('roles'))) {
        return true;
    }else{
        return false;
    }
	}


	function is_moderator() {
		$ci = get_instance();
    if (in_array(2, $ci->session->userdata('roles'))) {
        return true;
    }else{
        return false;
    }
	}

	function is_user() {
		$ci = get_instance();
    if (in_array(1, $ci->session->userdata('roles'))) {
        return true;
    }else{
        return false;
    }
	}


	function is_login() {
		$ci = get_instance();
		if ($ci->session->userdata('email') != '') {
			return true;
		}

		return false;
	}

 ?>