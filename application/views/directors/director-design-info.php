<?php 
	if (empty($id_newsletter)) {
		$getField = array_flip(getTableFields('design'));
		$data = array_fill_keys(array_keys($getField), '');
	}
	
	if (isset($aClientData)) {
		$app_status = Get_design_approve_status($aClientData['design_one'], $aClientData['design_approve_status']);
	}
?>
<div id="ReturnLabelDetails" class="tabcontent">
	<h3 class="text-center">Return Label Details</h3>
	<div class="col-md-12 news-design">
		<div class="form-group">
			<label class="col-sm-4">Preferred Name:</label>
			<input type="text" class="col-sm-4" name="p_name" value="<?php echo isset($data['p_name']) ? $data['p_name'] : ''; ?>">
		</div>
		<div class="clearfix"></div>
		<div class="form-group">
			<label class="col-sm-4">Preferred Address:</label>
			<input type="text" class="col-sm-4" name="p_address" value="<?php echo isset($data['p_address']) ? $data['p_address'] : ''; ?>"> 
		</div>
		<div class="clearfix"></div>
		<div class="form-group">
			<label class="col-sm-4">Preferred City:</label>
			<input type="text" class="col-sm-4" name="p_city" value="<?php echo isset($data['p_city']) ? $data['p_city'] : ''; ?>">
		</div>
		<div class="clearfix"></div>

		<div class="form-group">
			<label class="col-sm-4">Preferred State:</label>
			<input type="text" class="col-sm-4" name="p_state" value="<?php echo isset($data['p_state']) ? $data['p_state'] : ''; ?>">
		</div>
		<div class="clearfix"></div>

		<div class="form-group">
			<label class="col-sm-4">Preferred Zip:</label>
			<input type="text" class="col-sm-4" name="p_zip" value="<?php echo isset($data['p_zip']) ? $data['p_zip'] : ''; ?>">
		</div>
		
		<div class="clearfix"></div>
		
		<div class="form-group">
			<label class="col-sm-4">Preferred Phone Number:</label>
			<input type="text" class="col-sm-4" name="p_phone" value="<?php echo isset($data['p_phone']) ? $data['p_phone'] : ''; ?>">
		</div>
		<div class="clearfix"></div>
		<div class="form-group">
			<label class="col-sm-4">Preferred Email:</label>
			<input type="text" class="col-sm-4" name="p_email" value="<?php echo isset($data['p_email']) ? $data['p_email'] : ''; ?>">
		</div>
		<div class="clearfix"></div>
		<div class="form-group">
			<label class="col-sm-4">Preferred Website:</label>
			<input type="text" class="col-sm-4" name="p_web" value="<?php echo isset($data['p_web']) ? $data['p_web'] : ''; ?>">
		</div>
		<div class="clearfix"></div>
		
		
	</div>
</div>

