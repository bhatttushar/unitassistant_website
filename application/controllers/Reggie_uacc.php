<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reggie_uacc extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('reggie_uacc_model');
		$this->load->helper('reggie_helper');
	}


	function reggie_uacc() {
		if($this->input->post()) {
			$data = $this->input->post();
            payload_ua_api($data['consultant_number'], $data[intouch_password], false, true, 1);
            $id_cc_newsletter = $this->reggie_uacc_model->add_to_uacc($data);

			if ($id_cc_newsletter > 0) {
				$send_mail = $this->send_mail($data, $id_cc_newsletter);
				if ($send_mail > 0) { 
                    $getPara =$this->input->get('language');
                    if (isset($getPara) && !empty($getPara)) {
                        redirect('reggie-uacc?language='.$getPara.'?success');
                    }else{
                        redirect('reggie-uacc?success');
                    }
				}
			}
		}else {
			$this->global['pageTitle'] = 'Unit Assistant Service';
			loadViews('reggie_uacc', $this->global, NULL, NULL);
		}
	}

	function send_mail($data, $id_cc_newsletter){
		$lg = $data['language'];
    
		$message = '<html><body>';
        $message .= '<p style="font-size:16px;">'.hello[$lg].' '.$data['name'].',</p>';
        $subject = lang_label('welcome_uacc', $lg);  

        $client_msg = $this->reggie_uacc_model->get_UACC_client_messages();

        if ($lg=='S') {
        	$message .=  html_entity_decode($client_msg['welcome_spanish']);
            $bcc = 'office@textblastcustomers.com, shannons@unitassistant.com, customers@unitassistant.com, accounts@unitassistant.com';
        }else{
        	$message .=  html_entity_decode($client_msg['welcome_english']);
            $bcc = 'office@textblastcustomers.com, shannons@unitassistant.com, customers@unitassistant.com';
        }

        $message .= "<p align='left'>We should have you set up within 48 business hours.</p>
                    <p align='left'>If you are not able to login within 48 hours please contact us at <a href='mailto:customers@unitassistant.com'>customers@unitassistant.com</a></p>";

        $message .= mail_format(lang_label('name', $lg), $data['name']);
        $message .= mail_format(lang_label('Cell_Number', $lg), $data['cell_number']);
        $message .= mail_format(lang_label('consultant_id', $lg), $data['consultant_number']);
        $message .= mail_format(lang_label('national_area', $lg), $data['national_area']);
        $message .= mail_format(lang_label('Seminar', $lg), $data['seminar_affiliation']);
        $message .= mail_format(lang_label('payment_type', $lg), $data['pmt_type']);
        $message .= mail_format(lang_label('Mary_Kay_Website', $lg), $data['mary_kay_website']);
        $message .= mail_format(lang_label('Facebook_Link', $lg), $data['fb_link']);
        $message .= mail_format(lang_label('directory_title', $lg), $data['cc_director_title']);
        $message .= mail_format(lang_label('Who_referred_you', $lg), $data['reffered_by']);
        $message .= mail_format(lang_label('birthday', $lg), $data['birthday']);
        $message .= mail_format(lang_label('Discount_Code', $lg), $data['discount_code']);
        $message .= mail_format(lang_label('hear_about_us', $lg), $data['hear_us']);
        $message .= mail_format(lang_label('Address', $lg), $data['address']);
        $message .= mail_format(lang_label('City', $lg), $data['city']);
        $message .= mail_format(lang_label('State', $lg), $data['state']);
        $message .= mail_format(lang_label('Zip', $lg), $data['zip']);
        $message .= mail_format(lang_label('Carona_Virus_special_prospecting', $lg), $data['cv_prospect']);
        $message .= mail_format(lang_label('Digital_Biz_Card', $lg), $data['digital_biz_card']);
        $message .= mail_format(lang_label('type_name_to_confirm', $lg), $data['recurring_sign']);
        $message .= mail_format(lang_label('Recurring_Todays_Date', $lg), $data['recurring_today_date']);
		$message .= "</body></html>";

		$this->load->library('email');
		$this->email->set_mailtype("html");
	    $this->email->from('customers@unitassistant.com', 'Unit Assistant Team');
	    $this->email->to($data['email']);
	    $this->email->bcc($bcc);
	    $this->email->subject($subject);
	    $this->email->message($message);
	    $send = $this->email->send();

        if ($send) {
            $msg = '<p><strong>YES</strong> Recurring Charge: Please subscribe me to your service. I understand that there is recurring charge on the 1st day of the each month - I authorize regularly scheduled charges to the credit card or bank account. First billing date will occur on the next 1st of the month after today date.</p>';
            $bixC = ($data['digital_biz_card'] == '1' ? 'YES' : 'NO');
            $msg .= '<p><strong>'.$bixC.'</strong> I would like to add the Digital Biz card for just $20 a month</p>';
            $msg .= '<p><strong>Name :</strong> '.$data['recurring_sign'].'</p>';
            $msg .= '<p><strong>Date :</strong> '.$data['recurring_today_date'].'</p>';

            $this->email->from('customers@unitassistant.com', 'Unit Assistant Team');
            $this->email->to('tamid@unitassistant.com');
            $this->email->subject('Welcome to Text Blast Customer');
            $this->email->message($msg);
            $send_mail = $this->email->send();

            if ($send_mail) {
                return $this->reggie_uacc_model->add_to_email_records($id_cc_newsletter, $message);
            }
        }

	}

    function reggie_uacc_unique_email(){
        echo checkReggieEmailExists($this->input->post('email'));
        exit();
    }

    function reggie_uacc_unique_id(){
        echo checkReggieConsultantExists($this->input->post('consultant'));
        exit();
    }

}