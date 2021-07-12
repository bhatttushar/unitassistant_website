<?php
class UACC_excel_export_model extends CI_Model{

	function fetch_uacc_data($id_cc_newsletter){
		$table = empty($id_cc_newsletter) ? 'cc_newsletters' : 'cc_histories';
		$where = empty($id_cc_newsletter) ? array('deleted'=>'0', 'cc'=>'Y') : array('deleted'=>'0', 'cc'=>'Y', 'id_cc_newsletter'=>$id_cc_newsletter);
		$order_by = empty($id_cc_newsletter) ? 'name ASC' : 'created_at DESC';

		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
    	$this->db->order_by($order_by);
		return $this->db->get()->result_array();
	}

	function get_unsub_uacc(){
		$sAndWhere  = " 1 = 1";
		$sAndWhere .= " AND contract_update_date !=''";
		$sAndWhere .= " AND deleted= '1' ";
		$sAndWhere .= " AND DATE(contract_update_date) < DATE_SUB(NOW(), INTERVAL 90 DAY)";

		$this->db->select('*');
		$this->db->from('cc_newsletters');
		$this->db->where($sAndWhere);
    	$this->db->order_by('name', 'ASC');
		return $this->db->get()->result_array();
	}
	
}