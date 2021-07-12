<?php
class Unsub_export_model extends CI_Model{

	function get_unsub_director(){
		
		$sAndWhere  = " 1 = 1";
	    $sAndWhere .= " AND ng.contract_update_date !=''";
	    $sAndWhere .= " AND nd.package_for = 'C'";
	    $sAndWhere .= " AND ng.deleted = '1'";
	    $sAndWhere .= " AND ng.contract_update_date < DATE_SUB(NOW(), INTERVAL 90 DAY)";

		$this->db->select('ng.*, nd.*, np.*, no.design_approve_status');
		$this->db->from('newsletter_general_info AS ng');
		$this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
		$this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
		$this->db->join('newsletter_other_details AS no', 'no.id_newsletter=ng.id_newsletter', 'left');
		$this->db->where($sAndWhere);
    	$this->db->order_by('ng.name', 'ASC');
		return $this->db->get()->result_array();
	}
	
}