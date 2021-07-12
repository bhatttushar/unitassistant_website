<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter_approve extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('API/newsletter_approve_model');
		/*isSecuredApp();*/
	}


	//apiNewsletterApprove.php
	function index(){
		if($this->input->post()) {
			extract($this->input->post());
			$this->load->helper('API/api_helper');
			if(empty($id_newsletter)){
	            AddApprovalLogs($id_newsletter,'1','0','Application','Client id is required');
	            $msg= array( 'status'=>0, 'message'=>lg('client_required', $language));
	        }else{
	            $client = $this->newsletter_approve_model->get_client_id($id_newsletter);
	            if(empty($client)){
	                AddApprovalLogs($id_newsletter,'1','0','Application','Client id is not valid');
	                $msg= array( 'status'=>0, 'message'=>lg('Client_id_is_not_valid', $language));
	            }else{
	                $data = $this->newsletter_approve_model->get_client_data($id_newsletter);

	                if (empty($data)) {
	                	$msg=array('status'=>0, 'message'=>lg('Client_id_is_not_valid', $language) );
	                }else{
	                	$status = $this->newsletter_approve_model->update_design_approve_status($id_newsletter, '1');
		                if ($status == TRUE) {
		                    AddApprovalLogs($id_newsletter,'1','0','Application','Newsletter approved in database');
		                }

		                if(!empty($data['name'])){
		                    $aResponse = $this->get_response_api($data['consultant_number']);
		                    if(!isset($aResponse['error'])){
		                        $sSend = $this->send_approve_mail($data['name']);
		                        if($sSend) {
		                        	$aClientData=array('client_name'=>$data['name'], 'client_id'=>$data['id_newsletter']);
		                            AddApprovalLogs($id_newsletter,'1','1','Application','Newsletter has been approved successfully');
		                            $msg= array('status'=>1, 'message'=>lg('Newsletter_has_been_approved_successfully', $language), 'data'=>$aClientData);
		                        }else{
		                            AddApprovalLogs($id_newsletter,'0','0','Application','Newsletter not approved and mail not send');
		                            $msg=array('status'=>0, 'message'=>lg('Something_wrong_with_your_approval_of_newsletter', $language) );   
		                        }
		                    }else {
		                        AddApprovalLogs($id_newsletter,'0','0','Application','ERROR:'.$aResponse['error']);
		                    }
		                   
		                }else{
		                    AddApprovalLogs($id_newsletter,'1','0','Application','Your newsletter is already approved');
		                    $msg=array('status'=>0, 'message'=>lg('Your_newsletter_is_already_approved', $language) );  
		                }
	                }
	            }
	        }
		}

		echo SendResponse($msg);
		exit();	
	}

	function get_response_api($consultant_number){
		$data = array( 'method'=>'acceptNewsletter', 'consultId'=> $consultant_number);
        $url = 'https://www.unitnet.com/ua-api/newsletter';
        $username = "*54YeX{u7^%[BP*X";
        $password = "2ypD;z2/Ru#N+PX![*'DE!LVf";
        $ch = curl_init ();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_USERPWD,"$username:$password");
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode($data));

        $response = curl_exec($ch);
        $aResponse = json_decode($response, true);
        curl_close($ch);
        return $aResponse;
	}

	function send_approve_mail($name){
        $sContent = "<html><body>";
        $sContent .= "<p style='font-size:16px;'>Hello,</p>";
        $sContent .= "<p style='font-size:16px;'>Your Client ".$name." has approved their newsletter successfully.</p>";
        $sContent .= "<p style='font-size:16px;'>This newsletter has been approved via application.</p>";
        $sContent .= "<p style='font-size:16px;'>Thanks,</p>";
        $sContent .= "<p style='font-size:16px;'><strong>".$name."</strong></p>";
        $sContent .= "</body></html>";

	    $this->email->set_mailtype("html");
	    $this->email->from('office@unitassistant.com', 'Unit Assistant');
	    $this->email->to('office@unitassistant.com');
	    $this->email->subject($name);
	    $this->email->message($sContent);
	    return $this->email->send();
	}


	//End of apiNewsletterApprove.php

}