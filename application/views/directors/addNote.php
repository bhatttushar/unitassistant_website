<style type="text/css">
	img#img-load{
		width: 50px;
	    position: absolute;
	    top: 5.6%;
	    left: 0;
	    right: 0;
	    margin-left: auto;
	    margin-right: auto;
	}
</style>

<form class="new-form" method="post" action="" id="addNoteForm">
	<div class="form-group">
		<div class="row">
			<div class="col-md-9">
				<label class="control-label">Add Note:</label>
			</div>
			<div class="col-md-3">
				<input type="button" name="save_note" class="btn btn-success pull-right save-note" value="Add Note" onclick="saveNote(<?php echo $id_newsletter?>);">
				<input type="hidden" class="hidden-user" name="hidden-user">
				<input type="hidden" name="client_hidden_name" id="name_client" value="<?php echo $data['name']; ?>">
			</div>
		</div>
		<textarea class="form-control profile-form" name="note" id="note" required="" ></textarea>
		<span id="note-error" class="error"></span>
		<div class="row">
			<div class="col-lg-12 member">
				<label for="id_label_multiple"> Assign note to user: </label>
				<select class="js-example-basic-multiple js-states form-control" id="id_label_multiple" multiple="multiple">
				<?php

				foreach ($users as $value) { ?>
					<option value="<?php echo $value['id_user']; ?>"><?php echo $value['first_name'] . "&nbsp;" . $value['last_name']; ?></option>
				<?php } ?>
				</select>
			</div>
		</div>
		<img src="<?php echo base_url('assets/images/load.gif');?>" class="img-responsive" id="img-load">
		<?php
		if (!empty($notedata)) {  ?>

			<div class="notes_listing">
				<div class="chat_area">
					<ul class="list-unstyled">
						<?php
						$nCount = 1;
						foreach ($notedata as $aNotesData) {
							$sNotifyUser = $aNotesData['id_notify_user'];
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
							$nDate = $aNotesData['created_at'];
							$sCreatedDate = date("M j", strtotime($nDate));
							$sTime = date('h:i A', strtotime($nDate));
							$sYear = date('Y', strtotime($nDate));
							$sCurrentYear = date('Y');
							?>
							<li class="left clearfix">
				                <span class="chat-img1 pull-left">
			                    	<?php
									$sProfile = empty($aNotesData['profile_pic']) ? base_url('assets/images/user_profile/female.jpg') : base_url('assets/images/user_profile/'.$aNotesData['profile_pic']);
									?>
	                    			<img src="<?php echo $sProfile; ?>" class="chat-img1">
			                    </span>
			                    <div class="chat-body1 clearfix">
			                        <p><span class="user-name"><?php echo ucfirst($aNotesData['first_name']) . "&nbsp;" . ucfirst($aNotesData['last_name']); ?> - </span><?php echo $aNotesData['note']; ?></p>
			                        <?php
									if (!empty($sUsers)) { ?>
			                         	<p><span class="user-name">Assigned Users - </span><span class="wrap"><?php echo $sUsers; ?></span>
			                         	</p>
			                        <?php }
										if ($aNotesData['id_cc_newsletter'] != '' && $aNotesData['id_cc_newsletter'] == oldCCN($id_newsletter) ) {
										echo "<span class='error'><strong>TBC</strong></span>";
										}else {
										echo "<span class='error'><strong>UA</strong></span>";
										}
									 ?>
									<div class="chat_time pull-right"><?php echo $sCreatedDate."&nbsp;at&nbsp;". $sYear . "&nbsp;at&nbsp;" . $sTime; ?></div>
			                    </div>
			                </li>

						<?php 
							$nCount++;
						}

						if ($nCount >= 8) { ?>
							<a href="javascript:void(0);" class="btn btn-default pull-right show-btn" onclick="loadNewNotes(<?php echo $id_newsletter; ?>, 'all')">View All Activity</a>
						<?php } ?>
			        </ul>
				</div>
			</div>
            <?php } else { ?>
            	<div class="notes_listing">
					<div class="chat_area">
						<h3 class="note-area">No notes found!!</h3>
					</div>
				</div>
    		<?php } ?>
	</div>
</form>