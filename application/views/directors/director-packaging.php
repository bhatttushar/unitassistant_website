<?php  
	if (empty($id_newsletter)) {
		$getField = array_flip(getTableFields('packaging'));
		$data = array_fill_keys(array_keys($getField), '');
	}

	$decrypted = !empty($data['cv_account']) ? decryptIt($data['cv_account']) : '';
?>
<div id="PackagingBTN" class="tabcontent">
	<div class="col-md-12 news-design">
		<div class="col-md-12">
			<label> Point Credit : </label>
			<input type="text"  name="point_credit" value="<?php echo ($data['point_credit']) ? $data['point_credit'] : ''; ?>" id="point_credit">
		</div>
		<div class="col-md-12">
			<label> Actual Unit Size : </label>
			<input type="number" min="0" name="unit_size" value="<?php echo ($data['unit_size'] != '') ? $data['unit_size'] : ''; ?>" id="unit_size">
			<span id="error" style="color: rgb(196, 30, 30);"></span>
		</div>
		<div class="col-md-12">
			<label> Package :</label>
			<input type="radio" name="package" class="radio-inline notget" value="S" <?php echo (isset($data['package']) && $data['package'] == 'S') ? 'checked = "checked"' : '' ?>> Sapphire
			<input type="radio" name="package"  class="radio-inline notget" value="R" <?php echo (isset($data['package']) && $data['package'] == 'R') ? 'checked = "checked"' : '' ?>> Ruby
			<input type="radio" name="package"  class="radio-inline notget" value="D" <?php echo (isset($data['package']) && $data['package'] == 'D') ? 'checked = "checked"' : '' ?>> Diamond
			<input type="radio" name="package"  class="radio-inline notget" value="E" <?php echo (isset($data['package']) && $data['package'] == 'E') ? 'checked = "checked"' : '' ?>> Emerald
			<input type="radio" name="package"  class="radio-inline notget" value="P" <?php echo (isset($data['package']) && $data['package'] == 'P') ? 'checked = "checked"' : '' ?>> Pearl
			<input type="radio" name="package"  class="radio-inline notget" value="E1" <?php echo (isset($data['package']) && $data['package'] == 'E1') ? 'checked = "checked"' : '' ?>> Economy
			<input type="radio" name="package"  class="radio-inline notget" value="S1" <?php echo (isset($data['package']) && $data['package'] == 'S1') ? 'checked = "checked"' : '' ?>> Special
			<input type="radio" name="package"  class="radio-inline notget" value="N" <?php echo (isset($data['package']) && (($data['package'] == 'N') || ($data['package'] == ''))) ? 'checked = "checked"' : '' ?>> No Subscription
		</div>
		<div class="col-md-12">
			<label> Facebooking Newsletter </label>
			<input type="checkbox" name="facebook" class="radio-inline notget" value="1" <?php echo (isset($data['facebook']) && $data['facebook'] == '1') ? 'checked = "checked"' : '' ?>>
		</div>

		<div class="col-md-12">
			<label> Facebook Everything </label>
			<input type="checkbox" name="facebook_everything" class="radio-inline notget" value="1" <?php echo (isset($data['facebook_everything']) && $data['facebook_everything'] == '1') ? 'checked = "checked"' : '' ?>>
		</div>

		<div class="col-md-12">
			<label> Newsletter </label>
			<input type="radio" name="emailing" class="radio-inline notget" value="1" <?php echo (isset($data['emailing']) && $data['emailing'] == '1') ? 'checked = "checked"' : '' ?>> $38
			<input type="radio" name="emailing" class="radio-inline notget" value="2" <?php echo (isset($data['emailing']) && $data['emailing'] == '2') ? 'checked = "checked"' : '' ?>> $55
			<input type="radio" name="emailing" class="radio-inline notget" value="0" <?php echo (isset($data['emailing']) && ($data['emailing'] == '0' || $data['emailing'] == '')) ? 'checked = "checked"' : '' ?>>
			<?php
				$hidden_radio = (isset($data['emailing']) && ($data['emailing']== '1') ? 38 :  (isset($data['emailing']) && ($data['emailing'] == 2) ? 55 : 0));
			?>
			<input type="hidden" name="hidden_radio" id="hidden_radio" value="<?php echo $hidden_radio ?>">No Subscription
		</div>
		<div class="col-md-12">
			<label>
				<span>Digital Biz Card $20</span> 
				<input type="checkbox" name="digital_biz_card" class="digital_biz_card notget" value="1" <?php echo (isset($data['digital_biz_card']) && $data['digital_biz_card'] == '1') ? 'checked = "checked"' : '' ?> >
				<input type="text" name="digital_biz_link" id="buzz_link" value="<?php echo isset($data['digital_biz_link']) ? $data['digital_biz_link'] : ''; ?>">
			</label>
		</div>

		<div class="col-md-12">
			<label>Canada Services - US Dollar $99
				<input type="checkbox" <?php echo (isset($data['canada_service']) && $data['canada_service']== '1') ? 'checked' : '' ?> name="canada_service" value="1" class="radio-inline canadaService notget">
			</label>
		</div>

		<div class="col-md-12">
			<label> Formatting and or emailing of Newsletter $20 </label>
				<input type="checkbox" name="email_newsletter" class="radio-inline notget" value="1" <?php echo (!empty($data['email_newsletter']) && $data['email_newsletter'] == '1') ? 'checked = "checked"' : '' ?> >
		</div>
		
		<div class="col-md-12">
			<label> Total text package: </label>
			<input type="checkbox" name="total_text_program" class="radio-inline notget" value="1" <?php echo (!empty($data['total_text_program']) && $data['total_text_program'] == '1') ? 'checked = "checked"' : '' ?> >

			<?php 
				if (!empty($data['package']) && !empty($data['total_text_program'])) {
					$hidden = Get_total_text_program($data['package'], $data['total_text_program']);
				}else{
					$hidden = 0;
				}
			 ?>
			<input type="hidden" name="hidden_total_text_program" id="hidden_total_text_program" value="<?php echo !empty($hidden) ? $hidden : ''; ?>">
			<input type="hidden" name="hidden_total_text" id="hidden_total_text" value="<?php echo !empty($data['total_text_program']) ? $data['total_text_program'] : ''; ?>">
		</div>
		<div class="col-md-12">
			<label> 7/2019 Total Text Package: </label>
			<input type="checkbox" name="total_text_program7" class="radio-inline notget" value="1" <?php echo ($data['total_text_program7'] == '1') ? 'checked = "checked"' : '' ?> <?php echo ($data['canada_service']== '1') ? 'readonly' : '' ?> > NL emailed & texted out is included with texting system. <br/> ONLY if we design clients newsletter. If wanting their own formatted - click the $20 option above. <br/><br/>
			<?php $hidden = Get_total_text_program7($data['package'], $data['total_text_program7']); ?>
			<input type="hidden" name="hidden_total_text_program7" id="hidden_total_text_program7" value="<?php echo $hidden ? $hidden : ''; ?>">
			<input type="hidden" name="hidden_total_text7" id="hidden_total_text7" value="<?php echo $data['total_text_program7']; ?>">
		</div>
		<div class="col-md-12">
			<label> Prospect System: </label>
			<input type="checkbox" name="prospect_system" class="radio-inline notget" value="1" <?php echo (!empty($data['prospect_system']) && $data['prospect_system'] == '1') ? 'checked = "checked"' : '' ?> >
			<input type="hidden" name="hidden_prospect_system" id="hidden_prospect_system" value="<?php echo $data['prospect_system']; ?>">
			<label style="margin-left: 35px;"> FREE: </label>
			<input type="checkbox" name="free" class="radio-inline notget" value="1" <?php echo (!empty($data['free']) && $data['free']=='1') ? 'checked = "checked"' : '' ?> >
		</div>
		<div class="col-md-12">
			<label> Magic Booker System: </label>
			<input type="checkbox" name="magic_booker" class="radio-inline notget" value="1" <?php echo (!empty($data['magic_booker']) && $data['magic_booker'] == '1') ? 'checked = "checked"' : '' ?> >
			<input type="hidden" name="hidden_magic_booker" id="hidden_magic_booker" value="<?php echo $data['magic_booker']; ?>">
		</div>
		<div class="col-md-12">
			<label> Other language newsletter </label>
			<input type="checkbox" name="other_language_newsletter" class="radio-inline notget" value="1" <?php echo ($data['other_language_newsletter'] == '1') ? 'checked = "checked"' : '' ?> >
		</div>
		<div class="col-md-12">
			<label> Personal Unit App </label>
			<input type="checkbox" name="personal_unit_app" class="radio-inline notget" value="1" <?php echo ($data['personal_unit_app'] == '1') ? 'checked = "checked"' : '' ?> >
		</div>
		<div class="col-md-12">
			<label> Personal Unit App - Canada </label>
			<input type="checkbox" name="personal_unit_app_ca" class="radio-inline notget" value="1" <?php echo ($data['personal_unit_app_ca'] == '1') ? 'checked = "checked"' : '' ?> >
		</div>
		<div class="col-md-12">
			<label> Personal Website </label>
			<input type="checkbox" name="personal_website" class="radio-inline notget" value="1" <?php echo ($data['personal_website'] == '1') ? 'checked = "checked"' : '' ?> >
		</div>
		<div class="col-md-12">
			<label class="col-sm-3" style="padding-left: 0;"> Website Link </label>
			<input type="text" class="col-sm-7" name="website_link" value="<?php echo $data['website_link'] != '' ? $data['website_link'] : '' ?>">
		</div>
		<div class="col-md-12">
			<label> Personal URL </label>
			<input type="checkbox" name="personal_url" class="radio-inline notget" value="1" <?php echo ($data['personal_url'] == '1') ? 'checked = "checked"' : '' ?> >
		</div>
		<div class="col-md-12">
			<label> 10 Updates on subscription </label>
			<input type="checkbox" name="subscription_updates" class="radio-inline notget" value="1" <?php echo ($data['subscription_updates'] == '1') ? 'checked = "checked"' : '' ?> >
		</div>
		<div class="col-md-12">
			<label> App custom color </label>
			<input type="checkbox" name="app_color" class="radio-inline notget" value="1" <?php echo ($data['app_color'] == '1') ? 'checked = "checked"' : ''; ?> >
		</div>
		
		<div class="col-md-12 credit-notes">
			<label class="bottom-label credit-notes"> Misc charge <small>Tami only</small> </label>
            <textarea  name="misc_description" ><?php echo $data['misc_description']; ?></textarea>
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Amount ($) </label>
            <input type="text" id="misc_charge" name="misc_charge" value="<?php echo $data['misc_charge'] ? $data['misc_charge'] : 0; ?>">
            <input type="hidden" id="misc_charge_old" name="misc_charge_old" value="<?php echo $data['misc_charge'] ? $data['misc_charge'] : 0; ?>">
		</div>
		<div class="col-md-6">
			<label>
			Sub Total
			</label>
		</div>
		<div class="col-md-6">
		  <input type="text"  class="sub_total" value="<?php echo empty($data['sub_total']) ? 0 : $data['sub_total']; ?>" readonly>
		  <input type="hidden" name="sub_total" class="sub_total" value="<?php echo empty($data['sub_total']) ? 0 : $data['sub_total']; ?>">
		</div>
		<div class="clearfix"></div>
		<div class="col-md-6">
			<label>
			Total Package Price:PKG Includes all @ signs for test and all other Email services with @ sign.
			</label>
		</div>
		<div class="col-md-6">
		  <input type="text"  class="package_value" value="<?php echo empty($data['package_pricing']) ? 0 : $data['package_pricing']; ?>" readonly>
		  <input type="hidden" name="package_pricing" id="hidden_package" value="<?php echo empty($data['package_pricing']) ? 0 : $data['package_pricing']; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label">
				<?php
					if ($data['package'] == 'S' || $data['package'] == 'R') {
						$approtext = "<small>SJS approved</small>";
					} else {
						$approtext = '';
					}
				?>
				Account Credit: <?php echo $approtext; ?>
			</label>
            <input type="text" id="special_creadit" name="special_creadit" value="<?php echo $data['special_creadit']; ?>">
            <input type="hidden" id="special_creadit_old" name="special_creadit_old" value="<?php echo $data['special_creadit']; ?>" >
		</div>
        <div class="col-md-12 credit_notes">
			<label class="bottom-label credit-notes"> Credit Notes: <small>Does not show words on invoice</small> </label>
            <textarea  name="credit_notes"><?php echo $data['credit_notes']; ?></textarea>
		</div>
		<div class="col-md-12 credit_notes">
			<label class="bottom-label credit-notes"> Billing Alert box: <small>Tami only</small> </label>
            <textarea  name="billing_alert"><?php echo trim($data['billing_alert']); ?></textarea>
		</div>
		<div class="col-md-12">
			<label class="bottom-label">
			 Special Credit <small>Approved staff only <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; only shows on invoice</small>
			</label>
			<input type="text" name="special_credit" value="<?php echo ($data['special_credit']) ? $data['special_credit'] : 0.00; ?>">
			<input type="hidden" name="special_credit_hidden" id="special_credit" value="<?php echo isset($data['special_credit']) ? $data['special_credit'] : 0.00 ?>">
		</div>
		<div class="col-md-12 credit_notes">
			<label class="bottom-label credit-notes"> Special Credit Reason: </label>
			<textarea class="resone_txt" name="package_note"><?php echo ($data['package_note']) ? $data['package_note'] : '' ?></textarea>
		</div>
		<div class="col-md-12 credit_notes">
			<label class="bottom-label credit-notes"> Invoice Note: </label>
			<textarea class="resone_txt" name="invoice_note"><?php echo ($data['invoice_note']) ? $data['invoice_note'] : '' ?></textarea>
		</div>
        <div class="col-md-12">
			<label> Director has Spanish consultants: </label>
			<input type="checkbox" class="notget" name="spanish_consultant" value="1" <?php echo ($data['spanish_consultant'] == '1') ? 'checked = "checked"' : '' ?>>
		</div>

		<div class="col-md-12 links_custom">
			<label class="col-md-3"> Catalog Link: </label>
			<input type="text" class="col-md-6" name="catalog_link" value="<?php echo $data['catalog_link'];?>">
		</div>
		<div class="col-md-12 links_custom">
			<label class="col-md-3"> Shop Link: </label>
			<input type="text" class="col-md-6" name="shop_link" value="<?php echo $data['shop_link'];?>">
		</div>
		<div class="col-md-12 links_custom">
			<label class="col-md-3"> Boss Babe Link: </label>
			<input type="text" class="col-md-6" name="boss_babe_link" value="<?php echo $data['boss_babe_link'];?>">
		</div>
		<div class="col-md-12 social_share">
			<label> Social Media: </label>
			<?php
				if (!empty($data['socialM'])) {
					$SSocial = unserialize($data['socialM']);
					$SSocial = array_filter((array)$SSocial);
				} else {
					$SSocial = array();
				}

				?>
				<label>
				<span>Facebook</span> <input type="checkbox" <?php echo (!empty($SSocial) && array_key_exists("Sfacebook", $SSocial))  ? 'checked = "checked"' : ''; ?>  name="Sfacebook" class="SMcheck noget" id="Sfacebook" value="0">
				<input type="text" name="socialM[Sfacebook]" style="display: none;" id="Sfacebook-in" value="<?php echo empty($SSocial['Sfacebook']) ? '' : $SSocial['Sfacebook']; ?>">
				</label>
				<label>
				<span>LinkedIn</span> <input type="checkbox" <?php echo (!empty($SSocial) && array_key_exists("Slinkedin", $SSocial) ) ? 'checked = "checked"' : ''; ?> name="linkedin" class="SMcheck noget" id="Slinkedin" value="0">
				<input type="text" name="socialM[Slinkedin]" style="display: none;" id="Slinkedin-in" value="<?php echo empty($SSocial['Slinkedin']) ? '' : $SSocial['Slinkedin'] ; ?>">
				</label>
				<label>
				<span>GooglePlus</span> <input type="checkbox" <?php echo (!empty($SSocial) && array_key_exists("SgoogleP", $SSocial) ) ? 'checked = "checked"' : ''; ?> name="googleP" class="SMcheck noget" id="SgoogleP" value="0">
				<input type="text" name="socialM[SgoogleP]" style="display: none;" id="SgoogleP-in" value="<?php echo empty($SSocial['SgoogleP']) ? '' : $SSocial['SgoogleP']; ?>">
				</label>
				<label>
				<span>Youtube</span> <input type="checkbox" <?php echo (!empty($SSocial) && array_key_exists("Syoutube", $SSocial) ) ? 'checked = "checked"' : ''; ?> name="youtube" class="SMcheck noget" id="Syoutube" value="0">
				<input type="text" name="socialM[Syoutube]" style="display: none;" id="Syoutube-in" value="<?php echo empty($SSocial['Syoutube']) ? '' : $SSocial['Syoutube']; ?>">
				</label>
				<label>
				<span>Instagram</span> <input type="checkbox" <?php echo (!empty($SSocial) && array_key_exists("Sinstagram", $SSocial) ) ? 'checked = "checked"' : ''; ?> name="instagram" class="SMcheck noget" id="Sinstagram" value="0">
				<input type="text" name="socialM[Sinstagram]" style="display: none;" id="Sinstagram-in" value="<?php echo empty($SSocial['Sinstagram']) ? '' : $SSocial['Sinstagram']; ?>">
				</label>
				<label>
				<span>Twitter</span> <input type="checkbox" <?php echo (!empty($SSocial) && array_key_exists("Stwitter", $SSocial) ) ? 'checked = "checked"' : ''; ?> name="twitter" class="SMcheck noget" id="Stwitter" value="0">
				<input type="text" name="socialM[Stwitter]" style="display: none;" id="Stwitter-in" value="<?php echo empty($SSocial['Stwitter']) ? '' : $SSocial['Stwitter']; ?>">
				</label>
				<label>
				<span>Snapchat</span> <input type="checkbox" <?php echo (!empty($SSocial) && array_key_exists("Ssnapchat", $SSocial) ) ? 'checked = "checked"' : ''; ?> name="snapchat" class="SMcheck noget" id="Ssnapchat" value="0">
				<input type="text" name="socialM[Ssnapchat]" style="display: none;" id="Ssnapchat-in" value="<?php echo empty($SSocial['Ssnapchat']) ? '' : $SSocial['Ssnapchat']; ?>">
				</label>
		</div>
		<div id="ac_deltail">
			<div class="col-md-12">
				<label> Select Payment Mode: </label>
				<input type="radio" class="account_detail radio-inline notget" name="account_detail" value="Y" <?php echo ($data['account_detail'] == 'Y') ? 'checked = "checked"' : '' ?>>  Routing
				<input type="radio" class="account_detail radio-inline" name="account_detail" value="N" <?php echo ($data['account_detail'] == 'N') ? 'checked = "checked"' : '' ?>> Credit Card
			</div>
			<div class="col-md-12 account_detail_routing">
				<label class="bottom-label"> Routing: </label>
				  <input type="text" maxlength="9" id="cu" name="cu_routing" value="<?php echo empty($data['cu_routing']) ? '' : $data['cu_routing']; ?>">
			</div>
			<div class="col-md-12 account_detail_routing">
				<label class="bottom-label"> Account: </label>
				<input type="text"  id="cv" name="cv_account" value="<?php echo empty($data['cv_account']) ? '' : $decrypted; ?>">
			</div>
			<div class="col-md-12 account_detail_cc">
				<label class="bottom-label col-sm-6" style="padding-left: 0;"> Credit Card </label>
				<div class="col-sm-6 cc_dt" style="padding-left: 4px;"> Card Number<br>
					<input type="text" name="cc_number" value="<?php echo empty($data['cc_number']) ? '' : $data['cc_number']; ?>" placeholder="**** **** **** ****"><br> Security Code<br>
					<input type="text" placeholder="Security Code" name="cc_code" value="<?php echo empty($data['cc_code']) ? '' : $data['cc_code']; ?>"><br>Expiration Date<br>
					<input type="text" maxlength="5" name="cc_expir_date" placeholder="MM/YY" value="<?php echo empty($data['cc_expir_date']) ? '' : $data['cc_expir_date']; ?>"><br> Postal Code<br>
					<input type="text" name="cc_zip" placeholder="1001" value="<?php echo empty($data['cc_zip']) ? '' : $data['cc_zip']; ?>">
					</div>
			</div>
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Newsletter-Color </label>
			<input type="number" min="0" name="newsletter_color" value="<?php echo ($data['newsletter_color']) ? $data['newsletter_color'] : 0; ?>">
			<input type="hidden" name="newsletter_color_hidden" id="newsletter_color" value="<?php echo ($data['newsletter_color']) ? newsletter_color_constant_val * $data['newsletter_color'] : 0; ?>" >
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Newsletter-Black White </label>
			<input type="number" min="0" name="newsletter_black_white" value="<?php echo ($data['newsletter_black_white']) ? $data['newsletter_black_white'] : 0; ?>">
			<input type="hidden" name="newsletter_black_white_hidden" id="newsletter_black_white" value="<?php echo ($data['newsletter_black_white']) ? newsletter_black_white_constant_val * $data['newsletter_black_white'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Last Month Packets Postage </label>
			<input type="number" min="0" name="month_packet_postage" value="<?php echo ($data['month_packet_postage']) ? $data['month_packet_postage'] : 0; ?>">
			<input type="hidden" name="month_packet_postage_hidden" id="month_packet_postage" value="<?php echo ($data['month_packet_postage']) ? month_packet_postage_constant_val * $data['month_packet_postage'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> New Consultant Packet Postage </label>
			<input type="number" min="0" name="consultant_packet_postage" value="<?php echo ($data['consultant_packet_postage']) ? $data['consultant_packet_postage'] : 0; ?>">
		<input type="hidden" name="consultant_packet_postage_hidden" id="consultant_packet_postage" value="<?php echo ($data['consultant_packet_postage']) ? consultant_packet_postage_constant_val * $data['consultant_packet_postage'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> New Consultant Bundles </label>
			<input type="number" min="0" name="consultant_bundles" value="<?php echo ($data['consultant_bundles']) ? $data['consultant_bundles'] : 0; ?>">
			<input type="hidden" name="consultant_bundles_hidden" id="consultant_bundles" value="<?php echo ($data['consultant_bundles']) ? consultant_bundles_constant_val * $data['consultant_bundles'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Consistency Gift </label>
			<input type="number" min="0" name="consistency_gift" value="<?php echo ($data['consistency_gift']) ? $data['consistency_gift'] : 0; ?>">
			<input type="hidden" name="consistency_gift_hidden" id="consistency_gift" value="<?php echo ($data['consistency_gift']) ? consistency_gift_constant_val * $data['consistency_gift'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Reds Program Gift </label>
			<input type="number" min="0" name="reds_program_gift" value="<?php echo ($data['reds_program_gift']) ? $data['reds_program_gift'] : 0; ?>">
			<input type="hidden" name="reds_program_gift_hidden" id="reds_program_gift" value="<?php echo ($data['reds_program_gift']) ? reds_program_gift_constant_val * $data['reds_program_gift'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Stars Program Gift </label>
			<input type="number" min="0" name="stars_program_gift" value="<?php echo ($data['stars_program_gift']) ? $data['stars_program_gift'] : 0; ?>">
			<input type="hidden" name="stars_program_gift_hidden" id="stars_program_gift" value="<?php echo ($data['stars_program_gift']) ? stars_program_gift_constant_val * $data['stars_program_gift'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Gift Wrap and Postage </label>
			<input type="number" min="0" name="gift_wrap_postpage" value="<?php echo ($data['gift_wrap_postpage']) ? $data['gift_wrap_postpage'] : 0; ?>">
			<input type="hidden" name="gift_wrap_postpage_hidden" id="gift_wrap_postpage" value="<?php echo ($data['gift_wrap_postpage']) ? gift_wrap_postpage_constant_val * $data['gift_wrap_postpage'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> One Rate Postage </label>
			<input type="number" min="0" name="one_rate_postpage" value="<?php echo ($data['one_rate_postpage']) ? $data['one_rate_postpage'] : 0; ?>">
			<input type="hidden" name="one_rate_postpage_hidden" id="one_rate_postpage" value="<?php echo ($data['one_rate_postpage']) ? one_rate_postpage_constant_val * $data['one_rate_postpage'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Month End Blast Flyer </label>
			<input type="number" min="0" name="month_blast_flyer" value="<?php echo ($data['month_blast_flyer']) ? $data['month_blast_flyer'] : 0; ?>">
			<input type="hidden" name="month_blast_flyer_hidden" id="month_blast_flyer" value="<?php echo ($data['month_blast_flyer']) ? month_blast_flyer_constant_val * $data['month_blast_flyer'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Text and Email to Unit </label>
			<input type="number" min="0" name="flyer_ecard_unit" value="<?php echo ($data['flyer_ecard_unit']) ? $data['flyer_ecard_unit'] : 0; ?>">
			<input type="hidden" name="flyer_ecard_unit_hidden" id="flyer_ecard_unit" value="<?php echo ($data['flyer_ecard_unit']) ? flyer_ecard_unit_constant_val * $data['flyer_ecard_unit'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Unit Challenge Flyer </label>
			<input type="number" min="0" name="unit_challenge_flyer" value="<?php echo ($data['unit_challenge_flyer']) ? $data['unit_challenge_flyer'] : 0; ?>">
			<input type="hidden" name="unit_challenge_flyer_hidden" id="unit_challenge_flyer" value="<?php echo ($data['unit_challenge_flyer']) ? unit_challenge_flyer_constant_val * $data['unit_challenge_flyer'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Team Building Flyer </label>
			<input type="number" min="0" name="team_building_flyer" value="<?php echo ($data['team_building_flyer']) ? $data['team_building_flyer'] : 0; ?>">
			<input type="hidden" name="team_building_flyer_hidden" id="team_building_flyer" value="<?php echo ($data['team_building_flyer']) ? team_building_flyer_constant_val * $data['team_building_flyer'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Wholesale Promo Flyer </label>
			<input type="number" min="0" name="wholesale_promo_flyer" value="<?php echo ($data['wholesale_promo_flyer']) ? $data['wholesale_promo_flyer'] : 0; ?>">
			<input type="hidden" name="wholesale_promo_flyer_hidden" id="wholesale_promo_flyer" value="<?php echo ($data['wholesale_promo_flyer']) ? wholesale_promo_flyer_constant_val * $data['wholesale_promo_flyer'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Design Fee </label>
			<input type="number" min="0" name="postcard_design" value="<?php echo ($data['postcard_design']) ? $data['postcard_design'] : 0; ?>">
			<input type="hidden" name="postcard_design_hidden" id="postcard_design" value="<?php echo ($data['postcard_design']) ? postcard_design_constant_val * $data['postcard_design'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Custom Changes </label>
			<input type="number" min="0" name="postcard_edit" value="<?php echo ($data['postcard_edit']) ? $data['postcard_edit'] : 0; ?>">
			<input type="hidden" name="postcard_edit_hidden" id="postcard_edit" value="<?php echo ($data['postcard_edit']) ? postcard_edit_constant_val * $data['postcard_edit'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Small Edit </label>
			<input type="number" min="0" name="ecard_unit" value="<?php echo ($data['ecard_unit']) ? $data['ecard_unit'] : 0; ?>">
			<input type="hidden" name="ecard_unit_hidden" id="ecard_unit" value="<?php echo ($data['ecard_unit']) ? ecard_unit_constant_val * $data['ecard_unit'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Graphic Insert </label>
			<input type="number" min="0" name="nl_flyer" value="<?php echo ($data['nl_flyer']) ? $data['nl_flyer'] : 0; ?>">
			<input type="hidden" name="nl_flyer_hidden" id="nl_flyer" value="<?php echo ($data['nl_flyer']) ? nl_flyer_constant_val * $data['nl_flyer'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Specialty Postcard </label>
			<input type="number" min="0" name="speciality_postcard" value="<?php echo ($data['speciality_postcard']) ? $data['speciality_postcard'] : 0; ?>">
			<input type="hidden" name="speciality_postcard_hidden" id="speciality_postcard" value="<?php echo ($data['speciality_postcard']) ? speciality_postcard_constant_val * $data['speciality_postcard'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Greeting Card with gift </label>
			<input type="number" min="0" name="card_with_gift" value="<?php echo ($data['card_with_gift']) ? $data['card_with_gift'] : 0; ?>">
			<input type="hidden" name="card_with_gift_hidden" id="card_with_gift" value="<?php echo ($data['card_with_gift']) ? card_with_gift_constant_val * $data['card_with_gift'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Greeting Card </label>
			<input type="number" min="0" name="greeting_card" value="<?php echo ($data['greeting_card']) ? $data['greeting_card'] : 0; ?>">
			<input type="hidden" name="greeting_card_hidden" id="greeting_card" value="<?php echo ($data['greeting_card']) ? greeting_card_constant_val * $data['greeting_card'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Greeting Post Card </label>
			<input type="number" min="0" name="birthday_brownie" value="<?php echo ($data['birthday_brownie']) ? $data['birthday_brownie'] : 0; ?>">
			<input type="hidden" name="birthday_brownie_hidden" id="birthday_brownie" value="<?php echo ($data['birthday_brownie']) ? birthday_brownie_constant_val * $data['birthday_brownie'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Birthday Cards and Starbucks </label>
			<input type="number" min="0" name="birthday_starbucks" value="<?php echo ($data['birthday_starbucks']) ? $data['birthday_starbucks'] : 0; ?>">
			<input type="hidden" name="birthday_starbucks_hidden" id="birthday_starbucks" value="<?php echo ($data['birthday_starbucks']) ? birthday_starbucks_constant_val * $data['birthday_starbucks'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Anniversary Card and Starbucks </label>
			<input type="number" min="0" name="anniversary_starbucks" value="<?php echo ($data['anniversary_starbucks']) ? $data['anniversary_starbucks'] : 0; ?>">
			<input type="hidden" name="anniversary_starbucks_hidden" id="anniversary_starbucks" value="<?php echo ($data['anniversary_starbucks']) ? anniversary_starbucks_constant_val * $data['anniversary_starbucks'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Referral Credit </label>
			<input type="number" min="0" name="referral_credit" value="<?php echo ($data['referral_credit']) ? $data['referral_credit'] : 0; ?>">
			<input type="hidden" name="referral_credit_hidden" id="referral_credit" value="<?php echo ($data['referral_credit']) ? referral_credit_constant_val * $data['referral_credit'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Text Blast Customers Billing </label>
			<input type="number" min="0" name="cc_billing" value="<?php echo ($data['cc_billing']) ? $data['cc_billing'] : 0; ?>">
			<input type="hidden" name="cc_billing_hidden" id="cc_billing" value="<?php echo !empty($data['cc_billing']) ? $data['cc_billing']*UACC_BILLING : '0' ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> Customer Newsletter </label>
			<input type="number" min="0" name="customer_newsletter" value="<?php echo ($data['customer_newsletter']) ? $data['customer_newsletter'] : 0; ?>">
			<input type="hidden" name="customer_newsletter_hidden" id="customer_newsletter" value="<?php echo ($data['customer_newsletter']) ? customer_newsletter_constant_val * $data['customer_newsletter'] : 0; ?>">
		</div>
		
		
		<div class="col-md-12">
			<label class="bottom-label"> Picture Texting </label>
			<input type="number" min="0" name="picture_texting" value="<?php echo ($data['picture_texting']) ? $data['picture_texting'] : 0; ?>">
			<input type="hidden" name="picture_texting_hidden" id="picture_texting" value="<?php echo ($data['picture_texting']) ? picture_texting_constant_val * $data['picture_texting'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> KeyWord </label>
			<input type="number" min="0" name="keyword" value="<?php echo ($data['keyword']) ? $data['keyword'] : 0; ?>">
			<input type="hidden" name="keyword_hidden" id="keyword" value="<?php echo ($data['keyword']) ? keyword_constant_val * $data['keyword'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<label class="bottom-label"> New Client Set up Fee </label>
			<input type="number" min="0" name="client_setup" value="<?php echo ($data['client_setup']) ? $data['client_setup'] : 0; ?>">
			<input type="hidden" name="client_setup_hidden" id="client_setup" value="<?php echo ($data['client_setup']) ? client_setup_constant_val * $data['client_setup'] : 0; ?>">
		</div>
		<div class="col-md-12">
			<img src="<?php echo base_url('assets/images/thumbnail_pkg_charges.png'); ?>" class="img-responsive" height="100%" width="100%">
		</div>
		<div class="col-md-12">
			<h3 style="text-decoration: underline;">Ala Carte Items to add:</h3>
			<p>Text & Email Service for $39.99 / stand alone is $69.99 <br>
				Customer Text & Email System $29.99 <br>
				Digital Business Card $20 <br>
				Newsletter Service $55 or $38 <br>
				Newsletter Printed mailings: Color $1.29 or Black/White .99
			</p>
		</div>
	</div>
</div>
