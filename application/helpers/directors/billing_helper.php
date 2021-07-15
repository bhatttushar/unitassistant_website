<?php 

if (!function_exists('get_instance')) {
	function get_instance() {
		$CI = &get_instance();
	}
}

function SetBalance($id_newsletter, $balance) {
	$CI = get_instance();
	$sDate = date("Y-m-d H:i:s");

	//NEEDED
	$sFound = $CI->db->get_where('invoice_balance',array('id_newsletter'=>$id_newsletter))->num_rows();
	if ($sFound > 0) {
		$data = array('balance'=>abs($balance), 'update_at'=>$sDate);
		$CI->db->set($data);
		$CI->db->where('id_newsletter', $id_newsletter);
		$Qobject = $CI->db->update('invoice_balance');
		return 1;
		exit();
	} else {
		$data = array('id_newsletter'=>$id_newsletter, 'balance'=>abs($balance));
		$Qobject = $CI->db->insert('invoice_balance', $data);
		return 1;
		exit();
	}
}

function CountInvoice($id){
	$CI = get_instance();
	$result = $CI->db->get_where('invoices',array('id_newsletter'=>$id,'deleted'=>'0'))->num_rows();
	if($result <= 0) {
		return "disabled";
	}else {
		return "";
	}
}

function GetInvoiceMailContent($id_newsletter,$id_invoice){
	$CI = get_instance();
	$CI->db->select('content');
	$CI->db->from('invoice_mail');
	$CI->db->where(array('id_newsletter'=>$id_newsletter,'id_invoice'=>$id_invoice));
	$CI->db->limit(1);
	$CI->db->order_by('id_mail', 'desc');
	$mail_content = $CI->db->get()->row_array();

	if (!empty($mail_content)) {
    	return $mail_content['content'];
	}else {
		return '';
	}
}

function get_excel_field_price($data, $aRows, $field){

	if ($field=='newsletter_color') {
		$sTotalCharge = $aRows[2] * (newsletter_color_constant_val);
	    $sTotalCharge += $aRows[3] * (newsletter_black_white_constant_val);
	}elseif ($field=='month_packet_postage') {
		$sTotalCharge = $aRows[2] * (month_packet_postage_constant_val);
	}elseif ($field=='consultant_packet_postage') {
        $sTotalCharge = $aRows[2] * (consultant_packet_postage_constant_val);
	}elseif ($field == 'consultant_bundles') {
        $sTotalCharge = $aRows[2] * (consultant_bundles_constant_val);
	}elseif ($field == 'consistency_gift') {
        $sTotalCharge = $aRows[2] * (consistency_gift_constant_val);
	}elseif ($field == 'reds_program_gift') {
        $sTotalCharge = $aRows[2] * (reds_program_gift_constant_val);
	}elseif ($field == 'stars_program_gift') {
        $sTotalCharge = $aRows[2] * (stars_program_gift_constant_val);
	}elseif ($field == 'gift_wrap_postpage') {
        $sTotalCharge = $aRows[5] * (gift_wrap_postpage_constant_val);
	}elseif ($field == 'one_rate_postpage') {
        $sTotalCharge = $aRows[2] * (one_rate_postpage_constant_val);
	}elseif ($field == 'month_blast_flyer') {
        $sTotalCharge = $aRows[2] * (month_blast_flyer_constant_val);
	}elseif ($field == 'flyer_ecard_unit') {
        $sTotalCharge = $aRows[2] * (unit_challenge_flyer_constant_val);
        $sTotalCharge += $aRows[3] * (team_building_flyer_constant_val);
        $sTotalCharge += $aRows[4] * (wholesale_promo_flyer_constant_val);
        $sTotalCharge += $aRows[5] * (nl_flyer_constant_val);
        $sTotalCharge += $aRows[6] * (postcard_design_constant_val);
        $sTotalCharge += $aRows[7] * (ecard_unit_constant_val);
        $sTotalCharge += $aRows[8] * (flyer_ecard_unit_constant_val);
        $sTotalCharge += $aRows[9] * (postcard_edit_constant_val);
	}elseif ($field == 'speciality_postcard') {
        $sTotalCharge = $aRows[2] * (speciality_postcard_constant_val);
	}elseif ($field == 'card_with_gift') {
        $sTotalCharge = $aRows[2] * (card_with_gift_constant_val);
	}elseif ($field == 'birthday_brownie') {
        $sTotalCharge = $aRows[2] * (birthday_brownie_constant_val);
	}elseif ($field == 'birthday_starbucks') {
        $sTotalCharge = $aRows[2] * (birthday_starbucks_constant_val);
	}elseif ($field == 'anniversary_starbucks') {
		$sTotalCharge = $aRows[2] * (anniversary_starbucks_constant_val);
    }elseif ($field == 'referral_credit') {
        $nNewReferral = $aRows[2] * (referral_credit_constant_val);
        $nOldReferral = referral_credit_constant_val;
        $sTotalCharge = ( $nOldReferral) - $nNewReferral; 
    }elseif ($field == 'special_credit') {
    	$sTotalCharge = 0; 
    }elseif ($field == 'cc_billing') {
        $sTotalCharge = $aRows[2] * (UACC_BILLING);
    }elseif ($field == 'customer_newsletter') {
        $sTotalCharge = $aRows[2] * (customer_newsletter_constant_val);

    }elseif ($field == 'picture_texting') {
        $sTotalCharge = $aRows[2] * (picture_texting_constant_val);
    }elseif ($field == 'keyword') {
        $sTotalCharge = $aRows[2] * (keyword_constant_val);
    }elseif ($field == 'client_setup') {
        $sTotalCharge = $aRows[2] * (client_setup_constant_val);
    }elseif ($field=='greeting_card') {
        $sTotalCharge = $aRows[2] * (greeting_card_constant_val);
	}

    return $sTotalCharge + $data['package_pricing'];
}


