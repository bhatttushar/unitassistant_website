<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Response_token_model extends CI_Model {

	function get_response_token($id_device){
		$this->db->select('id_response_token');
		$this->db->from('response_token');
		$this->db->where('id_device', $id_device);
		return $this->db->get()->num_rows();
	}

	function add_response_token($data){
		$details = array('id_device'=>$data['id_device'], 'id_user'=>$data['id_user'], 'platform'=>$data['platform']);
		return $this->db->insert('response_token', $details);
	}

	function update_response_token($data){
		$details = array('id_device'=>$data['id_device'], 'id_user'=>$data['id_user'], 'platform'=>$data['platform']);
		$this->db->set($details);
		$this->db->where('id_device', $data['id_device']);
		return $this->db->update('response_token');
	}

}

?>