<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Director_edit extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('directors/director_edit_model');
		$this->load->helper('directors/director_helper');
		$this->load->helper('directors/billing_helper');
		$this->load->helper('directors/director_mail_helper');
		isUserLoggedIn();
	}

	function index($id_newsletter){

		$url = $this->uri->segment(1);
		$Is_note = (!empty($this->uri->segment(3)) ? $this->uri->segment(3) : 0);
		$is_send_mail = $this->input->post('is_send_mail');
		$is_view_details_save = $this->input->post('is_view_details_save');
		if ($this->input->post()) {

			$package_for = $this->input->post('package_for');
			if ($package_for == 'F' || $url=='edit-future-director') {
				$future_director_exists=$this->director_edit_model->is_future_director_exists($id_newsletter);
				if (empty($future_director_exists)) {
					$this->load->model('directors/director_add_model');
					$add_future_director = $this->director_add_model->add_director($this->input->post(), 'future');	
				}else{
					$edit_future_director=$this->director_edit_model->edit_director($this->input->post(), 'future');
				}
			}else{
				$editDirector = $this->director_edit_model->edit_director($this->input->post());
				if ($editDirector) {
					if ($is_send_mail == '1') {
						$sendDirectorMail=$this->director_edit_model->SendFullEmail($id_newsletter, $this->input->post());
					}
				}
			}
			if(isset($_COOKIE['flag']) && $_COOKIE['flag']==0){ 
				if ($url=='edit-future-director') {
					redirect('edit-future-director/'.$id_newsletter);
				}else{
					redirect('edit-director/'.$id_newsletter);
				}
			}else if($url=='edit-future-director') {
				unset($_COOKIE['flag']);
				redirect('future-directors');
			}else{
				unset($_COOKIE['flag']);
				redirect('directors');	
			}
		}else{
			$table = ($url=='edit-future-director') ? 'future' : 'newsletter'; 

			$data['data'] = $this->director_edit_model->get_newsletter_data($id_newsletter, $table);
			$mailData = $this->director_edit_model->get_user_email_details($id_newsletter, $table);

			if (!empty($mailData)) {
				$data['aClientData'] = $this->director_edit_model->get_client_data($mailData['id_newsletter'], $table);
			}

			$data['id_newsletter'] = $id_newsletter;
			$data['cc_exists']=$this->director_edit_model->get_cc_exists($data['data']['consultant_number']);
			$data['is_user_login']=$this->director_edit_model->get_purpose($id_newsletter);
			$data['future_date']=$this->director_edit_model->get_future_date($id_newsletter);
			$data['Is_note'] = $Is_note;
			$data['past_emails'] = $this->director_edit_model->GetPastEmails($id_newsletter, $table);
			$data['users'] = get_users();
			$data['notedata'] = $this->director_edit_model->get_notes_data($id_newsletter);
			$this->global['pageTitle'] = 'Edit Director || '.$data['data']['name'];
			loadFrontViews('directors/director-edit', $this->global, $data, NULL);	
		}
	}

	function ViewDetails() {
		if (!empty($this->input->post())) {
			return $this->director_edit_model->ViewModel($this->input->post());
		}else {
			return '';
		}
	}

	function add_note(){
		$res = $this->director_edit_model->add_note($this->input->post());
		if ($res > 0) {
			if(!empty($this->input->post('users'))) {
				$this->director_edit_model->SendNoteEmail($this->input->post('id_newsletter'), $this->input->post());
			}
		}
		echo empty($res) ? 0 : $this->input->post('id_newsletter');
		exit();
	}

	function note_list(){
		$data = $this->director_edit_model->get_notes_data($this->input->post('id_newsletter'));
		return $this->NoteListsHtml($this->input->post('id_newsletter'), $data);
	}
	
	function NoteListsHtml($id_newsletter,$data){ ?>
		<div class="form-group">
			<div class="row">
				<div class="col-md-9">
					<label class="control-label">Add Note:</label>
				</div>
				<div class="col-md-3">
					<input type="button" name="save_note" class="btn btn-success pull-right save-note" value="Add Note" onclick="saveNote(<?php echo $id_newsletter?>);">
					<input type="hidden" class="hidden-user" name="hidden-user">
					<input type="hidden" name="client_hidden_name" id="name_client" value="<?php echo getName($id_newsletter); ?>">
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
			              if ($val['id_cc_newsletter']!='' && $val['id_cc_newsletter']==oldCCN($val['id_newsletter'])) {
			                    echo "<span class='error'><strong>UACC</strong></span>";
			              }else {
			                    echo "<span class='error'><strong>UA</strong></span>";
			              } 
			            ?>
			            <div class="chat_time pull-right"><?php echo $sCreatedDate.' at '.$sYear."&nbsp;at&nbsp;".$sTime; ?></div>
			          </div>
			        </li>
			        <?php 
			        $nCount++;
			    	} 
			          if ($nCount >= 8) { ?>
			            <a href="javascript:void(0);" class="btn btn-default pull-right show-btn" onclick="loadNewNotes(<?php echo $id_newsletter; ?>, 'all');">View All Activity</a>
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
}