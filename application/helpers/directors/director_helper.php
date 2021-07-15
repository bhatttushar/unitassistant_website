<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
if (!function_exists('get_instance')) {
	function get_instance() {
		$CI=&get_instance();
	}
}

function getIdNewsletter($name){
    $CI=get_instance();
    $CI->db->select('id_newsletter');
    $CI->db->from('newsletter_general_info');
    $CI->db->where('name', $name);
    return $CI->db->get()->row()->id_newsletter;
}

function Get_email_content($lang){
	$CI=get_instance();
	$lang=(!empty($lang) ? $lang : 'welcome_english');
	if($lang == 'welcome_english'){
		return $CI->db->get('client_messages')->row()->welcome_english;
	}
	if($lang == 'welcome_canada_english'){
		return $CI->db->get('client_messages')->row()->welcome_canada_english;
	}

	if($lang == 'welcome_spanish'){
		return $CI->db->get('client_messages')->row()->welcome_spanish;
	}

	if($lang == 'welcome_french'){
		return $CI->db->get('client_messages')->row()->welcome_french;
	}

	if($lang == 'current_english'){
		return $CI->db->get('client_messages')->row()->current_english;
	}

	if($lang == 'current_canada_english'){
		return $CI->db->get('client_messages')->row()->current_canada_english;
	}

	if($lang == 'current_french'){
		return $CI->db->get('client_messages')->row()->current_french;
	}

	if($lang == 'current_spanish'){
		return $CI->db->get('client_messages')->row()->current_spanish;
	}
}

