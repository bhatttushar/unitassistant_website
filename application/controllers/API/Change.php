<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Change extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('API/change_model');
		$this->load->helper('API/api_helper');
		/*isSecuredApp();*/
	}

	//apiChange.php
	function index(){
		$params = (array) json_decode(file_get_contents('php://input'), TRUE);
		/*$sFileName = $params['file'];*/
		$sFileName = $_FILES['file'];

		$siteUrl = 'https://testing.unitassistant.website';
		$sDate = date("Y-m-d H:i:s");

		if(!empty($sFileName)){
        	$type = 'png';
			header("Content-type:image/".$type);
			$filesname = base64_decode($sFileName);
			$nUnique = generateUnique(4,4);
		   	$file= $nUnique;
		   	$filename = $file.".".$type;
			$path = 'https://testing.unitassistant.website/assets/images/API/'.$filename;	
    		$file_put = file_put_contents($path, $filesname);
			if($file_put){
	        	$aMessage=array('file'=>$filename);
            }else{
            	$aMessage=array('file'=>"");	
            }
		}else{
			$aMessage=array('file'=>"");
		}

		echo SendResponse($aMessage);
		exit();
	}
	//End of apiChange.php


	//apiChangeAndriod.php
	function change_android(){
		if($this->input->post()) {
			$params = (array) json_decode(file_get_contents('php://input'), TRUE);

			$siteUrl = 'https://testing.unitassistant.website';
			/*$nNewsLetterId =  isset($params['id_newsletter']) ? $params['id_newsletter'] : '';*/
			$nNewsLetterId = $this->input->post('id_newsletter');
			/*$sNames = isset($params['requested_changes']) ? addslashes($params['requested_changes']) : '';*/
			$sNames = $this->input->post('requested_changes');
			/*$aFiles = isset($params['files']) ? $params['files'] : '';*/
			$aFiles = empty($_FILES['files']['name']) ? '' : $_FILES['files']['name'];


			$sLanguage = $this->input->post('language');

			if(empty($nNewsLetterId)){
				$aMessage=array('status'=>0, 'message'=>lg('Newsletter_id_is_required', $sLanguage) );
			}elseif(empty($sNames)){
				$aMessage=array('status'=>0, 'message'=>lg('Please_enter_description', $sLanguage) );
			}else{
				$data = $this->change_model->get_client_id($nNewsLetterId);

				if (empty($data)) {
					$msg=array('status'=>0, 'message'=>lg('Client_id_is_not_valid', $sLanguage));
				}else{
				    $id_change = $this->change_model->add_to_changes($nNewsLetterId, $sNames);	
				    /*if(!empty($params['files'])){*/
				    if(!empty($aFiles)){
				    	/*foreach ($aFiles as $key => $value) {*/
				    		$this->change_model->add_to_changes_files($nNewsLetterId, $id_change, $aFiles);	
					    // }
				    }


				    $this->change_model->update_design_approve_status($nNewsLetterId, '3');
				    $change_name = $this->change_model->get_name($nNewsLetterId);

				    $this->load->library('MY_Email');

		            $semi_rand     = md5(time());
		            $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
		            /*$headers      .= "\nMIME-Version: 1.0\n" .
		                              "Content-Type: multipart/mixed;\n" .
		                            " boundary=\"{$mime_boundary}\"";*/
		            $dataMessage = "<p style='font-size:16px;'>Hello,</p>";
		            $dataMessage .= "<p style='font-size:16px;'>Your client &nbsp;".$change_name['name']."&nbsp;have submitted changes they want in their newsletter are as follow.</p>";
		            $dataMessage .= $sNames;
		            $message = "--{$mime_boundary}\n" .
		                      "Content-type: text/html; charset=iso-8859-1\n" .
		                      "Content-transfer-encoding: 8bit\n\n" .$dataMessage . "\n\n";
		            /*if (!empty($params['files'])){*/
		            if (!empty($aFiles)){
						/*foreach($aFiles as $key=>$value){*/
			            	$path   = "./assets/images/API/".$aFiles;
							$fileatt     = $path;
			               	$fileatttype = "image/png";
			                $fileattname = $aFiles; 
			                $data = chunk_split(base64_encode(file_get_contents($fileatt)));
		                	$message .= "--{$mime_boundary}\n" .
		                              "Content-Type: {$fileatttype};\n" .
		                              " name=\"{$fileattname}\"\n" .
		                              "Content-Disposition: attachment;\n" .
		                              " filename=\"{$fileattname}\"\n" .
		                              "Content-Transfer-Encoding: base64\n\n" .
		                            $data . "\n\n" .
		                                 "-{$mime_boundary}-\n";       
		                /*}*/
		            }

		            $this->email->set_mailtype("html");
				    $this->email->from('office@unitassistant.com', 'Unit Assistant Team');
				    $this->email->set_header("MIME-Version", "1.0");
				    $this->email->set_header("Content-Type", "multipart/mixed");
				    $this->email->set_header("boundary", $mime_boundary);
				    $this->email->to('cherylt@unitassistant.com');
				    $this->email->subject('Unit Assistant Team');
				    $this->email->message($message);
				    $sMail = $this->email->send();

		            if($sMail){
		            	$aRequestedChanges=array('id_newsletter'=>$nNewsLetterId, 'requested_changes'=>$sNames, 'file'=>$aFiles);
		            	$aMessage=array('status'=>1, 'message'=>lg('Requested_changes_successfully_submitted', $sLanguage), 'data'=>$aRequestedChanges);
		            }
				}		
			}

			echo SendResponse($aMessage);
			exit();
		}
	}
	//End of apiChangeAndriod.php


}