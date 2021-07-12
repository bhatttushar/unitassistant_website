<?php
class User_track_export_model extends CI_Model{

	function get_whole_track($id_user){
		$this->db->select('l.login_time, l.logout_time, l.total_time, l.created_at, u.first_name');
		$this->db->from('user_logs AS l');
		$this->db->join('users AS u', 'u.id_user=l.id_user', 'left');
		$this->db->where(array('u.activated'=>'1', 'u.deleted'=>'0', 'l.id_user'=>$id_user));
		$this->db->order_by('l.created_at', 'DESC');
		return $this->db->get()->result_array();
	}

	function get_track_data($id_user, $weekly=""){
		$sAndWhere  = " 1 = 1";
		$sAndWhere .= " AND u.activated = '1' AND u.deleted = '0' "; 
		$sAndWhere .= " AND l.id_user = '".$id_user."'"; 

		if (!empty($weekly)) {
			$sAndWhere .= " AND DATE(l.created_at) >=  DATE_SUB(DATE(NOW()), INTERVAL DAYOFWEEK(NOW())+7 DAY)";
		}


		$this->db->select('l.created_at, count(l.login_time) AS login_count, count(l.logout_time) AS logout_count, u.first_name');
		$this->db->from('user_logs AS l');
		$this->db->join('users AS u', 'u.id_user=l.id_user', 'left');
		$this->db->where($sAndWhere);
		$this->db->group_by('DATE(l.created_at)');
		$this->db->order_by('l.created_at', 'DESC');
		return $this->db->get()->result_array();
	}

	


	
}