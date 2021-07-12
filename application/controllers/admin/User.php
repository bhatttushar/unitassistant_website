<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/user_model');
		isAdminLoggedIn();
	}

	function index(){
		$data['aUserDetails'] = $this->user_model->userListing();
		$this->global['pageTitle'] = 'Unit Assistant : User Listing';
		loadAdminViews("admin/user/userList", $this->global, $data, NULL);
	}

	function user_logout($id_user){
		$this->user_model->update_loggedin($id_user);
		redirect('admin/user-list');
	}

	function add_user() {
		if ($this->input->post()) {

			$emailExists = $this->user_model->checkEmailExists($this->input->post('email'));

			if (empty($emailExists)) {
				$result = $this->user_model->add_user($this->input->post());

				if ($result > 0) {
					$this->session->set_flashdata('success', 'User created successfully');
				} else {
					$this->session->set_flashdata('error', 'User creation failed');
				}
				redirect('admin/user-list');
			}else{
				$this->session->set_flashdata('error', 'This email already exists');
				redirect('admin/add-user');
			}

			
		} else {
			$this->global['pageTitle'] = 'Unit Assistant : Add User';
			loadAdminViews("admin/user/addUser", $this->global, NULL, NULL);
		}
	}

	function edit_user($id_user) {
		if ($this->input->post()) {
			$result = $this->user_model->edit_user($this->input->post());

			if ($result == true) {
				$this->session->set_flashdata('success', 'User updated successfully');
			} else {
				$this->session->set_flashdata('error', 'User updation failed');
			}
			redirect('admin/user-list');
		} else {
			$data['userInfo'] = $this->user_model->getUserInfo($id_user);
			$this->global['pageTitle'] = 'Unit Assistant : Edit User';
			loadAdminViews("admin/user/editUser", $this->global, $data, NULL);
		}
	}

	function delete_user($id_user) {
		$result = $this->user_model->delete_user($id_user);

		if ($result > 0) {
			$this->session->set_flashdata('success', 'User deleted successfully');
		} else {
			$this->session->set_flashdata('error', 'User deletion failed');
		}
		redirect('admin/user-list');
	}

	function delete_all_user() {
		$result = $this->user_model->delete_all_user($this->input->post('id_users'));
		if ($result > 0) {
			echo 'Users deleted successfully';
		} else {
			echo 'Users deletion failed';
		}
	}

	function re_send_mail($id_user) {
		$admin = $this->user_model->get_admin(); 
		$user = $this->user_model->get_user_data($id_user);

		$sPassword = generatePassword(6,2);
		$sSaltPassword = sha1($user['salt'] . $sPassword);

		$this->user_model->update_user_password($sSaltPassword, $id_user);
		
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';

		$msg = '<html><body>
				<p>Hello&nbsp;'.$user['first_name']."&nbsp;".$user['last_name'].',</p>
				<p>Your Password has been generate!!!</p>
				<p>Your Account Details are</p>
				<p><strong>Your Username :&nbsp;</strong>'.$user['user_name'].'</p>
				<p><strong>Your Password :&nbsp;</strong>'.$sPassword.'</p>
				<p>To Login into Unit Assistant Services, click on the below link.</p>
				<a href = "'.base_url().'">unitassistant.website</a>
				<p>Thank you!</p>
				<p><strong>Regards,</strong><br/></p>
				<p>'.$admin.'</p>
			</body></html>';

		$this->email->initialize($config);
		$this->email->from('<office@unitassistant.com>', 'Unit Assistant Team');
		$this->email->to($user['email']);
		$this->email->subject('Unit Assistant Verification Mail');
		$this->email->message($msg);

		$send = $this->email->send();	
		
		if ($send) {
			$res = $this->user_model->add_to_mail_record($id_user);

			if ($res > 0) {
				$this->session->set_flashdata('success', 'Mail send successfully');
			} else {
				$this->session->set_flashdata('error', 'Mail send failed');
			}
			redirect('admin/user-list');
		}
	}

	function track_hours($id_user) {
		$data['aLogsDetails'] = $this->user_model->getLogsDetails($id_user);
		$data['aDayLogsDetails'] = $this->user_model->getDayLogsDetails($id_user);
		$data['sumTotal'] = $this->user_model->getTimeDetails($id_user);
		$this->global['pageTitle'] = 'Unit Assistant : Hours Track';
		loadAdminViews("admin/user/trackHours", $this->global, $data, NULL);
	}
}

?>