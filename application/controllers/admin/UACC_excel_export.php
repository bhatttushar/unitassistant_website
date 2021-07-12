<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UACC_excel_export extends CI_Controller {

  public function __construct() {
		parent::__construct();
		$this->load->model('admin/UACC_excel_export_model');
    $this->load->helper('UACC/uacc');
	}
	
	function index(){
	}

  // $id_cc_newsletter for UACC history
  function download_uacc_excel($id_cc_newsletter=""){
    $url = $this->uri->segment(2);
    $unsub = $this->uri->segment(3);

    $this->load->library("excel");
    $object = new PHPExcel();

    $object->setActiveSheetIndex(0);

    $table_columns = array(
      "Client Notes",
      "Month to start Mailing",
      "Year to start Mailing",
      "Account Number",
      "Name",
      "Consultant ID",
      "Password",
      "Seminar",
      "Client Birthday",
      "Phone Number",
      "Email",
      "Birthday Note",
      "Anniversary",
      "Birthday",
      "Newsletters",
      "Product Promotion",
      "Bill to 2",
      "Bill to 3",
      "Mary Kay Website",
      "FB Link if applicable",
      "PMT TYPE",
      "Area",
      "Cheking Account Number",
      "Routing Number",
      "Unsubscribe Date",
      "Who Referred You?",
      "Question/Comment",
      "Text Note",
      "Text Package",
      "Misc charge",
      "Billing Alert box",
      "Month bill date",
      "Director Title",
      "Send Mail",
      "Card Number",
      "Security Code",
      "Expiration Date",
      "Postal Code",
      "Created At",
      "Revert Date",
      "Address",
      "City",
      "State",
      "Zip",
      "Also UA client",
      "Carona Virus special prospecting",
      "Digital Biz Card $20"
    );

    $column = 0;
    foreach($table_columns as $field){
      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
      $column++;
    }

    if (isset($unsub) && ($unsub=='unsub')) {
      $data = $this->UACC_excel_export_model->get_unsub_uacc();
    }else{
      $data = $this->UACC_excel_export_model->fetch_uacc_data($id_cc_newsletter);
    }


    $row = 2;
    foreach($data as $val){
      $decrypted = empty($val['cv_account']) ? '' : decryptIt( $val['cv_account'] );
      $mask = maskCreditCard($decrypted);
      $date = $val['dob'];
      $dt = $val['month_mailing'];
      $dateElements = explode('/', $dt);
      $sStartMonth = empty($dateElements[0]) ? '' : $dateElements[0];
      $sStartYear = empty($dateElements[1]) ? '' : $dateElements[1] ;
      $sNewsDesign = get_newsletters_design($val['cc_newsletter']);
      $sProductPromotion = (($val['product_promotion']=='Y') ? 'Yes' : (($val['product_promotion']=='N') ? 'No' : '' ));
      $sAnniversaryOne = ($val['cc_anniversary'] == 'X') ? 'X' : '';
      $sHbirthday = ($val['cc_birthday'] == 'X') ? 'X' : '';
      $aTextPackage = get_cc_text_system($val['cc_text_system']);
      $is_ua = is_ua($val['consultant_number']);
      $is_ua = empty($is_ua) ? 'In UA' : '';
      $cv_prospect = isset($val['cv_prospect']) ? 'X' : '';
      $sDigitalizCard20 = empty($val['digital_biz_card']) ? '' : 'X';

      $object->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $val['client_note']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $sStartMonth); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $sStartYear); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $val['account_number']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $val['name']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $val['consultant_number']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $val['intouch_password']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $val['seminar_affiliation']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $val['dob']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $val['cell_number']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $val['email']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $val['birth_note']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $sAnniversaryOne) ; 
      $object->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $sHbirthday); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $sNewsDesign); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $sProductPromotion); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $val['bill_2']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(17, $row, $val['bill_3']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $val['mary_kay_website']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(19, $row, $val['fb_link']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(20, $row, $val['pmt_type']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(21, $row, $val['national_area']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(22, $row, $val['cv_account']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(23, $row, $val['cu_routing']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(24, $row, $val['contract_update_date']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(25, $row, $val['reffered_by']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(26, $row, $val['question_comment']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(27, $row, $val['note']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(28, $row, $aTextPackage); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(29, $row, $val['misc_charge']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(30, $row, $val['billing_alert']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(31, $row, $val['m_bill_date']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(32, $row, $val['cc_director_title']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(33, $row, $val['send_mail']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(34, $row, $val['cc_number']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(35, $row, $val['cc_code']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(36, $row, $val['cc_expir_date']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(37, $row, $val['cc_zip']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(38, $row, $val['created_at']); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(39, $row, isset($val['revert_date'])?$val['revert_date']:''); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(40, $row, isset($val['address'])?$val['address'] : ''); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(41, $row, isset($val['city']) ? $val['city'] : ''); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(42, $row, isset($val['state']) ? $val['state'] : ''); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(43, $row, isset($val['zip']) ? $val['zip'] : ''); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(44, $row, $is_ua); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(45, $row, $cv_prospect); 
      $object->getActiveSheet()->setCellValueByColumnAndRow(46, $row, $sDigitalizCard20);
      $object->getActiveSheet()->setCellValueExplicit('X'.$row, $val['cu_routing'], PHPExcel_Cell_DataType::TYPE_STRING);
      $object->getActiveSheet()->setCellValueExplicit('W'.$row, $decrypted, PHPExcel_Cell_DataType::TYPE_STRING);
      $object->getActiveSheet()->setCellValueExplicit('J'.$row, $val['cell_number'], PHPExcel_Cell_DataType::TYPE_STRING);
      $object->getActiveSheet()->setCellValueExplicit('AI'.$row, $val['cc_number'], PHPExcel_Cell_DataType::TYPE_STRING);
      $row++;
    }

    $object->getActiveSheet()->getRowDimension(1)->setRowHeight(140);
    $object->getDefaultStyle()
        ->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
     $object->getActiveSheet()->getStyle("A1:AZ1")->getFont()->setBold(true)->setName('Verdana')->setSize(10)
                                    ->getColor()->setRGB('6F6F6F');
    $object->getActiveSheet()->getStyle('A1:AZ1')->getAlignment()->setTextRotation(90);
     $object->getActiveSheet()->getColumnDimension('AI')->setWidth(20);
    // Rename worksheet
    $object->getActiveSheet()->setTitle('Clients');
    $object->setActiveSheetIndex(0);
    $objWriter = new PHPExcel_Writer_Excel2007($object);

    if (isset($unsub) && ($unsub=='unsub')) {
      $excel_file_name = 'Unsub_UACC_client.xlsx';
    }else{
      $excel_file_name = empty($id_cc_newsletter) ? 'UACC_Client_'.date('m-d-y').'.xlsx' : 'UACC-client-history.xlsx';
    }
    

    if ($url == 'uacc-excel-save') {
      $objWriter->save('./assets/download_excel/'.$excel_file_name);
    }else{
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8');
      header('Content-Disposition: attachment;filename="'.$excel_file_name.'"');
      header('Cache-Control: max-age=0');
      $objWriter->save('php://output');
    }

    
  }

}