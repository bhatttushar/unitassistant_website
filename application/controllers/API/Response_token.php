<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Response_token extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('API/response_token_model');
		/*isSecuredApp();*/
	}


	//apiResponseToken.php
	function index(){
		if($this->input->post()) {
			extract($this->input->post());
	        $response_token = $this->response_token_model->get_response_token($id_device);
	        
	        if($response_token > 0){
	            $sResposne = $this->response_token_model->update_response_token($this->input->post());
	        }else{
	            $sResposne = $this->response_token_model->add_response_token($this->input->post());
	        }

	        if($sResposne){
	            $aDetail = array('id_device'=>$id_device, 'id_user'=>$id_user, 'platform'=>$platform );
	            $aMessage=array('status'=>1, 'data'=>$aDetail);
	        }else{
	        	$aMessage=array('status'=>0, 'data'=>'');
	        }   
			
		}
		echo SendResponse($aMessage);
		exit();	

	}
	//End of apiResponseToken.php

}