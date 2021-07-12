<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Admin_model extends CI_Model {

	function login($username, $password) {
		$data = $this->db->get_where('admin', array('user_name' => $username, 'deleted'=>'0'))->result_array();
		
		if (!empty($data)) {
			$sPassword = sha1($data[0]['salt'].$password);
			if ($sPassword == $data[0]['password']) {
				return $data;
			} else {
				return array();
			}
		} else {
			return array();
		}
	}
	
}

?>