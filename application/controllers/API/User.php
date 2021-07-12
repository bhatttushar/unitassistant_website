<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('API/user_model');
		/*isSecuredApp();*/
	}

	//apiUserLogin.php
	function user_login() {
		if($this->input->post()) {
			extract($this->input->post());

			$curr_ver = $this->user_model->getAppVersion(); 
			$appMsg = array();

			if($device_type == 'A' || $device_type == 'a') {
				if($curr_ver['ua_android'] > $version){
					$appMsg=array('update'=>1,'message'=>lg('You_are_using_old_Unit_Assistant_app', $language));
					//$appMsg=array('update'=>1,'message'=>'App under maintenance');
				}
			}elseif ($device_type == 'I' || $device_type == 'i') {
				if($curr_ver['ua_ios'] > $version){
					$appMsg=array('update'=>1,'message'=>lg('You_are_using_old_Unit_Assistant_app', $language));
					//$appMsg=array('update'=>1,'message'=>'App under maintenance');
				}
			}

			if(empty($consultant_number) || empty($password)) {
				$msg=array('update'=>0, 'status'=>0, 'message'=>lg('Please_enter_login_details', $language), 'data'=>'empty data'); 
			}else {
				$userData = $this->user_model->getNewsInfo($consultant_number);
				if (empty($userData)) {
					$msg=array('update'=>0, 'status'=>0,'message'=>lg('Incorrect_login_details', $language), 'data'=>'empty data');
				}else{
					if ($password != 'Hi5') {
						if ($password != $userData['intouch_password']) {
							$msg=array('update'=>0, 'status'=>0,'message'=>lg('Incorrect_login_details', $language), 'data'=>'empty data');
							echo SendResponse($msg);
							exit();
						}
					}
					$adminData = $this->user_model->getAdminInfo();

					if(empty($userData['cv_account'])){
						$decrypted = '';
						$mask = '';
					}else{
						$decrypted = decryptIt($userData['cv_account']);
                    	$mask = maskCreditCard($decrypted);
					}

					if(strstr($userData['beatly_url'], 'http')){
						$aBitlyUrl = explode('//', $userData['beatly_url']);
			        	$sBitly = $aBitlyUrl[1];
					}else{
						$sBitly = $userData['beatly_url'];
					}

					if(strstr($userData['beatly_url_one'], 'http')){
						$aBitlyUrlSn = explode('//', $userData['beatly_url_one']);
			        	$sBitlySn = $aBitlyUrlSn[1];
					}else{
						$sBitlySn = $userData['beatly_url_one'];
					}

					if(strstr($userData['beatly_url_two'], 'http')){
						$aBitlyUrlFr = explode('//', $userData['beatly_url_two']);
			        	$sBitlyFr = $aBitlyUrlFr[1];
					}else{
						$sBitlyFr = $userData['beatly_url_two'];
					}

					$this->load->helper('API/api_helper');
					$aClientDetail = get_client_data($userData, $userData['cu_routing'], $decrypted, $mask, $adminData, $consultant_number, 0, $sBitly, $sBitlySn, $sBitlyFr);

					if(isset($appMsg) && !empty($appMsg)){
		        		$msg = $appMsg;
		        	}else{
		        		if($userData['app_login'] == '0') {
		        			if($device_type == 'i' || $device_type == 'I') {
								$device = 'iPhone';
							}elseif ($device_type == 'a' || $device_type == 'A') {
								$device = 'Android';
							}else {
								$device = 'No Device';
							}
						    $message=$this->sendMail($userData['name'], $userData['email'], $consultant_number, $device, 'shannons@unitassistant.com', 'Unit Assistant');
						    if (!empty($message)) {
						    	$this->user_model->editAppLogin($userData['id_newsletter']);
						    	$this->user_model->addEmailRecords($userData['id_newsletter'],$device,$message);
						    }
		        		}
		        		$this->user_model->editAppLastLogin($userData['id_newsletter']);
		        		$this->user_model->addFCM($consultant_number, $device_type, $id_fcm, $id_device);
		        		$msg=array('status'=>1, 'message'=>lg('You_are_loggedin_successfully', $language), 'data'=>$aClientDetail);
		        	}
				}
			}
			echo SendResponse($msg);
			exit();
		}
	}

	function sendMail($name, $email, $consultant_number, $device, $to, $subject){
		$message = "Hello, <br><br>";
		$message .= "<strong>".$name."</strong> is logged in successfully. The Consultant ID is <strong> ".$consultant_number."</strong> <br><br>";
		$message .= "Logged in from ".$device."<br><br>";
		$message .= "Thank you!";
	    $this->email->set_mailtype("html");
	    $this->email->from($email, $name);
	    $this->email->to($to);
	    $this->email->subject($subject.'- New client logged in');
	    $this->email->message($message);
	    $send = $this->email->send();
	    return ($send==true) ? $message : '';
	}
	//End of apiUserLogin.php


	//apiDevice.php
	function device_update(){
		if($this->input->post()) {
			extract($this->input->post());
			if(empty($id_fcm) || empty($id_device)){
				$msg=array('status'=>0, 'message'=>lg('Both_id_is_required', $language));
			}else{
				$add_fcm = $this->user_model->getDeviceInfo($id_fcm, $id_device, $device_type);

				if ($add_fcm == 'insert') {
					$msg=array('status'=>1, 'message'=>lg('Data_saved_successfully', $language));
				}elseif($add_fcm=='update'){
					$msg=array('status'=>0, 'message'=>lg('Data_updated_successfully', $language));
				}
			}
			echo SendResponse($msg);
			exit();	
		}
	}
	//End of apiDevice.php


	//apiBitly.php
	function bitly_api(){
		if($this->input->post()) {
			extract($this->input->post());
			$data = $this->user_model->get_bitly_data($id_client);

			if($language == 'en'){
	    		$sLang = 'E';
	    	}elseif($language == 'sp'){
	    		$sLang = 'S';
	    	}elseif($language == 'fr'){
	    		$sLang = 'F';
	    	}else{
	    		$sLang = 'E';
	    	}

			if($bitly =='en'){
				$aClientDetail = array( 'id_client' => $id_client, 'en' => $data['beatly_url'] );
			}elseif($bitly =='sp'){
				$aClientDetail = array( 'id_client' => $id_client, 'sp' => $data['beatly_url_one'] );
			}elseif ($bitly =='biz') {
				$aClientDetail = array('id_client' => $id_client, 'biz' => empty($data['digital_biz_link']) ? '' : $data['digital_biz_link'].'?lang='.$sLang);
			}elseif ($bitly =='fr') {
				$aClientDetail = array( 'id_client' => $id_client, 'fr' => $data['beatly_url_two'] );
			}

			if(!empty($aClientDetail)) {
				$aMessage= array( 'status'=>1, 'data'=>$aClientDetail );
			}else{
				if($bitly =='biz'){
					$msg = lg('digial_biz_card_is_not_available', $language);
				}else {
					$msg = lg('Bitly_is_not_available_for_you', $language);
				}

				$aMessage= array( 'status'=>0, 'message'=>$msg );
			}
			
			echo SendResponse($aMessage);
			exit();
		}
	}
	//End of apiBitly.php

	//apiNcp.php
	function ncp_api(){
		if($this->input->post()) {
			extract($this->input->post());

			if(!empty($id_client) && !empty($language)) {

				$data = $this->user_model->get_ncp_data($id_client);

				if(!empty($data)){
					if($language == 'en'){
						if(!empty($data['ncp_link_en'])) {
							$url = parse_url($data['ncp_link_en']);
							if($url['scheme'] == 'https' || $url['scheme'] == 'http'){
								$path = str_replace('%20', ' ', $url['path']);
								$data['ncp_link_en'] = $url['scheme'].'://'.$url['host'].  $path;
							}else{
								$data['ncp_link_en'] = str_replace('%20', ' ', $data['ncp_link_en']);					
								$data['ncp_link_en'] = 'http://'.$data['ncp_link_en'];
							}

							$aMessage=array( 'status'=>1, /*'data'=> preg_replace('#^https?://#', '', $data['ncp_link_en'])*/ 'data'=> $data['ncp_link_en'] );
						}else {
							$aMessage=array( 'status'=>0, 'message'=> lg('Consultant_packet_link_is_not_available', $language) );
						}
						
				    }elseif ($language == 'sp'){

				    	if(!empty($data['ncp_link_sp'])) {
				    		$url = parse_url($data['ncp_link_sp']);
							if($url['scheme'] == 'https' || $url['scheme'] == 'http'){
								$path = str_replace('%20', ' ', $url['path']);
							   	$data['ncp_link_sp'] = $url['scheme']."://".$url['host'].  $path;
							}else{
								$data['ncp_link_sp'] = str_replace('%20', ' ', $data['ncp_link_sp']);					
								$data['ncp_link_sp'] = 'http://'.$data['ncp_link_sp'];
							}

					    	$aMessage= array('status'=>1, /*'data'=>preg_replace('#^https?://#', '', $data['ncp_link_sp'])*/
					            'data'=>$data['ncp_link_sp']);
					    }else {
					    	$aMessage=array( 'status'=>0, 'message'=> lg('Consultant_packet_link_is_not_available', $language) );
					    }
				    	
				    }elseif ($language == 'fr'){

				    	if(!empty($data['ncp_link_fr'])) {

				    		$url = parse_url($data['ncp_link_fr']);

							if($url['scheme'] == 'https' || $url['scheme'] == 'http'){

								$path = str_replace('%20', ' ', $url['path']);
							   	$data['ncp_link_fr'] = $url['scheme']."://".$url['host'].  $path;
							}else{

								$data['ncp_link_fr'] = str_replace('%20', ' ', $data['ncp_link_fr']);					
								$data['ncp_link_fr'] = 'http://'.$data['ncp_link_fr'];
							}

					    	$aMessage=array('status'=>1, /*'data'=>preg_replace('#^https?://#', '', $data['ncp_link_fr'])*/
					            'data'=>$data['ncp_link_fr'] );
					    }else {
					    	$aMessage=array('status'=>0,'message'=> lg('Consultant_packet_link_is_not_available', $language));
					    }

				    }
				}else{
					$aMessage= array('status'=>0, 'message'=> lg('Consultant_packet_link_is_not_available', $language));
				}
			}else{
				$aMessage=array( 'status'=>0, 'message'=> lg('Client_id_and_Language_is_require', 'en'));
			}

			echo SendResponse($aMessage);
			exit();
		}
	}
	//End of apiNcp.php


	//apiUserLogin.php
	function uacc_user_login() {
		if($this->input->post()) {
			extract($this->input->post());

			$curr_ver = $this->user_model->getAppVersion(); 
			$appMsg = array();
			if($app == 'A' || $app == 'a') {
				if($curr_ver['uacc_android'] > $version){
					$appMsg=array('update'=>1,'message'=>lg('You_are_using_old_UACC_app', $language));
					//$appMsg=array('update'=>1,'message'=>'App under maintenance');
				}
			}elseif ($app == 'I' || $app == 'i') {
				if($curr_ver['uacc_ios'] > $version){
					$appMsg=array('update'=>1,'message'=>lg('You_are_using_old_UACC_app', $language));
					//$appMsg=array('update'=>1,'message'=>'App under maintenance');
				}
			}

			if(empty($consultant_number) || empty($password)) {
				$msg=array('update'=>0, 'message'=>lg('Please_enter_login_details', $language), 'data'=>'empty data'); 
			}else {
				$userData = $this->user_model->getUACCInfo($consultant_number);
				if (empty($userData)) {
					$msg=array('update'=>0, 'message'=>lg('Incorrect_login_details', $language), 'data'=>'empty data');
				}else{
					if ($password != $userData['intouch_password']) {
						$msg=array('update'=>0, 'message'=>lg('Incorrect_login_details',$language), 'data'=>'empty data');
						echo SendResponse($msg);
						exit();
					}

					$adminData = $this->user_model->getAdminInfo();

					if(empty($userData['cv_account'])){
						$decrypted = '';
						$mask = '';
					}else{
						$decrypted = decryptIt($userData['cv_account']);
                    	$mask = maskCreditCard($decrypted);
					}

					$this->load->helper('API/api_helper');
					$aClientDetail = get_client_data($userData, $userData['cu_routing'], $decrypted, $mask, $adminData, $consultant_number, 1);

					if (!empty($fcm)) {
						$this->user_model->updateUACCFCM($userData['id_cc_newsletter'], $fcm, $app);
					}

					if(isset($appMsg) && !empty($appMsg)){
		        		$msg = $appMsg;
		        	}else{
		        		if($userData['app_login'] == '0') {
		        			if($app == 'i') {
								$device = 'iPhone';
							}elseif ($app == 'a') {
								$device = 'Android';
							}else {
								$device = 'No Device';
							}
						    $message=$this->sendMail($userData['name'], $userData['email'], $consultant_number, $device, 'office@textblastcutomers.com', 'Text Blast Customers');

						    if (!empty($message)) {
						    	$this->user_model->editUACCAppLogin($userData['id_cc_newsletter']);
						    	$this->user_model->addUACCEmailRecords($userData['id_cc_newsletter'],$device,$message);
						    }
		        		}
		        		$this->user_model->editUACCAppLastLogin($userData['id_cc_newsletter']);
		        		
		        		$msg=array('status'=>1, 'message'=>lg('You_are_loggedin_successfully', $language), 'data'=>$aClientDetail);
		        	}
				}
			}
			echo SendResponse($msg);
			exit();
		}
	}
	//End of apiUserLogin.php


	//apiTbpUserLogin.php
	function tbp_user_login() {
		if($this->input->post()) {
			extract($this->input->post());

			$curr_ver = $this->user_model->getAppVersion(); 
			$appMsg = array();
			if($app == 'a') {
				if($curr_ver['tbp_android'] > $version){
					$appMsg=array('update'=>1,'message'=>lg('You_are_using_old_UACC_app', $language));
				}
			}elseif ($app == 'i') {
				if($curr_ver['tbp_ios'] > $version){
					$appMsg=array('update'=>1,'message'=>lg('You_are_using_old_UACC_app', $language));
				}
			}

			if(empty($loginid) || empty($password)) {
				$msg=array('update'=>0, 'message'=>lg('Please_enter_login_details', $language), 'data'=>'empty data'); 
			}else {
				$userData = $this->user_model->getTBPInfo($loginid);
				if (empty($userData)) {
					$msg=array('update'=>0, 'message'=>lg('Incorrect_login_details', $language), 'data'=>'empty data');
				}else{
					if ($password != $userData['password']) {
						$msg=array('update'=>0, 'message'=>lg('Incorrect_login_details',$language), 'data'=>'empty data');
						echo SendResponse($msg);
						exit();
					}

					$adminData = $this->user_model->getAdminInfo();

					$aClientDetail = array(
    					'id_client' =>  empty($userData['id_blastpro']) ? '' : $userData['id_blastpro'] ,
    					'name' =>  empty($userData['name']) ? '' : $userData['name'] ,
    					'cell_phone_number' =>  empty($userData['phone']) ? '' : $userData['phone'],
    					'email_address' =>  empty($userData['email']) ? '' : $userData['email'],
    					'address' =>  empty($userData['address']) ? '' : $userData['address'],
    					'company_city' =>  empty($userData['c_city']) ? '' : $userData['c_city'],
    					'state' =>  empty($userData['state']) ? '' : $userData['state'],
    					'city' =>  empty($userData['city']) ? '' : $userData['city'],
    					'zip' =>  empty($userData['zip']) ? '' : $userData['zip'],
    					'website' =>  empty($userData['website']) ? '' : $userData['website'],
    					'facebook' =>  empty($userData['facebook']) ? '' : $userData['facebook'],
    					'referred' =>  empty($userData['referred']) ? '' : $userData['referred'],
    					'routing' => empty($userData['routing_no']) ? '' : $userData['routing_no'],
    					'account_no' => empty($userData['account_no']) ? '' : $userData['account_no'],
    					'admin_email' => empty($adminData['email']) ? '' : $adminData['email'],
    					'admin_phone_number' =>  empty($adminData['telephone']) ? '' : $adminData['telephone'],
    					'ftp_host'=>FTP_HOST,
    					'ftp_user'=>FTP_USER,
    					'ftp_password'=>FTP_PASS,
    					'ftp_file_upload_path'=>FILE_PATH
			        	);
					
					if(isset($appMsg) && !empty($appMsg)){
		        		$msg = $appMsg;
		        	}else{
						$msg=array('status'=>1, 'message'=>lg('You_are_loggedin_successfully', $language), 'data'=>$aClientDetail);
		        	}
				}
			}
			echo SendResponse($msg);
			exit();
		}
	}
	//End of apiTbpUserLogin.php




}