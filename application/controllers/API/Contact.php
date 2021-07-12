<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct() {
		parent::__construct();
		/*isSecuredApp();*/
	}


	//apiContact.php
	function index(){
		if($this->input->post()) {
			extract($this->input->post());
			$sErrorMessage = $this->get_error_msg($this->input->post());
			if($sErrorMessage == ''){
				$subject_txt = 'Unit Assistant - '.$subject;
				$send = $this->send_mail($this->input->post(), 'office@unitassistant.com', $subject_txt);
			    if ($send) {
			    	$data=
			    		array(
			    			'name'=>$name,
				    		'cell_phone_number'=>$cell_number,
				    		'email_address'=>$email,
				    		'subject'=>$subject,
				    		'message'=>$message
			    		);
			    	$msg=array('status'=>1, 'message'=>lg('Mail_sent_successfully', $language), 'data'=>$data);
			    }else{
			    	$msg=array('status'=>0, 'message'=>lg('Mail_cant_be_sent', $language), 'data'=>'Empty Data');
			    }
			}else{
			    $msg=array('status'=>0, 'message'=>$sErrorMessage);
			}
		}
		echo SendResponse($msg);
		exit();	

	}
	//End of apiContact.php

	//UACC apiContact.php
	function uacc_contact(){
		if($this->input->post()) {
			extract($this->input->post());
			$sErrorMessage = $this->get_error_msg($this->input->post());
			if($sErrorMessage == ''){
				$subject_txt = 'Text Blast Customers - '.$subject;
				$send = $this->send_mail($this->input->post(), 'tamid@unitassistant.com', $subject_txt);
			    if ($send) {
			    	$data=
			    		array(
			    			'name'=>$name,
				    		'cell_phone_number'=>$cell_number,
				    		'email_address'=>$email,
				    		'subject'=>$subject,
				    		'message'=>$message
			    		);
			    	$msg=array('status'=>1, 'message'=>lg('Mail_sent_successfully', $language), 'data'=>$data);
			    }else{
			    	$msg=array('status'=>0, 'message'=>lg('Mail_cant_be_sent', $language), 'data'=>'Empty Data');
			    }
			}else{
			    $msg=array('status'=>0, 'message'=>$sErrorMessage);
			}
		}
		echo SendResponse($msg);
		exit();	
	}
	//End of UACC apiContact.php


	//apiContactTB.php
	function tbp_contact(){
		if($this->input->post()) {
			extract($this->input->post());
			$sErrorMessage = $this->get_error_msg($this->input->post());
			if($sErrorMessage == ''){
				$subject_txt = 'TextBlastPro - '.$subject;
				$send = $this->send_mail($this->input->post(), 'office@unitassistant.com', $subject_txt);
			    if ($send) {
			    	$data=
			    		array(
			    			'name'=>$name,
				    		'cell_phone_number'=>$cell_number,
				    		'email_address'=>$email,
				    		'subject'=>$subject,
				    		'message'=>$message
			    		);
			    	$msg=array('status'=>1, 'message'=>lg('Mail_sent_successfully', $language), 'data'=>$data);
			    }else{
			    	$msg=array('status'=>0, 'message'=>lg('Mail_cant_be_sent', $language), 'data'=>'Empty Data');
			    }
			}else{
			    $msg=array('status'=>0, 'message'=>$sErrorMessage);
			}
		}
		echo SendResponse($msg);
		exit();	
	}
	//End of apiContactTB.php

	function get_error_msg($data){
		if(empty($data['name'])){
			$sErrorMessage = lg('Name_is_required', $data['language']);
		}elseif(empty($data['email'])){
			$sErrorMessage = lg('Email_address_is_required', $data['language']);
		}elseif (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
			$sErrorMessage = lg('Please_enter_valid_email_address', $data['language']);
		}elseif(empty($data['cell_number'])){
			$sErrorMessage = lg('Contact_number_is_required', $data['language']);
		}elseif(empty($data['subject'])){
			$sErrorMessage = lg('Subject_is_required', $data['language']);
		}elseif(empty($data['message'])){
			$sErrorMessage = lg('Message_is_required', $data['language']);
		}else{
			$sErrorMessage = '';
		}

		return $sErrorMessage;
	}

	function send_mail($data, $to, $subject_txt){
		$sContent = "<html><body>";
	    $sContent .= "<p style='font-size:16px;'>Hello,</p>";
	    $sContent .= "<p style='font-size:16px;'>A person ". $data['name'] ." has contacted you.</p>";
	    $sContent .= "<p style='font-size:16px;'><strong>Name:</strong> ".$data['name']." </p>";
	    $sContent .= "<p style='font-size:16px;'><strong>Email Address:</strong> ".$data['email']." </p>";
	    $sContent .= "<p style='font-size:16px;'><strong>Phone Number:</strong> ".$data['cell_number']." </p>";
	    $sContent .= "<p style='font-size:16px;'><strong>Subject:</strong> ".$data['subject']." </p>";
	    $sContent .= "<p style='font-size:16px;'><strong>Message:</strong> ".$data['message']." </p>";
	    $sContent .= "</body></html>";

	    $this->email->set_mailtype("html");
	    $this->email->from($data['email'], $data['name']);
	    $this->email->to($to);
	    $this->email->subject($subject_txt);
	    $this->email->message($sContent);
	    return $this->email->send();		
	}

}