<div id="NewsletterDesigns" class="tabcontent">
	<h3 class="text-center">Newsletter Designs</h3>
	
	<div class="col-md-12 news-design">
		<div class="notice notice-danger">
        	<strong>Approval Status: </strong> <?php echo isset($app_status) ? $app_status : ''; ?> || <strong>Approval Date: </strong><?php echo empty($aClientData['approved_date']) ? '' : $aClientData['approved_date'] ?>  
    	</div>

		<div class="col-md-12"><label class="text-center"> Newsletter Designs: </label></div>
		<br>
		<div class="col-md-12">
			<div class="col-md-6">
				<input type="radio" name="design_one" id="SE" class="radio-inline" value="2" <?php echo (isset($data['hidden_newsletter']) && $data['hidden_newsletter']=='SE') ? 'checked = "checked"' : '' ?>>
				Simple Newsletter English
			</div>
			<div class="col-md-6">
				<input type="radio" name="design_one" id="AE" class="radio-inline" value="4" <?php echo (isset($data['hidden_newsletter']) && $data['hidden_newsletter']=='AE') ? 'checked = "checked"' : '' ?>>
				 Advanced Newsletter English
			</div>

		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<input type="radio" name="design_one" id="SS" class="radio-inline" value="2" <?php echo (isset($data['hidden_newsletter']) && $data['hidden_newsletter'] == 'SS') ? 'checked = "checked"' : '' ?>>
				Simple Newsletter Spanish
			</div>
			
			<div class="col-md-6">
				<input type="radio" name="design_one" id="AS" class="radio-inline" value="4" <?php echo (isset($data['hidden_newsletter']) && $data['hidden_newsletter'] == 'AS') ? 'checked = "checked"' : '' ?>>
					Advanced Newsletter Spanish
			</div>
			
			
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<input type="radio" name="design_one"  id="SB" class="radio-inline" value="4" <?php echo (isset($data['hidden_newsletter']) && $data['hidden_newsletter'] == 'SB') ? 'checked = "checked"' : '' ?>>
				Simple Newsletter Both
			</div>
			<div class="col-md-6">
				<input type="radio" name="design_one" id="AB" class="radio-inline" value="6" <?php echo (isset($data['hidden_newsletter']) && $data['hidden_newsletter'] == 'AB') ? 'checked = "checked"' : '' ?>>
					Advanced Newsletter Both
			</div>
			
		</div>

		<div class="col-md-12">
			<div class="col-md-6">
				<input type="radio" name="design_one" id="no" class="radio-inline" value="0" <?php echo ( isset($data['hidden_newsletter']) && ($data['hidden_newsletter']=='no' || $data['hidden_newsletter']=='')) ? 'checked = "checked"' : '' ?>>
				No Subscription
				<input type="hidden" name="hidden_newsletter" id="hidden_newsletter" value="<?php echo isset($data['hidden_newsletter']) ? $data['hidden_newsletter'] : '' ?>">
			</div>

			<div class="col-md-6">
				<input type="radio" name="design_one" id="AC" class="radio-inline" value="4" <?php echo (isset($data['hidden_newsletter']) && $data['hidden_newsletter'] == 'AC') ? 'checked = "checked"' : '' ?>>
					Advanced Newsletter Canada ( English & French)
			</div>

		</div>
		<div class="col-md-12">
			<div class="notice notice-danger">
		        <strong>Notice</strong> Possible to take additional NL language in points or $25 extra cost.
		    </div>
		</div>
	</div>
	<div class="col-md-12 news-design">
		<div class="col-md-12">
			<label> Director Name in Stars: </label>
			<input type="radio" name="design_two" class="radio-inline" value="Y" <?php echo (isset($data['design_two']) && $data['design_two']== 'Y') ? 'checked = "checked"' : '' ?>> Yes
			<input type="radio" name="design_two" class="radio-inline" value="N" <?php echo (isset($data['design_two']) && (($data['design_two'] == 'N') || ($data['design_two'] == ''))) ? 'checked = "checked"' : '' ?>> No
			<input type="radio" name="design_two" class="radio-inline" value="X" <?php echo (isset($data['design_two']) && $data['design_two'] == 'X') ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label> Wholesale Section -Show wholesale amounts: </label>
			<input type="radio" name="wholesale_amount" class="radio-inline" value="Y" <?php echo (isset($data['wholesale_amount']) && (($data['wholesale_amount']=='Y') || ($data['wholesale_amount']==''))) ? 'checked = "checked"' : '' ?>> Yes
			<input type="radio" name="wholesale_amount"  class="radio-inline" value="N" <?php echo (isset($data['wholesale_amount']) && $data['wholesale_amount'] == 'N') ? 'checked = "checked"' : '' ?>> No
			<input type="radio" name="wholesale_amount"  class="radio-inline" value="X" <?php echo (isset($data['wholesale_amount']) && $data['wholesale_amount'] == 'X') ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label> Wholesale Section - Show Director name in Stats: </label>
			<input type="radio" name="wholesale_section" class="radio-inline" value="Y" <?php echo (isset($data['wholesale_section']) && $data['wholesale_section'] == 'Y') ? 'checked = "checked"' : '' ?>> Yes
			<input type="radio" name="wholesale_section"  class="radio-inline" value="N" <?php echo (isset($data['wholesale_section']) && (($data['wholesale_section'] == 'N') || ($data['wholesale_section'] == ''))) ? 'checked = "checked"' : '' ?>> No
			<input type="radio" name="wholesale_section"  class="radio-inline" value="X" <?php echo (isset($data['wholesale_section']) && $data['wholesale_section'] == 'X') ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label> Court of Sales~Show Consultant Amounts: </label>
			<input type="radio" name="court_sale" class="radio-inline" value="Y" <?php echo ( isset($data['court_sale']) && (($data['court_sale'] == 'Y') || ($data['court_sale'] == ''))) ? 'checked = "checked"' : '' ?>> Yes
			<input type="radio" name="court_sale"  class="radio-inline" value="N" <?php echo ( isset($data['court_sale']) && $data['court_sale'] == 'N') ? 'checked = "checked"' : '' ?>> No
			<input type="radio" name="court_sale"  class="radio-inline" value="X" <?php echo ( isset($data['court_sale']) && $data['court_sale'] == 'X') ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label> Court of Sales~Show Director name in Stats: </label>
			<input type="radio" name="court_sale_director" class="radio-inline" value="Y" <?php echo (isset($data['court_sale_director']) && $data['court_sale_director'] == 'Y') ? 'checked = "checked"' : '' ?>> Yes
			<input type="radio" name="court_sale_director"  class="radio-inline" value="N" <?php echo (isset($data['court_sale_director']) && (($data['court_sale_director'] == 'N') || ($data['court_sale_director'] == ''))) ? 'checked = "checked"' : '' ?>> No
			<input type="radio" name="court_sale_director"  class="radio-inline" value="X" <?php echo (isset($data['court_sale_director']) && $data['court_sale_director'] == 'X') ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label> Court of Sharing~Show commission Amounts: </label>
			<input type="radio" name="court_sharing" class="radio-inline" value="Y" <?php echo (isset($data['court_sharing']) && (($data['court_sharing']=='Y') || ($data['court_sharing']==''))) ? 'checked="checked"' : '' ?>> Yes
			<input type="radio" name="court_sharing"  class="radio-inline" value="N" <?php echo (isset($data['court_sharing']) && $data['court_sharing'] == 'N') ? 'checked = "checked"' : '' ?>> No
			<input type="radio" name="court_sharing"  class="radio-inline" value="X" <?php echo (isset($data['court_sharing']) && $data['court_sharing'] == 'X') ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label> Court of Sharing - Show Director Name Stats: </label>
			<input type="radio" name="court_sharing_director" class="radio-inline" value="Y" <?php echo (isset($data['court_sharing_director']) && $data['court_sharing_director'] == 'Y') ? 'checked = "checked"' : '' ?>> Yes
			<input type="radio" name="court_sharing_director"  class="radio-inline" value="N" <?php echo (isset($data['court_sharing_director']) && (($data['court_sharing_director'] == 'N') || ($data['court_sharing_director'] == ''))) ? 'checked = "checked"' : '' ?>> No
			<input type="radio" name="court_sharing_director"  class="radio-inline" value="X" <?php echo (isset($data['court_sharing_director']) && $data['court_sharing_director'] == 'X') ? 'checked = "checked"' : '' ?>>
				No Subscription
		</div>
		<div class="col-md-12">
			<label> Do you Celebrate Birthdays: </label>
			<input type="radio" name="birthday_rec" class="radio-inline" value="Y" <?php echo (isset($data['birthday_rec']) && (($data['birthday_rec'] == 'Y') || ($data['birthday_rec'] == ''))) ? 'checked = "checked"' : '' ?>>
				Yes
			<input type="radio" name="birthday_rec"  class="radio-inline" value="N" <?php echo (isset($data['birthday_rec']) && $data['birthday_rec'] == 'N') ? 'checked = "checked"' : '' ?>>
				No
			<input type="radio" name="birthday_rec"  class="radio-inline" value="X" <?php echo (isset($data['birthday_rec']) && $data['birthday_rec'] == 'X') ? 'checked = "checked"' : '' ?>>
				No Subscription
		</div>
		<div class="col-md-12">
			<label> Birthday/Anniversary: </label>
			<input type="radio" name="birthday_anniversary" class="radio-inline" value="T" <?php echo ( isset($data['birthday_anniversary']) && (($data['birthday_anniversary'] == 'T') || ($data['birthday_anniversary'] == ''))) ? 'checked = "checked"' : '' ?>>
				This Month
			<input type="radio" name="birthday_anniversary"  class="radio-inline" value="N" <?php echo (isset($data['birthday_anniversary']) && $data['birthday_anniversary'] == 'N') ? 'checked = "checked"' : '' ?>>
				Next Month
		</div>
	</div>
	<div class="col-md-12 news-design">
		<div class="col-md-12">
			<div class="col-md-6">
				<label> Wholesale - Remove any names under : </label>
			</div>
			<div class="col-md-6">
				<input type="text" name="wholesale_remove_name" value="<?php echo isset($data['wholesale_remove_name']) ? $data['wholesale_remove_name'] : 0 ?>" class="new-con-text">
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<label> Wholesale - Remove any amounts under this amount but leave names Amount here: </label>
			</div>
			<div class="col-md-6">
				<input type="text" name="wholesale_remove" value="<?php echo isset($data['wholesale_remove']) ? $data['wholesale_remove'] : 0 ?>" class="new-con-text">
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<label> Special Newsletter Requests </label>
			</div>
			<div class="col-md-6">
				<input type="text" name="special_news_request" value="<?php echo isset($data['special_news_request']) ? $data['special_news_request'] : '' ?>" class="new-con-text">
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<label>English Etiny Url:</label>
			</div>
			<div class="col-md-6">
				<input type="text" name="beatly_url" value="<?php echo isset($data['beatly_url']) ? $data['beatly_url'] : '' ?>" class="new-con-text">
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<label>Spanish Etiny Url:</label>
			</div>
			<div class="col-md-6">
				<input type="text" name="beatly_url_one" value="<?php echo isset($data['beatly_url_one']) ? $data['beatly_url_one'] : '' ?>" class="new-con-text">
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-6">
				<label>French Etiny Url:</label>
			</div>
			<div class="col-md-6">
				<input type="text" name="beatly_url_two" value="<?php echo isset($data['beatly_url_two']) ? $data['beatly_url_two'] : '' ?>" class="new-con-text">
			</div>
		</div>

		<div class="col-md-12">
			<div class="notice notice-danger" style="color:#E8000D;">
		       <b>Please don't write http:// or https:// in etiny url.</b>
		    </div>
		</div>
	</div>
