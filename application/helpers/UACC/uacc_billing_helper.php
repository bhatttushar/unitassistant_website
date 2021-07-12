<?php 

if (!function_exists('get_instance')) {
	function get_instance() {
		$CI = &get_instance();
	}
}


function set_UACC_balance($id_cc_newsletter, $balance) {
	$CI = get_instance();
	$sDate = date("Y-m-d H:i:s");

	//NEEDED
	$sFound = $CI->db->get_where('cc_invoice_balance',array('id_cc_newsletter'=>$id_cc_newsletter))->num_rows();
	if ($sFound > 0) {
		$data = array('balance'=>abs($balance), 'update_at'=>$sDate);
		$CI->db->set($data);
		$CI->db->where('id_cc_newsletter', $id_cc_newsletter);
		$Qobject = $CI->db->update('cc_invoice_balance');
		return 1;
		exit();
	} else {
		$data = array('id_cc_newsletter'=>$id_cc_newsletter, 'balance'=>abs($balance));
		$Qobject = $CI->db->insert('cc_invoice_balance', $data);
		return 1;
		exit();
	}
}

function CountInvoice($id){
	$CI = get_instance();
	$result = $CI->db->get_where('cc_invoices',array('id_cc_newsletter'=>$id,'deleted'=>'0'))->num_rows();
	if($result <= 0) {
		return "disabled";
	}else {
		return "";
	}
}

function GetInvoiceMailContent($id_cc_newsletter,$id_cc_invoice){
	$CI = get_instance();
	$CI->db->select('content');
	$CI->db->from('cc_invoice_mail');
	$CI->db->where(array('id_cc_newsletter'=>$id_cc_newsletter,'id_cc_invoice'=>$id_cc_invoice));
	$CI->db->limit(1);
	$CI->db->order_by('id_mail', 'desc');
	$mail_content = $CI->db->get()->row_array();

	if (!empty($mail_content)) {
    	return $mail_content['content'];
	}else {
		return '';
	}
}