function GetPackageValue($PakcageType, $unitsize) {

    $aPackageValues=0;
	//Sapphire
    if($PakcageType == 'S') {  
        if($unitsize>=0 && $unitsize <=29){ $aPackageValues =  Sapphire0;}
        if($unitsize>=30 && $unitsize <=54){ $aPackageValues =  Sapphire30;}
        if($unitsize>=55 && $unitsize <=79){ $aPackageValues =   Sapphire55;}
        if($unitsize>=80 && $unitsize <=104){$aPackageValues =   Sapphire80;}
        if($unitsize>=105 && $unitsize <=124){ $aPackageValues = Sapphire105;}
        if($unitsize>=125 && $unitsize <=154){ $aPackageValues = Sapphire125;}
        if($unitsize>=155 && $unitsize <=174){ $aPackageValues = Sapphire155;}
        if($unitsize>=175 && $unitsize <=199){ $aPackageValues = Sapphire175;}
        if($unitsize>=200 && $unitsize <=224){ $aPackageValues = Sapphire200;}
        if($unitsize>=225 && $unitsize <=249){ $aPackageValues = Sapphire225;}
        if($unitsize>=250 && $unitsize <=300){$aPackageValues =  Sapphire250;}
    }
    //Pearl
    if($PakcageType == 'P') {  
        if($unitsize>=0 && $unitsize <=29){ $aPackageValues =  Pearl0;}
        if($unitsize>=30 && $unitsize <=54){ $aPackageValues =  Pearl30;}
        if($unitsize>=55 && $unitsize <=79){ $aPackageValues =   Pearl55;}
        if($unitsize>=80 && $unitsize <=104){$aPackageValues =   Pearl80;}
        if($unitsize>=105 && $unitsize <=124){ $aPackageValues = Pearl105;}
        if($unitsize>=125 && $unitsize <=154){ $aPackageValues = Pearl125;}
        if($unitsize>=155 && $unitsize <=174){ $aPackageValues = Pearl155;}
        if($unitsize>=175 && $unitsize <=199){ $aPackageValues = Pearl175;}
        if($unitsize>=200 && $unitsize <=224){ $aPackageValues = Pearl200;}
        if($unitsize>=225 && $unitsize <=249){ $aPackageValues = Pearl225;}
        if($unitsize>=250 && $unitsize <=300){$aPackageValues =  Pearl250;}
    }
    //Diamond
    if($PakcageType == 'D') {  
        if($unitsize>=0 && $unitsize <=29){ $aPackageValues =  Diamond0;}
        if($unitsize>=30 && $unitsize <=54){ $aPackageValues =  Diamond30;}
        if($unitsize>=55 && $unitsize <=79){ $aPackageValues =   Diamond55;}
        if($unitsize>=80 && $unitsize <=104){$aPackageValues =   Diamond80;}
        if($unitsize>=105 && $unitsize <=124){ $aPackageValues = Diamond105;}
        if($unitsize>=125 && $unitsize <=154){ $aPackageValues = Diamond125;}
        if($unitsize>=155 && $unitsize <=174){ $aPackageValues = Diamond155;}
        if($unitsize>=175 && $unitsize <=199){ $aPackageValues = Diamond175;}
        if($unitsize>=200 && $unitsize <=224){ $aPackageValues = Diamond200;}
        if($unitsize>=225 && $unitsize <=249){ $aPackageValues = Diamond225;}
        if($unitsize>=250 && $unitsize <=300){$aPackageValues =  Diamond250;}
    }
    //Emerald
    if($PakcageType == 'E') {  
        if($unitsize>=0 && $unitsize <=29){ $aPackageValues =  Emerald0;}
        if($unitsize>=30 && $unitsize <=54){ $aPackageValues =  Emerald30;}
        if($unitsize>=55 && $unitsize <=79){ $aPackageValues =   Emerald55;}
        if($unitsize>=80 && $unitsize <=104){$aPackageValues =   Emerald80;}
        if($unitsize>=105 && $unitsize <=124){ $aPackageValues = Emerald105;}
        if($unitsize>=125 && $unitsize <=154){ $aPackageValues = Emerald125;}
        if($unitsize>=155 && $unitsize <=174){ $aPackageValues = Emerald155;}
        if($unitsize>=175 && $unitsize <=199){ $aPackageValues = Emerald175;}
        if($unitsize>=200 && $unitsize <=224){ $aPackageValues = Emerald200;}
        if($unitsize>=225 && $unitsize <=249){ $aPackageValues = Emerald225;}
        if($unitsize>=250 && $unitsize <=300){$aPackageValues =  Emerald250;}
    }
    //Ruby
    if($PakcageType == 'R') {  
        if($unitsize>=0 && $unitsize <=29){ $aPackageValues =  Ruby0;}
        if($unitsize>=30 && $unitsize <=54){ $aPackageValues =  Ruby30;}
        if($unitsize>=55 && $unitsize <=79){ $aPackageValues =   Ruby55;}
        if($unitsize>=80 && $unitsize <=104){$aPackageValues =   Ruby80;}
        if($unitsize>=105 && $unitsize <=124){ $aPackageValues = Ruby105;}
        if($unitsize>=125 && $unitsize <=154){ $aPackageValues = Ruby125;}
        if($unitsize>=155 && $unitsize <=174){ $aPackageValues = Ruby155;}
        if($unitsize>=175 && $unitsize <=199){ $aPackageValues = Ruby175;}
        if($unitsize>=200 && $unitsize <=224){ $aPackageValues = Ruby200;}
        if($unitsize>=225 && $unitsize <=249){ $aPackageValues = Ruby225;}
        if($unitsize>=250 && $unitsize <=300){$aPackageValues =  Ruby250;}
    }
    //Economy
    if($PakcageType == 'E1') {  
        if($unitsize>=0 && $unitsize <=29){ $aPackageValues =  Economy0;}
        if($unitsize>=30 && $unitsize <=54){ $aPackageValues =  Economy30;}
        if($unitsize>=55 && $unitsize <=79){ $aPackageValues =   Economy55;}
        if($unitsize>=80 && $unitsize <=104){$aPackageValues =   Economy80;}
        if($unitsize>=105 && $unitsize <=124){ $aPackageValues = Economy105;}
        if($unitsize>=125 && $unitsize <=154){ $aPackageValues = Economy125;}
        if($unitsize>=155 && $unitsize <=174){ $aPackageValues = Economy155;}
        if($unitsize>=175 && $unitsize <=199){ $aPackageValues = Economy175;}
        if($unitsize>=200 && $unitsize <=224){ $aPackageValues = Economy200;}
        if($unitsize>=225 && $unitsize <=249){ $aPackageValues = Economy225;}
        if($unitsize>=250 && $unitsize <=300){$aPackageValues =  Economy250;}
    }
    // package for special
    if($PakcageType == 'S1') {  
        $aPackageValues = SpecialAll;
    }
    return $aPackageValues;
}

function Get_hidden_newsletter($hidden_newsletter) {
	if($hidden_newsletter == 'SB' || $hidden_newsletter == 'AB'){
        return newsletter_desing_sb_ab;
    }
    if($hidden_newsletter == 'SS' || $hidden_newsletter == 'AS' || $hidden_newsletter == 'AE' || $hidden_newsletter == 'SE' || $hidden_newsletter == '' || $hidden_newsletter == 'no' ){
        return 0;
    }
}

