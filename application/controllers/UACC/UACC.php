<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UACC extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('UACC/UACC_model');
		$this->load->helper('UACC/uacc_mail_helper');
		$this->load->helper('UACC/uacc_helper');
		isUserLoggedIn();
	}

	function add_uacc(){
		if ($this->input->post()) {
			$id_cc_newsletter = $this->UACC_model->add_uacc($this->input->post());
			if ($id_cc_newsletter > 0) {
				$data = $this->UACC_model->get_uacc_data($id_cc_newsletter);
			 	$id_cc_history=$this->UACC_model->add_cc_history($data);  
			 	$email_setting = $this->UACC_model->get_email_setting();
				if ($data['send_mail']=='1' && $email_setting=='1') {
					$mail_content = $this->UACC_model->get_mail_content();
					$sendMail = $this->UACC_model->send_mail($data, $mail_content);
				}
				$delete_client = $this->UACC_model->delete_cc_client($id_cc_newsletter, $data['contract_update_date']);
				redirect('customer-communication');
			}
		}else{
			$data['data'] = '';
			$this->global['pageTitle'] = 'Add new UACC';
			loadFrontViews('UACC/UACC-add', $this->global, $data, NULL);
		}
	}

	function edit_uacc($id_cc_newsletter){
		if ($this->input->post()) {
			$res = $this->UACC_model->edit_uacc($this->input->post(), $id_cc_newsletter);
			if ($res) {
				$data = $this->UACC_model->get_uacc_data($id_cc_newsletter);
			 	$id_cc_history=$this->UACC_model->add_cc_history($data);  
			 	$email_setting = $this->UACC_model->get_email_setting();
				if ($data['send_mail']=='1' && $email_setting=='1') {
					$mail_content = $this->UACC_model->get_mail_content();
					$sendMail = $this->UACC_model->send_mail($data, $mail_content, 'edit_client');
				}
				$delete_client=$this->UACC_model->delete_cc_client($id_cc_newsletter, $data['contract_update_date']);


				if (isset($_COOKIE['uacc-flag']) && $_COOKIE['uacc-flag'] == 0) { 
					redirect('edit-uacc/'.$id_cc_newsletter);
				}else{
					unset($_COOKIE['flag']);
					redirect('customer-communication');
				}
			}
		}else{
			$data['data'] = $this->UACC_model->get_uacc_data($id_cc_newsletter);
			$data['past_emails'] = $this->UACC_model->get_uacc_past_emails($id_cc_newsletter);
			$data['users'] = get_users();
			$data['notedata'] = $this->UACC_model->get_uacc_notes($id_cc_newsletter);

			$this->global['pageTitle'] = 'Edit UACC';
			loadFrontViews('UACC/UACC-edit', $this->global, $data, NULL);
		}
	}

	

	function add_cc_note(){
		$res = $this->UACC_model->add_cc_note($this->input->post());
		if ($res > 0) {
			if(!empty($this->input->post('users'))) {
				$this->UACC_model->SendCCNoteEmail($this->input->post('id_cc_newsletter'), $this->input->post());
			}
		}
		echo empty($res) ? 0 : $this->input->post('id_cc_newsletter');
		exit();
	}

	function cc_note_list(){
		$data = $this->UACC_model->get_uacc_notes($this->input->post('id_cc_newsletter'));
		return $this->CCNoteListsHtml($this->input->post('id_cc_newsletter'), $data);
	}
	
	function CCNoteListsHtml($id_cc_newsletter,$data){ ?>
		<div class="form-group">
			<div class="row">
				<div class="col-md-9">
					<label class="control-label">Add Note:</label>
				</div>
				<div class="col-md-3">
					<input type="button" name="save_note" class="btn btn-success pull-right save-note" value="Add Note" onclick="saveCCNote(<?php echo $id_cc_newsletter?>);">
					<input type="hidden" class="hidden-user" name="hidden-user">
					<input type="hidden" name="client_hidden_name" id="name_client" value="<?php echo getUACCName($id_cc_newsletter); ?>">
				</div>
			</div>
			<textarea class="form-control profile-form" name="note" id="note" required="" ></textarea>
			<span id="note-error" class="error"></span>
			<div class="row">
				<div class="col-lg-12 member">
					<label for="id_label_multiple"> Assign note to user: </label>
					<select class="js-example-basic-multiple js-states form-control" id="id_label_multiple" multiple="multiple">
					<?php

					foreach (get_users() as $value) { ?>
						<option value="<?php echo $value['id_user']; ?>"><?php echo $value['first_name'] . "&nbsp;" . $value['last_name']; ?></option>
					<?php } ?>
					</select>
				</div>
			</div>
			<img src="<?php echo base_url('assets/images/load.gif');?>" class="img-responsive" id="img-load">
			<div class="notes_listing">
				<div class="chat_area">
			      <ul class="list-unstyled">
			        <?php 
			        $nCount = 1;
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
			            <?php  $sProfile = empty($val['profile_pic']) ? 'assets/images/user_profile/female.jpg' : 'assets/images/user_profile/'.$val['profile_pic']; ?>
			            <img src="<?php echo base_url($sProfile);?>" class="chat-img1">
			          </span>
			          <div class="chat-body1 clearfix">
			           <p><span class="user-name"><?php echo ucfirst($val['first_name'])."&nbsp;".ucfirst($val['last_name']);?> - </span><?php echo $val['note']; ?></p>
			            <?php if(!empty($sUsers)) { ?>
			                  <p class="assigned_users"><span class="user-name">Assigned Users - </span><span class="wrap"><?php echo $sUsers;?></span></p>
			            <?php } ?>

			            <?php 
			              if( (isset($val['id_newsletter']) && $val['id_newsletter']!='') && $val['id_newsletter']==GetNewsletterId($val['id_cc_newsletter'])){
			                echo "<span class='error'><strong>UA</strong></span>";
			              }else {
			              	echo "<span class='error'><strong>UACC</strong></span>";    
			              } 
			            ?>
			            <div class="chat_time pull-right"><?php echo $sCreatedDate.' at '.$sYear."&nbsp;at&nbsp;".$sTime; ?></div>
			          </div>
			        </li>
			        <?php 
			        $nCount++;
			    } 
			          if ($nCount >= 8) { ?>
			            <a href="javascript:void(0);" class="btn btn-default pull-right show-btn" onclick="loadNewCCNotes(<?php echo $id_cc_newsletter; ?>, 'all');">View All Activity</a>
			          <?php } ?>
			      </ul>
			    </div>
			</div>
	    </div>
	    <script type="text/javascript">
	    	$(".js-example-basic-multiple").select2({
			  placeholder: "Click to select a user"
			});

			$(".js-example-basic-multiple").on("select2:select", function (e) { 
			    var select_val = $(e.currentTarget).val();
			    $(".hidden-user").val(select_val);
			});
	    </script>
	<?php }


	function UACCEmailExist(){
		echo checkUACCEmailExists($this->input->post('email'), $this->input->post('id'));
		exit();
	}

	//check Consultant Number Exist
	function UACCConsultantExist(){
		echo checkUACCConsultantExist($this->input->post('id'), $this->input->post('consultant'));
		exit();
	}

	function unsub_uacc_note($id_cc_newsletter){
		$this->global['pageTitle'] = 'Unsubscribed UACC Note';
		$data['data'] = $this->UACC_model->get_uacc_name($id_cc_newsletter);
		$data['notedata'] = $this->UACC_model->get_uacc_notes($id_cc_newsletter);
		$data['past_emails'] = $this->UACC_model->get_uacc_past_emails($id_cc_newsletter, 'unsub');
		$data['users'] = get_users();
		loadFrontViews('UACC/UACC-addNoteForUnsubscribe', $this->global, $data, NULL);	
	}


}