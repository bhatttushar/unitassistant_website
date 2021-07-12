<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class User_model extends CI_Model {

	function userListing() {
		$this->db->select('id_user, user_name, first_name, last_name, email, is_loggedin, created_at');
		$this->db->from('users');
		$this->db->where('deleted', '0');
		$this->db->order_by('created_at', 'DESC');
		return $this->db->get()->result_array();
	}

	function checkEmailExists($email, $userId = 0){
        $this->db->select("email");
        $this->db->from("users");
        $this->db->where(array('deleted'=>'0', 'email'=>$email));   
        if($userId != 0){
            $this->db->where("id_user !=", $userId);
        }
        return $this->db->get()->row_array();
    }

	function add_user($userInfo) {
		$userInfo['created_at'] = date("Y-m-d H:i:s");
		$userInfo['updated_at'] = date("Y-m-d H:i:s");
		$this->db->insert('users', $userInfo);
		return $this->db->insert_id();
	}

	function getUserInfo($userId) {
		$this->db->select('id_user, user_name, first_name, last_name, email, gender');
		$this->db->from('users');
		$this->db->where('id_user', $userId);
		return $this->db->get()->row_array();
	}

	function edit_user($userInfo) {
		$userInfo['updated_at'] = date('Y-m-d H:i:s');
		$this->db->set($userInfo);
		$this->db->where('id_user', $userInfo['id_user']);
		$this->db->update('users');
		return TRUE;
	}

	function deleteUser($userId) {
		$this->db->set(array('deleted' => '1', 'updated_at' => date('Y-m-d H:i:s')));
		$this->db->where('id_user', $userId);
		$this->db->update('users');
		return $this->db->affected_rows();
	}

	function deleteAllUser($id_users) {
		$this->db->set(array('deleted' => '1', 'updated_at' => date('Y-m-d H:i:s')));
		$this->db->where_in('id_user', $id_users);
		$this->db->update('users');
		return $this->db->affected_rows();
	}

	function update_loggedin($id_user){
		$this->db->set(array('is_loggedin'=>'0', 'updated_at'=>date('Y-m-d H:i:s') ));
		$this->db->where('id_user', $id_user);
		return $this->db->update('users');
	}

	function get_admin(){
		$this->db->select('user_name');
		$this->db->from('users');
		$this->db->where('deleted', '0');
		return $this->db->get()->row()->user_name;
	}

	function get_user_data($id_user){
		$this->db->select('first_name, last_name, user_name, email, salt');
		$this->db->from('users');
		$this->db->where(array('activated'=>'1', 'deleted'=>'0', 'id_user'=>$id_user));
		return $this->db->get()->row_array();
	}

	function update_user_password($password, $id_user){
		$this->db->set('password', $password);
		$this->db->where('id_user', $id_user);
		return $this->db->update('users');
	}

	function add_to_mail_record($id_user){
		$date = date("Y-m-d H:i:s");
		$data=array('userto'=>$id_user,'id_admin'=>'1','purpose'=>'Reset Password','created_at'=>$date,'updated_at'=>$date);
		$this->db->insert('email_records', $data);
		return $this->db->insert_id();
	}

	function getLogsDetails($nUserId){
		date_default_timezone_set('Asia/Kolkata');
		$this->db->select('l.login_time, l.logout_time, l.total_time, l.created_at, u.first_name, u.last_name');
		$this->db->from('user_logs as l');
		$this->db->join('users as u', 'u.id_user=l.id_user', 'left');
		$this->db->where(array('u.activated'=>'1', 'u.deleted'=>'0', 'l.id_user'=>$nUserId));
		$this->db->order_by('l.created_at', 'DESC');
		return $this->db->get()->result_array();
	}

	function getDayLogsDetails($nUserId){
		date_default_timezone_set('Asia/Kolkata');

		// Daily logs detail
		$this->db->select('l.login_time, l.logout_time, l.total_time, l.created_at, count(l.login_time) AS login_count, u.first_name, u.last_name');
		$this->db->from('user_logs as l');
		$this->db->join('users as u', 'u.id_user=l.id_user', 'left');
		$this->db->where(array('u.activated'=>'1', 'u.deleted'=>'0', 'l.id_user'=>$nUserId));
		$this->db->group_by('DATE(l.created_at)');
		$this->db->order_by('l.created_at', 'DESC');
		return $this->db->get()->result_array();
	}

	function getTimeDetails($nUserId){
		$this->db->select('l.total_time');
		$this->db->from('user_logs AS l');
		$this->db->join('users AS u', 'u.id_user=l.id_user', 'left');
		$this->db->where(array('u.activated'=>'1', 'u.deleted'=>'0', 'l.id_user'=>$nUserId));
		$aTimes = $this->db->get()->result_array();

		$sum = 0;
	    $sum2=0;
	    foreach ($aTimes as $values){
	        foreach ($values as $key => $value) {
	            $sum1= (int)$value-$sum;
	            $sum2 = $sum2+$sum1;
	        }   
	    }

	    $sum4=$sum+$sum2;
	    $sumTotal = $sum4/1000; 
	    return $sumTotal;
	}

	
}

?>