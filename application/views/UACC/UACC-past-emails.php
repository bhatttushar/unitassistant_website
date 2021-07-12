<div id="uacc_past_email" class="modal fade" role="dialog">
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
						if (is_array($past_emails) || is_object($past_emails)) {
							foreach ($past_emails as $val) {
								
								$aUserData = getUserData($val['userby']);
								$nDate = isset($val['created_at']) ? $val['created_at'] : '';
								$sCreatedDate = date("M j", strtotime($nDate));
								$sTime = date('h:i A', strtotime($nDate));
								$nYear = date('Y', strtotime($nDate));
								$sCurrentYear = date('Y');
								if ($nYear < $sCurrentYear) {
									$sYear = "'" . $nYear;
								} else {
									$sYear = '';
								}

								if ($val['purpose'] == 'Update client' || $val['purpose'] == 'Approval mail' || $val['purpose'] == 'Add client') { 
									
									$cData = 1;

									?>
					            <li class="left clearfix">
					                <span class="chat-img1 pull-left">
					                    <?php $sProfile = empty($aUserData['profile_pic']) ? base_url('assets/images/user_profile/female.jpg') : base_url('assets/images/user_profile/'.$aUserData['profile_pic']); ?>
					                    <img src="<?php echo $sProfile; ?>" class="chat-img1">
					                </span>
					                <div class="chat-body1 clearfix">
					                <?php
										if ($val['purpose'] == 'Approval mail') {
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
					                <p><span class="user-name">Purpose - </span><?php echo $val['purpose']; ?></p>
					                <?php echo htmlspecialchars_decode(htmlentities(html_entity_decode($val['detail']))); ?></p>
					                <div class="chat_time pull-right"><?php echo $sCreatedDate . $sYear . "&nbsp;at&nbsp;" . $sTime; ?></div>
					                </div>
					            </li>
				        	<?php }
							}

							if($cData == 0) {
			        			echo '<h4 class="modal-title text-center" style="color: red;font-weight: bold;">Email not found</h4>';
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