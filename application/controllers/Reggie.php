<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reggie extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('reggie_model');
		$this->load->helper('directors/director_helper');
		$this->load->helper('reggie_helper');
	}


	function reggie() {
		if($this->input->post()) {
			$consultant_number = $this->input->post('consultant_number');
			$intouch_password = $this->input->post('intouch_password');
			
			$id_newsletter = $this->reggie_model->add_to_ua($this->input->post());

			if ($id_newsletter) {

				payload_ua_api($consultant_number, $intouch_password, true, false, 0);

				$id_cc_newsletter = $this->reggie_model->add_to_uacc($this->input->post(), $id_newsletter);

				if ($id_cc_newsletter) {
					$mail_data = $this->reggie_model->get_mail_data($id_newsletter);
					$nsd_data = array(
						$this->input->post('nsd_name'), 
						$this->input->post('nsd_address'), 
						$this->input->post('nsd_city'), 
						$this->input->post('nsd_state'), 
						$this->input->post('nsd_zip')
					);

					$first_name = $this->input->post('first_name');
					$send_mail = $this->send_mail($mail_data, $nsd_data, $first_name);
					if ($send_mail) {
						$addToEmail = $this->reggie_model->add_to_email_records($id_newsletter, $id_cc_newsletter);
						if ($addToEmail > 0) {
							$getPara =$this->input->get('language');
							if (isset($getPara) && !empty($getPara)) {
		                        redirect('reggie?language='.$getPara.'?success');
		                    }else{
		                        redirect('reggie?success');
		                    }
						}
					}
				}
			}
		}else {
			$this->global['pageTitle'] = 'Unit Assistant Service';
			loadViews('reggie', $this->global, NULL, NULL);
		}
	}

	function send_mail($data, $nsd_data, $first_name){
		$lg = $data['newsletters_design'];

        /*$dateElements = explode('/', $data['month_mailing']);*/
        /*$sStartYear = empty($dateElements[1]) ? '' : $dateElements[1];*/
        $sPackageName = GetPackageName($data['package']);
        $sHiddenNewsletterPrice = Get_hidden_newsletter($data['hidden_newsletter']);
        $sHiddenNewletter = GetDesignName($data['hidden_newsletter']);

        $sEmailNl = isset($data['distribution_one']) ? $data['distribution_one'] : '';
        $sPcBirthday = isset($data['birthday_one']) ? $data['birthday_one'] : '';
        $sStatusOne = isset($data['status_one']) ? $data['status_one'] : '';
        $sStatusTwo = isset($data['status_two']) ? $data['status_two'] : '';
        $sStatusFive = isset($data['status_five']) ? $data['status_five'] : '';
        $sStatusSix = isset($data['status_six']) ? $data['status_six'] : '';
        $sStatusEight = isset($data['status_eight']) ? $data['status_eight'] : '';

        $sLastTwo = ($data['last_one'] == 1) ? '1 Point' : 'Unsubscribed';
        $sConsultantTwo = isset($data['consultant_two']) ? $data['consultant_two'] : '';

        $sTotalCharges = $data['package_pricing'] + $sHiddenNewsletterPrice;
        $sTotalCharge = empty($sTotalCharges) ? 'N/C' : '$' . $sTotalCharges;

		$client_msg = $this->reggie_model->get_client_messages();
		
		$message = '<html><body>';
        $message .= '<p style="font-size:16px;">'.hello[$lg].' '.$first_name . ',</p>';
        $subject = mail_subject[$lg];

        if ($lg=='E') {
            $message .=  html_entity_decode($client_msg['welcome_english']);
        }elseif ($lg=='S') {
            $message .= html_entity_decode($client_msg['welcome_spanish']);
        }elseif ($lg=='F') {
            $message .= html_entity_decode($client_msg['welcome_french']);
        }else{
        	$message .=  html_entity_decode($client_msg['welcome_english']);
        }
        
        $bcc='tamid@unitassistant.com, cherylt@unitassistant.com, office@textblastcustomers.com, shannons@unitassistant.com';

		$message .= mail_format(lang_label('directory_title', $lg), $data['director_title']);
		$message .= mail_format(lang_label('name', $lg), $data['name']);
		$message .= mail_format(lang_label('phone_number', $lg), $data['cell_number']);

		if (!empty($data['alt_phone'])) {
			$message .= mail_format(lang_label('alt_phone', $lg), $data['alt_phone']);
		}

		$message .= mail_format(lang_label('closing_emails', $lg), $data['closing_ecards']);
		$message .= mail_format(lang_label('birthday', $lg), $data['dob']);

		if (!empty($data['unit_web_site'])) {
			$message .= mail_format(lang_label('unit_web_site', $lg), $data['unit_web_site']);
		}

		if (!empty($data['unit_color'])) {
			$message .= mail_format(lang_label('unit_colors_theme', $lg), $data['unit_color']);
		}
		
		$message .= mail_format(lang_label('consultant_id', $lg), $data['consultant_number']);
		$message .= mail_format(lang_label('mk_director', $lg), $data['mk_director']);

		if (!empty($data['p_name'])) {
			$message .= mail_format(lang_label('name_label', $lg), $data['p_name']);
		}
		
		if (!empty($data['p_address'])) {
			$message .= mail_format(lang_label('address_label', $lg), $data['p_address']);
		}

		if (!empty($data['p_city'])) {
			$message .= mail_format(lang_label('city_label', $lg), $data['p_city']);
		}

		if (!empty($data['p_state'])) {
			$message .= mail_format(lang_label('state_label', $lg), $data['p_state']);
		}

		if (!empty($data['p_zip'])) {
			$message .= mail_format(lang_label('zip_label', $lg), $data['p_zip']);
		}

		if (!empty($data['p_phone'])) {
			$message .= mail_format(lang_label('phone_number_label', $lg), $data['p_phone']);
		}

		if (!empty($data['p_email'])) {
			$message .= mail_format(lang_label('email_label', $lg), $data['p_email']);
		}

		if (!empty($data['p_web'])) {
			$message .= mail_format(lang_label('website_shopping_site', $lg), $data['p_web']);
		}

		$message .= mail_format(lang_label('in_touch_password', $lg), $data['intouch_password']);
		$message .= mail_format(lang_label('unit_number', $lg), $data['unit_number']);
		$message .= mail_format(lang_label('unit_name', $lg), $data['unit_name']);
		$message .= mail_format(lang_label('unit_goals', $lg), $data['unit_goal']);


		if (!empty($nsd_data['nsd_name'])) {
            $message .= mail_format(lang_label('nsd_name', $lg), $nsd_data['nsd_name']);
        }

        if (!empty($nsd_data['nsd_address'])) {
            $message .= mail_format(lang_label('nsd_address', $lg), $nsd_data['nsd_address']);
        }

        if (!empty($nsd_data['nsd_city'])) {
            $message .= mail_format(lang_label('nsd_city', $lg), $nsd_data['nsd_city']);
        }

        if (!empty($nsd_data['nsd_state'])) {
            $message .= mail_format(lang_label('nsd_state', $lg), $nsd_data['nsd_state']);
        }

        if (!empty($nsd_data['nsd_zip'])) {
            $message .= mail_format(lang_label('nsd_zip', $lg), $nsd_data['nsd_zip']);
        }
        
        $message .= mail_format(lang_label('reffered_by', $lg), $data['reffered_by']);
        $message .= mail_format(lang_label('national_area', $lg), $data['national_area']);

        if ($lg !='F') {
        	$message .= mail_format(lang_label('seminar_affiliation', $lg), $data['seminar_affiliation']);
        }

        $message .= mail_format(lang_label('unit_size', $lg), $data['unit_size']);
        $message .= mail_format(lang_label('cu_routing', $lg), $data['cu_routing']);
        $message .= mail_format(lang_label('cv_account', $lg), $data['cv_account']);
        $message .= mail_format(lang_label('start_year', $lg), '');
        $message .= mail_format(lang_label('package_billing', $lg), $sPackageName);
        $message .= mail_format(lang_label('newsletter_design', $lg), $sHiddenNewletter);
        $message .= mail_format(lang_label('digital_business_card', $lg), $sEmailNl);
        $message .= mail_format(lang_label('happy_birthday_post_card', $lg), $sPcBirthday);
        $message .= mail_format(lang_label('a3_post_card', $lg), $sStatusOne);
        $message .= mail_format(lang_label('i1_post_card', $lg), $sStatusTwo);
        $message .= mail_format(lang_label('t1_post_card', $lg), $sStatusFive);
        $message .= mail_format(lang_label('thank_you_post_card', $lg), $sStatusSix);
        $message .= mail_format(lang_label('star_on_target_post_card', $lg), $sStatusEight);
        $message .= mail_format(lang_label('last_month_post_card', $lg), $sLastTwo);
        $message .= mail_format(lang_label('new_consultant_post_cards', $lg), $sConsultantTwo);
        $message .= mail_format(lang_label('total_point', $lg), $data['point_value']);
        $message .= mail_format(lang_label('total_charges', $lg), $sTotalCharge);
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

	function reggie_ua_unique_email(){
        echo checkReggieEmailExists($this->input->post('email'), '1');
        exit();
    }

    function reggie_ua_unique_id(){
        echo checkReggieConsultantExists($this->input->post('consultant'), '1');
        exit();
    }

}