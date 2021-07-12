<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

function pre($data) {
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	exit();
}

if (!function_exists('get_instance')) {
	function get_instance() {
		$CI = &get_instance();
	}
}

function setFlashData($status, $flashMsg) {
	$CI = get_instance();
	$CI->session->set_flashdata($status, $flashMsg);
}

function loadAdminViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL) {
	$CI = get_instance();
	$CI->load->view('admin/header', $headerInfo);
	$CI->load->view($viewName, $pageInfo);
	$CI->load->view('admin/footer', $footerInfo);
}

function loadFrontViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL) {
	$CI = get_instance();
	$CI->load->view('header', $headerInfo);
	$CI->load->view($viewName, $pageInfo);
	$CI->load->view('footer', $footerInfo);
}

function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL) {
	$CI = get_instance();
	$CI->load->view('blank_header', $headerInfo);
	$CI->load->view($viewName, $pageInfo);
	$CI->load->view('blank_footer', $footerInfo);
}

function BillingViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL) {
	$CI = get_instance();
	$CI->load->view('billing/header', $headerInfo);
	$CI->load->view($viewName, $pageInfo);
	$CI->load->view('billing/footer', $footerInfo);
}

function UACC_billing_views($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL) {
	$CI = get_instance();
	$CI->load->view('UACC_billing/header', $headerInfo);
	$CI->load->view($viewName, $pageInfo);
	$CI->load->view('UACC_billing/footer', $footerInfo);
}

function getUserLogged($id_user){
	$CI = get_instance();
	$CI->db->select('is_loggedin');
	$CI->db->from('users');
	$CI->db->where(array('deleted'=>'0', 'id_user'=>$id_user));
	return $CI->db->get()->row_array();
}

function isUserLoggedIn(){
	$CI = get_instance();
	$isUserLoggedIn = $CI->session->userdata('isUserLoggedIn');
	$id_user =  $CI->session->userdata('id_user');
	$login = getUserLogged($id_user);
	if (!isset($isUserLoggedIn) || $isUserLoggedIn != TRUE || $login['is_loggedin'] == '0') {
		redirect('user-login');
	}
}

function isAdminLoggedIn() {
	$CI = get_instance();
	$url = array('newsletter-approval-success', 'newsletter-approval-failed', 'approve-newsletter-design');
	$isAdminLoggedIn = $CI->session->userdata('isAdminLoggedIn');
	if (!isset($isAdminLoggedIn) || $isAdminLoggedIn != TRUE) {
		if (!in_array($CI->uri->segment(2), $url)) {
			redirect('admin/admin-login');
		}
	}
}

function UpdateBy() {
	$CI = get_instance();
	$isUserLoggedIn = $CI->session->userdata('username');
	if(!empty($isUserLoggedIn)) {
		return $isUserLoggedIn; 
	}else {
		return ''; 
	}
}

function encryptIt($q){       
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $encryptionMethod = "AES-256-CBC"; 
    $secretHash = "qJB0rGtIn5UB1xG03efyCp";
    $qEncoded = @openssl_encrypt($q, $encryptionMethod, $secretHash);
    return( $qEncoded );
}

function decryptIt( $q ) {
    $encryptionMethod = "AES-256-CBC"; 
    $secretHash = "qJB0rGtIn5UB1xG03efyCp";
    $qDecoded = @openssl_decrypt($q, $encryptionMethod, $secretHash);
    return( $qDecoded );
}

function maskCreditCard($cc) {
    $cc_length = strlen($cc);
    for ($i = 0; $i < $cc_length - 4; $i++) {
        if ($cc[$i] == '-') {
            continue;
        }
        $cc[$i] = 'X';
    }
    return $cc;
}

function CurrentDateTime(){
	return date("Y-m-d H:i:s");
}

function UserList(){
	$CI = get_instance();
	$date = date('m-d-y');
	$result = $CI->db->get_where('users',array('deleted'=>'0'))->result_array();
	return $result;
}