</div>

<div id="DigitalOption" class="tabcontent">
	<h3 class="text-center">Digital Option</h3>
	<div class="col-md-12 news-design">
		<div class="col-md-12">
			<label class="lebal-second">Digital Business Card:</label>
			<input type="checkbox" name="distribution_one" value="2" <?php echo (isset($data['distribution_one']) && $data['distribution_one'] != 0) ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-second">Facebook Posting Unit Newsletter</label>
			<input type="checkbox" name="distribution_two" value="2" <?php echo (isset($data['distribution_two']) && $data['distribution_two'] != 0) ? 'checked = "checked"' : '' ?>>
		</div>
	</div>
</div>

<div id="Birthday" class="tabcontent">
	<h3 class="text-center">Birthday</h3>
	<div class="col-md-12 news-design">
		<div class="col-md-12">
			<div class="col-md-3">
				<label class="lebal-third"> Birthday : </label>
			</div>
			<div class="col-md-12">
				<label> <input type="radio" name="birthday_one" value="2" <?php echo (isset($data['birthday_one']) && $data['birthday_one'] == '2') ? 'checked = "checked"' : '' ?>> Hand Signed - Gift Included - Magnet </label>
			</div>
			<div class="col-md-12">
				<label><input type="radio" name="birthday_one" value="1" <?php echo (isset($data['birthday_one']) && $data['birthday_one'] == '1') ? 'checked = "checked"' : '' ?>>Birthday Post Card</label>
			</div>
			<div class="col-md-12">
				<label><input type="radio" name="birthday_one"  class="radio-inline" value="0" <?php echo (isset($data['birthday_one']) && $data['birthday_one'] == '0') ? 'checked = "checked"' : '' ?>>No Subscription</label>
			</div>
		</div>
	</div>