function get_excel_field_price($hidden_point, $package_pricing, $aRows, $field){
	$aUnserialzed = unserialize($hidden_point);

	if ($field=='newsletter_color') {
		$nNewNewsletterColor = $aRows[3] * (newsletter_color_constant_val);
	    $nNewNewsletterBlack = $aRows[4] * (newsletter_black_white_constant_val);
	    $Old_newsColor = $aPriceDetail['newsletter_color'] * newsletter_color_constant_val;
	    $Old_newsBAW = $aPriceDetail['newsletter_black_white'] * newsletter_black_white_constant_val;
	    $sTotalCharge = $package_pricing +($nNewNewsletterColor-$Old_newsColor)+($nNewNewsletterBlack-$Old_newsBAW); 
	    $aUnserialzed[0] = $nNewNewsletterColor;
	    $aUnserialzed[1] = $nNewNewsletterBlack;

	}elseif ($field='month_packet_postage') {

		$month_packet_postage = $aRows[1] * (month_packet_postage_constant_val);
		$sTotalCharge = $package_pricing + $month_packet_postage - $aUnserialzed[2]; 
		$aUnserialzed[2] = $month_packet_postage;

	}elseif ($field=='consultant_packet_postage') {
        $consultant_packet_postage = $aRows[1] * (consultant_packet_postage_constant_val);
        $sTotalCharge = $package_pricing + $consultant_packet_postage - $aUnserialzed[3]; 
        $aUnserialzed[3] = $consultant_packet_postage;

	}elseif ($field == 'consultant_bundles') {
        $consultant_bundles = $aRows[1] * (consultant_bundles_constant_val);
        $sTotalCharge = $package_pricing + $consultant_bundles - $aUnserialzed[4]; 
        $aUnserialzed[4] = $consultant_bundles;

	}elseif ($field == 'consistency_gift') {
        $consistency_gift = $aRows[1] * (consistency_gift_constant_val);
        $sTotalCharge = $package_pricing + $consistency_gift - $aUnserialzed[5]; 
        $aUnserialzed[5] = $consistency_gift;

	}elseif ($field == 'reds_program_gift') {
        $reds_program_gift = $aRows[1] * (reds_program_gift_constant_val);
        $sTotalCharge = $package_pricing + $reds_program_gift - $aUnserialzed[6]; 
        $aUnserialzed[6] = $reds_program_gift;

	}elseif ($field == 'stars_program_gift') {
        $stars_program_gift = $aRows[1] * (stars_program_gift_constant_val);
        $sTotalCharge = $package_pricing + $stars_program_gift - $aUnserialzed[7]; 
        $aUnserialzed[7] = $stars_program_gift;

	}elseif ($field == 'gift_wrap_postpage') {
        $gift_wrap_postpage = $aRows[4] * (gift_wrap_postpage_constant_val);
        $sTotalCharge = $package_pricing + $gift_wrap_postpage - $aUnserialzed[8]; 
        $aUnserialzed[8] = $gift_wrap_postpage;

	}elseif ($field == 'one_rate_postpage') {
        $one_rate_postpage = $aRows[1] * (one_rate_postpage_constant_val);
        $sTotalCharge = $package_pricing + $one_rate_postpage - $aUnserialzed[9]; 
        $aUnserialzed[9] = $one_rate_postpage;

	}elseif ($field == 'month_blast_flyer') {
        $month_blast_flyer = $aRows[2] * (month_blast_flyer_constant_val);
        $sTotalCharge = $package_pricing + $month_blast_flyer - $aUnserialzed[10];
        $aUnserialzed[10] = $month_blast_flyer;

	}elseif ($field == 'flyer_ecard_unit') {
        $nUnitChallengeFlyer = $aRows[2] * (unit_challenge_flyer_constant_val);
        $nTeamBuildingFlyer = $aRows[3] * (team_building_flyer_constant_val);
        $nWholeSalePromoFlyer = $aRows[4] * (wholesale_promo_flyer_constant_val);
        $nNlFlyer = $aRows[5] * (nl_flyer_constant_val);
        $nPostcardDesignFlyer = $aRows[6] * (postcard_design_constant_val);
        $nFlyerDesign = $aRows[7] * (ecard_unit_constant_val);
        $nFlyerEcatdToUnit = $aRows[8] * (flyer_ecard_unit_constant_val);
        $nPostcardEdit = $aRows[9] * (postcard_edit_constant_val);
                 
        $sTotalCharge = $package_pricing + ($nUnitChallengeFlyer - $aUnserialzed[12]) + ($nTeamBuildingFlyer - $aUnserialzed[13]) + ($nWholeSalePromoFlyer - $aUnserialzed[14]) + ($nPostcardDesignFlyer - $aUnserialzed[15]) + ($nFlyerDesign - $aUnserialzed[17]) +($nFlyerEcatdToUnit - $aUnserialzed[11]) + ($nPostcardEdit - $aUnserialzed[16]) + ($nNlFlyer - $aUnserialzed[29]); 

        $aUnserialzed[11] = $nFlyerEcatdToUnit;
        $aUnserialzed[12] = $nUnitChallengeFlyer;
        $aUnserialzed[13] = $nTeamBuildingFlyer;
        $aUnserialzed[14] = $nWholeSalePromoFlyer;
        $aUnserialzed[15] = $nPostcardDesignFlyer;
        $aUnserialzed[16] = $nPostcardEdit;
        $aUnserialzed[17] = $nFlyerDesign;
        $aUnserialzed[29] = $nNlFlyer;

	}elseif ($field == 'speciality_postcard') {
        $speciality_postcard = $aRows[1] * (speciality_postcard_constant_val);
        $sTotalCharge = $package_pricing + $speciality_postcard - $aUnserialzed[18]; 
        $aUnserialzed[18] = $speciality_postcard;

	}elseif ($field=='greeting_card') {
        $aUnserialzed[32] = (!empty($aUnserialzed[32]) ? $aUnserialzed[32] : 0);
        $greeting_card = $aRows[1] * (greeting_card_constant_val);
        $sTotalCharge = $package_pricing + $greeting_card - $aUnserialzed[32]; 
        $aUnserialzed[32] = $greeting_card;

	}elseif ($field == 'card_with_gift') {
        $card_with_gift = $aRows[1] * (card_with_gift_constant_val);
        $sTotalCharge = $package_pricing + $card_with_gift - $aUnserialzed[19]; 
        $aUnserialzed[19] = $card_with_gift;

	}elseif ($field == 'birthday_brownie') {
        $birthday_brownie = $aRows[1] * (birthday_brownie_constant_val);
        $sTotalCharge = $package_pricing + $birthday_brownie - $aUnserialzed[20]; 
        $aUnserialzed[20] = $birthday_brownie;

	}elseif ($field == 'birthday_starbucks') {
        $birthday_starbucks = $aRows[1] * (birthday_starbucks_constant_val);
        $sTotalCharge = $package_pricing + $birthday_starbucks - $aUnserialzed[21]; 
        $aUnserialzed[21] = $birthday_starbucks;

	}elseif ($field == 'anniversary_starbucks') {
        $sTotalCharge = $package_pricing + $aRows[1] - $aUnserialzed[22]; 
        $aUnserialzed[22] = $aRows[1];

    }elseif ($field == 'referral_credit') {
        $nNewReferral = $aRows[1] * (referral_credit_constant_val);
        $nOldReferral = $aUnserialzed[23];
        $sTotalCharge = ($package_pricing + $nOldReferral) - $nNewReferral; 
        $aUnserialzed[23] = $nNewReferral;

    }elseif ($field == 'special_credit') {
        $sTotalCharge = $package_pricing; 
        $aUnserialzed[24] = $aRows[1];

    }elseif ($field == 'cc_billing') {
        $cc_billing = $aRows[1] * (cc_billing_constant_val);
        $sTotalCharge = $package_pricing + $cc_billing - $aUnserialzed[25]; 
        $aUnserialzed[25] = $cc_billing;
        
    }elseif ($field == 'customer_newsletter') {
        $customer_newsletter = $aRows[1] * (customer_newsletter_constant_val);
        $sTotalCharge = $package_pricing + $customer_newsletter - $aUnserialzed[26]; 
        $aUnserialzed[26] = $customer_newsletter;

    }elseif ($field == 'picture_texting') {
        $picture_texting = $aRows[1] * (picture_texting_constant_val);
        $sTotalCharge = $package_pricing + $picture_texting - $aUnserialzed[30]; 
        $aUnserialzed[30] = $picture_texting;

    }elseif ($field == 'keyword') {
        $keyword = $aRows[1] * (keyword_constant_val);
        $sTotalCharge = $package_pricing + $keyword - $aUnserialzed[31]; 
        $aUnserialzed[31] = $keyword;

    }elseif ($field == 'client_setup') {
        $client_setup = $aRows[1] * (client_setup_constant_val);
        $sTotalCharge = $package_pricing + $client_setup - $aUnserialzed[32]; 
        $aUnserialzed[32] = $client_setup;
        
    }

	return array(serialize($aUnserialzed), $sTotalCharge);
}


