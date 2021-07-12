<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reggie_bellafizz extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('reggie_bellafizz_model');
	}

	function reggie_bellafizz() {
		if($this->input->post()) {
            
            //Payload for Randy bellafizzcc API
            $data = array( 'method'=>'user', 'action'=>'create', "repId"=>$this->input->post('rep_id') );
            $url = 'https://bellafizzcc.com/ua-api/bellafizz';
            $username = "22u9vk77cvJESuJF";
            $password = "KAN3txBYRgqZM36R";
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
            if($aResponse['success']){
                $id_bellafizz = $this->reggie_bellafizz_model->add_to_bellafizz($this->input->post());

                if ($id_bellafizz > 0) {
                    redirect('reggie-bellafizz?success');
                }
            }else{
                $this->session->set_flashdata('error', 'Something went wrong with BellaFizz API');
                redirect('reggie-bellafizz');
            }
		}else {
			$this->global['pageTitle'] = 'Reggie Bellafizz';
			loadViews('reggie_bellafizz', $this->global, NULL, NULL);
		}
	}

    function reggie_bellafizz_unique_email(){
        echo $this->reggie_bellafizz_model->checkReggieEmailExists($this->input->post('email'));
        exit();
    }

    function reggie_bellafizz_unique_rep_id(){
        echo $this->reggie_bellafizz_model->checkRepIdExists($this->input->post('rep_id'));
        exit();
    }

}