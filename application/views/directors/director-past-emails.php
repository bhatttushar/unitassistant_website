<div id="pastemail" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:80%;">
		<div class="modal-content">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title text-center"><?php echo $data['name']; ?></h4>
	      	</div>
	      	<div class="modal-body" id="content">
                <div class="chat_area chat-widget">
			        <ul class="list-unstyled">
			        <?php 
			        	$cData = 0;
			        	foreach ($past_emails as $value) {
			        		if((isset($value['purpose']) && $value['purpose'] == 'Update client') || (isset($past_emails['purpose']) && $past_emails['purpose'] == 'Approval mail') || (isset($value['purpose']) && $value['purpose'] == 'Registered by reggie canada form') || (isset($value['purpose']) && $value['purpose'] == 'Registered by reggie UA form')) {
			        			$cData = 1;
			        		}
			        	}
			        	if($cData == 0) {
			        		echo '<h4 class="modal-title text-center" style="color: red;font-weight: bold;">Email not found</h4>';
			        	}
						if (is_array($past_emails) || is_object($past_emails)) {
							foreach ($past_emails as $past_email) {
								$aUserData = getUserData($past_email['userby']);
								
								$nDate = isset($past_email['created_at']) ? $past_email['created_at'] : '';
								$sCreatedDate = date("M j", strtotime($nDate));
								$sTime = date('h:i A', strtotime($nDate));
								$nYear = date('Y', strtotime($nDate));
								$sCurrentYear = date('Y');
								if ($nYear < $sCurrentYear) {
									$sYear = "'" . $nYear;
								} else {
									$sYear = '';
								}
								if ($past_email['purpose'] == 'Update client' || $past_email['purpose'] == 'Approval mail' || $past_email['purpose'] == 'Registered by reggie canada form' || $value['purpose'] == 'Registered by reggie UA form') { ?>
					            <li class="left clearfix">
					                <span class="chat-img1 pull-left">
					                    <?php $sProfile = empty($aUserData['profile_pic']) ? base_url('assets/images/user_profile/female.jpg') : base_url('assets/images/user_profile/'.$aUserData['profile_pic']); ?>
					                    <img src="<?php echo $sProfile; ?>" class="chat-img1">
					                </span>
					                <div class="chat-body1 clearfix">
					                <?php
										if ($past_email['purpose'] == 'Approval mail') {
											$sUsername = 'Admin';
										} else {
											if (empty($aUserData)) {
												$sUsername = '';
											}else{
												$sUsername = ucfirst($aUserData['first_name']) . "&nbsp;" . ucfirst($aUserData['last_name']);	
											}
											
										}
									?>
					                <p><span class="user-name"><?php echo $sUsername; ?> - </span></p>
					                <p><span class="user-name">Purpose - </span><?php echo $past_email['purpose']; ?></p>
					                <?php 
					                	echo htmlspecialchars_decode(htmlentities(html_entity_decode($past_email['detail']))); 
					                ?>
					                <div class="chat_time pull-right"><?php echo $sCreatedDate . $sYear . "&nbsp;at&nbsp;" . $sTime; ?></div>
					                </div>
					            </li>
				        	<?php }
							}
						}
					?>
			        </ul>
			    </div><!--chat_area-->
            </div>
            <div class="modal-footer">
	        	<button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Close</button>
	      	</div>
	      	<div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>