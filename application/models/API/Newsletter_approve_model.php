<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Newsletter_approve_model extends CI_Model {

	function get_client_id($id_client){
		$this->db->select('id_newsletter');
		$this->db->from('newsletter_general_info');
		$this->db->where(array('id_newsletter'=>$id_client, 'deleted'=>'0'));
		return $this->db->get()->row_array();
	}

	function get_client_data($id_client){
		$this->db->select('ng.name, ng.id_newsletter, ng.consultant_number');
		$this->db->from('newsletter_general_info AS ng');
		$this->db->join('newsletter_other_details AS no', 'no.id_newsletter=ng.id_newsletter', 'left');
		$this->db->where(array('ng.id_newsletter'=>$id_client, 'no.design_approve_status !='=>'1'));
		return $this->db->get()->row_array();
	}

	function update_design_approve_status($id_newsletter, $design_approve_status){
		$date = date("Y-m-d H:i:s");

		$this->db->set('updated_at', $date);
		$this->db->where('id_newsletter', $id_newsletter);
		$res = $this->db->update('newsletter_general_info');

		if ($res==TRUE) {
			$this->db->set( array('design_approve_status'=>$design_approve_status, 'approved_date'=>date("Y-m-d") ) );
			$this->db->where('id_newsletter', $id_newsletter);
			return $this->db->update('newsletter_other_details');			
		}
	}

}

?>