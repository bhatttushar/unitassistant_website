<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class User_profile_model extends CI_Model {

	function get_client_id($id_client){
		$this->db->select('id_newsletter');
		$this->db->from('newsletter_general_info');
		$this->db->where(array('id_newsletter'=>$id_client, 'deleted'=>'0'));
		return $this->db->get()->row_array();
	}

	function edit_profile($data){
		$details = 
			array(
				'name'=>$data['name'], 
				'cell_number'=>$data['cell_number'], 
				'email'=>$data['email'],
				'dob'=>$data['dob'],
				'updated_at'=> date('Y-m-d H:i:s')
			);

		$this->db->set($details);
		$this->db->where('id_newsletter', $data['id_client']);
		$res = $this->db->update('newsletter_general_info');

		if ($res == true) {
			$this->db->set(array('cu_routing'=>$data['routing'], 'cv_account'=>encryptIt($data['account']) ));
			$this->db->where('id_newsletter', $data['id_client']);
			return $this->db->update('newsletter_packaging');
		}
	}

	function getAdminInfo(){
		$this->db->select('email, telephone');
		$this->db->from('admin');
		$this->db->where(array('id_admin'=>'1', 'deleted'=>'0'));
		return $this->db->get()->row_array();
	}

	function get_uacc_client_id($id_client){
		$this->db->select('id_cc_newsletter');
		$this->db->from('cc_newsletters');
		$this->db->where(array('id_cc_newsletter'=>$id_client, 'deleted'=>'0'));
		return $this->db->get()->row_array();
	}

	function checkEmailExists($email, $id_client, $uacc="", $tbp=""){
		$this->db->select('email');
		
		if (!empty($uacc)) {
			$this->db->from('cc_newsletters');
			$this->db->where('id_cc_newsletter !=', $id_client);
		}elseif (!empty($tbp)) {
			$this->db->from('blastpro');
			$this->db->where('id_blastpro !=', $id_client);
		}else{
			$this->db->from('newsletter_general_info');
			$this->db->where('id_newsletter !=', $id_client);
		}

		$this->db->where('email', $email);
		$this->db->where('deleted', '0');
		return $this->db->get()->num_rows();		
	}

	function edit_uacc_profile($data){
		$details = 
			array(
				'name'=>$data['name'], 
				'cell_number'=>$data['cell_number'], 
				'email'=>$data['email'],
				'dob'=>$data['dob'],
				'cu_routing'=>$data['routing'],
				'cv_account'=> encryptIt( $data['account'] ),
				'updated_at'=> date('Y-m-d H:i:s')
			);

		$this->db->set($details);
		$this->db->where('id_cc_newsletter', $data['id_client']);
		return $this->db->update('cc_newsletters');
	}

	function get_tbp_client_id($id_client){
		$this->db->select('id_blastpro');
		$this->db->from('blastpro');
		$this->db->where(array('id_blastpro'=>$id_client, 'deleted'=>'0'));
		return $this->db->get()->row_array();
	}

	function edit_tbp_profile($data){
		$details = 
			array(
				'c_city'=>$data['company_city'],
				'name'=>$data['name'],
				'address'=>$data['address'],
				'city'=>$data['city'],
				'state'=>$data['state'],
				'zip'=>$data['zip'],
				'email'=>$data['email_address'],
				'phone'=>$data['cell_phone_number'],
				'account_no'=>$data['account_no'],
				'routing_no'=>$data['routing'],
				'website'=>$data['website'],
				'facebook'=>$data['facebook'],
				'referred'=>$data['referred'],
				'updated_at'=> date('Y-m-d H:i:s')
			);

		$this->db->set($details);
		$this->db->where('id_blastpro', $data['id_client']);
		return $this->db->update('blastpro');
	}

}

?>