function GetInvoiceTable($data){

	$table = '';
	$Credit = (GetTotalDue($data['id_newsletter']) - GetBalance($data['id_newsletter']));
	if ($data['account_detail'] == 'N') {
		$ttotal = number_format((float) $data['package_pricing'] - (float)$data['special_credit'], 2);
		$CCcharge = ($ttotal * 5) / 100;
	} else {
		$CCcharge = '';
	}

	$sPackageValue = ($data['package_value'] == '' ? '0.00' : $data['package_value']);
	$sFacebookNewsletter = ($data['facebook'] == '1') ? facebook : '';
	$sFacebookEverythingNewsletter = ($data['facebook_everything'] == '1') ? facebook_everything : '';
	$sNewsletter = (($data['emailing'] == '1') ? emailing_0 : (($data['emailing'] == 2) ? emailing_1 : ''));
	$sNewsletterDesign = (($data['hidden_newsletter'] == 'SB' || $data['hidden_newsletter'] == 'AB') ? newsletter_design_constant_val : '$0');
	$sEmailNewsletter = ($data['email_newsletter'] == '1') ? email_newsletter : '';
	$BizCard = ($data['digital_biz_card'] == '1') ? DIGITAL_BIZ_CARD : '';
	$canadaService = ($data['canada_service'] == '1') ?  : '';
	$nsd_client = ($data['nsd_client'] == '1') ?  '1' : '';

	if ($data['canada_service'] == '1') {
		if ($data['package'] == 'N' || $data['package'] == '') {
			$canadaService =  canada_service + total_text_program7_n;
		}else{
			$canadaService = canada_service + total_text_program7_y;
		}
	}else{
		$canadaService = '';
	}

	$sTotalTextProgram=($data['total_text_program']=='1') ? Get_total_text_program($data['package'], $data['total_text_program']) : '';
	$sTotalTextProgram7=($data['total_text_program7']=='1') ? Get_total_text_program7($data['package'], $data['total_text_program7']) : '';

	//Director Access Texting System
	if ($data['nsd_client'] == '1') {
		$sDirectorAccess = '0';
	} elseif ($data['total_text_program'] == '1') {
		$sDirectorAccess = '0';
	} else {
		$sDirectorAccess = '';
	}
	$sProspectSystem = ($data['prospect_system'] == '1') ? PROSPECT_SYSTEM : '';
	$sMagicBooker = ($data['magic_booker'] == '1') ? MAGIC_BOOKER : '';
	$sOtherLanguageNewsletter = ($data['other_language_newsletter'] == '1') ? other_language_newsletter : '';
	$sPersonalUnitApp = ($data['personal_unit_app'] == '1') ? personal_unit_app_val : '';
	$sPersonalWebsite = ($data['personal_website'] == '1') ? personal_website_val : '';
	$sPersonalUrl = ($data['personal_url'] == '1') ? personal_url_val : '';
	$sSubscriptionUpdates = ($data['subscription_updates'] == '1') ? subscription_updates_val : '';
	$sAppColor = ($data['app_color'] == '1') ? app_color_val : '';
	$sPackageName =  GetPackageName($data['package']);
?>

    <div class="col-sm-12">
        <table class="table table-bordered table-hover" id="tab_logic_sub">
            <thead>
                <tr>
                    <th class="text-center"> # </th>
                    <th class="text-center th-name"> Name </th>
                    <th class="text-center th-unit"> Quantity </th>
                    <th class="text-center th-value"> Value($) </th>
                    <th class="text-center th-total"> Total($) </th>
                </tr>
            </thead>
            <tbody>
                <?php
	$l_num = 1;
	$table='';
	
	if ($data['package']) {
		$table .= table_format($l_num, 'package', "Package: ".$sPackageName." (Unit size - ".$data['unit_size'].")", 'unit_size', '', 'package_value', $sPackageValue, 'package_value_total', $sPackageValue);
		$l_num++;
	}

	if ($sFacebookNewsletter) {
		$table .= table_format($l_num, 'facebook_name', 'Facebook Newsletters', 'facebook', '1', 'facebook_val', $sFacebookNewsletter, 'facebook_val_total', $sFacebookNewsletter);
		$l_num++;
	}

	if ($sFacebookEverythingNewsletter) {
		$table .= table_format($l_num, 'facebook_everything_name', 'Facebook Everything', 'facebook_everything', '1', 'facebook_everything_val', $sFacebookEverythingNewsletter, 'facebook_everything_val_total', $sFacebookEverythingNewsletter);
		$l_num++;
	}

	//emailing
	if ($sNewsletter) {
		$table .= table_format($l_num, 'emailing_name', 'Newsletters', 'emailing', '1', 'emailing_val', $sNewsletter, 'emailing_val_total', $sNewsletter);
		$l_num++;
	}
	if ($BizCard) {
		$table .= table_format($l_num, 'digital_biz_card_name', 'Digital Biz Card', 'digital_biz_card', '1', 'digital_biz_card_val', $BizCard, 'digital_biz_card_val_total', $BizCard);
		$l_num++;
	}

	if ($canadaService) {
		$table .= table_format($l_num, 'canada_service_name', 'Canada Service', 'canada_service', '1', 'canada_service_val', $canadaService, 'canada_service_val_total', $canadaService);
		$l_num++;
	}

	// email newsletter
	if ($sEmailNewsletter) {
		$table .= table_format($l_num, 'email_newsletter_name', 'Email Newsletter', 'email_newsletter', '1', 'email_newsletter_val', $sEmailNewsletter, 'email_newsletter_val_total', $sEmailNewsletter);
		$l_num++;
	}

	// NSD text and email
	if ($nsd_client != '') {
		$table .= table_format($l_num, 'nsd_client_name', 'NSD text and email', 'nsd_client', '1', 'nsd_client_val', $nsd_client, 'nsd_client_val_total', $nsd_client);
		$l_num++;
	}

	if ($sTotalTextProgram) {
		$table .= table_format($l_num, 'total_text_program_name', 'Total text package', 'total_text_program', '1', 'total_text_program_val', $sTotalTextProgram, 'total_text_program_val_total', $sTotalTextProgram);
		$l_num++;
	}

	if ($sTotalTextProgram7) {
		$table .= table_format($l_num, 'total_text_program7_name', '7/2019 Total text package', 'total_text_program7', '1', 'total_text_program7_val', $sTotalTextProgram7, 'total_text_program7_val_total', $sTotalTextProgram7);
		$l_num++;
	}

	if ($sProspectSystem) {
		$table .= table_format($l_num, 'prospect_system_name', 'Prospect System', 'prospect_system', '1', 'prospect_system_val', PROSPECT_SYSTEM, 'prospect_system_val_total', PROSPECT_SYSTEM);
		$l_num++;
	}

	if ($sMagicBooker) {
		$table .= table_format($l_num, 'magic_booker_name', 'Magic Booker System', 'magic_booker', '1', 'magic_booker_val', MAGIC_BOOKER, 'magic_booker_val_total', MAGIC_BOOKER);
		$l_num++;
	}

	if ($sOtherLanguageNewsletter) {
		$table .= table_format($l_num, 'other_language_newsletter_name', 'Other language newsletter', 'other_language_newsletter', '1', 'other_language_newsletter_val', other_language_newsletter, 'other_language_newsletter_val_total', other_language_newsletter);
		$l_num++;
	}
	if ($sPersonalUnitApp) {
		if ($data['package'] != 'N') {
			$table .= table_format($l_num, 'personal_unit_app_name', 'Personal Unit App', 'personal_unit_app', '1', 'personal_unit_app_val', personal_unit_app_val, 'personal_unit_app_val_total', personal_unit_app_val);
		} else {
			$table .= table_format($l_num, 'personal_unit_app_name', 'Personal Unit App', 'personal_unit_app', '1', 'personal_unit_app_val', pack_personal_unit_app_val, 'personal_unit_app_val_total', pack_personal_unit_app_val);
		}
		$l_num++;
	}
	if ($sPersonalWebsite) {
		if ($data['package'] != 'N') {
			$table .= table_format($l_num, 'personal_website_name', 'Personal Website', 'personal_website', '1', 'personal_website_val', personal_website_val, 'personal_website_val_total', personal_website_val);
		} else {
			$table .= table_format($l_num, 'personal_website_name', 'Personal Website', 'personal_website', '1', 'personal_website_val', pack_personal_website_val, 'personal_website_val_total',pack_personal_website_val);
		}
		$l_num++;
	}
	if ($sPersonalUrl) {
		$table .= table_format($l_num, 'personal_url_name', 'Personal URL', 'personal_url', '1', 'personal_url_val', personal_url_val, 'personal_url_val_total', personal_url_val);
		$l_num++;
	}
	if ($sSubscriptionUpdates) {
		$table .= table_format($l_num, 'subscription_updates_name', '10 Updates on subscription', 'subscription_updates', '1', 'subscription_updates_val', subscription_updates_val, 'subscription_updates_val_total', subscription_updates_val);
		$l_num++;
	}
	if ($sAppColor) {
		$table .= table_format($l_num, 'app_color_name', 'App custom color', 'app_color', '1', 'app_color_val', app_color_val, 'app_color_val_total', app_color_val);
		$l_num++;
	}

	if ($data['newsletter_color']) {
		$table .= table_format($l_num, 'newsletter_color_name', 'Newsletter-Color', 'newsletter_color', $data['newsletter_color'], 'newsletter_color_val', newsletter_color_constant_val, 'newsletter_color_val_total', newsletter_color_constant_val * $data['newsletter_color'] );
		$l_num++;
	}

	if ($data['newsletter_black_white']) {
		$table .=  table_format($l_num, 'newsletter_black_white_name', 'Newsletter-Black White', 'newsletter_black_white', $data['newsletter_black_white'], 'newsletter_black_white_val', newsletter_black_white_constant_val, 'newsletter_black_white_val_total', newsletter_black_white_constant_val * $data['newsletter_black_white']);
		$l_num++;
	}

	if ($data['month_packet_postage']) {
		$table .= table_format($l_num, 'month_packet_postage_name', 'Last Month Packets Postage', 'month_packet_postage', $data['month_packet_postage'], 'month_packet_postage_val', month_packet_postage_constant_val, 'month_packet_postage_val_total', month_packet_postage_constant_val * $data['month_packet_postage']);
		$l_num++;
	}

	if ($data['consultant_packet_postage']) {
		$table .= table_format($l_num, 'consultant_packet_postage_name', 'New Consultant Packet Postage', 'consultant_packet_postage', $data['consultant_packet_postage'], 'consultant_packet_postage_val', consultant_packet_postage_constant_val, 'consultant_packet_postage_val_total', consultant_packet_postage_constant_val * $data['consultant_packet_postage']);
		$l_num++;
	}

	if ($data['consultant_bundles']) {
		$table .= table_format($l_num, 'consultant_bundles_name', 'New Consultant Bundles', 'consultant_bundles', $data['consultant_bundles'], 'consultant_bundles_val', consultant_bundles_constant_val, 'consultant_bundles_val_total', consultant_bundles_constant_val * $data['consultant_bundles']);
		$l_num++;
	}

	if ($data['consistency_gift']) {
		$table .= table_format($l_num, 'consistency_gift_name', 'Consistency Gift', 'consistency_gift', $data['consistency_gift'], 'consistency_gift_val', consistency_gift_constant_val, 'consistency_gift_val_total', consistency_gift_constant_val * $data['consistency_gift']);
		$l_num++;
	}

	if ($data['reds_program_gift']) {
		$table .= table_format($l_num, 'reds_program_gift_name', 'Reds Program Gift', 'reds_program_gift', $data['reds_program_gift'], 'reds_program_gift_val', reds_program_gift_constant_val, 'reds_program_gift_val_total', reds_program_gift_constant_val * $data['reds_program_gift']);
		$l_num++;
	}

	if ($data['stars_program_gift']) {
		$table .= table_format($l_num, 'stars_program_gift_name', 'Stars Program Gift', 'stars_program_gift', $data['stars_program_gift'], 'stars_program_gift_val', stars_program_gift_constant_val, 'stars_program_gift_val_total', stars_program_gift_constant_val * $data['stars_program_gift']);
		$l_num++;
	}

	if ($data['gift_wrap_postpage']) {
		$table .= table_format($l_num, 'gift_wrap_postpage_name', 'Gift Wrap and Postage', 'gift_wrap_postpage', $data['gift_wrap_postpage'], 'gift_wrap_postpage_val', gift_wrap_postpage_constant_val, 'gift_wrap_postpage_val_total', gift_wrap_postpage_constant_val * $data['gift_wrap_postpage']);
		$l_num++;
	}

	if ($data['one_rate_postpage']) {
		$table .= table_format($l_num, 'one_rate_postpage_name', 'One Rate Postage', 'one_rate_postpage', $data['one_rate_postpage'], 'one_rate_postpage_val', one_rate_postpage_constant_val, 'one_rate_postpage_val_total', one_rate_postpage_constant_val * $data['one_rate_postpage']);
		$l_num++;
	}

	if ($data['month_blast_flyer']) {
		$table .= table_format($l_num, 'month_blast_flyer_name', 'Month End Blast Flyer', 'month_blast_flyer', $data['month_blast_flyer'], 'month_blast_flyer_val', month_blast_flyer_constant_val, 'month_blast_flyer_val_total', month_blast_flyer_constant_val * $data['month_blast_flyer']);
		$l_num++;
	}

	if ($data['flyer_ecard_unit']) {
		$table .= table_format($l_num, 'flyer_ecard_unit_name', 'Flyer Ecard to Unit', 'flyer_ecard_unit', $data['flyer_ecard_unit'], 'flyer_ecard_unit_val', flyer_ecard_unit_constant_val, 'flyer_ecard_unit_val_total', flyer_ecard_unit_constant_val * $data['flyer_ecard_unit']);
		$l_num++;
	}

	if ($data['unit_challenge_flyer']) {
		$table .= table_format($l_num, 'unit_challenge_flyer_name', 'Unit Challenge Flyer', 'unit_challenge_flyer', $data['unit_challenge_flyer'], 'unit_challenge_flyer_val', unit_challenge_flyer_constant_val, 'unit_challenge_flyer_val_total', unit_challenge_flyer_constant_val * $data['unit_challenge_flyer']);
		$l_num++;
	}

	if ($data['team_building_flyer']) {
		$table .= table_format($l_num, 'team_building_flyer_name', 'Team Building Flyer', 'team_building_flyer', $data['team_building_flyer'], 'team_building_flyer_val', team_building_flyer_constant_val, 'team_building_flyer_val_total', team_building_flyer_constant_val * $data['team_building_flyer']);
		$l_num++;
	}

	if ($data['wholesale_promo_flyer']) {
		$table .= table_format($l_num, 'wholesale_promo_flyer_name', 'Wholesale Promo Flyer', 'wholesale_promo_flyer', $data['wholesale_promo_flyer'], 'wholesale_promo_flyer_val', wholesale_promo_flyer_constant_val, 'wholesale_promo_flyer_val_total', wholesale_promo_flyer_constant_val * $data['wholesale_promo_flyer']);
		$l_num++;
	}

	if ($data['postcard_design']) {
		$table .= table_format($l_num, 'postcard_design_name', 'Design Fee', 'postcard_design', $data['postcard_design'], 'postcard_design_val', postcard_design_constant_val, 'postcard_design_val_total', postcard_design_constant_val * $data['postcard_design']);
		$l_num++;
	}

	if ($data['postcard_edit']) {
		$table .= table_format($l_num, 'postcard_edit_name', 'Custom Changes', 'postcard_edit', $data['postcard_edit'], 'postcard_edit_val', postcard_edit_constant_val, 'postcard_edit_val_total', postcard_edit_constant_val * $data['postcard_edit']);
		$l_num++;
	}

	if ($data['ecard_unit']) {
		$table .= table_format($l_num, 'ecard_unit_name', 'Small Edit', 'ecard_unit', $data['ecard_unit'], 'ecard_unit_val', ecard_unit_constant_val, 'ecard_unit_val_total', ecard_unit_constant_val * $data['ecard_unit']);
		$l_num++;
	}

	if ($data['speciality_postcard']) {
		$table .= table_format($l_num, 'speciality_postcard_name', 'Specialty Postcard', 'speciality_postcard', $data['speciality_postcard'], 'speciality_postcard_val', speciality_postcard_constant_val, 'speciality_postcard_val_total', speciality_postcard_constant_val * $data['speciality_postcard']);
		$l_num++;
	}

	if ($data['card_with_gift']) {
		$table .= table_format($l_num, 'card_with_gift_name', 'Greeting Card with gift', 'card_with_gift', $data['card_with_gift'], 'card_with_gift_val', card_with_gift_constant_val, 'card_with_gift_val_total', card_with_gift_constant_val * $data['card_with_gift']);
		$l_num++;
	}

	if ($data['greeting_card']) {
		$table .= table_format($l_num, 'greeting_card_name', 'Greeting Card', 'greeting_card', $data['greeting_card'], 'greeting_card_val', greeting_card_constant_val, 'greeting_card_val_total', greeting_card_constant_val * $data['greeting_card']);
		$l_num++;
	}

	if ($data['birthday_brownie']) {
		$table .= table_format($l_num, 'birthday_brownie_name', 'Greeting Post Card', 'birthday_brownie', $data['birthday_brownie'], 'birthday_brownie_val', birthday_brownie_constant_val, 'birthday_brownie_val_total', birthday_brownie_constant_val * $data['birthday_brownie']);
		$l_num++;
	}

	if ($data['birthday_starbucks']) {
		$table .= table_format($l_num, 'birthday_starbucks_name', 'Birthday Cards and Starbucks', 'birthday_starbucks', $data['birthday_starbucks'], 'birthday_starbucks_val', birthday_starbucks_constant_val, 'birthday_starbucks_val_total', birthday_starbucks_constant_val * $data['birthday_starbucks']);
		$l_num++;
	}

	if ($data['anniversary_starbucks']) {
		$table .= table_format($l_num, 'anniversary_starbucks_name', 'Anniversary Card and Starbucks', 'anniversary_starbucks', $data['anniversary_starbucks'], 'anniversary_starbucks_val', anniversary_starbucks_constant_val, 'anniversary_starbucks_val_total', anniversary_starbucks_constant_val * $data['anniversary_starbucks']);
		$l_num++;
	}

	if ($data['referral_credit']) {
		$table .= table_format($l_num, 'referral_credit_name', 'Referral Credit', 'referral_credit', $data['referral_credit'], 'referral_credit_val', referral_credit_constant_val, 'referral_credit_val_total', referral_credit_constant_val * $data['referral_credit']);
		$l_num++;
	}

	if (!empty($data['special_credit']) || !empty($data['package_note'])) {
		$table .= table_format($l_num, 'special_credit_name', $data['package_note'], 'special_credit', special_credit_constant_val, 'special_credit_val', $data['special_credit'], 'special_credit_val_total', special_credit_constant_val * $data['special_credit']);
		$l_num++;
	}

	if ($data['cc_billing']) {
		$table .= table_format($l_num, 'cc_billing_name', 'Consultant Communication- billing', 'cc_billing', $data['cc_billing'], 'cc_billing_val', UACC_BILLING, 'cc_billing_val_total', UACC_BILLING * $data['cc_billing']);
		$l_num++;
	}

	if ($data['customer_newsletter']) {
		$table .= table_format($l_num, 'customer_newsletter_name', 'Customer Newsletter', 'customer_newsletter', $data['customer_newsletter'], 'customer_newsletter_val', customer_newsletter_constant_val, 'customer_newsletter_val_total', customer_newsletter_constant_val * $data['customer_newsletter']);
		$l_num++;
	}

	if ($data['picture_texting']) {
		$table .= table_format($l_num, 'picture_texting_name', 'Picture Texting', 'picture_texting', $data['picture_texting'], 'picture_texting_val', picture_texting_constant_val, 'picture_texting_val_total', picture_texting_constant_val * $data['picture_texting']);
		$l_num++;
	}

	if ($data['keyword']) {
		$table .= table_format($l_num, 'keyword_name', 'Keywords for texting system', 'keyword', $data['keyword'], 'keyword_val', keyword_constant_val, 'keyword_val_total', keyword_constant_val * $data['keyword']);
		$l_num++;
	}
	if ($data['client_setup']) {
		$table .= table_format($l_num, 'client_setup_name', 'New Client Set up Fee', 'client_setup', $data['client_setup'], 'client_setup_val', client_setup_constant_val, 'client_setup_val_total', client_setup_constant_val * $data['client_setup']);
		$l_num++;
	}

	if ($data['nl_flyer']) {
		$table .= table_format($l_num, 'nl_flyer_name', 'Graphic Insert', 'nl_flyer', $data['nl_flyer'], 'nl_flyer_val', nl_flyer_constant_val, 'nl_flyer_val_total', nl_flyer_constant_val * $data['nl_flyer']);
		$l_num++;
	}

	if ($data['misc_charge']) {
		$table .= table_format($l_num, 'misc_charge_name', $data['misc_description'], '','', 'misc_charge', $data['misc_charge'], 'misc_charge_val_total', $data['misc_charge']);
		$l_num++;
	}

	if ($CCcharge != '') {
		$table .= table_format($l_num, 'cc_charge_name', 'Charges on credit card payment @ 5%', '','', 'cc_charge_val', $CCcharge, 'cc_charge_val_total', $CCcharge);
		$l_num++;
	}
	if ((float)$Credit < 0) {
		$table .= table_format($l_num, 'credit_roll_over_name', 'Account credit roll over', '', '', 'credit_roll_over_val', $Credit, 'credit_roll_over_total', $Credit);
		$l_num++;
	}
	if (!empty($data['invoice_note'])) {
		$table .= table_format($l_num, 'invoice_note_name', $data['invoice_note'], 'invoice_note', '0', 'invoice_note_val', '0', 'invoice_note_val_total', '0');
		$l_num++;
	}

	echo '<input type="hidden" name="count_var" id="count_var" value="'.$l_num.'">';
	$table .='</tbody> </table> </div>';

    return $table;
}

