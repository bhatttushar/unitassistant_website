<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('front_model');
		$this->load->helper('directors/director_helper');
	}

	function index() {
		$this->isUserLoggedIn();
	}

	function isUserLoggedIn() {
		$isUserLoggedIn = $this->session->userdata('isUserLoggedIn');

		$id_user =  $this->session->userdata('id_user');
		$login = getUserLogged($id_user);

		if ( (isset($isUserLoggedIn) || $isUserLoggedIn == TRUE) && $login['is_loggedin']=='1') {
			redirect('directors');
		} else {
			$this->global['pageTitle'] = 'User Login';
			loadViews('login', $this->global, NULL, NULL);
		}
	}

	function logout() {
		$id_user = $this->session->userdata('id_user');
		$res = $this->front_model->set_logged_out($id_user);
		if ($res) {
			$this->session->sess_destroy();
			redirect('user-login');
		}
	}

	function login() {
		if ($this->input->post()) {
			$result = $this->front_model->loginMe($this->input->post('username'), $this->input->post('password'));
			if (!empty($result)) {
				$sessionArray = 
					array(
						'id_user' => $result->id_user,
						'name' => $result->first_name . ' ' . $result->last_name,
						'username' => $result->user_name,
						'email' => $result->email,
						'profile_pic' => $result->profile_pic,
						'isUserLoggedIn' => TRUE,
					);
				$res = $this->front_model->set_logged_in_true($result->id_user);
				if ($res) {
					$this->session->set_userdata($sessionArray);
				}
				redirect('directors');
			} else {
				$this->session->set_flashdata('error', 'Email and password mismatch or you are login on other device');
				redirect('user-login');
			}
		}else{
			$this->index();
		}
	}

	function signup() {
		if ($this->input->post()) {
			$result = $this->front_model->userSignUp($this->input->post());
			if ($result > 0) {
				$this->session->set_flashdata('success', 'You have registered successfully');
			} else {
				$this->session->set_flashdata('error', 'You have not registered successfully');
			}
			redirect('user-login');
		} else {
			$this->global['pageTitle'] = 'User Signup';
			loadViews('signUp', $this->global, NULL, NULL);
		}
	}

	function all_notes(){
		$this->global['pageTitle'] = 'All Notes';
		loadFrontViews('all_notes', $this->global, NULL, NULL);
	}

	function all_notes_list_ajax(){
		if (!empty($this->input->post()) && !empty($this->input->post('Records')) ) {
			$val = $this->input->post('Records');
			$data = $this->input->post();
			
	        $draw = $data['draw'];
	        $row = $data['start'];
	        $rowperpage = $data['length']; // Rows display per page
	        

			$res=$this->front_model->$val($data, $row, $rowperpage);

			$count = ($row + 1);
	        $return = array();
	        foreach ($res['details'] as $value) {
	            
	            $return[] = array( 
	                'number'=> $count,
	                'note'=> $value['note'],
		            'name'=> $value['name'],
		            'created_date'=> $value['created_date']
	            );
	            $count++;    
	        }
	        $response = array(
	          "draw" => intval($draw),
	          "query" => $res['query'],
	          "iTotalRecords" => $res['total_record_filter'],
	          "iTotalDisplayRecords" => $res['total_records'],
	          "aaData" => $return
	        );

	        echo json_encode( $response );
			exit();
		}
	}

	function search_notes_by_tags(){
		$sStrings = !empty($this->input->post('string')) ? $this->input->post('string') : '';
		$sTodate = !empty($this->input->post('todate')) ? $this->input->post('todate') : '';
		$sFromdate = !empty($this->input->post('fromdate')) ? $this->input->post('fromdate') : '';

		$data = $this->front_model->get_search_notes_by_tags($sStrings, $sTodate, $sFromdate);
		return $this->NotesHtml($data);		
	}

	function NotesHtml($data){ ?>
		<table class="table table-striped table-bordered table-hover table-green" id="notes_table">
		    <thead>
		       	<tr>
			        <th>#</th>
			        <th>Note Description</th>
			        <th>Client Name</th>
			        <th>Created At</th>
			    </tr>   
		    </thead>
		    <tbody>
		        <?php 
		            $nCount=1 ; 
		            foreach ($data as $val) { ?>
		            <tr class="odd gradeX">
		                <td><?php echo $nCount++;?></td>
		                <td><?php echo $val['note'];?></td>
		                <td><?php echo $val['name'];?></td>
		                <td><?php echo $val['created_date'];?></td>
		            </tr>
		        <?php } ?> 
		    </tbody>
		</table>
<?php }


	function all_emails(){
		$this->global['pageTitle'] = 'All Emails';
		loadFrontViews('all_emails', $this->global, NULL, NULL);
	}

	function all_emails_list_ajax(){
		if (!empty($this->input->post()) && !empty($this->input->post('Records')) ) {
			$val = $this->input->post('Records');
			$data = $this->input->post();
			
	        $draw = $data['draw'];
	        $row = $data['start'];
	        $rowperpage = $data['length']; // Rows display per page
	        

			$res=$this->front_model->$val($data, $row, $rowperpage);

			$count = ($row + 1);
	        $return = array();

	        foreach ($res['details'] as $value) {

	        	if(!empty($value['id_newsletter'])){
                    $name = getName($value['id_newsletter']);
                }else{
                	$name = getUACCName($value['id_cc_newsletter']);
                }


                if ($value['userto'] != '') {
                	$aUserToData = getUserToName($value['userto']);
                	$sent_to = isset($aUserToData['first_name']) ? $aUserToData['first_name'].' '.$aUserToData['last_name'] : '';
                }else{
                	$sent_to='';
                }

	                

	        	$aUserByData = getUserByName($value['userby']);
	        	$sent_by = isset($aUserByData['first_name']) ? $aUserByData['first_name'].' '.$aUserByData['last_name'] : '';
	            
	            $return[] = array( 
	                'number'=> $count,
	                'sent_by'=> $sent_by,
		            'name'=> $name,
	                'sent_to'=> $sent_to,
	                'purpose'=> $value['purpose'],
		            'created_at'=> $value['created_at']
	            );
	            $count++;    
	        }
	        $response = array(
	          "draw" => intval($draw),
	          "query" => $res['query'],
	          "iTotalRecords" => $res['total_record_filter'],
	          "iTotalDisplayRecords" => $res['total_records'],
	          "aaData" => $return
	        );

	        echo json_encode( $response );
			exit();
		}
	}


	function user_account(){
		$id_user = CurrentUser();
		if ($this->input->post()) {

			$sError = false;
			if ($this->input->post('password') == '') {
				$sSalt = $this->input->post('salt');
	        	$sSaltPassword = $this->input->post('hidden_password');
			}else{
				if ($this->input->post('password') != $this->input->post('re_password')) {
					$sError = true;
					$error_msg = "Your Password Does Not Match, Please try again";	
				}else{
					$sSalt = md5($this->input->post('user_name') . gettimeofday(true));
		        	$sSaltPassword = sha1($sSalt . $this->input->post('password'));
				}
			}

			if (!empty($_FILES['profile_picture']['name'])){
				$aAllowedExt =  array('JPEG','PNG','png' ,'jpg','JPG','jpeg');
		        $sFilename = $_FILES['profile_picture']['name'];
		        $sExt = pathinfo($sFilename, PATHINFO_EXTENSION);
		        if(!in_array($sExt, $aAllowedExt) ){
		        	$sError = true;
		            $error_msg = "Extension Not Valid Please Choose valid file type!!";
		        }else{

		        	$aExtension = (explode(".", $_FILES['profile_picture']['name']));

				    $config['upload_path'] = './assets/images/user_profile/';
				    $config['allowed_types'] = 'JPEG|PNG|png|jpg|JPG|jpeg';
				    $config['file_name'] = prepareUniqueName($aExtension);
				    $this->load->library('upload', $config);

				    if($this->upload->do_upload('profile_picture')) {
				       $profile_img = $this->upload->data('file_name');
				       @unlink($config['upload_path'].$this->input->post('alt_image'));
				    }else{
				    	$profile_img = $this->input->post('alt_image');
				    }
		        }
			}else{
				$profile_img = $this->input->post('alt_image');
			}

			if ($sError == false){
				$result = $this->front_model->edit_user_profile($this->input->post(), $id_user, $sSalt, $sSaltPassword, $profile_img);
				if ($result) {
					$sessionArray = array(
						'name' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
						'profile_pic' => $profile_img,
					);

					$this->session->set_userdata($sessionArray);

					$this->session->set_flashdata('success', 'Profile updated successfully');
				} else {
					$this->session->set_flashdata('error', 'Profile not updated successfully');
				}	
			}else{
				$this->session->set_flashdata('error', $error_msg);
			}
			
			redirect('user-account');
		}else{
			
			$this->global['pageTitle'] = 'User Profile';
			$data['user_data'] = $this->front_model->get_user_data($id_user);
			loadFrontViews('profile', $this->global, $data, NULL);
		}
	}


}
