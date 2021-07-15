<?php
class Upload_excel_model extends CI_Model{

	function upload_balance_excel($aRows, $serializedData){
		$data = array('updated_by'=>'admin', 'name'=>$aRows[2], 'updated_at'=>date('Y-m-d H:i:s'));
		$this->db->set($data);
		$this->db->where('name', $aRows[15]);
		return $this->db->update('newsletter_general_info');
	}

	function getTotal($consultant_number){
		$this->db->select('id_invoice, total,due_amount,payment_status,total_paid, id_newsletter, last_paid');
		$this->db->from('invoices');
		$this->db->where('consultant_number', $consultant_number);
		$this->db->order_by('id_invoice', 'DESC');
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}

	function update_invoice($amount, $nFinalTotal, $fTotalpaid, $sPayStatus, $id_invoice){
		$dDate=date('Y-m-d H:i:s');
		$data = array("last_paid"=>$amount, "due_amount"=>number_format($nFinalTotal, 2), "total_paid"=>$fTotalpaid, "updated_at"=>$dDate, "payment_status"=>$sPayStatus, "payment_date"=>$dDate);
		$this->db->set($data);
		$this->db->where('id_invoice', $id_invoice);
		return $this->db->update('invoices');
	}

	function get_invoice_count($id_newsletter){
		$this->db->select("COUNT(id_invoice) as cont");
		$this->db->from('invoices');
		$this->db->where('id_newsletter', $id_newsletter);
		return $this->db->get()->row_array();
	}

	function get_old_invoice($id_newsletter){
		$this->db->select("id_invoice, total, due_amount, payment_status, total_paid, id_newsletter");
		$this->db->from('invoices');
		$this->db->where(array('payment_status !='=>'S', 'id_newsletter'=>$id_newsletter));
		$this->db->order_by('created_at', 'ASC');
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}

	function getPriceDetail($consultant_number){
		$this->db->select('ng.id_newsletter, np.unit_size, np.package, np.facebook, np.emailing, np.email_newsletter, np.digital_biz_card, np.other_language_newsletter, np.magic_booker, np.prospect_system, np.personal_website, np.personal_unit_app, np.personal_unit_app_ca, np.personal_url, np.subscription_updates, np.app_color, np.nsd_client, np.total_text_program, np.total_text_program7, np.newsletter_color, np.newsletter_black_white, np.month_packet_postage, np.consultant_packet_postage, np.consultant_bundles, np.consistency_gift, np.reds_program_gift, np.stars_program_gift, np.gift_wrap_postpage, np.one_rate_postpage, np.month_blast_flyer, np.flyer_ecard_unit, np.unit_challenge_flyer, np.team_building_flyer, np.wholesale_promo_flyer, np.postcard_design, np.postcard_edit, np.ecard_unit, np.speciality_postcard, np.card_with_gift, np.greeting_card, np.birthday_brownie, np.birthday_starbucks, np.anniversary_starbucks, np.referral_credit, np.special_creadit, np.cc_billing, np.customer_newsletter, np.nl_flyer, np.picture_texting, np.keyword, np.client_setup, np.package_value, np.package_pricing, np.misc_charge');
        $this->db->from('newsletter_general_info AS ng');
        $this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
        $this->db->where(array('ng.deleted'=>'0', 'ng.consultant_number'=>$consultant_number));
        $this->db->query('SET SQL_BIG_SELECTS=1');
        return $this->db->get()->row_array();
	}

	function update_newsletters($sPackagePrice, $sPackageSUB, $nNewUnit, $aPackageValue, $id_newsletter){
		$data = array('updated_by'=>'adminFile', "updated_at"=>date('Y-m-d H:i:s'));
		$this->db->set($data);
		$this->db->where('id_newsletter', $id_newsletter);
		$result = $this->db->update('newsletter_general_info');

		if ($result) {
			$data = array('package_pricing'=>$sPackagePrice, "sub_total"=>$sPackageSUB, "unit_size"=>$nNewUnit, "package_value"=>$aPackageValue);
			$this->db->set($data);
			$this->db->where('id_newsletter', $id_newsletter);
			return $this->db->update('newsletter_packaging');
		}
	}


	function get_excel_field($consultant_number, $field){

        if ($field == 'newsletter_color') {
            $this->db->select('np.package_pricing,np.newsletter_color,np.newsletter_black_white');
        }else{
            $this->db->select('np.package_pricing');
        }

        $this->db->from('newsletter_general_info AS ng');
        $this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
        $this->db->where(array('ng.consultant_number'=>$consultant_number, 'ng.deleted'=>'0'));
        $this->db->query('SET SQL_BIG_SELECTS=1');
        return $this->db->get()->row_array();
    }

    function update_excel_field($sub_total, $aRows, $field){
        $this->db->set(array('updated_by'=>'admin', 'updated_at'=>date('Y-m-d H:i:s')));
        $this->db->where(array('consultant_number'=>$aRows[1], 'deleted'=>'0'));
        $result = $this->db->update('newsletter_general_info');

        if ($result) {

        	if ($field == 'beatly_url' || $field == 'beatly_url_one' || $field == 'beatly_url_two') {
        		$id_newsletter = $this->get_id_newsletter($aRows[1]);

        		$this->db->set($field, $aRows[2]);
        		$this->db->where('id_newsletter', $id_newsletter);
            	return $this->db->update('newsletter_design_info');
        	}else{
            	$id_newsletter = $this->get_id_newsletter($aRows[1]);

            	if ($field == 'newsletter_color') {
	                $details = array(
	                			'package_pricing'=>$sub_total, 
	                			'newsletter_color'=>$aRows[2], 
	                			'newsletter_black_white'=>$aRows[3]
	                		);

	            }elseif ($field == 'gift_wrap_postpage') {
	            	$details = array( 'package_pricing'=>$sub_total,  $field=>$aRows[5] );
	            }elseif ($field == 'flyer_ecard_unit') {
	                $details = array(
	                	'package_pricing'=>$sub_total, 
	                	'unit_challenge_flyer'=>$aRows[2], 
	                	'team_building_flyer'=>$aRows[3], 
	                	'wholesale_promo_flyer'=>$aRows[4], 
	                	'nl_flyer'=>$aRows[5], 
	                	'postcard_design'=>$aRows[6], 
	                	'ecard_unit'=>$aRows[7], 
	                	$field=>$aRows[8], 
	                	'postcard_edit'=>$aRows[9]
	                );

	            }elseif ($field == 'special_cr_note') {
	                $details = array('package_note'=>$aRows[2]);
	            }elseif ($field == 'invoice_note') {
	                $details = array('invoice_note'=>$aRows[2]);
	            }else{
	                $details = array( 'package_pricing'=>$sub_total,  $field=>$aRows[2] );
	            }
	            
	            $this->db->set($details);
	        	$this->db->where(array('id_newsletter'=>$id_newsletter));
	        	return $this->db->update('newsletter_packaging');
        	}

        }
    }

    function get_id_newsletter($consultant_number){
    	$this->db->select('id_newsletter');
		$this->db->from('newsletter_general_info');
		$this->db->where(array('deleted'=>'0','consultant_number'=>$consultant_number));
		$data = $this->db->get()->row();
		if (!empty($data)) {
			return $data->id_newsletter;
		}
    }


}