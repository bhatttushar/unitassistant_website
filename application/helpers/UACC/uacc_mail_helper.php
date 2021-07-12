<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

	function send_uacc_mail($data, $mail_content){
		$CI = &get_instance();
		$sFname = explode(" ", $data['name']);

		$lg = (isset($data['cc_newsletter']) && $data['cc_newsletter']=='CE') ? 'E' : $data['cc_newsletter'];

		if ($lg == 'CE' || 'E') {
			$mail_content = $mail_content['welcome_english'];
		}elseif ($lg == 'S') {
			$mail_content = $mail_content['welcome_spanish'];
		}elseif ($lg == 'F') {
			$mail_content = $mail_content['welcome_french'];
		}

		$yourName = your_name[$lg];

		$mail_content=str_replace($yourName, $sFname[0], htmlspecialchars_decode(stripslashes($mail_content)));
		
		$subject = mail_subject[$lg];
		$message = '<html><body>';
		$message .= '<p style="font-size:16px;">'.hello[$lg].' '.$sFname[0].',</p>';
		$message .= $mail_content;
		$message .= '<p style="font-size:16px;">'.warmly[$lg].',<br>'.UpdateBy().'</p><br><br>';

		if (!empty($data['name'])) {
		    $message .= mail_format(name[$lg], strip_tags($data['name']));
		}

		if (!empty($data['cell_number'])) {
		    $message .= mail_format(cell_number[$lg], strip_tags($data['cell_number']));
		}

		if (!empty($data['consultant_number'])) {
		    $message .= mail_format(consultant_number[$lg], strip_tags($data['consultant_number']));
		}

		if (!empty($data['intouch_password'])) {
		    $message .= mail_format(intouch_password[$lg], strip_tags($data['intouch_password']));
		}

		if (!empty($data['national_area'])) {
		    $message .= mail_format(national_area[$lg], strip_tags($data['national_area']));
		}

		if (!empty($data['seminar_affiliation'])) {
		    $message .= mail_format(seminar_affiliation[$lg], strip_tags($data['seminar_affiliation']));
		}

		if (!empty($data['cu_routing'])) {
		    $message .= mail_format(cu_routing[$lg], strip_tags($data['cu_routing']));
		}

		if (!empty($data['client_note'])) {
		    $message .= mail_format(client_note[$lg], strip_tags($data['client_note']));
		}

		if (!empty($data['text_note'])) {
		    $message .= mail_format(text_note[$lg], strip_tags($data['text_note']));
		}

		if (!empty($data['cc_text_system'])) {
		    $message .= mail_format(text_package[$lg], strip_tags($data['cc_text_system']));
		}

		if (!empty($data['cc_anniversary'])) {
		    $message .= mail_format(cc_anniversary[$lg], strip_tags($data['cc_anniversary']));
		}

		if (!empty($data['prospect_system'])) {
		    $message .= mail_format(prospect_system[$lg], strip_tags($data['prospect_system']));
		}

		if (!empty($data['cv_prospect'])) {
		    $message .= mail_format(cv_prospect[$lg], strip_tags($data['cv_prospect']));
		}

		if (!empty($data['free'])) {
		    $message .= mail_format(prospect_system_free[$lg], strip_tags($data['free']));
		}

		if (!empty($data['cc_birthday'])) {
		    $message .= mail_format(cc_birthday[$lg], strip_tags($data['cc_birthday']));
		}

		if (!empty($data['product_promotion'])) {
		    $message .= mail_format(product_promotion[$lg], strip_tags($data['product_promotion']));
		}

		if (!empty($data['dob'])) {
		    $message .= mail_format(client_birthday[$lg], strip_tags($data['dob']));
		}

		if (!empty($data['birth_note'])) {
		    $message .= mail_format(client_birthday_note[$lg], strip_tags($data['birth_note']));
		}

		if (!empty($data['month_mailing'])) {
		    $message .= mail_format(cc_month_mail[$lg], strip_tags($data['month_mailing']));
		}

		if (!empty($data['account_number'])) {
		    $message .= mail_format(account_number[$lg], strip_tags($data['account_number']));
		}

		if (!empty($data['mary_kay_website'])) {
		    $message .= mail_format(mary_kay_website[$lg], strip_tags($data['mary_kay_website']));
		}

		if (!empty($data['fb_link'])) {
		    $message .= mail_format(fb_link[$lg], strip_tags($data['fb_link']));
		}

		if (!empty($data['pmt_type'])) {
		    $message .= mail_format(payment_type[$lg], strip_tags($data['pmt_type']));
		}

		if (!empty($data['cc_director_title'])) {
		    $message .= mail_format(director_title[$lg], strip_tags($data['cc_director_title']));
		}

		if (!empty($data['reffered_by'])) {
		    $message .= mail_format(cc_referred[$lg], strip_tags($data['reffered_by']));
		}

		if (!empty($data['question_comment'])) {
		    $message .= mail_format(comment[$lg], strip_tags($data['question_comment']));
		}

		$message .= "</body></html>";
		$CI->load->library('email');
		$CI->email->set_mailtype("html");
	    $CI->email->from('office@textblastcustomers.com', 'Unit Assistant Team');
	    $CI->email->to($data['email']);
	    $CI->email->bcc('office@textblastcustomers.com');
	    $CI->email->subject($subject);
	    $CI->email->message($message);
	    $status = $CI->email->send();

	    if ($status) {
	    	return $message;
	    }
	}

	function mail_format($key, $val){
		return "<div class='row' style='border-bottom: 1px solid #ccc;'>
		        <div class='col-xs-6' style='width: 50%; float: left;'>
		            <p style='text-align: left;font-weight: 800;'>".$key.":</p>
		        </div>
		        <div class='col-xs-6' style='width: 50%; float: left;'>
		            <p style='text-align: left;font-weight: 600;'>".$val."</p>
		        </div>
		        <div class='clearfix' style='clear: both;'></div>
		    </div>";
	}


	function sendCCNoteMail($emails, $data, $Assignnames) {
	    $CI = & get_instance();

	    $subject = empty($data['client_name']) ? 'No Name' : $data['client_name'];
	    $sContent = "<p style='font-size:16px;'>Hello,</p>";
		$sContent .= "<p style='font-size:16px;'>Client Name:&nbsp;".$data['client_name']."</p>";
		$sContent .= "<p style='font-size:16px;'>Assigned Users : &nbsp;".$Assignnames."</p>";
		$sContent .= "<p style='font-size:16px;'>".$data['note']."</p>";
		$sContent .= "<p style='font-size:16px;'>Thanks,</p>";
		$sContent .= "<p style='font-size:16px;'>".$CI->session->userdata('name')."</p>";

	    $CI->email->set_mailtype("html");
	    $CI->email->from('office@unitassistant.com', 'UACC');
	    $CI->email->to($emails);
	    $CI->email->subject($subject);
	    $CI->email->message($sContent);
	    return $CI->email->send();
	}

?>