function Get_personal_app($package, $personal_app){
	if($personal_app == 1) {
        if($package == 'N' || $package == '') {
            return pack_personal_unit_app_val;
        }else{
            return personal_unit_app_val;
        }
    }else {
       return 0;
    }
}

function Get_personal_web($package,$personal_web){
	if($personal_web == 1) {
        if($package == 'N' || $package == '') {
            return pack_personal_website_val;
        }else{
            return personal_website_val;
        }
    }else {
       return 0;
    }
}

function Get_total_text_program($package, $total_text_program){
	if($total_text_program == 1) {
        if($package=='S' || $package=='R' || $package=='D' || $package=='E1' || $package=='S1' || $package=='E') {
            return total_text_program_s_e1_r;
        }elseif($package == 'P'){
            return total_text_program_d_e_p;
        }elseif($package == 'N' || $package == ''){
            return total_text_program_n;
        }
    }else {
       return '';
    }
}

function Get_total_text_program7($package,$total_text_program7){
	if($total_text_program7 == 1) {
        if($package == 'P'){
        	return total_text_program7_p;
        }elseif($package == 'N' || $package == '') {
            return total_text_program7_n;
        }else{
            return total_text_program7_y;
        }
    }else {
       return '';
    }
}

function textSystem($package){
    if( ($package == 'D') || ($package == 'E') || ($package == 'P') ) {
        return '*';
    }elseif( ($package=='S') || ($package=='R') || ($package == 'E1') || ($package == 'S1') ) {
        return '$'.texting_s_r_e1;
    }elseif ( ($package == '') || ($package == 'N') ) {
        return '$'.texting_n;
    }
}

function Get_design_approve_status($design_one,$design_approve_status){
    if($design_one == 0) {
        return '<span>N/A</span>';
    } else {
        if($design_approve_status == 1){
            return '<span class="label label-success">Approved</span>';
        }elseif($design_approve_status == 0 || $design_approve_status == 2){
            return '<span class="label label-danger">Pending</span>';
        }elseif($design_approve_status == 3){
             return '<span class="label label-primary">Review</span>';
        }
    }
}

function getDesignStatus($design_approve_status){
    if ($design_approve_status == 1) {
        $sDesignStatus = 'A';
    } elseif ($design_approve_status == 2) {
        $sDesignStatus = 'P';
    } elseif ($design_approve_status == 0) {
        $sDesignStatus = 'N';
    } elseif ($design_approve_status == 3) {
        $sDesignStatus = 'R';
    }
    return $sDesignStatus;
}


function checkEmailExists($email, $id_newsletter=""){
	$CI = get_instance();
	$CI->db->select('email');
	if(!empty($id_newsletter)) {
		$CI->db->where('id_newsletter !=',$id_newsletter);
	}
	$CI->db->where(array('deleted'=>'0', 'email'=>$email));
	$Count = $CI->db->get('newsletter_general_info')->num_rows();		
    $data = ($Count > 0) ? 'Email Address must be unique!!' : '0';
	return $data;
}

function checkCC($id_newsletter=""){
	$CI = get_instance();

	$CI->db->select('id_newsletter');
	$CI->db->from('newsletter_packaging');
	$CI->db->where(array('id_newsletter'=>$id_newsletter, 'consultant_communication'=>'Y', 'deleted'=>'0'));
	$nRow = $CI->db->get()->num_rows();
	if($nRow > 0){
		$data = "yes";
	}else{
		$data = "no";
	}
	return $data;
}

function checkConsultantExist($id_newsletter="", $consultant_number){
	$CI = get_instance();
	if(empty($id_newsletter)) {
		$where = array('deleted'=>'0', 'consultant_number'=>$consultant_number);
	}else {
        $where = array('deleted'=>'0', 'consultant_number'=>$consultant_number, 'id_newsletter !='=>$id_newsletter);
	}
	$Count = $CI->db->get_where('newsletter_general_info',$where)->num_rows();
    $data = ($Count > 0) ? '1' : '0';
    return $data;
}

function GetDesignName($name) {

    if ($name == 'SE') {
        return "Simple English 2pt";
    }elseif($name == 'AE'){
        return "Advanced Newsletter English 4pt";
    }elseif ($name == 'SS') {
        return "Simple Newsletter Spanish 2pt";
    }elseif ($name == 'AS') {
        return "Advanced Newsletter Spanish 4pt";
    }elseif ($name == 'SB') {
        return "Simple Newsletter Both 2pt";
    }elseif ($name == 'AB') {
        return "Advanced Newsletter Both 4pts";
    }elseif ($name == 'AC') {
        return "Advanced Newsletter Canada 4pt";
    }elseif ($name == 'no' || $name == '') {
        return "No Subscription";
    }else{
        return "";
    }
          
}


