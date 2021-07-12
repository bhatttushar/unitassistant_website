<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('cron_model');
		$this->load->helper('directors/director_helper');
		$this->load->helper('directors/billing_helper');
	}

	function newsletter_cron(){

		$apiKey = mailchimp_key;
		$list_id = cron_list_id;
		$MailChimp = $this->get_mail_chimp_object($apiKey);
		$details = $this->cron_model->get_newsletter_data();
		
		$currDay = date('d');
		
		if($currDay == "10"){
		   $response=$this->get_mailchimp_member($list_id, $apiKey, 30, '0d2a4232-c479-439b-8ffd-34a6a6a3690d');
		   $aSubscribesEmails = $this->get_subscribes_emails($response);

		   $aEmails = array();
			if (!empty($details)) {
				foreach ($details as $key => $val) {
					if($val['beatly_url'] !='' || $val['beatly_url_one'] !='' || $val['beatly_url_two'] !=''){
			            if(($val['design_approve_status'] == '3') || ($val['design_approve_status'] == '2')){
			                $aEmails[] = $val['email'];
			                $memberId   = md5(strtolower($val['email']));

			                // If clients already found in subsribed list then update the client
			                if(in_array($val['email'], $aSubscribesEmails)){
			                	  $result = $MailChimp->patch("lists/".$list_id."/members/".$memberId, [
			                    'merge_fields' => ['FNAME'=>$val['name'], 'LNAME'=>$val['name'],'ID'=>$val['id_newsletter'], 'MMERGE5'=>$val['newsletters_design'], 'MMERGE6'=>$val['beatly_url_one'], 'MMERGE7'=>$val['beatly_url_two'], 'MMERGE4'=>$val['beatly_url']]]);
			                }else{
			                	  // If clients not  found in subsribed list then add  the client in mailchimp list
			                    $dataCenter = substr($apiKey, strpos($apiKey, '-') + 1);
			                    $url        = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/'.$list_id .'/members/' . $memberId;
			                    $json = json_encode([
			                        'email_address' => $val['email'],
			                        'status'        => 'subscribed',
			                        'update_existing'   => true, 
			                        'merge_fields'  => [
		                            	'FNAME'     => empty($val['name']) ? '' : $val['name'],
		                            	'LNAME'     => empty($val['name']) ? '' : $val['name'],
		                             	'ID' => $val['id_newsletter'],
		                             	'MMERGE5' => $val['newsletters_design'],
		                             	'MMERGE6'=>empty($val['beatly_url_one']) ? '' : $val['beatly_url_one'],
		                             	'MMERGE7'=>empty($val['beatly_url_two']) ? '' : $val['beatly_url_two'],
		                             	'MMERGE4'=>empty($val['beatly_url']) ? '' : $val['beatly_url']
			                        ]
			                    ]);
			                    $responseData = $this->send_post_request($url, $apiKey, 'PUT', $json);
			                }
			            }
			        }
				}
			}

			// If clients not exist in aEmails array then delete this client.
		    if(!empty($aSubscribesEmails)){
		        foreach ($aSubscribesEmails as $aSubscribesEmail) {
		            if(!in_array($aSubscribesEmail, $aEmails)){
		                $memberId   = md5(strtolower($aSubscribesEmail));       
		                $dataCenter = substr($apiKey, strpos($apiKey, '-') + 1);
		                $url='https://'.$dataCenter.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members/'.$memberId;
		                $json = json_encode([
		                    'email_address' => $aSubscribesEmail,
		                    'status'        => 'unsubscribed',
		                    'update_existing'   => true
		                ]);
		                $responseData = $this->send_post_request($url, $apiKey, 'DELETE', $json);
		            }
		        }    
		    }

		    $result = $MailChimp->post("campaigns", [
		    'type' => 'regular',
		    'recipients' => ['list_id' => cron_list_id],
		    'settings' => ['subject_line' => "Your newsletter is ready to view - Approval requested",
		       'reply_to' => "office@unitassistant.com",
		       'from_name' => "Unit Assistant Service"
		      ]
		    ]);
		    $response = $MailChimp->getLastResponse();
		    $responseObj = json_decode($response['body']);

		    $html = "asdasdasdlkajs  asdkj dlk as askldja 'ask aslk as slk asd";
		    $result = $MailChimp->put('campaigns/' . $responseObj->id . '/content', [
		      'template' => ['id' => cron_template_id]
		      ]);
		    $result = $MailChimp->post('campaigns/' . $responseObj->id . '/actions/send');
		}
	}

	function disapprove_design_status_cron(){
		$id_newsletters = $this->cron_model->get_id_newsletters();
		if (!empty($id_newsletters)) {
			foreach ($id_newsletters as $key => $value) {
				$this->cron_model->update_design_approve_status($value['id_newsletter']);
			}
		}
	}

	function logout_cron(){
		$this->cron_model->update_is_loggedin();
	}

	function reminder_cron(){
		$data = $this->cron_model->get_reminder_data();

		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$subject = 'Reminder from unitassistant service';
				$sContent = "<html><body>";
				$sContent .= "<h4 style='font-size:16px;'>Hello  <strong>".$value['user_name']."</strong>,</h4>";
				$sContent .= "<p style='font-size:16px;'>Your remainer for &nbsp;".$value['name']."</p>";
				$sContent .= "<p style='font-size:16px;'><strong>Reminder note:</strong>&nbsp;".$value['reminder_note']." </p>";
				$sContent .= "</body></html>";

				$this->email->set_mailtype("html");
			    $this->email->from('office@unitassistant.com', 'Unit Assistant');
			    $this->email->to($value['email']);
			    $this->email->subject($subject);
			    $this->email->message($sContent);
			    $send = $this->email->send();

				if($send){
					$this->cron_model->update_reminder($value['id_reminder']);
				}
			}
		}
	}

	function delete_all_member_mailchimp(){
		$apiKey = mailchimp_key;
		$list_id = cron_list_id;
		$MailChimp = $this->get_mail_chimp_object($apiKey);
		$response = $this->get_mailchimp_member($list_id, $apiKey, 500, '78f1c6f9-715e-4398-8ac7-a91be025bea5');
		$aSubscribesEmails = $this->get_subscribes_emails($response);
		$aSubscribesEmails = array_filter($aSubscribesEmails);
		$spamAddresses = $aSubscribesEmails;
		$Batch = $MailChimp->new_batch();

		for($i = 0; $i < sizeof($spamAddresses); $i++){
		    $subscriberHash = $MailChimp->subscriberHash($spamAddresses[$i]);
		    $Batch->delete("op$i", "lists/".$list_id."/members/".$subscriberHash);
		}
		$result = $Batch->execute();
		exit();
	}

	function delete_all_invoice_member_mailchimp(){
		$apiKey = mailchimp_key;
		$list_id = billing_list_id;
		$MailChimp = $this->get_mail_chimp_object($apiKey);
		$response = $this->get_mailchimp_member($list_id, $apiKey, 30, '78f1c6f9-715e-4398-8ac7-a91be025bea5');
		$aSubscribesEmails = $this->get_subscribes_emails($response);
		$aSubscribesEmails = array_filter($aSubscribesEmails);
		$spamAddresses = $aSubscribesEmails;
		$Batch = $MailChimp->new_batch();

		for($i = 0; $i < sizeof($spamAddresses); $i++){
		    $subscriberHash = $MailChimp->subscriberHash($spamAddresses[$i]);
		    $Batch->delete("op$i", "lists/".$list_id."/members/".$subscriberHash);
		}
		$result = $Batch->execute();
		exit();
	}

	function delete_all_UACC_invoice_member_mailchimp(){
		$apiKey = mailchimp_key;
		$list_id = UACC_billing_list_id;
		$MailChimp = $this->get_mail_chimp_object($apiKey);
		$response = $this->get_mailchimp_member($list_id, $apiKey, 30, '78f1c6f9-715e-4398-8ac7-a91be025bea5');
		$aSubscribesEmails = $this->get_subscribes_emails($response);
		$aSubscribesEmails = array_filter($aSubscribesEmails);
		$spamAddresses = $aSubscribesEmails;
		$Batch = $MailChimp->new_batch();

		for($i = 0; $i < sizeof($spamAddresses); $i++){
		    $subscriberHash = $MailChimp->subscriberHash($spamAddresses[$i]);
		    $Batch->delete("op$i", "lists/".$list_id."/members/".$subscriberHash);
		}
		$result = $Batch->execute();
		exit();
	}


	function get_mailchimp_member($list_id, $apiKey, $timeout, $token){
		$curl = curl_init();
	    curl_setopt_array($curl, array(
	      CURLOPT_URL => "https://us16.api.mailchimp.com/3.0/lists/".$list_id."/members?count=5000",
	      CURLOPT_RETURNTRANSFER => true,
	      CURLOPT_ENCODING => "",
	      CURLOPT_MAXREDIRS => 10,
	      CURLOPT_TIMEOUT => $timeout,
	      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	      CURLOPT_CUSTOMREQUEST => "GET",
	      CURLOPT_HTTPHEADER => array(
	        "Authorization: Bearer ".$apiKey."",
	        "Cache-Control: no-cache",
	        "Postman-Token: ".$token
	      ),
	    ));
	    $response = curl_exec($curl);
	    $err = curl_error($curl);
	    curl_close($curl);
	    return $response;
	}

	function send_post_request($url, $apiKey, $request, $json){
		$ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return json_decode($result, TRUE);  // 
	}

	function get_subscribes_emails($response){
		$aSubscribesEmails = array();
		$Report = json_decode($response);

		foreach ($Report->members as $key => $value) {
		    foreach ($value as $k => $v) {
		        $aSubscribesEmails[] = $value->email_address;
		    }
		}
		return array_filter($aSubscribesEmails);
	}

	function get_mail_chimp_object($apiKey){
		require_once APPPATH."/third_party/mailchimp-api-master/vendor/autoload.php"; 
		require_once APPPATH."/third_party/mailchimp-api-master/src/MailChimp.php";
		require_once APPPATH."/third_party/mailchimp-api-master/mcapi.php";
		require_once APPPATH."/third_party/mailchimp-api-master/examples/config/config.inc.php";
		$MailChimp = new \DrewM\MailChimp\MailChimp($apiKey);
		return $MailChimp;
	}

	function future_cron(){
		$data = $this->cron_model->get_future_clients();

		if (!empty($data)) {
			$this->load->model('directors/director_edit_model');
			foreach ($data as $key => $value) {
				$edit_director = $this->director_edit_model->edit_director($value);
				if ($edit_director) {
					$this->cron_model->update_table('id_newsletter', $value['id_newsletter'], 'future_general_info');
				}
			}
		}

		$unsub_client = $this->cron_model->get_unsubcribed_client('id_newsletter', 'newsletter_general_info');

		if (!empty($unsub_client)) {
			foreach ($unsub_client as $key => $value) {
				$aResponse = $this->unsub_client_curl($value, 0);			
	            if(isset($aResponse['success']) && ($aResponse['success'] == 'yes')){
	                $this->cron_model->update_table('id_newsletter', $value['id_newsletter'], 'newsletter_general_info');
	            }
			}
		}

		$unsub_cc_client = $this->cron_model->get_unsubcribed_client('id_cc_newsletter', 'cc_newsletters');
		
		if (!empty($unsub_cc_client)) {
			foreach ($unsub_cc_client as $key => $value) {
				$aResponse = $this->unsub_client_curl($value, 1);			
	            if(isset($aResponse['success']) && ($aResponse['success'] == 'yes')){
	                $this->cron_model->update_table('id_cc_newsletter', $value['id_cc_newsletter'], 'cc_newsletters');
	            }
			}
		}

	}

	function unsub_client_curl($val, $newState){

		$aExplodeContractDate = explode('-', $val['contract_update_date']);
     	$UD = $aExplodeContractDate[2].'-'.$aExplodeContractDate[0].'-'.$aExplodeContractDate[1];
     	$date=date_create($UD);
		$future = date_format($date,"Y/m/d");
     	$current = date("Y/m/d");

      if($future <= $current) {
         $data = array(
             'consultId'     => $val['consultant_number'],
             'method'        => 'updateUser',
             "newState"      => $newState
         );
         $url = 'https://www.unitnet.com/ua-api/updateuser';
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
		
	}


}