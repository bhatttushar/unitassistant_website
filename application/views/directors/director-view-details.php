<?php
	$id_user = $this->session->userdata('id_user');
	$userdata = getUserData($id_user);
?>
<input type="hidden" name="user_update_name" value="<?php echo $userdata['first_name']; ?>">
<div class="clearfix"></div>
  <div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog" style="width:80%;">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title">Client Newsletter Design Information</h4>
	      	</div>
	      	<div class="modal-body" id="content">
				<div class="news-design" id="main-design">
					<div class="row <?php echo (empty($data['hidden_newsletter']) || $data['hidden_newsletter'] == 'no' ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Newsletter Design :</p>
						</div>
						<div class="col-xs-6">
							<span id="newsletters-design"> <?php echo GetDesignName($data['hidden_newsletter']);?> </span>
							<input type="hidden" name="hidden_design" value="">
						</div>
					</div>
					<div class="row <?php echo (empty($data['distribution_two']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Facebook NL:</p>
						</div>
						<div class="col-xs-6">
							 <span id="facebook-posting"><?php echo ($data['distribution_two'] == 2) ? "X - 2pt" : ''; ?></span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['birthday_one']) || $data['birthday_one'] == '0' ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold"> Birthday Post Card :</p>
						</div>
						<div class="col-xs-6">
							<span id="birthday">
								<?php echo (($data['birthday_one'] == '2') ? " X - 2pt" : (($data['birthday_one'] == '1') ? 'X - 1pt' : (($data['birthday_one'] == '0' || $data['birthday_one'] == '') ? 'No Subscription' : ''))); ?>
							</span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['anniversary_one']) || $data['anniversary_one'] == '0' ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold"> Hand Signed Anniversary Post Card with gift :</p>
						</div>
						<div class="col-xs-6">
							 <span id="anniversary">
							 	<?php echo (($data['anniversary_one'] == '2') ? " X - 2pt" : (($data['anniversary_one'] == '1') ? ' X - 1pt' : (($data['anniversary_one'] == '0' || $data['anniversary_one'] == '') ? 'No Subscription' : ''))); ?>
							 </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['status_one']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold"> A3 Post card :</p>
						</div>
						<div class="col-xs-6">
							<span id="A3-post-card">
								<?php echo ($data['status_one'] == '1') ? "X - 1pt" : ''; ?>
							</span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['status_two']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">I1 Post Card :</p>
						</div>
						<div class="col-xs-6">
							 <span id="I1-post-card">
							 	<?php echo ($data['status_two'] == '1') ? "X - 1pt" : ''; ?>
							 </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['status_three']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">I2 Post Card :</p>
						</div>
						<div class="col-xs-6">
							 <span id="I2-post-card">
							 	<?php echo ($data['status_three'] == '1') ? "X - 1pt" : ''; ?>
							 </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['status_four']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">I3 Post Card:</p>
						</div>
						<div class="col-xs-6">
							<span id="I3-post-card">
								<?php echo ($data['status_four'] == '1') ? "X - 1pt" : ''; ?>
							</span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['status_five']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">T1 Post Card:</p>
						</div>
						<div class="col-xs-6">
							 <span id="T1-post-card">
							 	<?php echo ($data['status_five'] == '1') ? "X - 1pt" : ''; ?>
							 </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['status_six']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Thank You Post Card :</p>
						</div>
						<div class="col-xs-6">
							<span id="ordering-post-card">
								<?php echo ($data['status_six'] == '1') ? "X 1 pt" : ''; ?>
							</span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['status_seven']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Consistency Club Post Card :
							</p>
						</div>
						<div class="col-xs-6">
							<span id="consistency-club">
								<?php echo ($data['status_seven'] == '2') ? "X - 2pt" : ''; ?>
							</span>
							<span id="consistency-club1">
								<?php echo ($data['status_seven0']) ? $data['status_seven0'] : ''; ?>
							</span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['status_seven1']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Send gifts to Director to present: </p>
						</div>
						<div class="col-xs-6">
							<span id="send-to-director">
								<?php echo 'X - '.$data['status_seven1'].'pt'; ?>
							</span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['status_eight']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Star On Target Post Card: </p>
						</div>
						<div class="col-xs-6">
							<span id="star-on-target"> <?php echo ($data['status_eight']!=0) ? "X - 1pt" : ''; ?> </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['status_nine']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Star Gifts at the end of the quarter ( star certificate ect.)</p>
						</div>
						<div class="col-xs-6">
							<span id="star-gift"> <?php echo ($data['status_nine'] != 0) ? "X - 1pt" : ''; ?> </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['last_one']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Last Month Packets :</p>
						</div>
						<div class="col-xs-6">
							<span id="last-month">
								<?php echo (($data['last_one'] == '2') ? "X - 2pt" : (($data['last_one'] == '1') ? 'X - 1pt' : '')); ?>
							</span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['gift_one']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Top 10 Month Gift Club: Gift goes to top 2,3 or 5 consultants - all 10 get post card (gifts based on unit size): </p>
						</div>
						<div class="col-xs-6">
							<span id="monthly-post-card"> <?php echo ($data['gift_one'] != 0) ? "X - 3pt" : ''; ?> </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['gift_two']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Top 10 YTD Sales Club with Gift : Gift mails to top 2, 3 or 5 consultants based on unit size. Top 10 are featured on post card to the 10/ e card to the whole unit:</p>
						</div>
						<div class="col-xs-6">
							<span id="ytd-post-card"> <?php echo ($data['gift_two'] != 0) ? "X - 3pt" : ''; ?> </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['gift_three']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Top 5 Recruiting: Gift mails to queen of recruiting for the month - top 5 get post card recognition:</p>
						</div>
						 <div class="col-xs-6">
							<span id="recruiting-post-card"> <?php echo ($data['gift_three']!=0) ? "X - 3pt" : '';?> </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['gift_five']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Reds Program: quarterly program- All Sr consultants get post cards. All unit members get email. End of the quarter all Red Jackets get gift from Director.  Gifts are $5 at the end of quarter plus shipping: </p>
						</div>
						<div class="col-xs-6">
							<span id="reds"> <?php echo ($data['gift_five'] != 0) ? "X - 2pt" : ''; ?> </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['star_program']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Star Program - Lori Hogg Brush as gift: </p>
						</div>
						<div class="col-xs-6">
							<span id="star"> <?php echo ($data['star_program'] != 0) ? "X - 2pt" : ''; ?> </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['consultant_one']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Husband Post Card :</p>
						</div>
						<div class="col-xs-6">
							<span id="consultant-one">
								<?php echo ($data['consultant_one'] != 0) ? 'X - 1pt' : '' ?>
							</span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['consultant_two']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">New Consultant 6 week series of post cards:</p>
						</div>
						<div class="col-xs-6">
							<span id="consultant-two">
								<?php echo ($data['consultant_two'] != 0) ? 'X - 1pt' : '' ?>
							</span>
						</div>
					</div>

					<?php 

						if ($data['consultant_two1']=='Y') { ?>
							<div class="row <?php echo (empty($data['consultant_two1']) ? 'hidden' : ''); ?>">
								<div class="col-xs-6">
									<p class="label-bold">New Consultant Post cards - 1st card/ 7 day wonder promotion- sending Y for Yes - N for No :</p>
								</div>
								<div class="col-xs-6">
									<span id="consultant-two1">
										<span>&nbsp;</span><?php echo isset($data['consultant_two1']) ? $data['consultant_two1'] : ''; ?>
									</span>
								</div>
							</div>
						<?php }

					?>

					<div class="row <?php echo (empty($data['consultant_three']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">New Consultant Welcome Packet :</p>
						</div>
						<div class="col-xs-6">
							 <span id="consultant-three">
							 	<?php echo ($data['consultant_three'] != 0) ? 'X - 1pt' : '' ?>
							 </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['consultant_five']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">New Consultant Packet Bundles- Instead of mailing to consultants/ bundles sent to Director on request of Director: </p>
						</div>
						<div class="col-xs-6">
							<span id="consultant-four">
							<?php echo ($data['consultant_five'] == 1) ? 'X - 1pt' : 'No Subscription'; ?>
							</span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['consultant_six']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Recruiter Checklist :</p>
						</div>
						<div class="col-xs-6">
							<span id="consultant-six">
								<?php echo ($data['consultant_six'] != 0) ? 'X - 1pt' : '' ?>
							</span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['consultant_seven']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">New Consultant Notes Area :</p>
						</div>
						<div class="col-xs-6">
							 <span id="consultant-five">
							 	<?php echo empty($data['consultant_seven']) ? '' : 'X - '.$data['consultant_seven'].'pt' ?>
							 </span>
						</div>
					</div>
					<?php $printingT = newsletter_print_option($data); ?>
					<div class="row <?php echo (empty($printingT) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Newsletter Print Options:</p>
						</div>
						<div class="col-xs-6">
							 <span id="n0"> <?php echo $printingT; ?> </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['unit_size']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Actual Unit Size :</p>
						</div>
						<div class="col-xs-6">
							 <span id="actual-unit">
							 	<?php echo ($data['unit_size']) ? $data['unit_size'] : ''; ?>
							 </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['point_credit']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Point Credit :</p>
						</div>
						<div class="col-xs-6">
							 <span id="point-credit">
							 	<?php echo ($data['point_credit']) ? $data['point_credit'] : ''; ?>
							 </span>
						</div>
					</div>
					<?php $sPackageName = GetPackageName($data['package']); ?>
					<div class="row <?php echo ($sPackageName == 'Unsubscribed') ? 'hidden' : ''; ?>">
						<div class="col-xs-6">
							<p class="label-bold">Package:</p>
						</div>
						<div class="col-xs-6">
							 <span id="package"> <?php echo $sPackageName; ?> </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['facebook']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Facebooking Newsletter :</p>
						</div>
						<div class="col-xs-6">
							 <span id="facebook-newsletter">
							 	<?php echo ($data['facebook'] == 1) ? 'Facebooking Newsletter with $19.99' : '' ?>
							 </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['emailing']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Newsletter :</p>
						</div>
						<div class="col-xs-6">
							 <span id="newsletter">
							 	<?php
									echo (($data['emailing'] == '1') ? 'Newsletter with $38' : (($data['emailing'] == '2') ? 'Newsletter with $55' : (($data['emailing'] == '0' || $data['emailing'] == '') ? 'No Subscription' : ''))); ?>
							 </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['distribution_one']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Digital Biz Card :</p>
						</div>
						<div class="col-xs-6">
							 <span id="digital_biz_card-v">
							 	<?php echo 'X - '.$data['distribution_one'] .' pts'; ?>
							 </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['canada_service']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Canada Service :</p>
						</div>

						<div class="col-xs-6">
							 <span id="canada-service-v">
							 	<?php echo ($data['canada_service']=='1') ? '$99.00' : ''; ?>
							 </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['email_newsletter']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Formatting and or emailing of Newsletter $20 :</p>
						</div>
						<div class="col-xs-6">
							 <span id="email-newsletter">
							 	<?php echo ($data['email_newsletter'] == 1) ? '$19.99' : '' ?>
							 </span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['total_text_program']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">Total text package: </p>
						</div>
						<div class="col-xs-6">
							<span id="total-text-program">
								<?php
								if ($data['total_text_program'] == 1) {
									if ($data['package'] == 'R' || $data['package'] == 'S' || $data['package'] == 'D' || $data['package'] == 'E') {
										echo "$29.99";
									} elseif ($data['package'] == 'P') {
										echo "$9.99";
									} elseif ($data['package'] == 'N') {
										echo "$59.99";
									} else {
										echo "$0";
									}
								} else {
									echo "$0";
								}
								?>
							</span>
						</div>
					</div>
					<div class="row <?php echo (empty($data['total_text_program7']) ? 'hidden' : ''); ?>">
						<div class="col-xs-6">
							<p class="label-bold">7/2019 Total Text Package:</p>
						</div>
						<div class="col-xs-6">
							<span id="total-text-program7">
								<?php
								if($data['total_text_program7'] == 1) {
									if ($data['package'] == 'N' || $data['package'] == '') {
										echo '$69.99';
									} else {
										echo '$39.99';
									}
								}
								?>
							</span>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<p class="label-bold">Sub Total: </p>
						</div>
						<div class="col-xs-6">
							  <input type="text" class="sub_total" value="$<?php echo empty($data['sub_total']) ? 0 : $data['sub_total']; ?>" readonly>
							   <input type="hidden" name="sub_total" class="sub_total" value="<?php echo empty($data['sub_total']) ? 0 : $data['sub_total']; ?>">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<p class="label-bold">Total Charges: (does not include gifts for Reds program, Consistency Club gifts, Newsletter mailings, monthly promotional contests ordered ala carte,  New consultant packet postage, Last month packet postage) : </p>
						</div>
						<div class="col-xs-6">
							  <input type="text"  class="package_value" value="$<?php echo empty($data['package_pricing']) ? 0 : $data['package_pricing']; ?>" readonly>
						</div>
					</div>
				</div>
					<div class="row">
						<div class="col-sm-6">
						<label> Package For: </label>
						<input type="radio" name="package_for" class="radio-inline" value="C" <?php echo ($data['package_for']=='C') ? 'checked="checked"' : '' ?> > Current
						<input type="radio" name="package_for"  class="radio-inline" value="F" <?php echo ($data['package_for']=='F') ? 'checked="checked"' : '' ?>> future
						</div>
					</div>
					<div class="row future-date">
						<div id="hidden_package_for" class="col-sm-6">
							<label>Pick Date</label>
							<input type="text" id="example5" class="clsDatePicker" name="future_package_date" value="<?php echo empty($future_date) ? '' : $future_date['future_package_date']; ?> " style="z-index: 100000000;">
						</div>
					</div>
	      		</div>
		      	<div class="modal-footer">
		      		<a href="javascript:void(0);" class="btn btn-default" onclick="printPage('content')">Print</a>
		      		<input type="submit" name="send" class="btn btn-default view_details_send" value="Send">
		      		<input type="submit" name="save" class="btn btn-default view_details_save" value="Save">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
	      		<div class="clearfix"></div>
	    	</div>
			</div>
</div>