function ExplodeDate($date,$num){
	$dt = $date;
	$dateElements = explode('/', $dt);
	$sStartMonth = empty($dateElements[0]) ? '' : $dateElements[0];
	$sStartYear = empty($dateElements[1]) ? '' : $dateElements[1];
	if($num == 1) {
		return $sStartMonth;
	}else {
		return $sStartYear;
	}
}

function GetPackageName($package){
    if($package == 'D') {
        return 'DIAMOND';
    }elseif ($package == 'P') {
        return 'PEARL';  
    }elseif ($package == 'S') {
        return 'SAPPHIRE';  
    }elseif ($package == 'E') {
        return 'EMERALD';  
    }elseif ($package == 'R') {
        return 'RUBY';  
    }elseif ($package == 'E1') {
        return 'ECONOMY';  
    }elseif ($package == 'S1') {
        return 'SPECIAL';  
    }else {
        return 'Unsubscribed';
    }
}

function GetClientEmails($id_newsletter){
	$CI = get_instance();
	$query = "SELECT * FROM email_records WHERE id_newsletter = $id_newsletter AND ( purpose LIKE 'Update client' OR purpose LIKE 'Update client') AND deleted = '0' GROUP BY created_at ORDER BY created_at DESC";
	return $CI->db->query($query)->result_array();
}
function GetEmailPurpose($id_newsletter,$purpose){
	$CI = get_instance();
	$query = "SELECT * FROM email_records WHERE id_newsletter = $id_newsletter AND purpose = '$purpose' AND deleted = '0' GROUP BY created_at ORDER BY created_at DESC";
	return $CI->db->query($query)->result_array();
}

function IsInTbc($consultant_number) {
	$sAndWhereTB  = " 1 = 1";
    $sAndWhereTB .= " AND consultant_number = '" . $consultant_number . "'";
    $sAndWhereTB .= " AND consultant_number != ''";
    $sAndWhereTB .= " AND cc = 'Y'";
    $sAndWhereTB .= " AND deleted = '0'";

	$CI = get_instance();

	$CI->db->select('id_cc_newsletter');
	$CI->db->from('cc_newsletters');
	$CI->db->where($sAndWhereTB);
	return $CI->db->get()->num_rows(); 
}

function LoginFromApp($id_newsletter){
	$CI = get_instance();
	$mail = "SELECT * FROM `email_records` WHERE `id_newsletter` = ".$id_newsletter." AND (purpose LIKE 'Logged in from Android' OR purpose LIKE 'Logged in from iPhone') ORDER BY id_email_record DESC LIMIT 1";
	$data = $CI->db->query($mail)->result_array();
	if (count($data) > 0) {
		return array('success',$data[0]['purpose']);
	}else {
		return array('error','Client is not logged in yet.');
	}
}

