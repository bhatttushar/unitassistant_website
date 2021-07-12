<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Front_model extends CI_Model {

	function loginMe($username, $password) {
		$this->db->select('id_user, user_name, first_name, last_name, email, password, salt, profile_pic');
		$this->db->from('users');
		$this->db->where(array('user_name' => $username, 'is_loggedin'=> '0', 'deleted'=>'0'));
		$data = $this->db->get_where()->row();

		if (!empty($data)) {
			if (sha1($data->salt.$password) == $data->password) {
				return $data;
			} else {
				return array();
			}
		} else {
			return array();
		}
	}

	function set_logged_in_true($id_user){
		$data = array('updated_at'=>date('Y-m-d H:i:s'), 'is_loggedin'=>'1');
		$this->db->set($data);
		$this->db->where('id_user', $id_user);
		return $this->db->update('users');
	}

	function set_logged_out($id_user){
		$data = array('updated_at'=>date('Y-m-d H:i:s'), 'is_loggedin'=>'0');
		$this->db->set($data);
		$this->db->where('id_user', $id_user);
		return $this->db->update('users');
	}

	function notes_listing($data, $row, $rowperpage) {
        $date = date("m-d-y");
        $this->db->select("id_note");
        $this->db->from('notes');
        $this->db->where('deleted', '0');
        $totalRecords = $this->db->get()->num_rows();

        $this->db->select('n.note, n.created_date, r.name');
		$this->db->from('notes AS n');
		$this->db->join('newsletter_general_info AS r', 'r.id_newsletter=n.id_newsletter', 'left');
		$this->db->where(array('r.deleted'=>'0', 'n.deleted'=>'0'));
		$this->db->order_by('n.id_note', 'DESC');
		$this->db->limit($rowperpage, $row);
        $query = $this->db->get();
        $data = $query->result_array();
        $totalRecordwithFilter = count($data);

        return array('details'=>$data, 'query'=>$query, 'total_records'=>$totalRecords, 'total_record_filter'=>$totalRecordwithFilter);
  	}

  	function get_search_notes_by_tags($sStrings, $sTodate, $sFromdate){

	    $dTodate = $dFromdate = "";
	    if(strtotime($sTodate) > 0){
	        $dTodate = date("Y-m-d", strtotime($sTodate));
	    }

	    if(strtotime($sFromdate) > 0){
	        $dFromdate = date("Y-m-d", strtotime($sFromdate));
	    }

	    $sAndWhere  = " 1 = 1";
	    if(($sFromdate != "")  && ($sTodate!="")){
	        $sAndWhere .= " AND n.created_date between '".$dTodate."' AND '".$dFromdate."'";
	    }elseif($sFromdate != ""){
	       $sAndWhere .= " AND n.created_date = '".$dFromdate."'";
	    }elseif($sTodate != ""){
	       $sAndWhere .= " AND n.created_date = '".$dTodate."'";
	    }

	    if($sStrings != ""){
	    	$sql = array();
  			foreach ($sStrings as $key => $val) {
		        $aString = explode('#', $val);
		        $val = $aString[1];
		        $sql[] = 'n.note LIKE '."'%$val%'";
		    }	
	        $sAndWhere .= " AND ".implode($sql);
	    }

	    $sAndWhere .= " AND r.deleted=0";

	    $this->db->select('n.note, n.created_date, r.name');
		$this->db->from('notes AS n');
		$this->db->join('newsletter_general_info AS r', 'r.id_newsletter=n.id_newsletter', 'left');
		$this->db->where($sAndWhere);
		$this->db->order_by('n.id_note', 'DESC');
		return $this->db->get()->result_array();
  	}

  	function emails_listing($data, $row, $rowperpage) {
  		$sAndWhere  = " 1 = 1";
	    $sAndWhere .= " AND e.id_admin = 0";
	    $sAndWhere .= " AND e.userby = '".$this->session->userdata('id_user')."'";

        $date = date("m-d-y");
        $this->db->select("id_email_record");
        $this->db->from('email_records AS e');
        $this->db->where($sAndWhere);
        $totalRecords = $this->db->get()->num_rows();

        $this->db->select('e.id_newsletter, e.id_cc_newsletter, e.userto, e.userby, e.purpose, e.created_at');
		$this->db->from('email_records AS e');
		$this->db->join('users AS u', 'u.id_user=e.userto', 'left');
		$this->db->where($sAndWhere);
		$this->db->order_by('e.created_at', 'DESC');
		$this->db->limit($rowperpage, $row);
        $query = $this->db->get();
        $data = $query->result_array();
        $totalRecordwithFilter = count($data);

        return array('details'=>$data, 'query'=>$query, 'total_records'=>$totalRecords, 'total_record_filter'=>$totalRecordwithFilter);
  	}

  	function get_user_data($id_user){
  		$this->db->select('user_name, first_name, last_name, password, salt, email, gender, address, phone, dob, profile_pic');
  		$this->db->from('users');
  		$this->db->where('id_user', $id_user);
  		return $this->db->get()->row_array();
  	}

  	function edit_user_profile($data, $id_user, $sSalt, $sSaltPassword, $profile_img){

  		$dDate = strtr($data['dob'], '/', '-');
		$dDob = date('Y-m-d', strtotime($dDate));

  		$data = array(
  			'first_name'=>$data['first_name'],
  			'last_name'=>$data['last_name'],
  			'password'=>$sSaltPassword,
  			'salt'=>$sSalt,
  			'gender'=>$data['gender'],
  			'address'=>$data['address'],
  			'phone'=>$data['phone'],
  			'dob'=>$dDob,
  			'profile_pic'=>$profile_img,
  			'updated_at'=>date('Y-m-d H:i:s')
  		);

  		$this->db->where('id_user', $id_user);
  		return $this->db->update('users', $data);
  	}


}

?>