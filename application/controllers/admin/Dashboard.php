<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/dashboard_model');
		isAdminLoggedIn();
	}

	function index(){
		$data['userCount'] = $this->db->get_where('users', array('deleted'=>'0', 'activated'=>'1'))->num_rows();
		$data['historyCount'] = $this->db->get_where('newsletter_general_info', array('deleted'=>'0', 'activated'=>'1'))->num_rows();
		$data['cc_count'] = $this->db->get_where('cc_newsletters', array('deleted'=>'0', 'activated'=>'1'))->num_rows();
		$data['changesCount'] = $this->db->get_where('changes', array('1'=>'1'))->num_rows();
		$data['archieveCount'] = $this->db->get_where('newsletter_general_info', array('deleted'=>'1'))->num_rows();
		$data['ua_unsubscribe_count'] = $this->db->get_where('newsletter_general_info', array('deleted'=>'1', 'contract_update_date !='=>'', 'contract_update_date<='=>date("m:d:y")))->num_rows();
		$data['cc_unsubscribe_count'] = $this->db->get_where('cc_newsletters', array('deleted'=>'1', 'contract_update_date !='=>'', 'contract_update_date <='=>date("m:d:y")))->num_rows();

		$data['futureUpdateCount'] = $this->dashboard_model->get_future_clients();
		$data['totalEmail'] = $this->db->get_where('email_records', array('1'=>'1'))->num_rows();
		$data['total_admin_emails'] = $this->db->get_where('email_records', array('id_admin'=>'1'))->num_rows();
		$data['total_user_emails'] = $this->db->get_where('email_records', array('id_admin'=>'0'))->num_rows();
		$data['reportCount'] = $this->db->get_where('reports', array('1'=>'1'))->num_rows();
		$this->global['pageTitle'] = 'Unit Assistant : Dashboard';
		loadAdminViews("admin/dashboard", $this->global, $data, NULL);
	}


	function texting_reports(){
		$data['data'] = $this->dashboard_model->getReports();
		$this->global['pageTitle'] = 'Reports';
		loadAdminViews("admin/director/texting_reports", $this->global, $data, NULL);
	}	

	function newsletter_reports(){
		$data['data'] = $this->dashboard_model->getNewsletterReports();
		$this->global['pageTitle'] = 'Newsletter Reports';
		loadAdminViews("admin/director/newsletter_reports", $this->global, $data, NULL);
	}

	function newsletter_design_status(){
		$data['data'] = $this->dashboard_model->get_newsletter_design_status();
		$this->global['pageTitle'] = 'Newsletter Design Status';
		loadAdminViews("admin/director/newsletter_design_status", $this->global, $data, NULL);
	}

	function requested_changes(){
		$data['data'] = $this->dashboard_model->get_requested_changes_data();
		$this->global['pageTitle'] = 'Requested Changes';
		loadAdminViews("admin/director/requested_changes", $this->global, $data, NULL);
	}

	function view_changes_detail() {
		$result = $this->dashboard_model->getChangesViewDetail($this->input->post('changeId'));
		$aImageFiles = $this->dashboard_model->getChangesImage($this->input->post('changeId'));
		echo json_encode(array('result'=>$result, 'imgFile'=>$aImageFiles));
	}

	function email_setting(){
		if ($this->input->post()) {
			$result = $this->dashboard_model->change_email_setting($this->input->post('email_setting'));
			if ($result) {
				$this->session->set_flashdata('success', 'Email setting changed successfully');
			}else{
				$this->session->set_flashdata('error', 'Email setting not changed');
			}
			redirect('admin/email-setting');
		}else{
			$data['email_setting'] = $this->dashboard_model->get_email_setting();
			$this->global['pageTitle'] = 'Email Setting';
			loadAdminViews("admin/director/email_setting", $this->global, $data, NULL);
		}
	}

	function newsletter_message(){
		if ($this->input->post()) {
			$result = $this->dashboard_model->change_newsletter_message($this->input->post());
			if ($result) {
				$this->session->set_flashdata('success', 'Newsletter message save successfully');
			}else{
				$this->session->set_flashdata('error', 'Newsletter message not save');
			}
			redirect('admin/newsletter-messages');
		}else{
			$data['data'] = $this->dashboard_model->get_newsletter_message();
			$this->global['pageTitle'] = 'Newsletter Message';
			loadAdminViews("admin/newsletter_messages", $this->global, $data, NULL);
		}
	}

	function app_version(){
		if ($this->input->post()) {
			$result = $this->dashboard_model->change_app_version($this->input->post());
			if ($result) {
				$this->session->set_flashdata('success', 'App version changed successfully');
			}else{
				$this->session->set_flashdata('error', 'App version not changed');
			}
			redirect('admin/app-version');
		}else{
			$data['app_version'] = $this->dashboard_model->get_app_version();
			$this->global['pageTitle'] = 'App version';
			loadAdminViews("admin/app_version", $this->global, $data, NULL);
		}
	}

	function ua_admin_emails(){
		$data['data'] = $this->dashboard_model->getAdminEmailDetails();
		$this->global['pageTitle'] = 'Admin Emails';
		loadAdminViews("admin/adminEmails", $this->global, $data, NULL);
	}

	function ua_user_emails(){
		$data['data'] = $this->dashboard_model->getUserEmailDetails();
		$this->global['pageTitle'] = 'User Emails';
		loadAdminViews("admin/userEmails", $this->global, $data, NULL);
	}

	function uacc_admin_emails(){
		$data['data'] = $this->dashboard_model->getUACCAdminEmailDetails();
		$this->global['pageTitle'] = 'UACC Admin Emails';
		loadAdminViews("admin/uacc_admin_emails", $this->global, $data, NULL);
	}

	function uacc_user_emails(){
		$data['data'] = $this->dashboard_model->getUACCUserEmailDetails();
		$this->global['pageTitle'] = 'UACC User Emails';
		loadAdminViews("admin/uacc_user_emails", $this->global, $data, NULL);
	}

	function email_contents(){
		$data['aMessage'] = $this->db->get('client_messages')->row_array();
		if ($this->input->post()) {
			$result = $this->dashboard_model->add_client_messages($this->input->post(), $data['aMessage']);
			redirect('admin/email-contents');
		}else{
			$this->global['pageTitle'] = 'Unit Assistant : Emails Content';
			loadAdminViews("admin/director/email_contents", $this->global, $data, NULL);	
		}
	}

	function uacc_email_contents(){
		$data['aMessage'] = $this->db->get('tbc_client_messages')->row_array();
		if ($this->input->post()) {
			$result = $this->dashboard_model->add_uacc_client_messages($this->input->post(), $data['aMessage']);
			redirect('admin/uacc-email-contents');
		}else{
			$this->global['pageTitle'] = 'Unit Assistant : UACC Emails Content';
			loadAdminViews("admin/UACC/uacc_email_contents", $this->global, $data, NULL);	
		}
	}

	function approve_log(){
		$data['data'] = $this->dashboard_model->get_approve_log();
		$this->global['pageTitle'] = 'Approve Log';
		loadAdminViews("admin/approve_log", $this->global, $data, NULL);
	}

	function push_notifications() {
	    if (!empty($this->input->post())) {
	       $aResult = $this->dashboard_model->get_ua_fcm();
	      $targetA = array();
	      $targetI = array();

	      foreach ($aResult as $key => $value) {  
	        if($value['device_type'] == 'A'){
	          $targetA[] = $value['id_fcm'];
	        }elseif($value['device_type'] == 'I') {
	          $targetI[] = $value['id_fcm'];
	        }
	      }

	      $Akay = 'AAAAjh01eR4:APA91bEV6rI4BZVXl6bCs3PZE05ov7EgofhHvJUZRlX3jPklZytpc2KRxs2zE55qrIU3c-a_3R0w_NNZQAyLvCrDVQkSJ4eMOtWM_1EKkd7pfIV8dvLr0YtmV4m5mN8kNm7_mzhneKxL';

	      $Ikey = 'AAAA52vuIWo:APA91bE8-rh5aPp2mbNAa7wHuTf10fJfdUzxDPH1gUCNosOfcqCYSKeSH4usHnMVWtQ26XAns57gfIDm8EWoPHW8yFH42-MH4R0h1swIp6ifoIMeY4GaIBFz3JKcEBRuk2FUtMA4qPXT';

	      $result = $this->dashboard_model->Send_notification($targetA,$_POST['message'],$_POST['title'],$Akay);
	      $result = $this->dashboard_model->Send_notification($targetI,$_POST['message'],$_POST['title'],$Ikey);

	      $res = $this->dashboard_model->add_to_notification($this->input->post());

	      if ($res > 0) {
	      	$this->session->set_flashdata('success', 'Notification sent successfully.');
	      }else{
	      	$this->session->set_flashdata('error', 'Notification not sent.');
	      }

	      unset($_POST);
	      redirect('admin/push-notifications','refresh');
	    }else {
	    	$data['data'] = $this->dashboard_model->get_ua_notifications();
	      	$this->global['pageTitle'] = 'Unit Assistant : Send Notification';
	      	loadAdminViews("admin/push_notifications", $this->global, $data, NULL);
	    }
  	}

  	function uacc_push_notifications() {
	    if (!empty($this->input->post())) {
	      $aResult = $this->dashboard_model->get_uacc_fcm();
	      $targetA = array();
	      $targetI = array();

	      foreach ($aResult as $key => $value) {
			if(strtolower($value['app']) == 'a'){
				$targetA[] = $value['fcm'];
			}elseif(strtolower($value['app']) == 'i') {
				$targetI[] = $value['fcm'];
			}
		}

	      $Akay = 'AAAAjh01eR4:APA91bEV6rI4BZVXl6bCs3PZE05ov7EgofhHvJUZRlX3jPklZytpc2KRxs2zE55qrIU3c-a_3R0w_NNZQAyLvCrDVQkSJ4eMOtWM_1EKkd7pfIV8dvLr0YtmV4m5mN8kNm7_mzhneKxL';

	      $Ikey = 'AAAA52vuIWo:APA91bE8-rh5aPp2mbNAa7wHuTf10fJfdUzxDPH1gUCNosOfcqCYSKeSH4usHnMVWtQ26XAns57gfIDm8EWoPHW8yFH42-MH4R0h1swIp6ifoIMeY4GaIBFz3JKcEBRuk2FUtMA4qPXT';

	      $result = $this->dashboard_model->Send_notification($targetA,$_POST['message'],$_POST['title'],$Akay);
	      $result = $this->dashboard_model->Send_notification($targetI,$_POST['message'],$_POST['title'],$Ikey);
	      $res = $this->dashboard_model->add_to_uacc_notifications($this->input->post());

	      if ($res > 0) {
	      	$this->session->set_flashdata('success', 'Notification sent successfully.');
	      }else{
	      	$this->session->set_flashdata('error', 'Notification not sent.');
	      }

	      unset($_POST);
	      redirect('admin/uacc-push-notifications','refresh');
	    }else {
	      	$data['data'] = $this->dashboard_model->get_uacc_notifications();
	      	$this->global['pageTitle'] = 'Unit Assistant : Send Notification';
	      	loadAdminViews("admin/uacc_push_notifications", $this->global, $data, NULL);
	    }
    
  	}

  	function logout() {
		$this->session->sess_destroy();
		redirect('admin');
	}

}

?>