function getTableFields($table){

	if ($table == 'general') {
		$data = array('id_newsletter', 'id_user', 'updated_by', 'name', 'box_sent', 'contact', 'no_recognition', 'client_note', 'unit_number', 'consultant_number', 'mk_director', 'intouch_password', 'cell_number', 'director_title', 'closing_ecards', 'email', 'dob', 'unit_web_site', 'unit_name', 'unit_color', 'unit_goal', 'national_area', 'seminar_affiliation', 'primary_personality', 'reffered_by', 'first_bill_date', 'anniversary_month', 'anniversary_year', 'nsd_address', 'nsd_city', 'nsd_state', 'nsd_zip', 'contract_update_date', 'newsletters_design', 'select_email', 'image');
	}elseif ($table == 'design') {
		$data = array('id_newsletter', 'design_one', 'design_two', 'distribution_one', 'distribution_two', 'birthday_one', 'anniversary_one', 'status_one', 'status_two', 'status_three', 'status_four', 'status_five', 'status_six', 'status_seven', 'amount_box', 'accumulative', 'monthly', 'status_seven0', 'status_seven1', 'status_eight', 'status_eight1', 'status_nine', 'last_one', 'gift_one', 'gift_two', 'gift_three', 'gift_four', 'gift_five', 'consultant_one', 'consultant_two', 'consultant_two1', 'consultant_three', 'ncp_link_en', 'ncp_link_sp', 'ncp_link_fr', 'consultant_four', 'consultant_five', 'consultant_six', 'consultant_seven', 'no_email_option', 'override_color', 'override_black_white', 'english_only', 'n_zero', 'n_one', 'n_two', 'n_three', 'a_one', 'a_two', 'a_three', 'i_one', 'i_two', 'i_three', 't_one', 't_two', 't_three', 't_four', 'top_10_wsl', 'top_20_wsl', 'top_10_ytd', 'top_20_ytd', '600_plus_oder', 'wholesale_amount', 'wholesale_remove', 'wholesale_remove_name', 'wholesale_section', 'court_sale', 'court_sale_director', 'court_sharing', 'court_sharing_director', 'birthday_rec', 'birthday_anniversary', 'auto_send', 'special_news_request', 'beatly_url', 'beatly_url_one', 'beatly_url_two', 'newsletter_send_notes', 'p_name', 'p_address', 'p_email', 'p_web', 'p_phone', 'p_city', 'p_state', 'p_zip', 'star_program', 'note', 'package_for', 'postal_mailed_newsletter', 'send_mail', 'hidden_newsletter', 'economy', 'hidden_economy');
	}elseif ($table == 'emails') {
		$data = array('id_newsletter', 'welcome_email_english', 'welcome_email_canada_english', 'welcome_email_spanish', 'welcome_email_french', 'current_email_english', 'current_email_canada_english', 'current_email_spanish', 'current_email_french');
	}elseif ($table == 'packaging') {
		$data = array('id_newsletter', 'spanish_consultant', 'socialM', 'package', 'misc_charge', 'misc_description', 'facebook', 'facebook_everything', 'email_newsletter', 'emailing', 'digital_biz_card', 'digital_biz_link', 'canada_service', 'package_pricing', 'sub_total', 'credit_notes', 'billing_alert', 'unit_size', 'point_credit', 'cu_routing', 'cv_account', 'account_detail', 'cc_number', 'cc_code', 'cc_expir_date', 'cc_zip', 'package_value', 'special_creadit', 'package_note', 'invoice_note', 'nsd_client', 'total_text_program', 'total_text_program7', 'prospect_system', 'free', 'magic_booker', 'other_language_newsletter', 'personal_unit_app', 'personal_unit_app_ca', 'personal_website', 'website_link', 'catalog_link', 'shop_link', 'boss_babe_link', 'personal_url', 'subscription_updates', 'app_color', 'newsletter_color', 'newsletter_black_white', 'month_packet_postage', 'consultant_packet_postage', 'consultant_bundles', 'consistency_gift', 'reds_program_gift', 'stars_program_gift', 'gift_wrap_postpage', 'one_rate_postpage', 'month_blast_flyer', 'flyer_ecard_unit', 'unit_challenge_flyer', 'team_building_flyer', 'wholesale_promo_flyer', 'postcard_design', 'postcard_edit', 'ecard_unit', 'speciality_postcard', 'card_with_gift', 'greeting_card', 'birthday_brownie', 'birthday_starbucks', 'anniversary_starbucks', 'referral_credit', 'special_credit', 'cc_billing', 'customer_newsletter', 'picture_texting', 'keyword', 'client_setup', 'nl_flyer', 'point_value', 'review_date', 'consultant_communication', 'last_email_update_date');
	}elseif('design_reports'){
		$data = array('id_newsletter','hidden_newsletter','design_two','wholesale_amount','wholesale_section','court_sale','court_sale_director','court_sharing','court_sharing_director','birthday_rec','birthday_anniversary','wholesale_remove_name','wholesale_remove','special_news_request','beatly_url','beatly_url_one', 'beatly_url_two','cu_routing','cv_account');
	}elseif('reports'){
		$data = array('id_newsletter','package','nsd_client');
	}else{
		$data = '';
	}

	return $data;
}

function getUncheckedFields($table){
    if ($table=='design') {
        $data = array('distribution_one', 'distribution_two', 'status_one', 'status_two', 'status_three', 'status_four', 'status_five', 'status_six', 'status_eight', 'status_nine', 'status_seven', 'accumulative', 'monthly', 'status_seven1', 'gift_one', 'gift_two', 'gift_four', 'gift_five', 'star_program', 'consultant_one', 'consultant_two', 'consultant_three', 'consultant_five', 'consultant_six', 'no_email_option', 'override_color', 'override_black_white', 'english_only');
    }elseif ($table == 'packaging') {
        $data = array('facebook', 'facebook_everything', 'digital_biz_card', 'canada_service', 'email_newsletter', 'nsd_client', 'total_text_program', 'total_text_program7', 'prospect_system', 'free', 'magic_booker', 'other_language_newsletter', 'personal_unit_app', 'personal_unit_app_ca', 'personal_website', 'personal_url', 'subscription_updates', 'app_color', 'spanish_consultant');
    }

    return $data;
}

