<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Change_model extends CI_Model {

	function get_client_id($id_client){
		$this->db->select('id_newsletter');
		$this->db->from('newsletter_general_info');
		$this->db->where(array('id_newsletter'=>$id_client, 'deleted'=>'0'));
		return $this->db->get()->row_array();
	}

	function add_to_changes($id_newsletter, $names){
		$date = date("Y-m-d H:i:s");
		$data=array('id_newsletter'=>$id_newsletter, 'names'=>$names, 'created_at'=>$date, 'updated_at'=>$date);
		$this->db->insert('changes', $data);
		return $this->db->insert_id();
	}

	function add_to_changes_files($id_newsletter, $id_change, $file){
		$date = date("Y-m-d H:i:s");
		$data=array('id_newsletter'=>$id_newsletter, 'id_change'=>$id_change, 'file'=>$file, 'created_at'=>$date, 'updated_at'=>$date);
		return $this->db->insert('changes_files', $data);
	}

	function update_design_approve_status($id_newsletter, $design_approve_status){
		$date = date("Y-m-d H:i:s");

		$this->db->set('updated_at', $date);
		$this->db->where('id_newsletter', $id_newsletter);
		$res = $this->db->update('newsletter_general_info');

		if ($res==TRUE) {
			$this->db->set('design_approve_status', $design_approve_status);
			$this->db->where('id_newsletter', $id_newsletter);
			$this->db->update('newsletter_other_details');			

			$this->db->set('review_date', $date);
			$this->db->where('id_newsletter', $id_newsletter);
			$this->db->update('newsletter_packaging');			
		}
	}

	function get_name($id_newsletter){
		$this->db->select('ng.name');
		$this->db->from('changes AS c');
		$this->db->join('newsletter_general_info AS ng', 'ng.id_newsletter=c.id_newsletter', 'left');
		$this->db->where('c.id_newsletter', $id_newsletter);
		return $this->db->get()->row_array();
	}

}

?>