<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class User_model extends CI_Model {

	function getAppVersion() {
		return  $this->db->get('versions')->row_array();
	}

	function getNewsInfo($consultant_number) {
		$this->db->select('ng.id_newsletter, ng.name, ng.cell_number, ng.email, ng.intouch_password, ng.dob, nd.beatly_url, nd.beatly_url_one, nd.beatly_url_two, np.cu_routing, np.cv_account, no.app_login');
		$this->db->from('newsletter_general_info AS ng');
		$this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
		$this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
		$this->db->join('newsletter_other_details AS no', 'no.id_newsletter=ng.id_newsletter', 'left');
		$this->db->where(array('ng.consultant_number'=>$consultant_number, 'ng.deleted'=>'0'));
		$this->db->query('SET SQL_BIG_SELECTS=1');
		return $this->db->get()->row_array();
	}

	function getAdminInfo(){
		$this->db->select('email, telephone');
		$this->db->from('admin');
		$this->db->where(array('id_admin'=>'1', 'deleted'=>'0'));
		return $this->db->get()->row_array();
	}

	function addFCM($consultant_number, $device_type, $id_fcm, $id_device){
		$this->db->select('id');
		$this->db->from('devices');
		$this->db->where(array('consultant_number'=>$consultant_number, 'device_type'=>$device_type));
		$get_id = $this->db->get()->row_array();

		$data = array('id_fcm'=>$id_fcm, 'id_device'=>$id_device, 'device_type'=>$device_type, 'consultant_number'=>$consultant_number);
		if (empty($get_id)) {
			$this->db->insert('devices', $data);
			return $this->db->insert_id();
		}else{
			$this->db->set($data);
			$this->db->where('id', $get_id['id']);
			return $this->db->update('devices');
		}
	}

	function addEmailRecords($id_newsletter, $device, $msg){
		$date=date("Y-m-d H:i:s");
		$data = array('userby'=>'0', 'userto'=>'0', 'id_newsletter'=>$id_newsletter, 'id_cc_newsletter'=>'0', 'id_admin'=>'1', 'purpose'=>'Logged in from '.$device, 'detail'=>$msg, 'created_at'=>$date, 'updated_at'=>$date);
		$this->db->insert('email_records', $data);
		return $this->db->insert_id();
	}

	

	function editAppLastLogin($id_newsletter){
		$date = date("Y-m-d H:i:s");
		$res = $this->edit_updated_at($id_newsletter, $date); 
		if ($res == true) {
			$this->db->set('app_last_login', $date);
			$this->db->where('id_newsletter', $id_newsletter);
			return $this->db->update('newsletter_other_details');
		}
	}

	function editAppLogin($id_newsletter){
		$date = date("Y-m-d H:i:s");
		$res = $this->edit_updated_at($id_newsletter, $date); 
		if ($res == true) {
			$this->db->set('app_login', '1');
			$this->db->where('id_newsletter', $id_newsletter);
			return $this->db->update('newsletter_other_details');
		}
	}

	function edit_updated_at($id_newsletter, $date){
		$this->db->set('updated_at', $date);
		$this->db->where('id_newsletter', $id_newsletter);
		return $this->db->update('newsletter_general_info');
	}

	function getDeviceInfo($id_fcm, $id_device, $device_type){
		$this->db->select('id');
		$this->db->from('devices');
		$this->db->where('id_fcm', $id_fcm)->or_where('id_device', $id_device);
		$this->db->where('device_type', $device_type);
		$data = $this->db->get()->row_array();
		
		$details = array('id_fcm'=>$id_fcm, 'id_device'=>$id_device, 'device_type'=>$device_type);

		if (empty($data)) {
			$this->db->insert('devices', $details);
			$res = $this->db->insert_id();
			if ($res > 0) {
				$result = 'insert';
			}
		}else{
			$this->db->set($details);
			$this->db->where('id', $data['id']);
			$res = $this->db->update('devices');
			if ($res == true) {
				$result = 'update';
			}
		}
		return $result;
	}

	function get_bitly_data($id_newsletter){
		$this->db->select('nd.beatly_url, nd.beatly_url_one, nd.beatly_url_two, np.digital_biz_link');
		$this->db->from('newsletter_general_info as ng');
		$this->db->join('newsletter_design_info as nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
		$this->db->join('newsletter_packaging as np', 'np.id_newsletter=ng.id_newsletter', 'left');
		$this->db->where(array('ng.id_newsletter'=>$id_newsletter, 'ng.deleted'=>'0'));
		return $this->db->get()->row_array();
	}

	function get_ncp_data($id_newsletter){
		$this->db->select('nd.ncp_link_en, nd.ncp_link_sp, nd.ncp_link_fr');
		$this->db->from('newsletter_general_info as ng');
		$this->db->join('newsletter_design_info as nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
		$this->db->where(array('ng.id_newsletter'=>$id_newsletter, 'ng.deleted'=>'0'));
		return $this->db->get()->row_array();
	}

	function getUACCInfo($consultant_number) {
		$this->db->select('id_cc_newsletter, name, cell_number, email, dob, intouch_password, cv_account, cv_account, cu_routing, app_login');
		$this->db->from('cc_newsletters');
		$this->db->where(array('consultant_number'=>$consultant_number, 'deleted'=>'0'));
		return $this->db->get()->row_array();
	}

	function editUACCAppLogin($id_cc_newsletter){
		$this->db->set(array('app_login'=>'1', 'updated_at'=>date("Y-m-d H:i:s")));
		$this->db->where('id_cc_newsletter', $id_cc_newsletter);
		return $this->db->update('cc_newsletters');
	}

	function editUACCAppLastLogin($id_cc_newsletter){
		$this->db->set(array('app_last_login'=>date("Y-m-d H:i:s"), 'updated_at'=>date("Y-m-d H:i:s")));
		$this->db->where('id_cc_newsletter', $id_cc_newsletter);
		return $this->db->update('cc_newsletters');
	}

	function addUACCEmailRecords($id_cc_newsletter, $device, $msg){
		$date=date("Y-m-d H:i:s");
		$data = array('userby'=>'0', 'userto'=>'0', 'id_newsletter'=>'0', 'id_cc_newsletter'=>$id_cc_newsletter, 'id_admin'=>'1', 'purpose'=>'Logged in from '.$device, 'detail'=>$msg, 'created_at'=>$date, 'updated_at'=>$date);
		$this->db->insert('email_records', $data);
		return $this->db->insert_id();
	}

	function updateUACCFCM($id_cc_newsletter, $fcm, $app){
		$this->db->set(array('fcm'=>$fcm, 'app'=>$app));
		$this->db->where('id_cc_newsletter', $id_cc_newsletter);
		return $this->db->update('cc_newsletters');
	}

	function getTBPInfo($loginid) {
		$this->db->select('id_blastpro, name, phone, email, password, address, c_city, state, city, zip, website, facebook, referred, routing_no, account_no');
		$this->db->from('blastpro');
		$this->db->where(array('loginid'=>$loginid, 'deleted'=>'0'));
		return $this->db->get()->row_array();
	}


}

?>