function getProspectSystem($nProspectSystem, $nFree){
    if($nProspectSystem == '1') {
        if($nFree == '1') {
            $nProspectSystem = '0';         
        }else {
            $nProspectSystem = PROSPECT_SYSTEM;         
        }
    }else {
        $nProspectSystem = '0';
    }
    return $nProspectSystem;
}

function screenshotlayer($url) {

    $parse_url = parse_url($url);

    if (isset($parse_url['scheme'])) {
        $url = $url;
    }else{
        $url = "https://".$parse_url['path'];
    }

    $args = array();
    $args['width'] = '200';
    $args['ttl'] = '300';
    // set access key
    $access_key = "d7b4433bef3266147944107110238e25";
    // set secret keyword (defined in account dashboard)
    $secret_keyword = "admin@123";
    // encode target URL
    $params['url'] = urlencode($url);
    $params += $args;
    // create the query string based on the options
    foreach($params as $key => $value) { $parts[] = "$key=$value"; }
    // compile query string
    $query = implode("&", $parts);
    // generate secret key from target URL and secret keyword
    $secret_key = md5($url . $secret_keyword);
    $FullUrl = "https://api.screenshotlayer.com/api/capture?access_key=$access_key&secret_key=$secret_key&$query";

    $data = file_get_contents($FullUrl);

}

function english_content(){
    return "<div>Friendly reminder, your newsletter is now ready for your approval.</div>
            <div>&nbsp;</div>
            <div>Please review your newsletter design by clicking on the bitly link below.</div>
            <div>&nbsp;</div>
            <div>If you approve the newsletter, please let us know by clicking on the approve button.</div>
            <div>&nbsp;</div>
            <div>If you would like to make changes, click the changes button to submit any requested revisions.</div>
            <div>&nbsp;</div>
            <div>Click on below bitly url to view your newsletter design.</div>";
}

function spanish_content(){
    return "<p>Felicidades por su sabia decisi&oacute;n de agregarnos a su personal ejecutivo.</p>
             <p>Estamos muy emocionados de poder asistirle a usted y a su unidad a continuar hacia delante en ruta al crecimiento.</p>
             <p>Nuestro objetivo es poder ayudarle a concentrarse en el tiempo de calidad con la personas, mientras que nosotros manejamos el papeleo.</p>
             <p>&iexcl;Sabemos que esta relaci&oacute;n ser&aacute; una beneficiosa!</p>
             <p>A continuaci&oacute;n encontrar&aacute; informaci&oacute;n &uacute;til sobre su nueva Asistente de Unidad &ldquo;Unit Assistant&rdquo;.</p>
             <p>&nbsp;</p>
             <p>Nuestro n&uacute;mero de oficina: 231-734-5948 - Utilice este n&uacute;mero s&oacute;lo para asuntos con la oficina.</p>
             <p>Correo electr&oacute;nico: office@unitassistant.com</p>
             <p>Direcci&oacute;n de pagina web: www.unitassistant.com &ndash; Podr&aacute; encontrar copias de la mayor&iacute;a de la correspondencia en &eacute;sta p&aacute;gina.</p>
             <p>&nbsp;</p>
             <p>Su personal de oficina:</p>
             <p>Shannon Schmidt ~ Presidenta</p>
             <p>Donna Robinson ~ Vicepresidenta</p>
             <p>Olyvia Moored - Especialista en Cuentas Nuevas en Ingl&eacute;s -- Ext: 1</p>
             <p>Astrid Pagan ~ Especialista en Cuentas Nuevas en Espa&ntilde;ol --- Ext: 5 (todas las preguntas para las clientas en Espa&ntilde;ol &ndash; elija 5)</p>
             <p>Sylvia Guzm&aacute;n ~ Traducciones al Espa&ntilde;ol</p>
             <p>Jody Hardy ~ Especialista en Relaciones con Clientes Existentes- Ext: 3</p>
             <p>Eric Schmidt ~ Dise&ntilde;o de Postales~ Peri&oacute;dico</p>
             <p>Rob Robinson ~ Administrador de Correos para Unit Assistant &ndash; Correspondencia</p>
             <p>Julie Bancroft ~ Especialista en Tarjetas Electr&oacute;nicas ~ Coordinadora del Club de Consistencia</p>
             <p>Tammy Dellar ~ Especialista Nuevas Consultoras / Servicio al Cliente</p>
             <p>Taylor McKay ~ Directora de Producci&oacute;n</p>
             <p>Kay Albright ~ Tarjetas de Cumplea&ntilde;os / Paquetes de Ultimo Mes / Control de Calidad</p>
             <p>Cheryl Taylor ~ Especialista en Peri&oacute;dico del Mes</p>
             <p>Debbie Nemish ~ Cuentas por Pagar / Cuentas a Cobrar - Ext: 2</p>
             <p>Jody Clark ~ Comunicaciones para Consultoras ~ Programa para Clientas de MK.</p>
             <p>Alec Mckay ~ Publicidad y vestimenta personalizada impresa. (Ll&aacute;menos con sus necesidades)</p>
             <p>Estamos trabajando arduamente para preparar todos los servicios para usted. Por favor, responda al correo electr&oacute;nico si tiene alguna pregunta.</p>
             <p>A continuaci&oacute;n adjunto copia de sus servicios, d&eacute;jenos saber si usted tiene alguna duda de cualquiera de los servicios.</p>
             <p>Nuestra meta es ayudarle a llevar su unidad al pr&oacute;ximo nivel.</p>
             <p>Cari&ntilde;os y Bendiciones,</p>
             <p>Shannon</p>
             </p>";
}

