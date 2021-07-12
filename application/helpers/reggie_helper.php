<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

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

    //Payload for Randy ua-api
	function payload_ua_api($consultant_number, $intouch_password, $toll_free, $is_canadian, $user_type){
        $data = array(
            'method'        => 'createNewUser',
            'consultId'     => $consultant_number,
            "password"      => $intouch_password, 
            "addToVirtAlert" => true,
            "createWithTollFree" => $toll_free,
            "isCanadian" => $is_canadian,
            "userType"=> $user_type
        );
        $url = 'https://www.unitnet.com/ua-api/newuser';
        $username = "*54YeX{u7^%[BP*X";
        $password = "2ypD;z2/Ru#N+PX![*'DE!LVf";


        $ch = curl_init ();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_USERPWD,"$username:$password");
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode($data));

        $response = curl_exec($ch);
        $aResponse = json_decode($response, true);

        curl_close($ch);
	}

    function checkReggieEmailExists($email, $table=""){
        $CI = get_instance();
        $CI->db->select('email');
        $CI->db->where('email', $email);

        if (!empty($table) && ($table=='ua')) {
            $Count = $CI->db->get('newsletter_general_info')->num_rows();       
        }else{
            $Count = $CI->db->get('cc_newsletters')->num_rows();       
        }

        $data = ($Count > 0) ? 'Email Address must be unique!!' : '0';
        return $data;
    }

    function checkReggieConsultantExists($consultant_number, $ua=""){
        $CI = get_instance();
        $where = array('consultant_number'=>$consultant_number);
        
        if (empty($ua)) {            
            $Count = $CI->db->get_where('cc_newsletters', $where)->num_rows();
        }else{
            $Count = $CI->db->get_where('newsletter_general_info', $where)->num_rows();
        }
        
        $data = ($Count > 0) ? '1' : '0';
        return $data;
    }

?>