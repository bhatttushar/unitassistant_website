<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Firebase extends CI_Controller {

	public function __construct() {
		parent::__construct();
		/*isSecuredApp();*/
	}

	//androidFireBase.php
	function android_firebase(){

		//api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
		$server_key = 'AAAAjh01eR4:APA91bEV6rI4BZVXl6bCs3PZE05ov7EgofhHvJUZRlX3jPklZytpc2KRxs2zE55qrIU3c-a_3R0w_NNZQAyLvCrDVQkSJ4eMOtWM_1EKkd7pfIV8dvLr0YtmV4m5mN8kNm7_mzhneKxL';

		$target = array('f8JL70iRX30:APA91bFdRYAwgtHKJ6T63kFd0ZmejDFvokjRJtdxKiI0h5rkMMr58Mxm7HKLZ13YpmcesDNer_QHQ-0XMza0F0pwygsz4ydDhxiZETeTbJ-xhjGJ1qZrxgRMMpumxplQOyyCGJDw3ozr,f24e19XDgxY:APA91bFNctekIUye54bdxTYbqbw6pUDNrGauJGIIfarseTY4db_RbIAU7y7lSfP6Dd6TL0tqQkA2I3oW_Sb7ZvbRZlakh4LS-5rE3vwVI-oADTfxeQ5_lDeRq6fmLJGMicLLDoz7VIB9,djYembCsa_Q:APA91bFxadYek9RnyLOdP1ChAp-xPvdB7BpmaTswG6smF2PiFGKzIPy0iv4cNKQUgfbXpL6KFcRXPKBFslK1_CICQZYIhRAqm4XIZXYdsK_m61rEMfaspvPUQZxHpeTsOFpGADfytTgT','cmEY38f-hMQ:APA91bEkYLCI44zEfktZRDX69d4mABkLHr2jgbLbllMyhvNlLAtsN-svIAj2ujqbrdRodP1SlRDXzIbb_-rDHAyrzGo-YODuq-R8iN0SZz11jCsXkB0lm_zHiZ2ph-teHtgHhWuNhVPy','dvP_MJKZZvM:APA91bHBK7dcP-8jU7_MX5LiA4PTZvwcavSY6y_QzuYUklZMdaHOkvYPECSS7E0ReS_RtDDDdp_7MFUiafbbb5eeYcon6QNFlD3NnDa71iOuVof-T9IT-UaPAdjwcoGokeOYhbFkL0Mn','dezus2bGC6s:APA91bF6DQEqrsQybzfvUfqIp6UntgP9_0Ff8PRDQO9AAT-cNFDy8blBe0_i6itKnbV2PtAebsPcEigXnedcxDfefqtCY2NOuLsNRujqjBvZhpTnlDjp_gD2BusDM4rN8XyBp0RV76lV','d-86PebUyB8:APA91bEP0-xf4AjUPWPzzbiYkKyaTaLsDmUm89mh5RnxWuSBRD_ZE9usP__4cs13zcwcSjPnuFBioBJBv8sq_zpDVOqmrnJZhv0W6SJpSQofA9qOMtXO02veBOkfRKuvv6OFQOTBAZcq');
					
		$msg = array
		          (
				'body' 	=> 'Hey, Your newsletter is ready - Android Testing!!',
				'title'	=> 'Unit Assistant Newsletter - Android Test!!',
		     	'icon'	=> 'myicon',/*Default Icon*/
		      	'sound' => 'mySound'/*Default sound*/
		          );
					
		
		echo $this->send_fcm_api($server_key, $target, $msg);
		exit();	
		/*$aAppMessage=
			            array(
			            	'data'=> array(
			            			'body'=>'Hey, Your newsletter is ready - Android Testing!!',
			            			'title'=>'Unit Assistant Newsletter - Android Test!!'
			            		),
			            	'notification' => array(
			            			'body'=>'Hey, Your newsletter is ready - Android Testing!!',
			            			'title'=>'Unit Assistant Newsletter - Android Test!!',
			            			'click_action' => 'OPEN_ACTIVITY'
			            		),

			                'to' => $target
			            ); 
		header('Content-Type: application/json');
		echo json_encode($aAppMessage,JSON_UNESCAPED_SLASHES);*/
	}
	//End of androidFireBase.php



	//iPhoneFireBase.php
	function ios_firebase(){

		//api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
		$server_key = 'AAAA52vuIWo:APA91bE8-rh5aPp2mbNAa7wHuTf10fJfdUzxDPH1gUCNosOfcqCYSKeSH4usHnMVWtQ26XAns57gfIDm8EWoPHW8yFH42-MH4R0h1swIp6ifoIMeY4GaIBFz3JKcEBRuk2FUtMA4qPXT';

		$target = array('ckYooiZaHmQ:APA91bHm6iNTiiGvsxNmyhrQhVjTPU6UOSy58s_Adpn1xSCfZf2xu-hkt-5c5DvfFbOI4gwVBuXCAR4RysZq6mR4e-aZWl-Vz0TYm2onSsaxGozOPgRcJIgNlrAGMBqwZzhypAt010W6','fCly6lbumPM:APA91bGu2C6NH4gEMdgUosUyrbcsrLnf_DCsAQSsX_sckCqZJJPBB18zMwHC_XMG9lQX-O1166CVHbUEwQnFZbylel9NYWeovOB261M2ezz_jazrvYJlb8_BB-gYlxgz5Eg_A8b5AWdI');

		$msg = array
		          (
				'body' 	=> 'Hey, Your newsletter is ready!!',
				'title'	=> 'Unit Assistant Update!!',
		     	'icon'	=> 'myicon',/*Default Icon*/
		      	'sound' => 'mySound'/*Default sound*/
		          );
		echo $this->send_fcm_api($server_key, $target, $msg);
		exit();	

	}
	//End of iPhoneFireBase.php


	function send_fcm_api($server_key, $target, $msg){
		$url = 'https://fcm.googleapis.com/fcm/send';
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
		return $result;
		
	}

}