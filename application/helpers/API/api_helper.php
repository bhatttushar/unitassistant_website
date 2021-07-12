<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

    function get_client_data($data, $routing, $decrypted, $mask, $adminData, $cons_number='', $is_uacc='', $sBitly='', $sBitlySn='', $sBitlyFr=''){

        $aClientDetail = array();

        if (!empty($is_uacc) ) {
            $aClientDetail['id_client'] = isset($data['id_cc_newsletter']) ? $data['id_cc_newsletter'] : '';
        }else{
            $aClientDetail['id_client'] = isset($data['id_newsletter']) ? $data['id_newsletter'] : '';
        }
        
        if (!empty($cons_number)) {
            $aClientDetail['consultant_number'] = $cons_number;
        }
        $aClientDetail['name'] = $data['name'];
        $aClientDetail['cell_phone_number'] = $data['cell_number'];
        $aClientDetail['email_address'] = $data['email'];
        $aClientDetail['your_birthday'] = $data['dob'];

        $aClientDetail['en'] = empty($sBitly) ? '' : $sBitly;
        $aClientDetail['sn'] = empty($sBitlySn) ? '' : $sBitlySn;
        $aClientDetail['fr'] = empty($sBitlyFr) ? '' : $sBitlyFr;
    

        $aClientDetail['routing'] = $routing;
        $aClientDetail['account_full'] = $decrypted;
        $aClientDetail['account'] = $mask;
        $aClientDetail['admin_email'] = $adminData['email'];
        $aClientDetail['admin_phone_number'] = $adminData['telephone'];
        $aClientDetail['ftp_host'] = FTP_HOST;
        $aClientDetail['ftp_user'] = FTP_USER;
        $aClientDetail['ftp_password'] = FTP_PASS;
        $aClientDetail['ftp_file_upload_path'] = FILE_PATH;
        return $aClientDetail;
    }

	function generateUnique($length = 2, $strength = 0){
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
        $number = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $number .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $number .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $number;
    }

    function AddApprovalLogs($id_newsletter, $is_approve, $is_send_mail, $approve_using, $error_log){
        $CI = get_instance();
        
        $data = array(
                'id_newsletter'=>$id_newsletter,
                'is_approve'=>$is_approve,
                'is_send_mail'=>$is_send_mail,
                'approve_using'=>$approve_using,
                'error_log'=>$error_log
            );

        return $CI->db->insert('approve_log', $data);
    }