function french_content(){
    return "<div>Rappel amical, votre newsletter est maintenant pr&ecirc;te pour votre approbation.</div>
        <div>&nbsp;</div>
        <div>Veuillez revoir la conception de votre newsletter en cliquant sur le lien ci-dessous.</div>
        <div>&nbsp;</div>
        <div>Si vous approuvez la newsletter, veuillez nous en informer en cliquant sur le bouton approuver.</div>
        <div>&nbsp;</div>
        <div>Cliquez sur l&#39;url ci-dessous pour afficher la conception de votre newsletter.</div>";
}


function newsletter_message_mail($data, $aLanguage){

    $CI = get_instance();

    $data['beatly_url']=($data['beatly_url']!= '' ? "http://".$data['beatly_url'] : '');
    $data['beatly_url_one']=($data['beatly_url_one']!=''?"http://".$data['beatly_url_one'] : '');
    $data['beatly_url_two']=($data['beatly_url_two']!=''?"http://".$data['beatly_url_two'] : '');

    if($data['newsletters_design'] == 'E' || $data['newsletters_design'] == 'CE'){
        $lang = $aLanguage['english'];
    }elseif ($data['newsletters_design'] == 'S') {
        $lang = $aLanguage['spanish'];
    }elseif ($data['newsletters_design'] == 'F') {
        $lang = $aLanguage['french'];
    }

    $lg = ($data['newsletters_design']=='CE') ? 'E' : $data['newsletters_design'];

    $subject = lang_label('news_ready_to_view', $lg);
    $sContent = "<html><body>";
    $sContent .= "<h4 style='font-size:16px;'>".hello[$lg]."  <strong>".$data['name']."</strong>,</h4>";
    $sContent .= "<h4 style='font-size:16px;'>".$lang."</h4>";

    if(!empty($data['beatly_url'])) {
        $sContent .="<h4 style='font-size:16px;'><a href='".$data['beatly_url']."'>".$data['beatly_url']."</a></h4>";
    }

    if(!empty($data['beatly_url_one'])){
         $sContent .= "<h4 style='font-size:16px;'><a href='".$data['beatly_url_one']."'>".$data['beatly_url_one']."</a></h4>";
    }

    if(!empty($data['beatly_url_two'])){
        $sContent .= "<h4 style='font-size:16px;'><a href='".$data['beatly_url_two']."'>".$data['beatly_url_two']."</a></h4>";
    }

    $sContent .= "<h4><strong style='font-size:16px;'>".lang_label('click_below_to_approve', $lg)."</strong></h4>";
    $sContent .= "<a href='".base_url('admin/approve-newsletter-design/'.$data['id_newsletter'])."' title='".APPROVE[$lg]."' style='background-color:#44c767;-moz-border-radius:28px;-webkit-border-radius:28px;margin: 10px 20px 10px 0px;border-radius:28px;border:1px solid #44c767;display:inline-block;cursor:pointer;color:#ffffff;font-family:Arial;font-size:17px;padding:8px 24px;text-decoration:none;text-shadow:0px 1px 0px #2f6627;'>".APPROVE[$lg]."</a>";
    $sContent .= "<a href='https://www.unitassistant.com/current-newsletter-clients' title='".CHANGES[$lg]."' style='background-color:#46b8da;-moz-border-radius:28px;-webkit-border-radius:28px;margin: 10px 20px 10px 0px;border-radius:28px;border:1px solid #44c767;display:inline-block;cursor:pointer;color:#ffffff;font-family:Arial;font-size:17px;padding:8px 24px;text-decoration:none;text-shadow:0px 1px 0px #2f6627;'>".CHANG_NEED[$lg]."</a>";
    $sContent .= '<h4 style="font-size:16px;">'.lang_label('love_bless', $lg).'.</h4>';
    $sContent .= '<h4><strong>'.lang_label('cheryl_staff', $lg).'</strong></h4>';
    $sContent .= '<h4><strong style="font-size:16px;">Unit Assistant </strong></h4>';
    $sContent .= '<h4><strong style="font-size:16px;">office@unitassistant.com</strong></h4>';
    $sContent .= '<h4><strong style="font-size:16px;">* '.lang_label('remember_note', $lg).'</strong></h4>';
    $sContent .= "</body></html>";

    if($data['beatly_url']!=''||$data['beatly_url_one']!=''||$data['beatly_url_two']){
        if(($data['design_approve_status']=='3') || ($data['design_approve_status']=='2')){
            $CI->email->set_mailtype("html");
            $CI->email->from('office@unitassistant.com', 'Unit Assistant');
            $CI->email->to($data['email']);
            $CI->email->subject($subject);
            $CI->email->message($sContent);
            $sSend = $CI->email->send();
            
            if($sSend){
                $CI->db->set('last_email_update_date', date("Y-m-d H:i:s"));
                $CI->db->where('id_newsletter', $data['id_newsletter']);
                $res = $CI->db->update('newsletter_packaging');
                if ($res) {
                    $sDetail = htmlentities(($sContent), ENT_QUOTES);
                    $insertData = array('id_newsletter'=>$data['id_newsletter'], 'id_admin'=>'1', 'purpose'=>'Approval mail', 'detail'=>$sDetail, 'created_at'=>date("Y-m-d H:i:s"), 'updated_at'=>date("Y-m-d H:i:s"));
                    return $CI->db->insert('email_records', $insertData);
                }
            }
        }
    }
}

