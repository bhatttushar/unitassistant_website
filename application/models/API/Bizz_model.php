<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Bizz_model extends CI_Model {

	function get_bizz_data($id_cc_newsletter){
		$this->db->select('digital_biz_link');
		$this->db->from('cc_newsletters');
		$this->db->where(array('id_cc_newsletter'=>$id_cc_newsletter, 'deleted'=>'0'));
		return $this->db->get()->row_array();
	}

}

?>