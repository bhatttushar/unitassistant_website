<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_profile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('API/user_profile_model');
		/*isSecuredApp();*/
	}

	//apiUserProfileSave.php
	function index(){
		if($this->input->post()) {
			extract($this->input->post());

			$sErrorMessage = $this->get_error_msg($this->input->post());
			if($sErrorMessage != ''){
				$msg=array('status'=>0, 'message'=>lg('All_fields_are_required', $language), 'data'=>$sErrorMessage);
			}else{
				$data = $this->user_profile_model->get_client_id($id_client);

				if (empty($data)) {
					$msg=array('status'=>0, 'message'=>lg('Client_id_is_not_valid', $language), 'data'=>'Empty Data');
				}else{
					$uniqueEmail = $this->user_profile_model->checkEmailExists($email, $id_client);

					if ($uniqueEmail > 0) {
						$msg=array('status'=>0, 'message'=>lg('unique_email', $language), 'data'=>'Empty Data');
					}else{
						$result = $this->user_profile_model->edit_profile($this->input->post());
						if ($result == true) {
							$send_mail = $this->sendProfileMail($this->input->post(), $account, $routing);
							if ($send_mail) {
								$adminData = $this->user_profile_model->getAdminInfo();
								$decrypted = decryptIt(encryptIt( $account ));
			        			$mask = maskCreditCard($decrypted); 
			        			$this->load->helper('API/api_helper');
								$aClientDetail=get_client_data($this->input->post(), $routing, $decrypted, $mask, $adminData);
								$aClientDetail['id_client'] = $id_client;
								$msg=array('status'=>1, 'message'=>lg('Your_profile_has_been_saved_successfully', $language), 'data'=>$aClientDetail);
							}
						}else{
							$msg=array('status'=>0, 'message'=>lg('Sorry_your_profile_cant_updated', $language), 'data'=>'Empty Data');
						}
					}
				}
			}
			echo SendResponse($msg);
			exit();	
		}
	}
	//End of apiUserProfileSave.php

	function sendProfileMail($userProfile, $account, $routing, $is_uacc="", $is_tbp=""){

		if (empty($is_uacc) || !empty($is_tbp)) {
			$subject = 'Unit Assistant Service';
			$cc = '';
		}else{
			$subject = 'Text Blast Customers - Profile changed';
			$cc = 'office@unitassistant.com';
		}

		$your_client = empty($is_tbp) ? '' : 'TextBlastPro';

		$sContent = "<html><body>";
	    $sContent .= "<p style='font-size:16px;'>Hello,</p>";
	    $sContent .= "<p style='font-size:16px;'>Your ".$your_client." Client".$userProfile['name']." has changes his profile. Below is updated profile details.</p>";
	    $sContent .= "<p ><strong style='font-size:16px;'>Name:</strong>&nbsp;".$userProfile['name']." </p>";
	    

	    if (empty($is_tbp)) {
	    	$sContent .= "<p><strong style='font-size:16px;'>Email Address:</strong> ".$userProfile['email']." </p>";
	    	$sContent .= "<p><strong style='font-size:16px;'>Cell Numberr:</strong> ".$userProfile['cell_number']." </p>";
	    	$sContent .= "<p><strong style='font-size:16px;'>Birthdate:</strong> ".$userProfile['dob']." </p>";

	    }else{
	    	$sContent .= "<p><strong style='font-size:16px;'>Email Address:</strong> ".$userProfile['email_address']." </p>";
	    	$sContent .= "<p><strong style='font-size:16px;'>Cell Numberr:</strong> ".$userProfile['cell_phone_number']." </p>";
	    }

	    $sContent .= "<p><strong style='font-size:16px;'>Account:</strong> ".$account." </p>";
	    $sContent .= "<p><strong style='font-size:16px;'>Routing:</strong> ".$routing." </p>";
	    $sContent .= "<p style='font-size:16px;'>Thanks,</p>";
		$sContent .= "<p><strong style='font-size:16px;'>".$userProfile['name']."</strong></p>";
	    $sContent .= "</body></html>";

	    $this->email->set_mailtype("html");
	    $this->email->from('office@unitassistant.com', 'Unit Assistant Team');
	    $this->email->to('tamid@unitassistant.com');
	    $this->email->cc($cc);
	    $this->email->subject($subject);
	    $this->email->message($sContent);
	    return $this->email->send();
	}

	//apiCcUserProfileSave.php
	function uacc_user_profile(){
		if($this->input->post()) {
			extract($this->input->post());

			$sErrorMessage = $this->get_error_msg($this->input->post());
			if($sErrorMessage != ''){
				$msg=array('status'=>0, 'message'=>lg('All_fields_are_required', $language), 'data'=>$sErrorMessage);
			}else{
				$data = $this->user_profile_model->get_uacc_client_id($id_client);

				if (empty($data)) {
					$msg=array('status'=>0, 'message'=>lg('Client_id_is_not_valid', $language), 'data'=>'Empty Data');
				}else{
					$uniqueEmail = $this->user_profile_model->checkEmailExists($email, $id_client, 'uacc');

					if ($uniqueEmail > 0) {
						$msg=array('status'=>0, 'message'=>lg('unique_email', $language), 'data'=>'Empty Data');
					}else{
						$result = $this->user_profile_model->edit_uacc_profile($this->input->post());
						if ($result == true) {
							$send_mail = $this->sendProfileMail($this->input->post(), $account, $routing, 'uacc');
							if ($send_mail) {
								$adminData = $this->user_profile_model->getAdminInfo();
								$decrypted = decryptIt(encryptIt($account));
			        			$mask = maskCreditCard($decrypted); 
			        			$this->load->helper('API/api_helper');
								$aClientDetail=get_client_data($this->input->post(), $routing, $decrypted, $mask, $adminData, '', 'uacc');
								$aClientDetail['id_client'] = $id_client;
								$msg=array('status'=>1, 'message'=>lg('Your_profile_has_been_saved_successfully', $language), 'data'=>$aClientDetail);
							}
						}else{
							$msg=array('status'=>0, 'message'=>lg('Sorry_your_profile_cant_updated', $language), 'data'=>'Empty Data');
						}
					}
				}
			}
			echo SendResponse($msg);
			exit();	
		}
	}
	//End of apiCcUserProfileSave.php


	function get_error_msg($data){
		
		if(empty($data['id_client'])){
			$aMessage['id_client'] = lg('client_required', $data['language']);
		}elseif(empty($data['name'])){
			$aMessage['name'] = lg('Name_is_required', $data['language']);
		}elseif(empty($data['email'])){
			$aMessage['email'] = lg('Email_address_is_required', $data['language']);
		}elseif(empty($data['dob'])){
			$aMessage['dob'] = lg('Birthdate_is_required', $data['language']);
		}elseif(empty($data['cell_number'])){
			$aMessage['cell_number'] = lg('Cell_number_is_required', $data['language']);
		}elseif(empty($data['account'])){
			$aMessage['account'] = lg('Account_number_is_required', $data['language']);
		}elseif(empty($data['routing'])){
			$aMessage['routing'] = lg('Routing_is_required', $data['language']);
		}else{
			$aMessage = '';
		}

		return $aMessage;
	}

	//apiTBPprofile.php
	function tbp_user_profile(){
		if($this->input->post()) {
			extract($this->input->post());

			if(empty($id_client)){
				$aMessage['id_client'] = lg('client_required', $language);
			}

			if(empty($name)){
				$aMessage['name'] = lg('Name_is_required', $language);
			}

			if(empty($email_address)){
				$aMessage['email'] = lg('Email_address_is_required', $language);
			}elseif (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
				$aMessage['email'] = lg('Email_is_not_valid', $language);
			}
			
			if(isset($aMessage)){
				$msg=array('status'=>0, 'message'=>lg('All_fields_are_required', $language), 'data'=>$aMessage);
			}else{
				$data = $this->user_profile_model->get_tbp_client_id($id_client);

				if (empty($data)) {
					$msg=array('status'=>0, 'message'=>lg('Client_id_is_not_valid', $language), 'data'=>'Empty Data');
				}else{
					$uniqueEmail = $this->user_profile_model->checkEmailExists($email_address, $id_client, 'tbp');

					if ($uniqueEmail > 0) {
						$msg=array('status'=>0, 'message'=>lg('unique_email', $language), 'data'=>'Empty Data');
					}else{
						$result = $this->user_profile_model->edit_tbp_profile($this->input->post());

						if ($result == true) {
							$send_mail = $this->sendProfileMail($this->input->post(), $account_no, $routing, '', 'tbp');
							if ($send_mail) {

								$aClientDetail = $this->input->post();
								$aClientDetail['ftp_host'] = FTP_HOST;
								$aClientDetail['ftp_user'] = FTP_USER;
								$aClientDetail['ftp_password'] = FTP_PASS;
								$aClientDetail['ftp_file_upload_path'] = FILE_PATH;
								
								$msg=array('status'=>1, 'message'=>lg('Your_profile_has_been_saved_successfully', $language), 'data'=>$aClientDetail);
							}
						}else{
							$msg=array('status'=>0, 'message'=>lg('Sorry_your_profile_cant_updated', $language), 'data'=>'Empty Data');
						}
					}
				}
			}
			echo SendResponse($msg);
			exit();	
		}
	}
	//End of apiTBPprofile.php


}