<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

function is_ua($consultant_number){
    $CI = get_instance();
    $CI->db->select('id_newsletter');
    $CI->db->from('newsletter_general_info');    
    $CI->db->where(array('deleted'=>'0', 'consultant_number'=>$consultant_number,'consultant_number !='=>''));
    return $CI->db->get()->row();
}

function getUncheckedFields(){
    $data = array('cc_anniversary', 'prospect_system', 'free', 'cv_prospect', 'cc_birthday', 'send_mail', 'cc_chargefree', 'status_done', 'inc_tbc', 'digital_biz_card');
    return $data;
}

function get_cc_text_system($cc_text_system){
    if ($cc_text_system == 1) {
        $aTextPackage = 'T & E';
    }elseif ($cc_text_system==2) {
        $aTextPackage = 'EO';
    }elseif ($cc_text_system==3) {
        $aTextPackage = 'TO';
    }elseif ($cc_text_system==4) {
        $aTextPackage = 'NO T & E';
    }else{
        $aTextPackage = '';
    }

    return $aTextPackage;
}

function checkUACCConsultantExist($id_cc_newsletter="", $consultant_number){
    $CI = get_instance();
    if(empty($id_cc_newsletter)) {
        $where = array('deleted'=>'0', 'consultant_number'=>$consultant_number);
    }else {
        $where = array('deleted'=>'0', 'consultant_number'=>$consultant_number, 'id_cc_newsletter !='=>$id_cc_newsletter);
    }
    $Count = $CI->db->get_where('cc_newsletters',$where)->num_rows();
    $data = ($Count > 0) ? '1' : '0';
    return $data;
}

function checkUACCEmailExists($email, $id_cc_newsletter=""){
    $CI = get_instance();
    $CI->db->select('email');
    if(!empty($id_cc_newsletter)) {
        $CI->db->where('id_cc_newsletter !=',$id_cc_newsletter);
    }
    $CI->db->where(array('deleted'=>'0', 'email'=>$email));
    $Count = $CI->db->get('cc_newsletters')->num_rows();       
    $data = ($Count > 0) ? 'Email Address must be unique!!' : '0';
    return $data;
}

function detailed_item_report($row, $objPHPExcel, $val){
    $data = unserialize($val['data']);
    extract($data);

    //EXCEL START
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, $val['name']);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':G'.$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('566573');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':G'.$row)->getFont()->setBold(true);

    $total = 0;
    $total+= UACC_BILLING;
    /*if($val['create_by'] == "1") {
        $row++;
        sheetFormat($objPHPExcel, $row, $val['invoice_date'], 'Customer Communication', '1', UACC_BILLING, UACC_BILLING);
        $total+= UACC_BILLING;

        $chargeparsent = ($val['pmt_type']=='CC') ? (UACC_BILLING * 5) / 100 : 0;

        if($chargeparsent != 0) {
            $row++;
            sheetFormat($objPHPExcel, $row, $val['invoice_date'], 'Charges on credit card payment @ 5%', '1', $chargeparsent, $chargeparsent);
            $total+= $chargeparsent;
        }

        $row++;
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Total '.$val['name']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row, $val['total']);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':G'.$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('A3B1BD');
        $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getFont()->setBold(true)->setName('Verdana')->setSize(10)->getColor()->setRGB('000000');
        $row++;
    }else{*/
        if(!empty($customer_comm_name)) {
            $row++;
            sheetFormat($objPHPExcel, $row, $val['invoice_date'], $customer_comm_name, $customer_communication, $customer_comm_val, $customer_comm_val_total);
            $total+= number_format($customer_comm_val_total, 2);
        }

        if(!empty($prospect_system_name)) {
            $row++;
            sheetFormat($objPHPExcel, $row, $val['invoice_date'], $prospect_system_name, $prospect_system, $prospect_system_val, $prospect_system_val_total );
            $total+= number_format($prospect_system_val_total, 2);
        }

        if(!empty($cv_prospect_name)) {
            $row++;
            sheetFormat($objPHPExcel, $row, $val['invoice_date'], $cv_prospect_name, $cv_prospect, $cv_prospect_val, $cv_prospect_val_total );
            $total+= number_format($cv_prospect_val_total, 2);
        }

        if(!empty($misc_charge_name)) {
            $row++;
            sheetFormat($objPHPExcel, $row, $val['invoice_date'], $misc_charge_name, $misc_charge, $misc_charge_val, $misc_charge_val_total );
            $total+= number_format($misc_charge_val_total, 2);
        }

        if(!empty($digital_biz_card_name)) {
            $row++;
            sheetFormat($objPHPExcel, $row, $val['invoice_date'], $digital_biz_card_name, $digital_biz_card, $digital_biz_card_val, $digital_biz_card_val_total );
            $total+= number_format($digital_biz_card_val_total, 2);
        }

        if(!empty($special_credit_name)) {
            $row++;
            sheetFormat($objPHPExcel, $row, $val['invoice_date'], $special_credit_name, $special_credit, $special_credit_val, $special_credit_val_total );
            $total+= number_format($special_credit_val_total, 2);
        }

        if ( isset($extra_name) && !empty($extra_name)) {
            $lng = count($extra_name);
            for ($i=0; $i < $lng; $i++) {
                if($extra_val_total[$i] != '' && $extra_val_total[$i] != 0){
                    $row++;
                    sheetFormat($objPHPExcel, $row, $val['invoice_date'], $extra_name[$i], '1', $extra_val[$i], $extra_val_total[$i]);
                    $total+= number_format((float)$extra_val_total[$i], 2);
               }
            }
        }
    /*}*/

    $row++;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Total '.$val['name']);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row, $val['total']);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':G'.$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F0F3F8');
    $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getFont()->setBold(true)->setName('Verdana')->setSize(10)->getColor()->setRGB('000000');
    $row++;
}


function sheetFormat($objPHPExcel, $row, $date, $name, $qty, $price, $amount){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Invoice');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row, $date);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$row, $name); 
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row, $qty); 
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$row, number_format((float)$price, 2)); 
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$row, number_format((float)$amount, 2));
}