function pdf_format($l_num, $name, $quantity, $value, $total){
	
	if ($name == 'special_credit_name') {
		$name = ($name != '') ? $name : 'Special Credit';
	}elseif ($name == 'invoice_note_name') {
		$name = ($name != '') ? $name : 'Invoice Note';
	}

	$line = array(
		"#" => $l_num,
		"Name" => $name,
		"Quantity" => $quantity,
		"Value($)" => $value,
		"Total($)" => $total,
	);
	return $line;
}


function table_format($l_num, $first_name, $first_val, $second_name, $second_val, $third_name, $third_val, $fourth_name, $fourth_val){
	
	$html = '<tr>
	     <td> '.$l_num.' </td>';
	     if ($first_name == 'special_credit_name' || $first_name == 'invoice_note_name') {
	     	$html .= '<td><textarea name="'.$first_name.'">'.$first_val.'</textarea></td>';
	     }else{
	     	$html .='<td><input type="text" name="'.$first_name.'" value="'.$first_val.'" /> </td>';	
	     }
	     
	     $html .= '<td><input type="text" name="'.$second_name.'" value="'.$second_val.'" /></td>
	     <td><input type="text" name="'.$third_name.'" value="'.number_format($third_val, 2).'" /></td>
	     <td><input type="text" name="'.$fourth_name.'" value="'.number_format($fourth_val, 2).'" /> </td>
     </tr>';

     return $html;
}

?>