function oldCCN($id_newsletter) {
	$consultant_number = getConsultantNumber($id_newsletter);
	$CI = get_instance();
	$CI->db->select('id_cc_newsletter');
	$CI->db->from('cc_newsletters');
	$CI->db->where(array('deleted'=>'0','consultant_number'=>$consultant_number));
	$data = $CI->db->get()->row();
	if (!empty($data)) {
		return $data->id_cc_newsletter;
	}
}

function GetNewsletterId($id_cc_newsletter) {
	$consultant_number = get_cc_consultant_number($id_cc_newsletter);
	$CI = get_instance();
	$CI->db->select('id_newsletter');
	$CI->db->from('newsletter_general_info');
	$CI->db->where(array('deleted'=>'0','consultant_number'=>$consultant_number));
	$data = $CI->db->get()->row();
	if (!empty($data)) {
		return $data->id_newsletter;
	}
}

function CurrentUser() {
	$CI = get_instance();
	$isUserLoggedIn = $CI->session->userdata('id_user');
	if(!empty($isUserLoggedIn)) {
		return $isUserLoggedIn; 
	}else {
		return 0; 
	}
}

function getConsultantNumber($id_newsletter){
	$CI = get_instance();
	$CI->db->select('consultant_number');
	$CI->db->from('newsletter_general_info');
	$CI->db->where(array('deleted'=>'0','id_newsletter'=>$id_newsletter));
	$data = $CI->db->get()->row();
	if (!empty($data)) {
		return $data->consultant_number;
	}
}

function get_cc_consultant_number($id_cc_newsletter){
	$CI = get_instance();
	$CI->db->select('consultant_number');
	$CI->db->from('cc_newsletters');
	$CI->db->where(array('deleted'=>'0','id_cc_newsletter'=>$id_cc_newsletter));
	$data = $CI->db->get()->row();
	if (!empty($data)) {
		return $data->consultant_number;
	}
}

function get_users(){
	$CI = get_instance();
    $CI->db->select('id_user, first_name, last_name');
    $CI->db->from('users');
    $CI->db->where('deleted', '0');
    return $CI->db->get()->result_array();
  }

function GetUserDataC($id_user) {
	$CI = get_instance();
	$CI->db->select('user_name');
	$CI->db->from('users');
	$CI->db->where(array('deleted'=>'0','id_user'=>$id_user));
	$data = $CI->db->get()->row();
	if (!empty($data)) {
		return $data->user_name;
	}
}

function getUserData($id_user){
    $CI = get_instance();
    $CI->db->select('id_user, first_name, last_name, user_name, profile_pic');
    $CI->db->from('users');
    $CI->db->where(array('deleted'=>'0', 'id_user'=>$id_user));
    return $CI->db->get()->row_array();
}

function getUserByName($id_user){
    $CI = get_instance();
    $CI->db->select('first_name, last_name');
    $CI->db->from('users');
    $CI->db->where(array('deleted'=>'0', 'id_user'=>$id_user));
    return $CI->db->get()->row_array();
}

function getUserToName($userto){
	$userto = rtrim($userto, ',');
	$where= "1 = 1";
	$where .= " AND deleted='0' ";
	$where .= " AND id_user IN (".$userto.")";

    $CI = get_instance();
    $CI->db->select('first_name, last_name');
    $CI->db->from('users');
    $CI->db->where($where);
    /*$CI->db->where_in('id_user', $userto);*/
    return $CI->db->get()->row_array();
}

function getName($id_newsletter){
    $CI = get_instance();
    $CI->db->select('name');
    $CI->db->from('newsletter_general_info');
    $CI->db->where('id_newsletter', $id_newsletter);
    $data = $CI->db->get()->row();
    if (!empty($data)) {
    	return $data->name;
    }
}

function getUACCName($id_cc_newsletter){
    $CI = get_instance();
    $CI->db->select('name');
    $CI->db->from('cc_newsletters');
    $CI->db->where('id_cc_newsletter', $id_cc_newsletter);
    $data = $CI->db->get()->row();
    if (!empty($data)) {
    	return $data->name;
    }
}

