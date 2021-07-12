<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Directors extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/director_model');
		$this->load->helper('directors/director');
		isAdminLoggedIn();
	}

	function index(){
		$data['directors'] = $this->director_model->director_list();
		$this->global['pageTitle'] = 'Director List';
		loadAdminViews('admin/director/directors', $this->global, $data, NULL);
	}

	function approve_director($id_newsletter){
		$consultant_number = getConsultantNumber($id_newsletter);
		
		$data = array('consultId'=>$consultant_number, 'method'=>'acceptNewsletter');
		$url = 'https://www.unitnet.com/ua-api/newsletter';

		$aResponse = $this->director_api_call($data, $url);

		if(!isset($aResponse['error'])){
			$result=$this->director_model->update_design_approve_status($id_newsletter);
			if ($result == true) {
				$this->session->set_flashdata('success', 'Record approved successfully');
			} else {
				$this->session->set_flashdata('error', 'Something went wrong try again!!');
				$add_approve_log = $this->director_model->add_approve_log($id_newsletter,'0','0','Application','ERROR:'.$aResponse['error'],$sConnection);
			}
	    }else{
	    	$this->session->set_flashdata('error', 'Something went wrong try again!!');
	        $add_approve_log = $this->director_model->add_approve_log($id_newsletter,'0','0','Application','ERROR:'.$aResponse['error']);
	    }
		redirect('admin/directors');
	}

	function dis_approve_director($id_newsletter){
		$result=$this->director_model->update_design_dis_approve_status($id_newsletter);
		if ($result == true) {
			$this->session->set_flashdata('success', 'Record disapproved successfully');
		} else {
			$this->session->set_flashdata('error', 'Something went wrong try again!!');
		}
		redirect('admin/directors');
	}

	function director_api_call($data, $url){
		
        $username = "*54YeX{u7^%[BP*X";
        $password = "2ypD;z2/Ru#N+PX![*'DE!LVf";

		$ch = curl_init ();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_USERPWD,"$username:$password");
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        $aResponse = json_decode($response, true);
        curl_close($ch);
        return $aResponse;
	}

	function delete_director($id_newsletter){
		$consultant_number = getConsultantNumber($id_newsletter);
		$newUserType = 0;
		$sCCData = $this->director_model->get_cc_newsletter_data($consultant_number);

		if (isset($consultant_number) || !empty($consultant_number)) {
            if ($sCCData > 0) { 
                $newUserType = 2;        
            } 
        }

        $data = array('consultId'=>$consultant_number, 'method'=>'updateUser', 'newState'=>$newUserType);
		$url = 'https://www.unitnet.com/ua-api/updateuser';

		$aResponse = $this->director_api_call($data, $url);

        if(isset($aResponse['success']) && ($aResponse['success'] == 'yes')){
        	$result = $this->director_model->delete_director($id_newsletter);
            if($result == true){
            	$this->session->set_flashdata('success', 'Record deleted successfully');
            }else{
            	$this->session->set_flashdata('error', 'Something went wrong try again!!');
            }
        }else{
        	$this->session->set_flashdata('error', 'Something went wrong try again!!');
        }

        redirect('admin/directors');
	}

	function delete_selected_director(){
		$consultant_numbers = getMultiConsultantNumber($this->input->post('id_newsletter'));
		$newUserType = 0;

		foreach ($consultant_numbers as $key => $value) {
			$sCCData = $this->director_model->get_cc_newsletter_data($value['consultant_number']);
			if (isset($value['consultant_number']) || !empty($value['consultant_number'])) {
	            if ($sCCData > 0) { 
	                $newUserType = 2;        
	            } 
	        }

	        $data = array('consultId'=>$value['consultant_number'], 'method'=>'updateUser', 'newState'=>$newUserType);
			$url = 'https://www.unitnet.com/ua-api/updateuser';

			$aResponse = $this->director_api_call($data, $url);

	        if(isset($aResponse['success']) && ($aResponse['success'] == 'yes')){
	        	$result = $this->director_model->delete_selected_director($value['id_newsletter']);
	            if($result == true){
	            	$this->session->set_flashdata('success', 'Record deleted successfully');
	            }else{
	            	$this->session->set_flashdata('error', 'Something went wrong try again!!');
	            }
	        }else{
	        	$this->session->set_flashdata('error', 'Something went wrong try again!!');
	        }
		}
		redirect('admin/directors');
	}

	function director_history($id_newsletter){
		$this->global['pageTitle'] = 'Unit Assistant : Director History';
		$data['director_history'] = $this->director_model->director_history($id_newsletter);
		loadAdminViews("admin/director/director_history", $this->global, $data, NULL);	
	}

	function view_history($id_history){
		$this->global['pageTitle'] = 'Unit Assistant : View History';
		$data['data'] = $this->director_model->view_director_history($id_history);
		loadAdminViews("admin/director/view_history", $this->global, $data, NULL);	
	}

	function delete_history($id_newsletter, $id_history) {
		$result = $this->director_model->delete_history($id_history);
		if ($result == true) {
			$this->session->set_flashdata('success', 'Record deleted successfully');
		} else {
			$this->session->set_flashdata('error', 'Record deleted failed');
		}
		redirect('admin/director-history/'.$id_newsletter);
	}

	function delete_all_history(){
		$result = $this->director_model->delete_all_history($this->input->post('id_history'));
		if ($result == true) {
			$this->session->set_flashdata('success', 'History deleted successfully');
		} else {
			$this->session->set_flashdata('error', 'Something went wrong!!');
		}
		redirect('admin/director-history'.$this->input->post('id_newsletter'));
	}

	function view_email_detail($id_newsletter, $purpose){
		$this->global['pageTitle'] = 'View Email Detail';
		$data['aViewEmailDetails'] = $this->director_model->getViewEmailDetails($id_newsletter, $purpose);
		loadAdminViews('admin/director/viewEmailDetail', $this->global, $data, NULL);	
	}
	
	function director_emails($id_newsletter) {
		$this->global['pageTitle'] = 'Director Emails';
		$data['email_details'] = $this->director_model->get_email_details($id_newsletter);
		loadAdminViews('admin/director/director_emails', $this->global, $data, NULL);
	}

	function approve_newsletter_design($id_newsletter) {
		$id_newsletter = str_replace(',', '', $id_newsletter);

		if(empty($id_newsletter)){
		    $this->director_model->add_approve_log(0,'0','0','MailChimp','Newsletter ID Blank');
		    redirect('admin/newsletter-approval-failed');
		    exit; 
		}

		if( strpos($id_newsletter, ',') !== false ){
		    $id_newsletter = str_replace(',', '', $id_newsletter);
		}else{
		    $id_newsletter = $id_newsletter;
		}

		$aData = $this->director_model->get_name_and_consultant_number($id_newsletter);

		if(empty($aData['name']) || empty($aData['consultant_number'])){
		    $this->director_model->add_approve_log($id_newsletter,'0','0','MailChimp','Your newsletter is already approved or you cancel to approve');
		    redirect('admin/newsletter-approval-failed');
		    exit;
		}else{
		    
		    $data = array('consultId'=>$aData['consultant_number'], 'method'=>'acceptNewsletter');
			$url = 'https://www.unitnet.com/ua-api/newsletter';

			$aResponse = $this->director_api_call($data, $url);


		    if(!isset($aResponse['error'])){
				$result=$this->director_model->update_design_approve_status($id_newsletter);

				if ($result == true) {
			        $sSend = send_newsletter_approval_mail($aData['name']);
			        if($sSend) {
			            $this->director_model->add_approve_log($id_newsletter,'1','1','MailChimp','approved successfully and mail sent');
			            redirect('admin/newsletter-approval-success');
			        }else {
			            $this->director_model->add_approve_log($id_newsletter,'1','0','MailChimp','approved successfully and mail not send');
			        }
				} else {
					$this->director_model->add_approve_log($id_newsletter,'0','0','MailChimp','ERROR:'.$aResponse['error']);
		        	redirect('admin/newsletter-approval-failed');
				}
			}else{
				echo $aResponse['error'];
			}
		}
	}

	function newsletter_message(){
		if ($this->input->post()) {
			if ($this->input->post('id_newsletter')) {
				$data = $this->director_model->saveClientNewsDetails($this->input->post());
				if ($data == TRUE) {
					$this->session->set_flashdata('success', 'Save record successfully');
				}else{
					$this->session->set_flashdata('error', 'Record not saved');
				}
				redirect('admin/directors');
			}elseif ($this->input->post('save_newsletter_messages')) {
				$aMessages = $this->director_model->saveNewsletterMsg($this->input->post());
				if ($aMessages) {
					$this->session->set_flashdata('success', 'Save record successfully');
				}else{
					$this->session->set_flashdata('error', 'Record not saved');
				}
				redirect('admin/newsletter-message');
			}
		}else{
			$this->global['pageTitle'] = 'Unit Assistant : Newsletter Message';
			$data['aMsg']=$this->db->get_where('newsletter_messages',array('id_newsletter_message'=>'1'))->result_array();
			loadAdminViews("admin/director/newsletterMessage", $this->global, $data, NULL);	
		}
	}

	function newsletter_approval_failed(){
		$this->load->view('admin/newsletter_approval_failed');
	}

	function newsletter_approval_success(){
		$this->load->view('admin/newsletter_approval_success');
	}

	// Fetching future client list admin/futureUpdateList
	function future_update_list(){
		$data['data'] = $this->director_model->getFutureUpdateList();
		$this->global['pageTitle'] = 'Future Update List';
		loadAdminViews("admin/director/futureUpdateList", $this->global, $data, NULL);
	}	

	function future_history($id_newsletter){
		$data['data'] = $this->director_model->getFutureHistory($id_newsletter);
		$this->global['pageTitle'] = 'Unit Assistant : Future History';
		loadAdminViews("admin/director/futureHistory", $this->global, $data, NULL);
	}

	function delete_future_client($id_newsletter) {
		$result = $this->director_model->deleteFutureClient($id_newsletter);

		if ($result > 0) {
			$this->session->set_flashdata('success', 'Client deleted successfully');
		} else {
			$this->session->set_flashdata('error', 'Client not deleted');
		}
		redirect('admin/future-update-list');
	}

	// Remove Multiple Future UA Client
	function delete_selected_future_client(){
		$result = $this->director_model->deleteSelectedFutureClient($this->input->post('id_newsletters'));
		if ($result == true) {
			$this->session->set_flashdata('success', 'Deleted successfully');
		} else {
			$this->session->set_flashdata('error', 'Deleted failed');
		}
		redirect('admin/future-update-list');
	}

	function archieved_clients(){
		$data['data'] = $this->director_model->get_archieved_clients();
		$this->global['pageTitle'] = 'Archieved Clients';
		loadAdminViews("admin/director/archieved_clients", $this->global, $data, NULL);
	}

	function revert_client($id_newsletters){
		$result = $this->director_model->revert_client($id_newsletters);

		if ($result == true) {
			$this->session->set_flashdata('success', 'Revert client successfully');
		} else {
			$this->session->set_flashdata('error', 'Revert client failed');
		}
		redirect('admin/archieved-clients');
	}

	function revert_to_client_list($id_newsletters){
		$result = $this->director_model->revert_to_client_list($id_newsletters);

		if ($result == true) {
			$this->session->set_flashdata('success', 'Revert to client list successfully');
		} else {
			$this->session->set_flashdata('error', 'Revert to client list failed');
		}
		redirect('admin/archieved-clients');
	}

	function unsuscribed_clients(){
		$data['data'] = $this->director_model->get_unsuscribed_clients();
		$this->global['pageTitle'] = 'Unsuscribed Clients';
		loadAdminViews("admin/director/unsuscribed_clients", $this->global, $data, NULL);
	}
	

}