</div>

<div id="Anniversary" class="tabcontent">
	<h3 class="text-center">Anniversary</h3>
	<div class="col-md-12 news-design">
		<div class="col-md-12">
			<div class="col-md-3">
			<label class="lebal-third"> Anniversary : </label>
			</div>
			<div class="col-md-3">
				<input type="radio" name="anniversary_one" class="radio-inline" value="2" <?php echo (isset($data['anniversary_one']) && $data['anniversary_one'] == '2') ? 'checked = "checked"' : '' ?>> Hand Signed - Gift Included - Magnet
			</div>
			<div class="col-md-3">
				<input type="radio" name="anniversary_one" class=
			"radio-inline" value="1" <?php echo (isset($data['anniversary_one']) && $data['anniversary_one'] == '1') ? 'checked = "checked"' : '' ?>> Anniversary Post Card
			</div>
			<div class="col-md-3">
			<input type="radio" name="anniversary_one"  class="radio-inline" value="0" <?php echo (isset($data['anniversary_one']) && $data['anniversary_one'] == '0') ? 'checked = "checked"' : '' ?>>
				No Subscription
			</div>
		</div>
	</div>
</div>

<div id="StatusPostCards" class="tabcontent">
	<h3 class="text-center">Status Post Cards</h3>
	<div class="col-md-12 news-design">
		<div class="col-md-12">
			<label class="lebal-four"> A3 ~ Earned discount reminder Post Card</label>
			<input type="checkbox" name="status_one" value="1" <?php echo (isset($data['status_one']) && $data['status_one'] != 0) ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-four"> Inactive 1st Month Post Card </label>
			<input type="checkbox" name="status_two" value="1" <?php echo (isset($data['status_two']) && $data['status_two'] != 0) ? 'checked = "checked"' : '' ?>>
		</div>
		 <div class="col-md-12">
			<label class="lebal-four"> Inactive 2nd Month Post Card </label>
			<input type="checkbox" name="status_three" value="1" <?php echo (isset($data['status_three']) && $data['status_three'] != 0) ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-four"> Inactive 3rd Month Post Card </label>
			<input type="checkbox" name="status_four" value="1" <?php echo (isset($data['status_four']) && $data['status_four'] != 0) ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-four"> Terminated (TI) Post Card </label>
			<input type="checkbox" name="status_five" value="1" <?php echo (isset($data['status_five']) && $data['status_five'] != 0) ? 'checked = "checked"' : '' ?>>
		</div>
			<div class="col-md-12">
				<label class="col-sm-6" style="padding-left: 0"> Last Month Correspondence : </label>
				<div class="col-sm-6">
					<input type="radio" name="last_one" class="radio-inline" value="2" <?php echo (isset($data['last_one']) && $data['last_one'] == '2') ? 'checked = "checked"' : '' ?>> Look Book, Sample & Letter from you <br>
					<input type="radio" name="last_one"  class="radio-inline" value="1" <?php echo (isset($data['last_one']) && $data['last_one'] == '1') ? 'checked = "checked"' : '' ?>> Last Month Post Card <br>
					<input type="radio" name="last_one"  class="radio-inline" value="0" <?php echo (isset($data['last_one']) && $data['last_one'] == '0') ? 'checked = "checked"' : '' ?>> No Subscription
				</div>
			</div>
		<div class="col-md-12">
			<label class="lebal-four"> Thank For Ordering Post Card </label>
			<input type="checkbox" name="status_six" value="1" <?php echo (isset($data['status_six']) && $data['status_six'] != 0) ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-four"> Star on Target-Include Your name on card Y or N </label>
			<input type="checkbox" name="status_eight" value="1" <?php echo (isset($data['status_eight']) && $data['status_eight'] != 0) ? 'checked = "checked"' : '' ?>>
			 <input type="radio" name="status_eight1" class="radio-inline" value="Y" <?php echo (isset($data['status_eight1']) && $data['status_eight1'] == 'Y') ? 'checked = "checked"' : '' ?>> Yes
			<input type="radio" name="status_eight1"  class="radio-inline" value="N" <?php echo (isset($data['status_eight1']) && $data['status_eight1'] == 'N') ? 'checked = "checked"' : '' ?>> No
		</div>
	</div>