function responseInvoice($id_newsletter){
	$CI = get_instance();
    $CI->db->select('payment_status, total,payment_date,total_paid,paid_return,return_date,due_amount,invoice_name');
    $CI->db->from('invoices');
    $CI->db->where(array('id_newsletter'=>$id_newsletter, 'deleted'=>'0'));
    $CI->db->order_by('created_at', 'DESC');
    return $CI->db->get()->result_array();
}

function responseCCInvoice($id_cc_newsletter){
	$CI = get_instance();
    $CI->db->select('payment_status, total,payment_date,total_paid,paid_return,return_date,due_amount,invoice_name');
    $CI->db->from('cc_invoices');
    $CI->db->where(array('id_cc_newsletter'=>$id_cc_newsletter, 'deleted'=>'0'));
    $CI->db->order_by('created_at', 'DESC');
    return $CI->db->get()->result_array();
}

function GetTotalDue($id) {
	$CI = get_instance();
	$CI->db->select('i.*, b.balance,(SUM(i.total) - SUM(i.total_paid)) as due');
	$CI->db->from('invoices AS i');
	$CI->db->join('invoice_balance AS b', 'b.id_newsletter = i.id_newsletter', 'left');
	$CI->db->where(array('i.id_newsletter'=>$id,'i.deleted'=>'0','i.total >'=>'0'));
	$aTotal = $CI->db->get()->row_array();
	return str_replace(",", "", number_format($aTotal['due'], 2));
}

function GetBalance($id_newsletter) {
	$CI = get_instance();
	$CI->db->select('balance');
	$CI->db->from('invoice_balance');
	$CI->db->where('id_newsletter', $id_newsletter);
	$aResult = $CI->db->get()->row_array();
	if (!empty($aResult)) {
		return (float) str_replace(",", "", number_format($aResult['balance'],2));
	} else {
		return 0;
	}
}

function GetCCBalance($id_cc_newsletter) {
	$CI = get_instance();
	$CI->db->select('balance');
	$CI->db->from('cc_invoice_balance');
	$CI->db->where('id_cc_newsletter', $id_cc_newsletter);
	$aResult = $CI->db->get()->row_array();

	if (!empty($aResult)) {
		return (float) str_replace(",", "", number_format($aResult['balance'],2));
	} else {
		return 0;
	}
}

function GetCCTotalDue($id_cc_newsletter) {
	$CI = get_instance();
	$CI->db->select('i.*, b.balance,(SUM(i.total) - SUM(i.total_paid)) as due');
	$CI->db->from('cc_invoices AS i');
	$CI->db->join('cc_invoice_balance AS b', 'b.id_cc_newsletter = i.id_cc_newsletter', 'left');
	$CI->db->where(array('i.id_cc_newsletter'=>$id_cc_newsletter,'i.deleted'=>'0'));
	$aTotal = $CI->db->get()->result_array();
	$Mtotal = $aTotal[0]['due_amount'];
	return number_format($aTotal[0]['due'], 2);
}

function prepareUniqueName($aFileName) {
    if(empty($aFileName)) return false;
    $sExtension = array_pop($aFileName);
    $sLogo = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10 );
    return $sLogo . '.' . $sExtension;
}

function getMultiConsultantNumber($id_newsletters){
    $CI = get_instance();
    $CI->db->select('id_newsletter, consultant_number');
    $CI->db->from('newsletter_general_info');
    $CI->db->where("id_newsletter IN (".$id_newsletters.")", NULL, false);
    return $CI->db->get()->result_array();
}

function get_newsletters_design($newsletters_design){
    if($newsletters_design == 'S') {
        return 'Spanish';
    }elseif($newsletters_design == 'E'){
        return 'English';
    }elseif($newsletters_design == 'F'){
        return 'French';
    }elseif($newsletters_design == 'CE'){
        return 'Canada English';
    }else{
        return '';
    }   
}

function invoiceSendStatus($invoice_status){
    if($invoice_status == '0'){
       echo '<span class="label label-danger">Not Send</span>';
    }else if($invoice_status == '1'){
        echo '<span class="label label-success">Sent</span>';
    } else {
        echo '<span class="label label-success">Not Send</span>';
    }
}

