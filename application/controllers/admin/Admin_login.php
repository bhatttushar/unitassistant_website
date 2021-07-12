<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Admin_login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/admin_model');
	}

	public function index() {
		$isAdminLoggedIn = $this->session->userdata('isAdminLoggedIn');
		if (!isset($isAdminLoggedIn) || $isAdminLoggedIn != TRUE) {
			$this->load->view('admin/login_header');
			$this->load->view('admin/login');
			$this->load->view('admin/login_footer');
		} else {
			redirect('admin/dashboard');
		}
	}

	public function login() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('user_name', 'Username', 'required|max_length[128]');
		$this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$username = $this->security->xss_clean($this->input->post('user_name'));
			$password = $this->input->post('password');
		
			$result = $this->admin_model->login($username, $password);

			if (!empty($result)) {
				$sessionArray = array(
					'id_admin' => $result[0]['id_admin'],
					'user_name'=>$result[0]['user_name'],
					'email'=>$result[0]['email'],
					'first_name' => $result[0]['first_name'],
					'last_name'=> $result[0]['last_name'],
					'isAdminLoggedIn' => TRUE,
				);

				$this->session->set_userdata($sessionArray);
				redirect('admin/dashboard');
			} else {
				$this->session->set_flashdata('error', 'Incorrect User Name or Password, Please try again!!');
				redirect('admin');
			}
		}
	}
}

?>