</div>

<div id="GiftServices" class="tabcontent">
	<h3 class="text-center">Gift Services</h3>
	<div class="col-md-12 news-design">
		<div class="col-md-12">
			<label class="lebal-six"> Star gifts at the end of the quarter ( star certificates ect) </label>
			<input type="checkbox" name="status_nine" value="1" <?php echo (isset($data['status_nine']) && $data['status_nine'] != 0) ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-six"> Consistency Club </label>
			<input type="checkbox" name="status_seven" value="2" <?php echo (isset($data['status_seven']) && $data['status_seven'] != 0) ? 'checked = "checked"' : '' ?>>
			 <input type="button" value="$750" id="but" onclick="getVal();" class="btn btn-green btn-md"> Grey = track by 750 a qtr. 
			 <input type="hidden" id="hidden_val" name="status_seven0" value="<?php echo isset($data['status_seven0']) ? $data['status_seven0'] : ''; ?>">
		</div>

		<div class="col-md-12">
			<label class="lebal-six"> Amount Box </label>
			<input type="text" name="amount_box" id="amount_box" value="<?php echo isset($data['amount_box']) ? $data['amount_box'] : ''; ?>">
		</div>

		<div class="col-md-12">
			<label class="lebal-six"> Accumulative </label>
			<?php 
				$accumulative = ($data['accumulative']=='1') ? 'checked' : '';
				$monthly = ($data['monthly']=='1') ? 'checked' : '';
			?>
			  <input type="checkbox" name="accumulative" id="accumulative" value="1" <?php echo isset($accumulative) ? $accumulative : ''; ?> >
		</div>

		<div class="col-md-12">
			<label class="lebal-six"> Monthly </label>
			  <input type="checkbox" name="monthly" id="monthly" value="1" <?php echo isset($monthly) ? $monthly : ''; ?> >
		</div>

		<div class="col-md-12">
			<label class="lebal-six"> Send to Director </label>
			<input type="checkbox" class="notget" name="status_seven1" value="1" <?php echo (isset($data['status_seven1']) && $data['status_seven1'] == '1') ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-six"> Monthly wholesale Post Cards & Gift Service </label>
			<input type="checkbox" name="gift_one" value="3" <?php echo (!empty($data['gift_one']) && $data['gift_one']!='0') ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-six"> YTD Sales Post Card & Gift Service </label>
			<input type="checkbox" name="gift_two" value="3" <?php echo (!empty($data['gift_two']) && $data['gift_two'] != '0') ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-six"> Send Gift To Director </label>
			<input type="checkbox" class="notget" name="gift_four" value="1" <?php echo (isset($data['gift_four']) && $data['gift_four'] == '1') ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-six"> Reds Program . ( All Sr get post card) </label>
			<input type="checkbox" name="gift_five" value="2" <?php echo (!empty($data['gift_five']) && $data['gift_five'] != '0') ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-six"> Star Program- Lori Hogg brush gift </label>
			<input type="checkbox" name="star_program" value="2" <?php echo (!empty($data['star_program']) && $data['star_program'] != '0') ? 'checked = "checked"' : '' ?>>
		</div>
	</div>
</div>

