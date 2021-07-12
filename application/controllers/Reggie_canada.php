<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reggie_canada extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('reggie_canada_model');
		$this->load->helper('directors/director_helper');
		$this->load->helper('reggie_helper');
	}


	function reggie_canada() {
		if($this->input->post()) {

			$data = $this->input->post();

			if ($data['add_to']=='1') { 
				$data['id_newsletter'] = '';
                $data['pmt_type'] = 'CC';
                $id_cc_newsletter = $this->reggie_canada_model->add_to_uacc($data);
                $id_newsletter = 0;
                $nUserType = 1;
            }elseif ($data['add_to']=='2') {
            	$id_newsletter = $this->reggie_canada_model->add_to_ua($data);
                $id_cc_newsletter = 0;
                $nUserType = 0;
            }elseif ($data['add_to']=='3') {
                $data['id_newsletter'] = '';
                $data['pmt_type'] = 'CC';
                $id_cc_newsletter = $this->reggie_canada_model->add_to_uacc($data);
                unset($data['pmt_type']);
                $id_newsletter = $this->reggie_canada_model->add_to_ua($data);
                $nUserType = 2;
            }

            payload_ua_api($data['consultant_number'], $data['intouch_password'], false, true, $nUserType);

			if ($id_newsletter > 0 || $id_cc_newsletter > 0) {
				if (isset($id_newsletter) && $id_newsletter > 0) {
					$mail_data = $this->reggie_canada_model->get_ua_mail_data($id_newsletter);
                    $mail_data['cc_number']=$data['cc_number'];
                    $mail_data['cc_code']=$data['cc_code'];
                    $mail_data['cc_expir_date']=$data['cc_expir_date'];
                    $mail_data['cc_zip']=$data['cc_zip'];
				}else{
                    $mail_data = $this->reggie_canada_model->get_uacc_mail_data($id_cc_newsletter);
                    $mail_data['closing_ecards']=$data['closing_ecards'];
                    $mail_data['digital_business_card']='';
                }

				$nsd_data = array($data['nsd_name'],$data['nsd_address'],$data['nsd_city'],$data['nsd_state'],$data['nsd_zip']);

				$first_name = $this->input->post('first_name');

				$mail_data['add_to'] = $data['add_to'];

				$send_mail = $this->send_mail($mail_data, $nsd_data, $first_name);

				if ($send_mail) {

					if (isset($id_cc_newsletter)) {
						$addToEmail = $this->reggie_canada_model->add_to_email_records($id_newsletter, $id_cc_newsletter);
					}else{
						$addToEmail = $this->reggie_canada_model->add_to_email_records($id_newsletter);
					}

					if ($addToEmail > 0) { 
                        $getPara =$this->input->get('language');
                        if (isset($getPara) && !empty($getPara)) {
                            redirect('reggie-canada?language='.$getPara.'?success');
                        }else{
                            redirect('reggie-canada?success');
                        }
					}

				}
			}

		}else {
			$this->global['pageTitle'] = 'Unit Assistant Service';
			loadViews('reggie_canada', $this->global, NULL, NULL);
		}
	}

	function send_mail($data, $nsd_data, $first_name){
		$lg = ($data['add_to']=='1') ? $data['cc_newsletter'] : $data['newsletters_design'];

        /*$dateElements = explode('/', $data['month_mailing']);*/
        /*$sStartYear = empty($dateElements[1]) ? '' : $dateElements[1];*/
        
        $sHiddenNewsletterPrice = ($data['add_to'] !='1') ? Get_hidden_newsletter($data['hidden_newsletter']) : 0;
        $sEmailNl = isset($data['distribution_one']) ? $data['distribution_one'] : '';
        $sStatusOne = isset($data['status_one']) ? $data['status_one'] : '';
        $sStatusTwo = isset($data['status_two']) ? $data['status_two'] : '';
        $sStatusFive = isset($data['status_five']) ? $data['status_five'] : '';
        $sStatusSix = isset($data['status_six']) ? $data['status_six'] : '';
        $sStatusEight = isset($data['status_eight']) ? $data['status_eight'] : '';
        $sConsultantTwo = isset($data['consultant_two']) ? $data['consultant_two'] : '';
        $sTotalCharges = $data['package_pricing'] + $sHiddenNewsletterPrice;
        $sTotalCharge = empty($sTotalCharges) ? 'N/C' : '$' . $sTotalCharges;

		$message = '<html><body>';
        $message .= '<p style="font-size:16px;">'.hello[$lg].' '.$first_name . ',</p>';
        $subject = mail_subject[$lg];   


        if ($data['add_to']=='1'){
        	$client_msg = $this->reggie_canada_model->get_UACC_client_messages();
        }elseif ($data['add_to']=='2'){
        	$client_msg = $this->reggie_canada_model->get_client_messages();
        }else{
            $client_msg = $this->reggie_canada_model->get_client_messages();
        }

        if ($lg=='E') {
        	if($data['add_to']=='1'){
                $message .=  html_entity_decode($client_msg['welcome_english']);
            }elseif($data['add_to']=='2'){
            	$message .=  html_entity_decode($client_msg['welcome_canada_english']);
            }else{   
                $message .=  html_entity_decode($client_msg['welcome_both_english']);
            }   
        }elseif ($lg=='F') {
        	if($data['add_to']=='1'){
                $message .=  html_entity_decode($client_msg['welcome_french']);
            }elseif($data['add_to']=='2'){
            	$message .=  html_entity_decode($client_msg['welcome_french']);
            }else{   
                $message .=  html_entity_decode($client_msg['welcome_both_french']);
            }   
        }else{
        	if($data['add_to']=='1'){
                $message .=  html_entity_decode($client_msg['welcome_english']);
            }elseif($data['add_to']=='2'){
            	$message .=  html_entity_decode($client_msg['welcome_canada_english']);
            }else{   
                $message .=  html_entity_decode($client_msg['welcome_both_english']);
            }
        }

        $bcc='tamid@unitassistant.com, cherylt@unitassistant.com, office@textblastcustomers.com, shannons@unitassistant.com';

        if ($data['add_to'] == '1') {
            $message .= mail_format(lang_label('directory_title', $lg), $data['cc_director_title']);
        }else{
            $message .= mail_format(lang_label('directory_title', $lg), $data['director_title']);
        }

		
		$message .= mail_format(lang_label('name', $lg), $data['name']);
		$message .= mail_format(lang_label('phone_number', $lg), $data['cell_number']);
        
        if (!empty($data['alt_phone']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('alt_phone', $lg), $data['alt_phone']);
        }

		$message .= mail_format(lang_label('closing_emails', $lg), $data['closing_ecards']);
		$message .= mail_format(lang_label('birthday', $lg), $data['dob']);

        if (!empty($data['unit_web_site']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('unit_web_site', $lg), $data['unit_web_site']);
        }

        if (!empty($data['unit_color']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('unit_colors_theme', $lg), $data['unit_color']);
        }

		$message .= mail_format(lang_label('consultant_id', $lg), $data['consultant_number']);

        if (!empty($data['p_name']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('name_label', $lg), $data['p_name']);
        }
        
        if (!empty($data['p_address']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('address_label', $lg), $data['p_address']);
        }

        if (!empty($data['p_city']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('city_label', $lg), $data['p_city']);
        }

        if (!empty($data['p_state']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('state_label', $lg), $data['p_state']);
        }

        if (!empty($data['p_zip']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('zip_label', $lg), $data['p_zip']);
        }

        if (!empty($data['p_phone']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('phone_number_label', $lg), $data['p_phone']);
        }

        if (!empty($data['p_email']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('email_label', $lg), $data['p_email']);
        }

        if (!empty($data['p_web']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('website_shopping_site', $lg), $data['p_web']);
        }

        $message .= mail_format(lang_label('in_touch_password', $lg), $data['intouch_password']);

        if (!empty($data['unit_number']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('unit_number', $lg), $data['unit_number']);
        }

        if (!empty($data['unit_name']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('unit_name', $lg), $data['unit_name']);
        }

        if (!empty($data['unit_goals']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('unit_goals', $lg), $data['unit_goal']);
        }

        if (!empty($nsd_data['nsd_name']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('nsd_name', $lg), $nsd_data['nsd_name']);
        }

        if (!empty($nsd_data['nsd_address']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('nsd_address', $lg), $nsd_data['nsd_address']);
        }

        if (!empty($nsd_data['nsd_city']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('nsd_city', $lg), $nsd_data['nsd_city']);
        }

        if (!empty($nsd_data['nsd_state']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('nsd_state', $lg), $nsd_data['nsd_state']);
        }

        if (!empty($nsd_data['nsd_zip']) && $data['add_to']!='1' ) {
            $message .= mail_format(lang_label('nsd_zip', $lg), $nsd_data['nsd_zip']);
        }

        $message .= mail_format(lang_label('reffered_by', $lg), $data['reffered_by']);
        $message .= mail_format(lang_label('national_area', $lg), $data['national_area']);

        if ($lg !='F') {
            $message .= mail_format(lang_label('seminar_affiliation', $lg), $data['seminar_affiliation']);
        }

        if ($data['add_to']!='1') {
            $message .= mail_format(lang_label('unit_size', $lg), $data['unit_size']);
        }

        if ($data['add_to'] =='1' || $data['add_to'] =='3') {
	        $message .= mail_format(lang_label('card_number', $lg), $data['cc_number']);
	        $message .= mail_format(lang_label('security_code', $lg), $data['cc_code']);
	        $message .= mail_format(lang_label('expiration_date', $lg), $data['cc_expir_date']);
	        $message .= mail_format(lang_label('postal_code', $lg), $data['cc_zip']);
        }


        if ($data['add_to'] != '1') {
            $sHiddenNewletter = GetDesignName($data['hidden_newsletter']);
            $sPackageName = GetPackageName($data['package']);
            $message .= mail_format(lang_label('start_year', $lg), '');
            $message .= mail_format(lang_label('package_billing', $lg), $sPackageName);
            $message .= mail_format(lang_label('newsletter_design', $lg), $sHiddenNewletter);
        }

        if (!empty($sEmailNl)) {
            $message .= mail_format(lang_label('digital_business_card', $lg), $sEmailNl);
        }

        if ($data['add_to'] != '1') {
            $message .= mail_format(lang_label('a3_post_card', $lg), $sStatusOne);
            $message .= mail_format(lang_label('i1_post_card', $lg), $sStatusTwo);
            $message .= mail_format(lang_label('t1_post_card', $lg), $sStatusFive);
            $message .= mail_format(lang_label('thank_you_post_card', $lg), $sStatusSix);
            $message .= mail_format(lang_label('star_on_target_post_card', $lg), $sStatusEight);
            $message .= mail_format(lang_label('new_consultant_post_cards', $lg), $sConsultantTwo);
            $message .= mail_format(lang_label('total_point', $lg), $data['point_value']);
            $message .= mail_format(lang_label('total_charges', $lg), $sTotalCharge);    
        }else{
            $message .= mail_format(lang_label('total_charges', $lg), 42.98);
        }

		$message .= "</body></html>";

		$this->load->library('email');
		$this->email->set_mailtype("html");
	    $this->email->from('office@unitassistant.com', 'Unit Assistant Team');
	    $this->email->to($data['email']);
	    $this->email->bcc($bcc);
	    $this->email->subject($subject);
	    $this->email->message($message);
	    return $this->email->send();
	}

}