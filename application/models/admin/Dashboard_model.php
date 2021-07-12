<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Dashboard_model extends CI_Model {

	function get_future_clients(){
		$date = date("m-d-y");
	    $sAndWhere  = " 1 = 1";
	    $sAndWhere .= " AND fd.package_for='F'";
	    $sAndWhere .= " AND fd.future_package_date >= '".$date."'";
	    $sAndWhere .= " AND fg.deleted = '0'";

		$this->db->select("fg.id_newsletter");
		$this->db->from('future_general_info AS fg');
	    $this->db->join('future_design_info AS fd', 'fd.id_future_newsletter=fg.id_future_newsletter');
	    $this->db->where($sAndWhere);
	    return $this->db->get()->num_rows();
	}

	function getReports(){
	    $this->db->select('ng.name, r.nsd_client, r.updated_at');
	    $this->db->from('reports AS r');
	    $this->db->join('newsletter_general_info AS ng', 'ng.id_newsletter=r.id_newsletter', 'left');
	    $this->db->where('deleted', '0');
	    return $this->db->get()->result_array();
	}

	function getNewsletterReports(){
	    $this->db->select('r.hidden_newsletter, r.cv_account, r.cu_routing, r.updated_at, ng.name');
	    $this->db->from('newsletter_design_reports AS r');
	    $this->db->join('newsletter_general_info AS ng', 'ng.id_newsletter=r.id_newsletter', 'left');
	    $this->db->where('ng.deleted', '0');
	    return $this->db->get()->result_array();
	}

	function get_newsletter_design_status(){
	    $this->db->select('ng.name, nd.design_one, no.design_approve_status, u.user_name');
	    $this->db->from('users AS u');
	    $this->db->join('newsletter_general_info AS ng', 'ng.id_user=u.id_user', 'left');
	    $this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
	    $this->db->join('newsletter_other_details AS no', 'no.id_newsletter=ng.id_newsletter', 'left');
	    $this->db->where('ng.deleted','0');
	    $this->db->order_by('ng.created_at', 'DESC');
	    $this->db->query('SET SQL_BIG_SELECTS=1');
	    return $this->db->get()->result_array();
	}

	function get_requested_changes_data(){
	    $this->db->select('c.id_change, c.names, c.created_at, ng.name');
	    $this->db->from('changes AS c');
	    $this->db->join('newsletter_general_info AS ng', 'ng.id_newsletter=c.id_newsletter', 'left');
	    $this->db->where('ng.deleted','0');
	    $this->db->order_by('c.created_at', 'DESC');
	    return $this->db->get()->result_array();
	}

	function getChangesViewDetail($id_change){
	    $this->db->select('names');
	    $this->db->from('changes');
	    $this->db->where('id_change', $id_change);
	    return $this->db->get()->row_array();
	}

	function getChangesImage($id_change){
	    $this->db->select('file');
	    $this->db->from('changes_files');
	    $this->db->where('id_change', $id_change);
	    return $this->db->get()->result_array();
	}

	function get_email_setting(){
	    $this->db->select('email_setting');
	    $this->db->from('email_setting');
	    return $this->db->get()->row()->email_setting;
	}

	function change_email_setting($email_setting){
	    $this->db->set('email_setting', $email_setting);
	    $this->db->where('id_email_setting', '1');
	    return $this->db->update('email_setting');
	}

	function get_newsletter_message(){
	    $this->db->select('*');
	    $this->db->from('newsletter_messages');
	    return $this->db->get()->row_array();
	}

	function change_newsletter_message($data){
	    $this->db->set(array('english'=>$data['english'], 'spanish'=>$data['spanish'], 'french'=>$data['french']));
	    $this->db->where('id_newsletter_message', '1');
	    return $this->db->update('newsletter_messages');
	}

	function get_app_version(){
	    $this->db->select('*');
	    $this->db->from('versions');
	    return $this->db->get()->row_array();
	}


	function change_app_version($data){
	    $this->db->set($data);
	    $this->db->where('id_version', '1');
	    return $this->db->update('versions');
	}

	function getAdminEmailDetails(){
		$this->db->select('ng.id_newsletter AS id_newsletter_client, e.userto, e.purpose, e.created_at, u.id_user');
		$this->db->from('email_records AS e');
		$this->db->join('newsletter_general_info AS ng', 'e.id_newsletter=ng.id_newsletter', 'left');
		$this->db->join('users AS u', 'e.userto=u.id_user', 'left');
		$this->db->where('e.id_admin', '1');
		$this->db->order_by('e.created_at', 'DESC');
		return $this->db->get()->result_array();
	}

	function getUserEmailDetails(){
		$this->db->select('ng.id_newsletter AS id_newsletter_client, e.userto, e.userby, e.purpose, e.created_at, u.id_user');
		$this->db->from('email_records AS e');
		$this->db->join('newsletter_general_info AS ng', 'e.id_newsletter=ng.id_newsletter', 'left');
		$this->db->join('users AS u', 'e.userto=u.id_user', 'left');
		$this->db->where('e.id_admin', '0');
		$this->db->order_by('e.created_at', 'DESC');
		return $this->db->get()->result_array();
	}

	function getUACCAdminEmailDetails(){
		$this->db->select('n.id_cc_newsletter AS id_cc_newsletter_client, e.userto, e.purpose, e.created_at, u.id_user, u.id_user');
		$this->db->from('email_records AS e');
		$this->db->join('cc_newsletters AS n', 'e.id_cc_newsletter=n.id_cc_newsletter', 'left');
		$this->db->join('users AS u', 'e.userto=u.id_user', 'left');
		$this->db->where('e.id_admin', '1');
		$this->db->order_by('e.created_at', 'DESC');
		return $this->db->get()->result_array();
	}

	function getUACCUserEmailDetails(){
		$this->db->select('n.id_cc_newsletter AS id_cc_newsletter_client, e.userto, e.userby, e.purpose, e.created_at, u.id_user');
		$this->db->from('email_records AS e');
		$this->db->join('cc_newsletters AS n', 'e.id_cc_newsletter=n.id_cc_newsletter', 'left');
		$this->db->join('users AS u', 'e.userto=u.id_user', 'left');
		$this->db->where('e.id_admin', '0');
		$this->db->order_by('e.created_at', 'DESC');
		return $this->db->get()->result_array();
	}

	function add_client_messages($data, $aMessage){
	    $data['updated_at'] = date('Y-m-d H:i:s');
	    
	    unset($data['save']);
	    if (empty($aMessage)) {
	      $data['created_at'] = date('Y-m-d H:i:s');
	      return $this->db->insert('client_messages', $data);
	    }else{
	      $this->db->where('id_client_message', '1');
	      return $this->db->update('client_messages', $data);
	    }
	}

	function add_uacc_client_messages($data, $aMessage){
	    $data['updated_at'] = date('Y-m-d H:i:s');
	    unset($data['save']);
	    if (empty($aMessage)) {
	      $data['created_at'] = date('Y-m-d H:i:s');
	      return $this->db->insert('tbc_client_messages', $data);
	    }else{
	      $this->db->where('id_client_message', '1');
	      return $this->db->update('tbc_client_messages', $data);
	    }
	}

	function get_approve_log(){
		$this->db->select('ng.name, l.is_approve, l.is_send_mail, l.error_log, l.approve_using, l.approved_date');
		$this->db->from('approve_log AS l');
		$this->db->join('newsletter_general_info AS ng', 'l.id_newsletter=ng.id_newsletter', 'left');
		$this->db->order_by('l.id_approve_log', 'DESC');
		return $this->db->get()->result_array();
	}

	function get_ua_notifications(){
		$this->db->select('title, message');
		$this->db->from('notifications');
		$this->db->order_by('id_notifications', 'desc');
		$this->db->limit(1);
	    return $this->db->get()->row_array();
	}

	function get_ua_fcm(){
		$this->db->select('id_fcm, device_type');
		$this->db->from('devices');
		return $this->db->get()->result_array();
	}

	function add_to_notification($data){
		$data['user_id']='1';
		$this->db->insert('notifications', $data);
		return $this->db->insert_id();
	}

	function get_uacc_fcm(){
		$this->db->select('app, fcm');
		$this->db->from('cc_newsletters');
		$this->db->where('fcm !=', '');
		return $this->db->get()->result_array();
	}

	function get_uacc_notifications(){
		$this->db->select('title, message');
		$this->db->from('uacc_notifications');
		$this->db->order_by('id_notifications', 'desc');
		$this->db->limit(1);
	    return $this->db->get()->row_array();
	}


	function add_to_uacc_notifications($data){
		$data['user_id']='1';
		$this->db->insert('uacc_notifications', $data);
		return $this->db->insert_id();
	}


	function Send_notification($target,$body,$title,$server_key){
    	if(empty($target)){
            return false;
            exit();
        }
        $url = 'https://fcm.googleapis.com/fcm/send';
        $msg=array('body'=>$body, 'title'=>$title, 'icon'=>'myicon', 'sound'=>'mySound', 'click_action'=>'OPEN_ACTIVITY');
        $data=array('body'=>$body, 'title'=>$title,'icon'=>'myicon', 'sound'=>'mySound', 'click_action'=>'OPEN_ACTIVITY');
                                       
        $fields = array();
        $fields['data'] = $data;
        $fields['notification'] = $msg;

        if(is_array($target)){
            $fields['registration_ids'] = $target;
        }else{
            $fields['to'] = $target;
        }
        //header with content_type api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$server_key
        );
                    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        $aAppMessage=
                array(
                    'data'=> array(
                            'body'=>$body,
                            'title'=>$title
                        ),
                    'notification' => array(
                            'body'=>$body,
                            'title'=>$title,
                            'click_action' => 'OPEN_ACTIVITY'
                        ),

                    'to' => $target
                ); 
        header('Content-Type: application/json');
        return json_encode($aAppMessage,JSON_UNESCAPED_SLASHES);
  	}
	
}

?>