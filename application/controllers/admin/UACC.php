<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UACC extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/UACC_model');
		isAdminLoggedIn();
	}

	function index(){
		$data['consultant_clients'] = $this->UACC_model->uacc_list();
		$this->global['pageTitle'] = 'Consultant Clients';
		loadAdminViews('admin/UACC/consultant_clients', $this->global, $data, NULL);
	}

	function delete_uacc($id_cc_newsletter){
		$consultant_number = get_cc_consultant_number($id_cc_newsletter);
		$newUserType = 1;
		$newsData = $this->UACC_model->get_newsletter_data($consultant_number);

		if (isset($consultant_number) || !empty($consultant_number)) {
            if ($newsData > 0) { 
                $newUserType = 2;        
            } 
        }

        //$aResponse = $this->UACC_api_call($consultant_number, $newUserType);
        $aResponse['success'] = 'yes';
        if(isset($aResponse['success']) && ($aResponse['success'] == 'yes')){
        	$result = $this->UACC_model->delete_uacc($id_cc_newsletter);
            if($result == true){
            	$this->session->set_flashdata('success', 'Record deleted successfully');
            }else{
            	$this->session->set_flashdata('error', 'Something went wrong try again!!');
            }
        }else{
        	$this->session->set_flashdata('error', 'Something went wrong try again!!');
        }

        redirect('admin/uacc');
	}


	function delete_selected_uacc(){
		$result = $this->UACC_model->delete_selected_uacc($this->input->post('id_cc_newsletter'));
        if($result == true){
        	$this->session->set_flashdata('success', 'Record deleted successfully');
        }else{
        	$this->session->set_flashdata('error', 'Something went wrong try again!!');
        }
		redirect('admin/uacc');
	}

	function UACC_api_call($consultant_number, $newUserType='', $approve=''){
		if ($approve != '' && $approve=='approve') {
			$data = array('consultId'=>$consultant_number, 'method'=>'acceptNewsletter');
			$url = 'https://www.unitnet.com/ua-api/newsletter';
		}else{
			$data = array('consultId'=>$consultant_number, 'method'=>'updateUser', 'newState'=>$newUserType);	
			$url = 'https://www.unitnet.com/ua-api/updateuser';
		}
		
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

	function uacc_history($id_cc_newsletter){
		$this->global['pageTitle'] = 'Unit Assistant : UACC History';
		$data['uacc_history'] = $this->UACC_model->get_uacc_history($id_cc_newsletter);
		loadAdminViews("admin/UACC/uacc_history", $this->global, $data, NULL);	
	}

	function delete_uacc_history($id_cc_newsletter, $id_cc_history) {
		$result = $this->UACC_model->delete_uacc_history($id_cc_history);
		if ($result == true) {
			$this->session->set_flashdata('success', 'Record deleted successfully');
		} else {
			$this->session->set_flashdata('error', 'Something went wrong try again!!');
		}
		redirect('admin/uacc-history/'.$id_cc_newsletter);
	}

	function delete_selected_uacc_history(){
		$result = $this->UACC_model->delete_selected_uacc_history($this->input->post('id_cc_history'));
		if ($result == true) {
			$this->session->set_flashdata('success', 'History deleted successfully');
		} else {
			$this->session->set_flashdata('error', 'Something went wrong!!');
		}
		redirect('admin/uacc-history/'.$this->input->post('id_cc_newsletter'));
	}

	function view_uacc_history($id_cc_history){
		$this->global['pageTitle'] = 'Unit Assistant : View UACC History';
		$data['data'] = $this->UACC_model->view_uacc_history($id_cc_history);
		loadAdminViews("admin/UACC/view_uacc_history", $this->global, $data, NULL);	
	}

	function archieved_uacc_clients(){
		$data['data'] = $this->UACC_model->get_archieved_uacc_clients();
		$this->global['pageTitle'] = 'Archieved Clients';
		loadAdminViews("admin/UACC/archieved_uacc_clients", $this->global, $data, NULL);
	}

	function revert_uacc_client($id_cc_newsletters){
		$result = $this->UACC_model->revert_uacc_client($id_cc_newsletters);

		if ($result == true) {
			$this->session->set_flashdata('success', 'Revert client successfully');
		} else {
			$this->session->set_flashdata('error', 'Revert client failed');
		}
		redirect('admin/archieved-UACC-clients');
	}

	function revert_to_uacc_client_list($id_cc_newsletters){
		$result = $this->UACC_model->revert_to_uacc_client_list($id_cc_newsletters);

		if ($result == true) {
			$this->session->set_flashdata('success', 'Revert to client list successfully');
		} else {
			$this->session->set_flashdata('error', 'Revert to client list failed');
		}
		redirect('admin/archieved-UACC-clients');
	}

	function unsuscribed_uacc_clients(){
		$data['data'] = $this->UACC_model->get_unsuscribed_uacc_clients();
		$this->global['pageTitle'] = 'Unsuscribed UACC Clients';
		loadAdminViews("admin/UACC/unsuscribed_uacc_clients", $this->global, $data, NULL);
	}
	

}