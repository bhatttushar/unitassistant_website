<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bellafizz extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('bellafizz/bellafizz_model');
		isUserLoggedIn();
	}

	function index(){
		$this->global['pageTitle'] = 'Bella Fizz List';
		$res['data']=$this->bellafizz_model->bellafizz_listing();
		loadFrontViews('bellafizz/bellafizz-list', $this->global,$res, NULL);
	}

	/*function AjaxData(){
		if (!empty($this->input->post()) && !empty($this->input->post('Records')) ) {
			$val = $this->input->post('Records');
			$data = $this->input->post();
			$searchValue = $data['search']['value']; // Search value
	        $draw = $data['draw'];
	        $row = $data['start'];
	        $rowperpage = $data['length']; // Rows display per page
	        $columnIndex = $data['order'][0]['column']; // Column index
	        $columnName = $data['columns'][$columnIndex]['data']; // Column name
	        $columnSortOrder = $data['order'][0]['dir']; // asc or desc

			$res=$this->bellafizz_model->$val($data,$searchValue,$row,$rowperpage,$columnName,$columnSortOrder);

			$count = ($row + 1);
	        $return = array();
	        foreach ($res['details'] as $value) {
	            $action = '<a href="'.base_url('edit-bellafizz/'.$value['id_bellafizz']).'" title="Click to edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
	            	
	            	<a href="'.base_url('delete-bellafizz/'.$value['id_bellafizz']).'" title="Delete record" 
	            	onclick="return confirm('."'Are you sure want to delete this record ?'".')" ><i class="fa fa-remove"></i></a>';
         
		        $date = date_create($value['updated_at']);
		        $updated_at = date_format($date,"m-d-Y");

		        $return[] = array( 
		            'number'=> $count,
		            'action'=> $action,
		            'updated_at'=> $updated_at,
		            'name'=> $value['name'],
		            'email'=> $value['email'],
		            'rep_id'=> $value['rep_id'],
		            'phone'=> $value['phone'],
		            'c_city'=> $value['c_city'],
		            'month_billing'=> $value['month_billing'],
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

	        echo json_encode($response);
			exit();
		}
	}*/

	function delete_bellafizz($id_bellafizz){
		$result = $this->bellafizz_model->delete_bellafizz($id_bellafizz);
		if ($result == true) {
			$this->session->set_flashdata('success', 'Record deleted successfully!!');
		} else {
			$this->session->set_flashdata('error', 'Something went wrong try again!!');
		}
		redirect('bellafizz');
	}

	function add_bellafizz(){
		if ($this->input->post()) {
			$aResponse = $this->payload_api($this->input->post('rep_id'));
			if($aResponse['success']){
				$result = $this->bellafizz_model->add_bellafizz($this->input->post());
				if ($result > 0) {
					$this->session->set_flashdata('success', 'Record added successfully!!');
				}else{
					$this->session->set_flashdata('error', 'Something went wrong try again!!');
				}
				redirect('edit-bellafizz/'.$result);
			}else{
				echo "<h2 class='text-center'>Something went wrong with BellaFizz API.</h2>";
				exit();
			}

		}else{
			$data['data'] = '';
			$this->global['pageTitle'] = 'Add new bellafizz';
			loadFrontViews('bellafizz/bellafizz', $this->global, $data, NULL);
		}
	}

	function edit_bellafizz($id_bellafizz){
		if ($this->input->post()) {
			$result = $this->bellafizz_model->edit_bellafizz($this->input->post(), $id_bellafizz);
			if ($result==TRUE) {
				$this->session->set_flashdata('success', 'Record updated successfully!!');
			}else{
				$this->session->set_flashdata('error', 'Something went wrong try again!!');
			}
			redirect('bellafizz');
		}else{
			$data['data'] = $this->bellafizz_model->get_bellafizz_data($id_bellafizz);
			$data['notedata'] = $this->bellafizz_model->get_bellafizz_notes($id_bellafizz);
			$data['users'] = get_users();
			$this->global['pageTitle'] = 'Edit bellafizz';
			loadFrontViews('bellafizz/bellafizz', $this->global, $data, NULL);
		}
	}

	function bellafizzEmailExist(){
		echo $this->bellafizz_model->checkEmailExists($this->input->post('email'), $this->input->post('id_bellafizz'));
		exit();
	}

	function bellafizzRepExists(){
		echo $this->bellafizz_model->checkRepExist($this->input->post('id_bellafizz'), $this->input->post('rep_id'));
		exit();
	}

	function payload_api($rep_id){
		$data = array(
                'method'     => 'user',
                'action'     => 'create',
                "repId"      => $rep_id
        );
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
        return $aResponse;
	}

	function add_bellafizz_note(){
		extract($this->input->post());
		$res = $this->bellafizz_model->add_bellafizz_note($this->input->post());
		if ($res > 0) {
			if(!empty($users)) {
				$users = $this->bellafizz_model->get_user_data($users);

				$AssignnamesArray = array();
			    $emails = array();
			    $aUserID = array();

			    foreach ($users as $key => $value) {
			      $AssignnamesArray[]= $value['user_name'];
			      $emails[]= $value['email'];
			      $aUserID[] = $value['id_user'];
			    }

			    $Assignnames = implode(',', $AssignnamesArray);
			    $emails = implode(',', $emails);
			    $sUserID = implode(',', $aUserID);
			    $sSend = $this->sendBellafizzNoteMail($emails, $client_name, $note, $Assignnames);

			    if ($sSend) {
			    	$this->bellafizz_model->add_to_email_records($sUserID, $id_bellafizz, $note);
			    }
			}
		}
		echo empty($res) ? 0 : $this->input->post('id_bellafizz');
		exit();
	}

	function sendBellafizzNoteMail($emails, $client_name, $note, $Assignnames){
	    $subject = empty($client_name) ? 'No Name' : $client_name;
	    $sContent = "<p style='font-size:16px;'>Hello,</p>";
		$sContent .= "<p style='font-size:16px;'>Client Name:&nbsp;".$client_name."</p>";
		$sContent .= "<p style='font-size:16px;'>Assigned Users : &nbsp;".$Assignnames."</p>";
		$sContent .= "<p style='font-size:16px;'>".$note."</p>";
		$sContent .= "<p style='font-size:16px;'>Thanks,</p>";
		$sContent .= "<p style='font-size:16px;'>".$this->session->userdata('name')."</p>";

	    $this->email->set_mailtype("html");
	    $this->email->from('office@unitassistant.com', 'Bellafizz');
	    $this->email->to($emails);
	    $this->email->subject($subject);
	    $this->email->message($sContent);
	    return $this->email->send();
	}

	function bellafizz_note_list(){
		$data = $this->bellafizz_model->get_bellafizz_notes($this->input->post('id_bellafizz'));
		return $this->bellafizzNoteListsHtml($this->input->post('id_bellafizz'), $data);
	}
	
	function bellafizzNoteListsHtml($id_bellafizz, $data){ ?>
		<div class="chat_area">
	      <ul class="list-unstyled">
	        <?php $nCount = count($data);
	        foreach($data as $val) {     
	          $sNotifyUser = $val['id_notify_user'];
	          if($sNotifyUser !='') {
	            $aNotifyUser = explode(',', $sNotifyUser);
	            $aUsers = array();
	            foreach ($aNotifyUser as $key=>$value)  {
	                 $assinUser = GetUserDataC($value);
	                 if (!empty($assinUser)) {
	                       $aUsers[] = $assinUser;
	                 }
	            }
	            $sUsers = implode(',', $aUsers);
	          }else {
	            $sUsers = '';
	          }           
	          $nDate = $val['created_at'];
	          $sCreatedDate = date("M j", strtotime($nDate));
	          $sTime = date('h:i A', strtotime($nDate));            
	          $sYear = date('Y', strtotime($nDate));
	          $sCurrentYear = date('Y');
	         ?>    
	        <li class="left clearfix">
	          <span class="chat-img1 pull-left">
	            <?php  
	            	$path = 'assets/images/profile_img/';
	            	$sProfile = empty($val['profile_pic']) ? $path.'female.jpg' : $path.$val['profile_pic']; ?>
	            <img src="<?php echo base_url($sProfile);?>" class="chat-img1">
	          </span>
	          <div class="chat-body1 clearfix">
	           <p><span class="user-name"><?php echo ucfirst($val['first_name'])."&nbsp;".ucfirst($val['last_name']);?> - </span><?php echo $val['note']; ?></p>
	            <?php if(!empty($sUsers)) { ?>
	                  <p class="assigned_users"><span class="user-name">Assigned Users - </span><span class="wrap"><?php echo $sUsers;?></span></p>
	            <?php } ?>

	            <div class="chat_time pull-right"><?php echo $sCreatedDate.' at '.$sYear."&nbsp;at&nbsp;".$sTime; ?></div>
	          </div>
	        </li>
	        <?php } 
	          if ($nCount >= 8) { ?>
	            <a href="javascript:void(0);" class="btn btn-default pull-right show-btn" onclick="loadNewBellafizzNotes(<?php echo $id_bellafizz; ?>, 'all');">View All Activity</a>
	          <?php } ?>
	      </ul>
	    </div>
	<?php }


}