<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bizz extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('API/bizz_model');
		/*isSecuredApp();*/
	}

	//apiBiz.php
	function index(){
		if($this->input->post()) {
			extract($this->input->post());
			
			if($language == 'en'){
	    		$sLang = 'E';
	    	}elseif($language == 'sp'){
	    		$sLang = 'S';
	    	}elseif($language == 'fr'){
	    		$sLang = 'F';
	    	}else{
	    		$sLang = 'E';
	    	}

	    	$data = $this->bizz_model->get_bizz_data($id_client);

	    	if($data['digital_biz_link'] != ''){
				$aClientDetail = array('id_client' => $id_client, 'biz' => $data['digital_biz_link'].'?lang='.$sLang);
			}

			if(!empty($aClientDetail)) {
				$aMessage= array( 'status'=>1, 'data'=>$aClientDetail );
			}else{
				$aMessage=array('status'=>0, 'message'=>lg('digial_biz_card_is_not_available', $language));
			}
			
			echo SendResponse($aMessage);
			exit();
		}
	}
	//End of apiBiz.php

	

}