<div id="NewConsultantOptions" class="tabcontent">
	<h3 class="text-center">New Consultant Options</h3>
	<div class="col-md-12 news-design">
		<div class="col-md-12">
			<label class="lebal-seven"> New Consultant Husband Post Card </label>
			<input type="checkbox" name="consultant_one" value="1" <?php echo (isset($data['consultant_one']) && $data['consultant_one'] != 0) ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-seven"> New Consultant Post Card(5 week series) </label>
			<input type="checkbox" name="consultant_two" value="1" <?php echo (isset($data['consultant_two']) && $data['consultant_two'] != 0) ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-seven"> BONUS 7 Day wonder challange card Yes or No </label>
			<input type="radio" name="consultant_two1" class="radio-inline" id="cons_yes" value="Y" <?php echo (isset($data['consultant_two1']) && $data['consultant_two1'] == 'Y') ? 'checked = "checked"' : '' ?>> Yes
			<input type="radio" name="consultant_two1" class="radio-inline" id="cons_no" value="N" <?php echo (isset($data['consultant_two1']) && $data['consultant_two1'] == 'N') ? 'checked = "checked"' : '' ?>> No
			<input type="radio" name="consultant_two1" class="radio-inline" value="X" <?php echo (isset($data['consultant_two1']) && $data['consultant_two1'] == 'X') ? 'checked = "checked"' : '' ?>> Unsubscribe
		</div>
		<div class="col-md-12">
			<label class="lebal-seven"> New Consultant Welcome Packet </label>
			<input type="checkbox" name="consultant_three" value="1" <?php echo (isset($data['consultant_three']) && $data['consultant_three'] != 0) ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="col-sm-6" style="padding-left: 0;"> New consultant packet link - English </label>
			<input type="text" class="col-sm-6" name="ncp_link_en" value="<?php echo ( isset($data['ncp_link_en']) && $data['ncp_link_en'] != '') ? $data['ncp_link_en'] : '' ?>">
		</div>
		<div class="col-md-12">
			<label class="col-sm-6" style="padding-left: 0;"> New consultant packet link - Spanish </label>
			<input type="text" class="col-sm-6" name="ncp_link_sp" value="<?php echo ( isset($data['ncp_link_sp']) && $data['ncp_link_sp'] != '') ? $data['ncp_link_sp'] : '' ?>">
		</div>
		<div class="col-md-12">
			<label class="col-sm-6" style="padding-left: 0;"> New consultant packet link - French </label>
			<input type="text" class="col-sm-6" name="ncp_link_fr" value="<?php echo ( isset($data['ncp_link_fr']) && $data['ncp_link_fr'] != '') ? $data['ncp_link_fr'] : '' ?>">
		</div>
		<div class="col-md-12">
			<label class="lebal-seven"> New consultant bundles </label>
			<input type="checkbox" name="consultant_five" value="1" <?php echo ($data['consultant_five'] == 1) ? 'checked = "checked"' : '' ?>>
		</div>
		 <div class="col-md-12">
			<label class="lebal-seven"> Recruiter Checklist </label>
			<input type="checkbox" name="consultant_six" value="1" <?php echo (isset($data['consultant_six']) && $data['consultant_six'] != 0) ? 'checked = "checked"' : '' ?>>
		</div>
	</div>
	<div class="col-md-12 news-design">
		<div class="col-md-12">
			<label> New Consultant Notes:</label>
		</div>
		<div class="col-md-12">
			<textarea  name="consultant_seven" class="new-con-text form-control"><?php echo empty($data['consultant_seven']) ? '' : $data['consultant_seven'] ?></textarea>
		</div>
	</div>
	<div class="col-md-12 news-design">
		<div class="col-md-12">
			<input type="radio" name="consultant_four" value="U" <?php echo (isset($data['consultant_four']) && $data['consultant_four'] == 'U') ? 'checked = "checked"' : '' ?>> Unit Assistant Packet <br>
			<input type="radio" name="consultant_four" value="A" <?php echo (isset($data['consultant_four']) && $data['consultant_four'] == 'A') ? 'checked = "checked"' : '' ?>>
				Own Packet (Director own pkt. printed in one default language.If taking text/email  1 packet will be linked to all 4 emails  spots N0/N1)
				<br>
			<input type="radio" name="consultant_four" value="P" <?php echo (isset($data['consultant_four']) && $data['consultant_four'] == 'P') ? 'checked = "checked"' : '' ?>> Owns Packet (Director own pkt. in Spanish and English or a NON 7 day wonder client) <br>
			<input type="radio" name="consultant_four" value="N" <?php echo (isset($data['consultant_four']) && (($data['consultant_four'] == 'N') || ($data['consultant_four'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
	</div>
</div>

<div id="NewsletterPrintingoptions" class="tabcontent">
	<h3 class="text-center">Newsletter Printing options</h3>
	<div class="col-md-12 news-design">
		<div class="col-md-12">
			<label class="lebal-six"> No Email Option </label>
			<input type="checkbox" class="notget" name="no_email_option" value="1" <?php echo $data['no_email_option'] == '1' ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-six"> Override Color </label>
			<input type="checkbox" class="notget" name="override_color" value="1" <?php echo ($data['override_color'] == '1') ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-six"> Auto Send: </label>
			<input type="text" name="auto_send" value="<?php echo (isset($data['auto_send']) && $data['auto_send'] != '') ? $data['auto_send'] : '' ?>" id="auto_send">
		</div>
		<div class="col-md-12">
			<label class="lebal-six">Override Black /white</label>
			<input type="checkbox" class="notget" name="override_black_white" value="1" <?php echo (isset($data['override_black_white']) && $data['override_black_white'] == '1') ? 'checked = "checked"' : '' ?>>
		</div>
		<div class="col-md-12">
			<label class="lebal-six">English Only Newsletter</label>
			 <input type="checkbox" class="notget" name="english_only" value="1" <?php echo (isset($data['english_only']) && $data['english_only'] == '1') ? 'checked = "checked"' : '' ?>>
		</div>
	</div>
	<div class="col-md-12 news-design">
		<div class="col-md-12 ">
			<label class="lebal-six"> Newsletter Notes: </label>
		</div>
		<div class="col-md-12">
		<textarea name="newsletter_send_notes" class="news-send-box form-control" id="newsletter-note"><?php echo (isset($data['newsletter_send_notes']) && $data['newsletter_send_notes'] != '') ? $data['newsletter_send_notes'] : '' ?></textarea>
		</div>
	</div>
	<div class="col-md-12 news-design">
		<div class="col-md-12">
			<label class="lebal-third">N0</label>
			<input type="radio" name="n_zero" class="radio-inline" value="C" <?php echo (isset($data['n_zero']) && $data['n_zero'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="n_zero" class="radio-inline" value="B" <?php echo (isset($data['n_zero']) && $data['n_zero'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="n_zero" class="radio-inline" value="N" <?php echo (isset($data['n_zero']) &&  (($data['n_zero'] == 'N') || ($data['n_zero'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label class="lebal-third">N1</label>
			<input type="radio" name="n_one" class="radio-inline" value="C" <?php echo (isset($data['n_one']) && $data['n_one'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="n_one" class="radio-inline" value="B" <?php echo (isset($data['n_one']) && $data['n_one'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="n_one" class="radio-inline" value="N" <?php echo (isset($data['n_one']) && (($data['n_one'] == 'N') || ($data['n_one'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label class="lebal-third">N2</label>
			<input type="radio" name="n_two" class="radio-inline" value="C" <?php echo (isset($data['n_two']) && $data['n_two'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="n_two" class="radio-inline" value="B" <?php echo (isset($data['n_two']) && $data['n_two'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="n_two" class="radio-inline" value="N" <?php echo (isset($data['n_two']) && (($data['n_two'] == 'N') || ($data['n_two'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label class="lebal-third">N3</label>
			<input type="radio" name="n_three" class="radio-inline" value="C" <?php echo (isset($data['n_three']) && $data['n_three'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="n_three" class="radio-inline" value="B" <?php echo (isset($data['n_three']) && $data['n_three'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="n_three" class="radio-inline" value="N" <?php echo (isset($data['n_three']) && (($data['n_three'] == 'N') || ($data['n_three'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label class="lebal-third">A1</label>
			<input type="radio" name="a_one" class="radio-inline" value="C" <?php echo (isset($data['a_one']) && $data['a_one'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="a_one" class="radio-inline" value="B" <?php echo (isset($data['a_one']) && $data['a_one'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="a_one" class="radio-inline" value="N" <?php echo (isset($data['a_one']) && (($data['a_one'] == 'N') || ($data['a_one'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label class="lebal-third">A2</label>
			<input type="radio" name="a_two" class="radio-inline" value="C" <?php echo (isset($data['a_two']) && $data['a_two'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="a_two" class="radio-inline" value="B" <?php echo (isset($data['a_two']) && $data['a_two'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="a_two" class="radio-inline" value="N" <?php echo (isset($data['a_two']) && (($data['a_two'] == 'N') || ($data['a_two'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label class="lebal-third">A3</label>
			<input type="radio" name="a_three" class="radio-inline" value="C" <?php echo (isset($data['a_three']) && $data['a_three'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="a_three" class="radio-inline" value="B" <?php echo (isset($data['a_three']) && $data['a_three'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="a_three" class="radio-inline" value="N" <?php echo (isset($data['a_three']) && (($data['a_three'] == 'N') || ($data['a_three'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label class="lebal-third">I1</label>
			<input type="radio" name="i_one" class="radio-inline" value="C" <?php echo (isset($data['i_one']) && $data['i_one'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="i_one" class="radio-inline" value="B" <?php echo (isset($data['i_one']) && $data['i_one'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="i_one" class="radio-inline" value="N" <?php echo (isset($data['i_one']) && (($data['i_one'] == 'N') || ($data['i_one'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label class="lebal-third">I2</label>
			<input type="radio" name="i_two" class="radio-inline" value="C" <?php echo (isset($data['i_two']) && $data['i_two'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="i_two" class="radio-inline" value="B" <?php echo (isset($data['i_two']) && $data['i_two'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="i_two" class="radio-inline" value="N" <?php echo (isset($data['i_two']) && (($data['i_two'] == 'N') || ($data['i_two'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label class="lebal-third">I3</label>
			<input type="radio" name="i_three" class="radio-inline" value="C" <?php echo (isset($data['i_three']) && $data['i_three'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="i_three" class="radio-inline" value="B" <?php echo (isset($data['i_three']) && $data['i_three'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="i_three" class="radio-inline" value="N" <?php echo (isset($data['i_three']) && (($data['i_three'] == 'N') || ($data['i_three'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label class="lebal-third">T1</label>
			<input type="radio" name="t_one" class="radio-inline" value="C" <?php echo (isset($data['t_one']) && $data['t_one'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="t_one" class="radio-inline" value="B" <?php echo (isset($data['t_one']) && $data['t_one'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="t_one" class="radio-inline" value="N" <?php echo (isset($data['t_one']) && (($data['t_one'] == 'N') || ($data['t_one'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label class="lebal-third">T2-T5</label>
			<input type="radio" name="t_two" class="radio-inline" value="C" <?php echo (isset($data['t_two']) && $data['t_two'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="t_two" class="radio-inline" value="B" <?php echo (isset($data['t_two']) && $data['t_two'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="t_two" class="radio-inline" value="N" <?php echo (isset($data['t_two']) && (($data['t_two'] == 'N') || ($data['t_two'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label class="lebal-third">T6</label>
			<input type="radio" name="t_three" class="radio-inline" value="C" <?php echo (isset($data['t_three']) && $data['t_three'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="t_three" class="radio-inline" value="B" <?php echo (isset($data['t_three']) && $data['t_three'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="t_three" class="radio-inline" value="N" <?php echo (isset($data['t_three']) && (($data['t_three'] == 'N') || ($data['t_three'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label class="lebal-third">T7</label>
			<input type="radio" name="t_four" class="radio-inline" value="C" <?php echo (isset($data['t_four']) && $data['t_four'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="t_four" class="radio-inline" value="B" <?php echo (isset($data['t_four']) && $data['t_four'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="t_four" class="radio-inline" value="N" <?php echo (isset($data['t_four']) && (($data['t_four'] == 'N') || ($data['t_four'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>

		<div class="col-md-12">
			<label class="lebal-third">TOP 10 WSL</label>
			<input type="radio" name="top_10_wsl" class="radio-inline" value="C" <?php echo (isset($data['top_10_wsl']) && $data['top_10_wsl'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="top_10_wsl" class="radio-inline" value="B" <?php echo (isset($data['top_10_wsl']) && $data['top_10_wsl'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="top_10_wsl" class="radio-inline" value="N" <?php echo (isset($data['top_10_wsl']) && (($data['top_10_wsl'] == 'N') || ($data['top_10_wsl'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>

		<div class="col-md-12">
			<label class="lebal-third">TOP 20 WSL</label>
			<input type="radio" name="top_20_wsl" class="radio-inline" value="C" <?php echo (isset($data['top_20_wsl']) && $data['top_20_wsl'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="top_20_wsl" class="radio-inline" value="B" <?php echo (isset($data['top_20_wsl']) && $data['top_20_wsl'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="top_20_wsl" class="radio-inline" value="N" <?php echo (isset($data['top_20_wsl']) && (($data['top_20_wsl'] == 'N') || ($data['top_20_wsl'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>


		<div class="col-md-12">
			<label class="lebal-third">TOP 10 YTD</label>
			<input type="radio" name="top_10_ytd" class="radio-inline" value="C" <?php echo (isset($data['top_10_ytd']) && $data['top_10_ytd'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="top_10_ytd" class="radio-inline" value="B" <?php echo (isset($data['top_10_ytd']) && $data['top_10_ytd'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="top_10_ytd" class="radio-inline" value="N" <?php echo (isset($data['top_10_ytd']) && (($data['top_10_ytd'] == 'N') || ($data['top_10_ytd'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>

		<div class="col-md-12">
			<label class="lebal-third">TOP 20 YTD</label>
			<input type="radio" name="top_20_ytd" class="radio-inline" value="C" <?php echo (isset($data['top_20_ytd']) && $data['top_20_ytd'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="top_20_ytd" class="radio-inline" value="B" <?php echo (isset($data['top_20_ytd']) && $data['top_20_ytd'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="top_20_ytd" class="radio-inline" value="N" <?php echo (isset($data['top_20_ytd']) && (($data['top_20_ytd'] == 'N') || ($data['top_20_ytd'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>

		<div class="col-md-12">
			<label class="lebal-third">600+ Order</label>
			<input type="radio" name="600_plus_oder" class="radio-inline" value="C" <?php echo (isset($data['600_plus_oder']) && $data['600_plus_oder'] == 'C') ? 'checked = "checked"' : '' ?>> Full Color
			<input type="radio" name="600_plus_oder" class="radio-inline" value="B" <?php echo (isset($data['600_plus_oder']) && $data['600_plus_oder'] == 'B') ? 'checked = "checked"' : '' ?>> B/W
			<input type="radio" name="600_plus_oder" class="radio-inline" value="N" <?php echo (isset($data['600_plus_oder']) && (($data['600_plus_oder'] == 'N') || ($data['600_plus_oder'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>

	</div>
</div>

<div id="TextingSystem" class="tabcontent">
	<h3 class="text-center">Texting System</h3>
	<div class="col-md-12 news-design">
		<div class="col-md-12 signature-date">
			<label> Text Note: </label>
			<textarea name="note" class="news-send-box form-control" id="text_note"><?php echo (isset($data['note']) && $data['note'] != '') ? $data['note'] : '' ?></textarea>
		</div>
	</div>
</div>