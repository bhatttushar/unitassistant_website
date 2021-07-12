<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Prospects extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('prospects/prospects_model');
		isUserLoggedIn();
	}

	function index(){
		$this->global['pageTitle'] = 'Prospects List';
		$res['data']=$this->prospects_model->prospects_listing();
		loadFrontViews('prospects/prospects-list', $this->global,$res, NULL);
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

			$res=$this->prospects_model->$val($data,$searchValue,$row,$rowperpage,$columnName,$columnSortOrder);

			$count = ($row + 1);
	        $return = array();
	        foreach ($res['details'] as $value) {
	        	$action = '<a href="'.base_url('edit-prospects/'.$value['id_prospect']).'" title="Click to edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
	            	
	            	<a href="'.base_url('delete-prospects/'.$value['id_prospect']).'" title="Delete record" 
	            	onclick="return confirm('."'Are you sure want to delete this record ?'".')" ><i class="fa fa-remove"></i></a>';
         
		        $date = date_create($value['updated_at']);
		        $updated_at = date_format($date,"m-d-Y");

		        $return[] = array( 
		            'number'=> $count,
		            'action'=> $action,
		            'updated_at'=> $updated_at,
		            'name'=> $value['name'],
		            'phone'=> $value['phone'],
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

	function delete_prospects($id_prospect){
		$result = $this->prospects_model->delete_prospects($id_prospect);
		if ($result == true) {
			$this->session->set_flashdata('success', 'Record deleted successfully!!');
		} else {
			$this->session->set_flashdata('error', 'Something went wrong try again!!');
		}
		redirect('prospects');
	}

	function add_prospects(){
		if ($this->input->post()) {
			$result = $this->prospects_model->add_prospects($this->input->post());
			if ($result > 0) {
				$this->session->set_flashdata('success', 'Record added successfully!!');
			}else{
				$this->session->set_flashdata('error', 'Something went wrong try again!!');
			}
			redirect('edit-prospects/'.$result);
		}else{
			$this->global['pageTitle'] = 'Add new prospects';
			loadFrontViews('prospects/prospects', $this->global, NULL, NULL);
		}
	}

	function edit_prospects($id_prospect){
		if ($this->input->post()) {
			$result = $this->prospects_model->edit_prospects($this->input->post(), $id_prospect);
			if ($result==TRUE) {
				$this->session->set_flashdata('success', 'Record updated successfully!!');
			}else{
				$this->session->set_flashdata('error', 'Something went wrong try again!!');
			}
			redirect('prospects');
		}else{
			$data['data'] = $this->prospects_model->get_prospects_data($id_prospect);
			$data['notedata'] = $this->prospects_model->get_prospects_notes($id_prospect);
			$data['users'] = get_users();
			$this->global['pageTitle'] = 'Edit prospects';
			loadFrontViews('prospects/prospects', $this->global, $data, NULL);
		}
	}

	function add_prospects_note(){
		extract($this->input->post());
		$res = $this->prospects_model->add_prospects_note($this->input->post());
		if ($res > 0) {
			if(!empty($users)) {
				$users = $this->prospects_model->get_user_data($users);

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
			    $sSend = $this->sendProspectsNoteMail($emails, $client_name, $note, $Assignnames);

			    if ($sSend) {
			    	$this->prospects_model->add_to_email_records($sUserID, $id_prospect, $note);
			    }
			}
		}
		echo empty($res) ? 0 : $this->input->post('id_prospect');
		exit();
	}

	function sendProspectsNoteMail($emails, $client_name, $note, $Assignnames){
	    $subject = empty($client_name) ? 'No Name' : $client_name;
	    $sContent = "<p style='font-size:16px;'>Hello,</p>";
		$sContent .= "<p style='font-size:16px;'>Client Name:&nbsp;".$client_name."</p>";
		$sContent .= "<p style='font-size:16px;'>Assigned Users : &nbsp;".$Assignnames."</p>";
		$sContent .= "<p style='font-size:16px;'>".$note."</p>";
		$sContent .= "<p style='font-size:16px;'>Thanks,</p>";
		$sContent .= "<p style='font-size:16px;'>".$this->session->userdata('name')."</p>";

	    $this->email->set_mailtype("html");
	    $this->email->from('office@unitassistant.com', 'Prospects');
	    $this->email->to($emails);
	    $this->email->subject($subject);
	    $this->email->message($sContent);
	    return $this->email->send();
	}

	function prospects_note_list(){
		$data = $this->prospects_model->get_prospects_notes($this->input->post('id_prospect'));
		return $this->prospectsNoteListsHtml($this->input->post('id_prospect'), $data);
	}
	
	function prospectsNoteListsHtml($id_prospect, $data){ ?>
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
	            <a href="javascript:void(0);" class="btn btn-default pull-right show-btn" onclick="loadNewProspectsNotes(<?php echo $id_prospect; ?>, 'all');">View All Activity</a>
	          <?php } ?>
	      </ul>
	    </div>
	<?php }

}