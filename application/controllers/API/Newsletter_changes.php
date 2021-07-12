<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter_changes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('API/newsletter_changes_model');
		/*isSecuredApp();*/
	}


	//apiNewsletterChanges.php
	function index(){
		if($this->input->post()) {
			extract($this->input->post());

			if(empty($id_newsletter)){
				$aMessage=array('status'=>0, 'message'=>lg('Newsletter_id_is_required', $language) );
			}elseif(empty($requested_changes)){
				$aMessage=array('status'=>0, 'message'=>lg('Please_enter_description', $language) );
			}else{
				$data = $this->newsletter_changes_model->get_client_id($id_newsletter);

				if (empty($data)) {
					$aMessage=array('status'=>0, 'message'=>lg('Client_id_is_not_valid', $sLanguage));
				}else{
			        $allowedExts=array("pdf", "PDF", "jpg", "JPG", "png", "PNG", "jpeg", "JPEG", "gif", "GIF", ""); 
			       	$allowedMimeTypes = array('application/pdf', 'image/gif', 'image/GIF', 'image/jpeg', 'image/JPEG', 'image/jpg', 'image/JPG', 'image/png', 'image/PNG' );
			       	
			       	$files = array();
			       	if(!empty($_FILES['file']['name'])){
			        	for($i=0; $i<count($_FILES['file']['name']); $i++){
				       		list($txt, $rrr) = explode(".", $_FILES["file"]["name"][$i]);
							$imageExt = explode(".",$_FILES["file"]["name"][$i]);
							$ext = end($imageExt);
							if (in_array($ext, $allowedExts)) {
							 	$id_change = $this->newsletter_changes_model->add_to_changes($id_newsletter, $requested_changes);	
							    if(!empty($_FILES['file']['name'])){
							    	for($i=0; $i<count($_FILES['file']['name']); $i++){
							       		list($txt, $rrr) = explode(".", $_FILES["file"]["name"][$i]);
										$imageExt = explode(".",$_FILES["file"]["name"][$i]);
										$ext = end($imageExt);
										$nUnique = generateUnique(2,2);
									   	$file= $nUnique."_".$txt;
									   	$filename = $file.".".$ext;

							        		
									   	if(in_array( $_FILES["file"]["type"][$i], $allowedMimeTypes )) {   
									   		$_FILES['img_file']['name'] = $filename;
											$_FILES['img_file']['type'] = $_FILES['file']['type'][$i];
											$_FILES['img_file']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
											$_FILES['img_file']['error'] = $_FILES['file']['error'][$i];
											$_FILES['img_file']['size'] = $_FILES['file']['size'][$i];

									      	$config['upload_path']='./assets/images/API/';
									      	$config['allowed_types'] = 'pdf|PDF|jpg|JPG|png|PNG|jpeg|JPEG|gif|GIF';
									      	$this->load->library('upload', $config);


									      	if($this->upload->do_upload('img_file')) {
										        $this->newsletter_changes_model->add_to_changes_files($id_newsletter, $id_change, $filename);
												$files[] = $filename;	
									      	}else{
									      		print_r($this->upload->display_errors());
									      	}
										}	
									}
								}
								$this->newsletter_changes_model->update_design_approve_status($id_newsletter, '3');
						    	$change_name = $this->newsletter_changes_model->get_name($id_newsletter);
							

					            $semi_rand     = md5(time());
					            $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
					            /*$headers      .= "\nMIME-Version: 1.0\n" .
					                              "Content-Type: multipart/mixed;\n" .
					                            " boundary=\"{$mime_boundary}\"";*/
					            $dataMessage = "<p style='font-size:16px;'>Hello,</p>";
					            $dataMessage .= "<p style='font-size:16px;'>Your client &nbsp;".$change_name['name']."&nbsp;have submitted changes they want in their newsletter are as follow.</p>";
					            $dataMessage .= $requested_changes;
					            $message = "--{$mime_boundary}\n" .
					                      "Content-type: text/html; charset=iso-8859-1\n" .
					                      "Content-transfer-encoding: 8bit\n\n" .$dataMessage . "\n\n";
					            if (!empty($_FILES['file']['name'])){
									foreach($files as $key=>$value){
										$fileatt     = "./assets/images/API/".$value;
										for($i=0; $i<count($_FILES['file']['name']); $i++){
						                	$fileatttype = $_FILES['file']['type'][$i];
						               	}
						                $fileattname = $value; 
						                $data = chunk_split(base64_encode(file_get_contents($fileatt)));
					                	$message .= "--{$mime_boundary}\n" .
					                              "Content-Type: {$fileatttype};\n" .
					                              " name=\"{$fileattname}\"\n" .
					                              "Content-Disposition: attachment;\n" .
					                              " filename=\"{$fileattname}\"\n" .
					                              "Content-Transfer-Encoding: base64\n\n" .
					                            $data . "\n\n" .
					                                 "-{$mime_boundary}-\n";       
					                }
					            }

							    $sMail = $this->send_mail($mime_boundary, $message); 
							    
					            if($sMail){
					            	$aRequestedChanges=array('id_newsletter'=>$id_newsletter, 'requested_changes'=>$requested_changes, 'file'=>$files);
					            	$aMessage=array('status'=>1, 'message'=>lg('Requested_changes_successfully_submitted', $language), 'data'=>$aRequestedChanges);
					            }
							}else{
								$aMessage=array('status'=>0, 'message'=>lg('File_Extesion_Not_Allowed', $language));
							}
						}
					}
				}		
			}

		}

		echo SendResponse($aMessage);
		exit();	
	}

	function send_mail($mime_boundary, $message){
		$this->email->set_mailtype("html");
	    $this->email->from('office@unitassistant.com', 'Unit Assistant Team');
	    $this->email->set_header("MIME-Version", "1.0");
	    $this->email->set_header("Content-Type", "multipart/mixed");
	    $this->email->set_header("boundary", $mime_boundary);
	    $this->email->to('cherylt@unitassistant.com');
	    $this->email->subject('Unit Assistant Team');
	    $this->email->message($message);
	    return $this->email->send();
	}


	//End of apiNewsletterChanges.php

}