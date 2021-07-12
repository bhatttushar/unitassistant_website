<?php
class Excel_export_model extends CI_Model{

	function fetch_director_data($id_newsletter){
		$date = date("m-d-y");
		if (isset($id_newsletter) && !empty($id_newsletter)) {
			$this->db->select('hg.*, hd.*, hp.*, ho.design_approve_status');
			$this->db->from('history_general_info AS hg');
			$this->db->join('history_design_info AS hd', 'hd.id_history=hg.id_history', 'left');
			$this->db->join('history_packaging AS hp', 'hp.id_history=hg.id_history', 'left');
			$this->db->join('history_other_details AS ho', 'ho.id_history=hg.id_history', 'left');
			$this->db->where(array('hg.deleted'=>'0', 'hg.id_newsletter'=>$id_newsletter, 'hd.consultant_two1 !='=>'X'));
			$this->db->group_by('hg.id_history');
			$this->db->order_by('hg.name', 'ASC');
		}else{
			$this->db->select('ng.*, nd.*, np.*, no.design_approve_status');
			$this->db->from('newsletter_general_info AS ng');
			$this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
			$this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
			$this->db->join('newsletter_other_details AS no', 'no.id_newsletter=ng.id_newsletter', 'left');
			$this->db->where(array('ng.deleted'=>'0'));
	    	$this->db->where("(ng.contract_update_date ='' OR ng.contract_update_date >".$date.")", NULL, FALSE);	
	    	$this->db->order_by('ng.name', 'ASC');
	    	$this->db->query('SET SQL_BIG_SELECTS=1');
		}
		return $this->db->get()->result_array();
	}
	
}