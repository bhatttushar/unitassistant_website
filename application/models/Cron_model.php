<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Cron_model extends CI_Model {

	function get_newsletter_data(){
		$date = date('m-d-y');
		$this->db->select('ng.id_newsletter, ng.name, ng.newsletters_design, ng.email, nd.beatly_url, nd.beatly_url_one, nd.beatly_url_two, no.design_approve_status');
		$this->db->from('newsletter_general_info AS ng');
		$this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
		$this->db->join('newsletter_other_details AS no', 'no.id_newsletter=ng.id_newsletter', 'left');
		$this->db->where(array('ng.deleted'=>'0', 'nd.design_one !='=>'0', 'nd.design_one !='=>'', 'nd.hidden_newsletter!='=>'no'));
		$this->db->where("(ng.contract_update_date ='' OR ng.contract_update_date > ".$date.")", NULL, FALSE);
		$this->db->query('SET SQL_BIG_SELECTS=1');
		return $this->db->get()->result_array();
	}

	function get_id_newsletters(){
		$this->db->select('ng.id_newsletter');
		$this->db->from('newsletter_general_info AS ng');
		$this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
		$this->db->join('newsletter_other_details AS no', 'no.id_newsletter=ng.id_newsletter', 'left');
		$this->db->where(array('ng.deleted'=>'0', 'nd.design_one !='=>'', 'no.design_approve_status !='=>'2'))
		->group_start()
		->where("nd.design_one !=", '0')
		->or_where("nd.design_one !=", '3')
		->group_end();
		$this->db->query('SET SQL_BIG_SELECTS=1');
		return $this->db->get()->result_array();
	}

	function update_design_approve_status($id_newsletter){

		$this->db->set('updated_at', date('Y-m-d H:i:s'));
		$this->db->where('id_newsletter', $id_newsletter);
		$res = $this->db->update('newsletter_general_info');

		if ($res) {
			$this->db->set('design_approve_status', '2');
			$this->db->where('id_newsletter', $id_newsletter);
			return $this->db->update('newsletter_other_details');
		}
	}

	function update_is_loggedin(){
		$data = array('updated_at'=>date('Y-m-d H:i:s'), 'is_loggedin'=>'0');
		$this->db->set($data);
		$this->db->where('is_loggedin', '1');
		return $this->db->update('users');
	}

	function get_reminder_data(){
		$nCurrentdate = date('Y-m-d H:i:s');
		$this->db->select('u.user_name, u.email, ng.name, r.id_reminder, r.reminder_note');
		$this->db->from('reminders AS r');
		$this->db->join('users AS u', 'r.userto = u.id_user', 'left');
		$this->db->join('newsletter_general_info AS ng', 'ng.id_newsletter=r.id_client', 'left');
		$this->db->where(array('r.is_send'=>'0', 'r.reminder_date <='=>$nCurrentdate));
		$this->db->query('SET SQL_BIG_SELECTS=1');
		return $this->db->get()->result_array();
	}

	function update_reminder($id_reminder){
		$data = array('is_send'=>'1', 'last_email_update_date'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s'));
		$this->db->set($data);
		$this->db->where('id_reminder', $id_reminder);
		return $this->db->update('reminders');
	}

	function get_future_clients(){
	    $this->db->select('fg.*, fd.*, fe.*, fp.*, fo.*, fg.email as client_email, fg.dob as future_newsletter_dob');
	    $this->db->from('future_general_info AS fg');
	    $this->db->join('future_design_info AS fd', 'fd.id_future_newsletter=fg.id_future_newsletter', 'left');
	    $this->db->join('future_emails AS fe', 'fe.id_future_newsletter=fg.id_future_newsletter', 'left');
	    $this->db->join('future_packaging AS fp', 'fp.id_future_newsletter=fg.id_future_newsletter', 'left');
	    $this->db->join('future_other_details AS fo', 'fo.id_future_newsletter=fg.id_future_newsletter', 'left');
	    $this->db->join('users AS u', 'u.id_user=fg.id_user', 'left');
	    $this->db->where(array('fg.deleted'=>'0', 'fd.future_package_date <='=> date('m/d/y')));
	    return $this->db->get()->result_array();
	}

	function get_unsubcribed_client($field, $table){
		$date = date("m-d-y");
    	$this->db->select($field.', contract_update_date, consultant_number');
    	$this->db->from($table);
    	$this->db->where(array('deleted'=>'0', 'contract_update_date !='=>'', 'contract_update_date <='=>$date));
    	return $this->db->get()->result_array();
	}

	function update_table($field, $id, $table){
		$data = array('deleted'=>'1', 'updated_by'=>'admin', 'updated_at'=>date('Y-m-d H:i:s'));
		$this->db->set($data);
		$this->db->where($field, $id);
		return $this->db->update($table);
	}

}