function GetUACCInvoiceTable($data){

	$table = '';
    $BzBill = DIGITAL_BIZ_CARD;
	$TBill = ($data['digital_biz_card'] =='1' && $data['inc_tbc'] != '1') ? 0 : UACC_BILLING;

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
					$total = 0;
					
					$total = $TBill;
					$table .= table_format($l_num, 'customer_comm_name', "Customer Communication", 'customer_communication', '1', 
						'customer_comm_val', $TBill, 'customer_comm_val_total', $TBill);
					$l_num++;

					if ($data['prospect_system'] == '1') {
						$total = number_format($total + PROSPECT_SYSTEM, 2);        
						$table .= table_format($l_num, 'prospect_system_name', 'Prospect System', 'prospect_system', '1', 'prospect_system_val', PROSPECT_SYSTEM, 'prospect_system_val_total', PROSPECT_SYSTEM);
						$l_num++;
					}

					if ($data['cv_prospect'] == 1) {
						$total = number_format($total + CV_PROSPESCT_VAL, 2);
						$table .= table_format($l_num, 'cv_prospect_name', 'Carona Virus Special - discounted by 29.99', 'cv_prospect', '1', 'cv_prospect_val', CV_PROSPESCT_VAL, 'cv_prospect_val_total', CV_PROSPESCT_VAL);
						$l_num++;
					}

					if ($data['misc_charge'] != 0) {
						$total = number_format($total + $data['misc_charge'], 2);
						$table .= table_format($l_num, 'misc_charge_name', 'Misc. Charges', 'misc_charge', '1', 'misc_charge_val', $data['misc_charge'], 'misc_charge_val_total', $data['misc_charge']);
						$l_num++;
					}

					if ($data['digital_biz_card'] == 1) {
						$total = number_format($total + $BzBill, 2);
						$table .= table_format($l_num, 'digital_biz_card_name', 'Digital Biz Card', 'digital_biz_card', '1', 'digital_biz_card_val', $BzBill, 'digital_biz_card_val_total', $BzBill);
						$l_num++;
					}

					if ($data['special_credit'] != 0) {
						$table .= table_format($l_num, 'special_credit_name', 'Special Credit', 'special_credit', '1', 'special_credit_val', $data['special_credit'], 'special_credit_val_total', $data['special_credit']);
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

function add_page_pdf(){

	if ($l_num == 19) {
		$y = 8;
		$pdf->AddPage();
	}
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
	     <td><input type="text" name="'.$third_name.'" value="'.number_format((float)$third_val, 2).'" /></td>
	     <td><input type="text" name="'.$fourth_name.'" value="'.number_format((float)$fourth_val, 2).'" /> </td>
     </tr>';

     return $html;
}

?>