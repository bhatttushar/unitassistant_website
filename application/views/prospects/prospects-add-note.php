<?php 
	if ($this->uri->segment(1)=='edit-prospects') { ?>
		<form class="new-form" method="post" action="">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-9">
						<label class="control-label">Add Note:</label>
					</div>
					<div class="col-md-3">
						<input type="button" name="save_note" class="btn btn-success pull-right save-note" value="Add Note" onclick="saveProspectsNote(<?php echo $data['id_prospect']?>);">
						<input type="hidden" class="hidden-user" name="hidden-user">
						<input type="hidden" name="client_hidden_name" id="name_client" value="<?php echo $data['name']; ?>">
					</div>
				</div>
			</div>
			<div class="col-md-12 mb20">
				<textarea class="form-control" name="note" id="note" required="" ></textarea>
				<span id="note-error" class="error"></span>	
			</div>
			
			<div class="col-md-12 mb20">
				<label for="id_label_multiple"> Assign note to user: </label>
				<select class="js-example-basic-multiple js-states form-control"id="id_label_multiple" multiple="multiple">
					<?php
					foreach ($users as $value) { ?>
						<option value="<?php echo $value['id_user']; ?>"><?php echo $value['first_name'] . "&nbsp;" . $value['last_name']; ?></option>
					<?php } ?>
				</select>
			</div>
			<img src="<?php echo base_url('assets/images/load.gif');?>" class="img-responsive" id="img-load">
			<?php
			if (!empty($notedata)) {  ?>

				<div class="col-md-12 notes_listing">
					<div class="chat_area">
						<ul class="list-unstyled">
							<?php
							$nCount = count($notedata);
							foreach ($notedata as $val) {
								$sNotifyUser = $val['id_notify_user'];
								if ($sNotifyUser != '') {
									$aNotifyUser = explode(',', $sNotifyUser);
									$aUsers = array();
									foreach ($aNotifyUser as $key => $value) {
										$user_name = getUserData($value);
										$aUsers[] = $user_name['user_name'];
									}
									$sUsers = implode(', ', $aUsers);
								} else {
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
										$sProfile = empty($val['profile_pic']) ? base_url('assets/images/profile_img/female.jpg') : base_url('assets/images/profile_img/'.$val['profile_pic']);
										?>
		                    			<img src="<?php echo $sProfile; ?>" class="chat-img1">
				                    </span>
				                    <div class="chat-body1 clearfix">
				                        <p><span class="user-name"><?php echo ucfirst($val['first_name']) . "&nbsp;" . ucfirst($val['last_name']); ?> - </span><?php echo $val['note']; ?></p>
				                        <?php
										if (!empty($sUsers)) { ?>
				                         	<p><span class="user-name">Assigned Users - </span><span class="wrap"><?php echo $sUsers; ?></span>
				                         	</p>
				                        <?php } ?>
										<div class="chat_time pull-right"><?php echo $sCreatedDate."&nbsp;at&nbsp;". $sYear . "&nbsp;at&nbsp;" . $sTime; ?></div>
				                    </div>
				                </li>
							<?php }
							if ($nCount >= 8) { ?>
								<a href="javascript:void(0);" class="btn btn-default pull-right show-btn" onclick="loadNewProspectsNotes(<?php echo $data['id_prospect']; ?>, 'all')">View All Activity</a>
							<?php } ?>
				        </ul>
					</div>
				</div>
	            <?php } else { ?>
	            	<div class="col-md-12 notes_listing">
			            <div class="chat_area">
			                <h3 class="note-area m0">No notes found!!</h3>
			            </div>
			        </div>
	    		<?php } ?>
	            <div class="clearfix"></div>
			<span class="help-block"></span>
			<div class="clearfix"></div>
		</form>
<?php } ?>