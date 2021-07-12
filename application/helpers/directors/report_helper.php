<?php 

function sheetFormat($objPHPExcel, $row, $date, $name, $item, $qty, $price, $amount){
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Invoice');
 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row, $date);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$row, $name); 
 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row, $item); 
 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row, $qty); 
 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row, number_format((float)$price, 2)); 
 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row, number_format((float)$amount, 2));
}


function detailed_item_report($row, $objPHPExcel, $val){
	$data = unserialize($val['data']);

  $sPackageName = isset($data['package']) ? GetPackageName($data['package']) : '';
  $package_value = isset($data['package_value']) ? $data['package_value'] : '';
  $unit_size = isset($data['unit_size']) ? $data['unit_size'] : '';

  if (isset($data['emailing'])) {
  	$sNewsletter = (($data['emailing'] == 1) ? emailing_0 : (($data['emailing'] == 2) ?  emailing_1 : ''));
  }else{
  	$sNewsletter = '';
  }
 	
 	$sEmailNewsletter = (isset($data['email_newsletter']) && $data['email_newsletter'] == 1) ? email_newsletter : '';
  $sTotalTextProgram = isset($data['total_text_program']) ? Get_total_text_program($data['package'], $data['total_text_program']) : '';
	$credit_notes = isset($data['package_note']) ? $data['package_note'] :'Special Credit';        
  
  //Other language newsletter
  $sOtherLanguageNewsletter = (isset($data['other_language_newsletter']) && $data['other_language_newsletter'] == 1) ? other_language_newsletter : '';
  $sPersonalUnitApp = (isset($data['personal_unit_app']) && $data['personal_unit_app'] == 1) ? personal_unit_app_val : '';
  $sPersonalWebsite = (isset($data['personal_website']) && $data['personal_website'] == 1) ? personal_website_val : '';
  $sPersonalUrl = (isset($data['personal_url']) && $data['personal_url'] == 1) ? personal_url_val : '';
  $sSubscriptionUpdates = (isset($data['subscription_updates']) && $data['subscription_updates'] == 1) ? subscription_updates_val : '';
  $sAppColor = (isset($data['app_color']) && $data['app_color'] == 1) ? app_color_val : '';
	
 	//EXCEL START
 	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, $val['name']);
 	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':G'.$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('566573');
 	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':G'.$row)->getFont()->setBold(true);

 	$row++;
 	sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], $sPackageName.'('.$unit_size.')', '1', $package_value, $package_value);

 	$total = $package_value;
 	if(isset($data['facebook']) && $data['facebook'] == '1') {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Facebooking Newsletter', '1', facebook, facebook);
   	$total+= facebook;
 	}

 	if(!empty($sNewsletter)) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Newsletters', '1', $sNewsletter, $sNewsletter);
   	  $total+= $sNewsletter;
 	}
 	if($sEmailNewsletter) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Email Newsletter', '1', $sEmailNewsletter, $sEmailNewsletter);
   	$total+= $sEmailNewsletter;
 	}
 	if($sTotalTextProgram) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Total text package', '1', $sTotalTextProgram, $sTotalTextProgram);
   	$total+= $sTotalTextProgram;
 	}
 	
 	
 	if($sOtherLanguageNewsletter) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Other language newsletter', '1', other_language_newsletter, other_language_newsletter);
    	$total+= other_language_newsletter;
 	}
 	if($sPersonalUnitApp) {
 		if($data['package'] != 'N'){
      	$row++;
      	sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Personal Unit App', '1', personal_unit_app_val, personal_unit_app_val);
	   	$total+= personal_unit_app_val;
   }else {
   		$row++;
   		sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Personal Unit App', '1', pack_personal_unit_app_val, pack_personal_unit_app_val);
	   	$total+= pack_personal_unit_app_val;
   }
 	}
 	if($sPersonalWebsite) {
 		if($data['package'] != 'N'){
      	$row++;
      	sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Personal Website', '1', personal_website_val, personal_website_val);
	   	$total+= personal_website_val;
   }else {
   		$row++;
   		sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Personal Website', '1', pack_personal_website_val, pack_personal_website_val);
	   	$total+= pack_personal_website_val;
   }
 	}
 	if($sPersonalUrl) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Personal URL', '1',personal_url_val,personal_url_val);
   	$total+= personal_url_val;
 	}
 	if($sSubscriptionUpdates) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], '10 Updates on subscription', '1',subscription_updates_val,subscription_updates_val);
   	$total+= subscription_updates_val;
 	}
 	if($sAppColor) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], '10 App custom color','1',app_color_val,app_color_val);
   	$total+= app_color_val;
 	}
 	
 	if(!empty($data['newsletter_color'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Newsletter-Color', $data['newsletter_color'], ($data['newsletter_color'] * newsletter_color_constant_val), ($data['newsletter_color'] * newsletter_color_constant_val) );
   	$total+= ($data['newsletter_color'] * newsletter_color_constant_val);
 	}

 	if(!empty($data['newsletter_black_white'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Newsletter-Black White', $data['newsletter_black_white'], ($data['newsletter_black_white'] * newsletter_black_white_constant_val), ($data['newsletter_black_white'] * newsletter_black_white_constant_val) );
   	$total+= ($data['newsletter_black_white'] * newsletter_black_white_constant_val);
 	}

 	if(!empty($data['month_packet_postage'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Last Month Packets Postage', $data['month_packet_postage'], ($data['month_packet_postage'] * month_packet_postage_constant_val), ($data['month_packet_postage'] * month_packet_postage_constant_val) );
   	$total+= ($data['month_packet_postage'] * month_packet_postage_constant_val);
 	}

 	if(!empty($data['consultant_packet_postage'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Last Month Packets Postage', $data['consultant_packet_postage'], ($data['consultant_packet_postage'] * consultant_packet_postage_constant_val), ($data['consultant_packet_postage'] * consultant_packet_postage_constant_val) );
   	$total+= ($data['consultant_packet_postage'] * consultant_packet_postage_constant_val);
 	}

 	if(!empty($data['consultant_bundles'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'New Consultant Bundles', $data['consultant_bundles'], ($data['consultant_bundles'] * consultant_bundles_constant_val), ($data['consultant_bundles'] * consultant_bundles_constant_val) );
   	$total+= ($data['consultant_bundles'] * consultant_bundles_constant_val);
 	}

 	if(!empty($data['consistency_gift'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Consistency Gift', $data['consistency_gift'], ($data['consistency_gift'] * consistency_gift_constant_val), ($data['consistency_gift'] * consistency_gift_constant_val) );
   	$total+= ($data['consistency_gift'] * consistency_gift_constant_val);
 	}

 	if(!empty($data['reds_program_gift'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Reds Program Gift', $data['reds_program_gift'], ($data['reds_program_gift'] * reds_program_gift_constant_val), ($data['reds_program_gift'] * reds_program_gift_constant_val) );
   	$total+= ($data['reds_program_gift'] * reds_program_gift_constant_val);
 	}

 	if(!empty($data['stars_program_gift'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Stars Program Gift', $data['stars_program_gift'], ($data['stars_program_gift'] * stars_program_gift_constant_val), ($data['stars_program_gift'] * stars_program_gift_constant_val) );
   	$total+= ($data['stars_program_gift'] * stars_program_gift_constant_val);
 	}

 	if(!empty($data['gift_wrap_postpage'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Gift Wrap and Postage', $data['gift_wrap_postpage'], ($data['gift_wrap_postpage'] * gift_wrap_postpage_constant_val), ($data['gift_wrap_postpage'] * gift_wrap_postpage_constant_val) );
   	$total+= ($data['gift_wrap_postpage'] * gift_wrap_postpage_constant_val);
 	}
 	/*if(!empty($data['one_rate_postpage'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'One Rate Postage', $data['one_rate_postpage'], ((int)$data['one_rate_postpage'] * one_rate_postpage_constant_val), ((int)$data['one_rate_postpage'] * one_rate_postpage_constant_val) );
   	$total+= ((int)$data['one_rate_postpage'] * one_rate_postpage_constant_val);
 	}*/
 	if(!empty($data['month_blast_flyer'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Month End Blast Flyer', $data['month_blast_flyer'], ($data['month_blast_flyer'] * month_blast_flyer_constant_val), ($data['month_blast_flyer'] * month_blast_flyer_constant_val) );
   	$total+= ($data['month_blast_flyer'] * month_blast_flyer_constant_val);
 	}
 	if(!empty($data['flyer_ecard_unit'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Flyer Ecard to Unit', $data['flyer_ecard_unit'], ($data['flyer_ecard_unit'] * flyer_ecard_unit_constant_val), ($data['flyer_ecard_unit'] * flyer_ecard_unit_constant_val) );
   	$total+= ($data['flyer_ecard_unit'] * flyer_ecard_unit_constant_val);
 	}
 	if(!empty($data['unit_challenge_flyer'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Unit Challenge Flyer', $data['unit_challenge_flyer'], ($data['unit_challenge_flyer'] * unit_challenge_flyer_constant_val), ($data['unit_challenge_flyer'] * unit_challenge_flyer_constant_val) );
   	$total+= ($data['unit_challenge_flyer'] * unit_challenge_flyer_constant_val);
 	}
 	if(!empty($data['team_building_flyer'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Team Building Flyer', $data['team_building_flyer'], ($data['team_building_flyer'] * team_building_flyer_constant_val), ($data['team_building_flyer'] * team_building_flyer_constant_val) );
   	$total+= ($data['team_building_flyer'] * team_building_flyer_constant_val);
 	}
 	if(!empty($data['wholesale_promo_flyer'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Wholesale Promo Flyer', $data['wholesale_promo_flyer'], ($data['wholesale_promo_flyer'] * wholesale_promo_flyer_constant_val), ($data['wholesale_promo_flyer'] * wholesale_promo_flyer_constant_val) );
   	$total+= ($data['wholesale_promo_flyer'] * wholesale_promo_flyer_constant_val);
 	}
 	if(!empty($data['postcard_design'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Flyer/Page/ Postcard Design', $data['postcard_design'], ($data['postcard_design'] * postcard_design_constant_val), ($data['postcard_design'] * postcard_design_constant_val) );
   	$total+= ($data['postcard_design'] * postcard_design_constant_val);
 	}
 	if(!empty($data['postcard_edit'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Flyer/Page/ Postcard Edits', $data['postcard_edit'], ($data['postcard_edit'] * postcard_edit_constant_val), ($data['postcard_edit'] * postcard_edit_constant_val) );
   	$total+= ($data['postcard_edit'] * postcard_edit_constant_val);
 	}
 	if(!empty($data['ecard_unit'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Flyer Design/Ecard to unit', $data['ecard_unit'], ($data['ecard_unit'] * ecard_unit_constant_val), ($data['ecard_unit'] * ecard_unit_constant_val) );
   	$total+= ($data['ecard_unit'] * ecard_unit_constant_val);
 	}
 	if(!empty($data['speciality_postcard'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Specialty Postcard', $data['speciality_postcard'], ($data['speciality_postcard'] * speciality_postcard_constant_val), ($data['speciality_postcard'] * speciality_postcard_constant_val) );
   	$total+= ($data['speciality_postcard'] * speciality_postcard_constant_val);
 	}
 	if(!empty($data['card_with_gift'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Card with gift', $data['card_with_gift'], ($data['card_with_gift'] * card_with_gift_constant_val),($data['card_with_gift'] * card_with_gift_constant_val) );
   	$total+= ($data['card_with_gift'] * card_with_gift_constant_val);
 	}
 	if(!empty($data['birthday_brownie'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Birthday Card and Brownie', $data['birthday_brownie'], ($data['birthday_brownie'] * birthday_brownie_constant_val),($data['birthday_brownie'] * birthday_brownie_constant_val) );
   	$total+= ($data['birthday_brownie'] * birthday_brownie_constant_val);
 	}
 	if(!empty($data['birthday_starbucks'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Birthday Cards and Starbucks', $data['birthday_starbucks'], ($data['birthday_starbucks'] * birthday_starbucks_constant_val),($data['birthday_starbucks'] * birthday_starbucks_constant_val) );
   	$total+= ($data['birthday_starbucks'] * birthday_starbucks_constant_val);
 	}
 	if(!empty($data['anniversary_starbucks'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Anniversary Card and Starbucks', $data['anniversary_starbucks'], ($data['anniversary_starbucks'] * anniversary_starbucks_constant_val),($data['anniversary_starbucks'] * anniversary_starbucks_constant_val) );
   	$total+= ($data['anniversary_starbucks'] * anniversary_starbucks_constant_val);
 	}
 	if(!empty($data['referral_credit'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Referral Credit', $data['referral_credit'], '-'.($data['referral_credit'] * referral_credit_constant_val), '-'.($data['referral_credit'] * referral_credit_constant_val) );
   	$total-= ($data['referral_credit'] * referral_credit_constant_val);
 	}
 	if(!empty($data['special_credit'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], $credit_notes, $data['special_credit'], '-'.$data['special_credit'], '-'.$data['special_credit']);
 	$total-= $data['special_credit'];  	
}
if(!empty($data['cc_billing'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Text Blast Customers Billing', $data['cc_billing'], ($data['cc_billing'] * cc_billing_constant_val),($data['cc_billing'] * cc_billing_constant_val) );
   	$total+= ($data['cc_billing'] * cc_billing_constant_val);
 	}
 	if(!empty($data['customer_newsletter'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Customer Newsletter', $data['customer_newsletter'], ($data['customer_newsletter'] * customer_newsletter_constant_val),($data['customer_newsletter'] * customer_newsletter_constant_val) );
   	$total+= ($data['customer_newsletter'] * customer_newsletter_constant_val);
 	}
 
 	if(!empty($data['picture_texting'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Picture Texting', $data['picture_texting'], ($data['picture_texting'] * picture_texting_constant_val),($data['picture_texting'] * picture_texting_constant_val) );
   	$total+= ($data['picture_texting'] * picture_texting_constant_val);
 	}

 	if(!empty($data['keyword'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Keywords for texting system', $data['keyword'], ($data['keyword'] * keyword_constant_val),($data['keyword'] * keyword_constant_val) );
   	$total+= ($data['keyword'] * keyword_constant_val);
 	}
 	if(!empty($data['nl_flyer'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'NL Flyer or Edit', $data['nl_flyer'], ($data['nl_flyer'] * nl_flyer_constant_val),($data['nl_flyer'] * nl_flyer_constant_val) );
   	$total+= ($data['nl_flyer'] * nl_flyer_constant_val);
 	}
 	if(!empty($data['misc_charge'])) {
    $row++;
    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Misc Charges', '1', $data['misc_charge'], $data['misc_charge'] );
   	$total+= $data['misc_charge'];
 	}

  $chargeparsent = ($val['account_detail']=='N') ? ($val['package_pricing'] * 5)/100 : 0;

  if($chargeparsent != 0) {
  	$row++;
  	sheetFormat($objPHPExcel, $row, $val['invoice_date'], $val['name'], 'Charges on credit card payment @ 5%', '1', $chargeparsent, $chargeparsent);
    $total = (float)$total;
   	$total+= number_format($chargeparsent, 2);
	}

   	$row++;
   	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Total '.$val['name']);
   	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row, $val['total']);
   	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':G'.$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('A3B1BD');
   	$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getFont()->setBold(true)->setName('Verdana')->setSize(10)->getColor()->setRGB('000000');
   	$row++;
}

?>