<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Director_add extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('directors/director_add_model');
		$this->load->helper('directors/director_helper');
		$this->load->helper('directors/billing_helper');
		$this->load->helper('directors/director_mail_helper');
		isUserLoggedIn();
	}

	function index(){
		if ($this->input->post()) {

			$addDirector = $this->director_add_model->add_director($this->input->post());
			if ($addDirector) {
				$sendDirectorMail=$this->director_add_model->SendFullEmail($addDirector, $this->input->post());
				if ($sendDirectorMail) {
					redirect('edit-director/'.$addDirector);
				}
			}
		}else{
			$this->global['pageTitle'] = 'Add new director';
			loadFrontViews('directors/director-add', $this->global, NULL, NULL);
		}
	}

	function EmailExist(){
		echo checkEmailExists($this->input->post('email'), $this->input->post('id'));
		exit();
	}


	//check Consultant Number Exist
	function ConsultantExist(){
		echo checkConsultantExist($this->input->post('id'), $this->input->post('consultant'));
		exit();
	}

	function checkCC(){
		echo checkCC($this->input->post('id_newsletter'));
		exit();
	}

}