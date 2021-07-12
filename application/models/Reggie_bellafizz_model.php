<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Reggie_bellafizz_model extends CI_Model {

  	function add_to_bellafizz($data){
  		$this->db->insert('bellafizz', $data);
  		return $this->db->insert_id();
  	}

  	function checkReggieEmailExists($email){
        $this->db->select('email');
        $this->db->from('bellafizz');
        $this->db->where('email', $email);
        $Count = $this->db->get()->num_rows(); 
        return ($Count > 0) ? 'Email Address must be unique!!' : '0';
    }

    function checkRepIdExists($rep_id){
        $this->db->select('rep_id');
        $this->db->from('bellafizz');
        $this->db->where('rep_id', $rep_id);
        $Count = $this->db->get()->num_rows(); 
        return ($Count > 0) ? 'Rep ID must be unique!!' : '0';
    }

}