function send_newsletter_approval_mail($name){

    $CI = get_instance();
    $sContent = "<html><body>";
    $sContent .= "<p style='font-size:16px;'>Hello,</p>";
    $sContent .= "<p style='font-size:16px;'>Your Client&nbsp;".$name."&nbsp;has approved their newsletter successfully.</p>";
    $sContent .= "<p style='font-size:16px;'>This newsletter has been approved via email.</p>";
    $sContent .= "<p style='font-size:16px;'>Thanks,</p>";
    $sContent .= "<p style='font-size:16px;'><strong>".$name."</strong></p>";
    $sContent .= "</body></html>";

    $CI->email->set_mailtype("html");
    $CI->email->from('office@unitassistant.com', 'Unit Assistant');
    $CI->email->to('office@unitassistant.com');
    $CI->email->subject($name);
    $CI->email->message($sContent);
    return $CI->email->send();
}

function newsletter_print_option($data){
    
    $PrintingA = array();
    if($data['n_zero'] != 'N') {
        $PrintingA[] = 'N0';
    }
    if($data['n_one'] != 'N') {
        $PrintingA[] = 'N1';
    }
    if($data['n_two'] != 'N') {
        $PrintingA[] = 'N2';
    }
    if($data['n_three'] != 'N') {
        $PrintingA[] = 'N3';
    }
    if($data['a_one'] != 'N') {
        $PrintingA[] = 'A1';
    }
    if($data['a_two'] != 'N') {
        $PrintingA[] = 'A2';
    }
    if($data['a_three'] != 'N') {
        $PrintingA[] = 'A3';
    }
    if($data['i_one'] != 'N') {
        $PrintingA[] = 'I1';
    }
    if($data['i_two'] != 'N') {
        $PrintingA[] = 'I2';
    }
    if($data['i_three'] != 'N') {
        $PrintingA[] = 'I3';
    }
    if($data['t_one'] != 'N') {
        $PrintingA[] = 'T1';
    }
    if($data['t_two'] != 'N') {
        $PrintingA[] = 'T2';
    }
    if($data['t_three'] != 'N') {
        $PrintingA[] = 'TP';
    }
    if($data['t_four'] != 'N') {
        $PrintingA[] = 'TS';
    }
    if(!empty($PrintingA)) {
        $printingT = implode(',', $PrintingA);
    }else {
        $printingT = '';
    }

    return $printingT;

}