function invoicePaymentStatus($payment_status){
    if($payment_status == "P"){
       echo '<span class="label label-danger">Pending</span>';
    }elseif($payment_status == "S"){
        echo '<span class="label label-success">Success</span>';
    }elseif($payment_status == "C"){
        echo '<span class="label label-cancel">Cancel</span>';
    }elseif($payment_status == "D"){
        echo '<span class="label label-info">Declined</span>';
    }elseif($payment_status == "R"){
        echo '<span class="label label-danger">Remaining</span>';
    }
}

function lang_label($label, $lang){
	$CI = get_instance();
	if ($lang == 'E') {
		$CI->lang->load('reggie_english','english');
	}elseif ($lang == 'F') {
		$CI->lang->load('reggie_french','french');
	}elseif ($lang == 'S') {
		$CI->lang->load('reggie_spanish','spanish');
	}else{
		$CI->lang->load('reggie_english','english');
	}
    $return = $CI->lang->line($label);   
    return ($return) ? $return : $label; 
}

function lg($key, $lang){
	$CI = get_instance();
	if ($lang == 'en') {
		$CI->lang->load('api_english', 'english');
	}elseif ($lang == 'fr') {
		$CI->lang->load('api_french', 'french');
	}elseif ($lang == 'sp') {
		$CI->lang->load('api_spanish', 'spanish');
	}else{
		$CI->lang->load('api_english', 'english');
	}
    $return = $CI->lang->line($key);
    return ($return) ? $return : $key; 
}

	function generatePassword($length = 6, $strength = 0){
        $vowels = 'aeuy';
        $consonants = 'bdghjmnpqrstvz';
        if ($strength & 1) {
            $consonants .= 'BDGHJLMNPQRSTVWXZ';
        }
        if ($strength & 2) {
            $vowels .= "AEUY";
        }
        if ($strength & 4) {
            $consonants .= '23456789';
        }
        if ($strength & 8) {
            $consonants .= '@#$%';
        }
        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }

    function dayLogsTimeInfo($dDate, $nUserId, $daily='', $weekly=''){
	    $CI = get_instance();

	    $dDate = date("Y:m:d",strtotime($dDate));
	    $CI->db->select('l.total_time');
	    $CI->db->from('user_logs as l');
	    $CI->db->join('users as u', 'u.id_user=l.id_user', 'left');
	    $CI->db->where(array('u.activated'=>'1', 'u.deleted'=>'0', 'l.id_user'=>$nUserId, 'DATE(l.created_at)'=>$dDate));

	    if (!empty($daily) || !empty($weekly)) {
	    	 $CI->db->order_by('l.created_at', 'ASC');
	    }

	    $times = $CI->db->get()->result_array();
	    $sum = strtotime('00:00:00');
	    /*$sum = 0;*/
	    $sum2=0;
	    foreach ($times as $values){
	        foreach ($values as $key => $value) {
	            $sum1=strtotime($value)-$sum;
	            /*$sum1=(int)$value-$sum;*/
	            $sum2 = $sum2+$sum1;
	        }   
	    }
	    $sum3=$sum+$sum2;
	    $sumTotal1 = $sum3/1000;

	    if (!empty($daily) || !empty($weekly)) {
	    	return $sum3;
	    }else{
	    	return $sumTotal1;
	    }
	}

	// API Function
	function isSecuredApp() {
		$CI = get_instance();

		$date = date_default_timezone_set('Asia/Kolkata');
		$currentDate = base64_encode(date("Y-m-d"));
		$appToken = apache_request_headers();
		if (isset($appToken['App-Token'])  ) {
		    if($appToken['App-Token'] != $currentDate){
		        $aMessage = array('status' => 0, 'message' => 'Security Token is invalid');
			    echo $CI->SendResponse($aMessage);
		        exit();    
		    }
		}else{
		    $aMessage = array('status' => 0, 'message' => 'Please provide security token');
			echo $CI->SendResponse($aMessage);
		    exit();    
		}
	}

	function SendResponse($aMessage) {
		header('Content-Type: application/json');
		return json_encode($aMessage, JSON_UNESCAPED_SLASHES);
	}
	// End API Function

?>