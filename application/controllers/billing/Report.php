<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('billing/report_model');
        $this->load->helper('directors/director_helper');
        $this->load->helper('directors/billing_helper');
        $this->load->library("excel");
    }
    
    function index(){
        $this->global['pageTitle'] = 'Unit Assistant : Billing Reports';
        BillingViews("billing/reports", $this->global, NULL, NULL);
    }

    // Fetching UA clients to export to excel
    function download_year_report($id_newsletter){

        $objPHPExcel = $this->setExcelStyle();

        $msg = "Unit Assistant Inc.\r All Transaction for ".getName($id_newsletter)." \r January through December ".date('Y')."";
          // Create Header
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', $msg);
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A2', "Type")
                    ->setCellValue('B2', "Date")
                    ->setCellValue('C2', "Account")
                    ->setCellValue('D2', 'Amount');

        $result = $this->report_model->get_yearly_report($id_newsletter);

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:D1');
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true)
                    ->setName('Verdana')
                    ->setSize(12)
                    ->getColor()->setRGB('000000');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(60);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->applyFromArray(
            array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $row = 3;
        $nInvoiceId = 1;
        foreach($result['data'] as $key => $val){

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, 'Invoice')
                ->setCellValue('B' . $row, $val['invoice_date'])
                ->setCellValue('C' . $row, 'Accounts Receivable ')
                ->setCellValue('D' . $row, $val['total']);
                $row++;
                
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $row, 'Payment')
                        ->setCellValue('B' . $row, $val['payment_date'])
                        ->setCellValue('C' . $row, 'Undeposited Funds')
                        ->setCellValue('D' . $row, $val['total_paid']);
                $row++;
                $nInvoiceId++;
        }

        $objWriter = $this->saveExcelFile($objPHPExcel, 'Invoice Report');
    }

    function all_invoice_report($time=""){
        $objPHPExcel = $this->setExcelStyle();
        
        $monthFrom = $this->input->post('month_from');
        $monthTo = $this->input->post('month_to');
        $selectedYear = $this->input->post('selectedYear');

        $data = $this->report_model->get_all_invoice_report($time, $monthFrom, $monthTo, $selectedYear);
        $total = $this->report_model->get_all_invoice_total($time, $monthFrom, $monthTo, $selectedYear);

        if (empty($data)) {
            $this->session->set_flashdata('error', 'Record not found!!');

            if (empty($time)) {
                redirect('billing/clients');
            }else{
                redirect('billing/reports');
            }
        }else{
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', "Invoice Number")
                ->setCellValue('B1', "Consultant ID")
                ->setCellValue('C1', 'Client Name')
                ->setCellValue('D1', 'Month/Year')
                ->setCellValue('E1', 'Total')
                ->setCellValue('F1', 'Total Paid')
                ->setCellValue('G1', 'Due Amount')
                ->setCellValue('H1', 'Credit Balance')
                ->setCellValue('I1', 'Billing Notes')
                ->setCellValue('J1', 'Special Credit Reason')
                ->setCellValue('K1', 'Language')
                ->setCellValue('L1', 'Unsubscribe Date');

            $row = 2;
            $nInvoiceId = 1;

            foreach ($data as $key => $val) {
                $dInvoiceDate = isset($val['invoice_date']) ? $val['invoice_date'] : '';
                $nDueAmount = number_format($val['total']-$val['total_paid'], 2);
                $due_txt = ($nDueAmount==0 || $nDueAmount < 0) ? 'No Due' : $nDueAmount;
                $credit = ($nDueAmount < 0) ? abs($nDueAmount) : 'No Credit';

                if (strpos($dInvoiceDate, ',') !== false) {
                    $aArray = explode(',', $dInvoiceDate);
                    $sDatesmonth = '';
                    foreach ($aArray as $key => $value) {
                        $sDatesmonth .= date('M/y', strtotime($value)) . ', ';
                    }
                } else {
                    $sDatesmonth = date('M/y', strtotime($dInvoiceDate));
                }

                $sLanguage = get_newsletters_design($val['newsletters_design']);

                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $row, $nInvoiceId)
                        ->setCellValue('B' . $row, $val['consultant_number'])
                        ->setCellValue('C' . $row, $val['name'])
                        ->setCellValue('D' . $row, $sDatesmonth)
                        ->setCellValue('E' . $row, number_format($val['total'], 2))
                        ->setCellValue('F' . $row, number_format($val['total_paid'], 2))
                        ->setCellValue('G' . $row, $due_txt)
                        ->setCellValue('H' . $row, $credit)
                        ->setCellValue('I' . $row, $val['billing_alert'])
                        ->setCellValue('J' . $row, $val['package_note'])
                        ->setCellValue('K' . $row, $sLanguage)
                        ->setCellValue('L' . $row, $val['contract_update_date']);
                $row++;
                $nInvoiceId++;
            }

            foreach ($total as $key => $value) {
                $row++;

                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D' . $row, 'Grand Total')
                        ->setCellValue('E' . $row, number_format($value['total_amounts'], 2))
                        ->setCellValue('F' . $row, number_format($value['total_paids'], 2))
                        ->setCellValue('G' . $row, number_format(($value['total_amounts'] - $value['total_paids']), 2));
                $objPHPExcel->getActiveSheet()->getStyle('D' . $row . ':' . 'G' . $row)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('D' . $row . ':' . 'D' . $row)->getFont()->setSize(11);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $row . ':' . 'G' . $row)->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->getStyle('H' . $row . ':' . 'G' . $row)->getFont()->setSize(12);
            }

            $objWriter = $this->saveExcelFile($objPHPExcel, 'All Invoice Report');

        }
    } 

    function bank_report($time=""){

        $objPHPExcel = $this->setExcelStyle();

        $monthFrom = $this->input->post('month_from');
        $monthTo = $this->input->post('month_to');
        $year_month = $this->input->post('year_month');
        $selectedYear = $this->input->post('selectedYear');
        $data = $this->report_model->get_bank_report($time, $monthFrom, $monthTo, $year_month, $selectedYear);
        
        if (empty($data)) {
            $this->session->set_flashdata('error', 'Bank Record not found!!');
            redirect('billing/reports');
        }else{
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', "Routing")
                ->setCellValue('B1', "Account")
                ->setCellValue('C1', "Account Type")
                ->setCellValue('D1', "Name")
                ->setCellValue('E1', "Detail ID")
                ->setCellValue('F1', 'Month Amount')
                ->setCellValue('G1', 'Account Balance')
                ->setCellValue('H1', 'Billing Alert Box')
                ->setCellValue('I1', 'Special Credit')
                ->setCellValue('J1', 'Special Credit Reason')
                ->setCellValue('K1', 'Language')
                ->setCellValue('L1', 'Unsubscribe Date')
                ->setCellValue('M1', 'Created Date')
                ->setCellValue('N1', 'First Bill Date')
                ->setCellValue('O1', 'Card Number')
                ->setCellValue('P1', 'Security Code')
                ->setCellValue('Q1', 'Expiration Date')
                ->setCellValue('R1', 'Postal Code')
                ->setCellValue('S1', 'Director Title')
                ->setCellValue('T1', 'Invoice Note');

            $row = 2;
            $nInvoiceId = 1;

            foreach ($data as $key => $val) {
                $routing = isset($val['cu_routing']) ? $val['cu_routing'] : '';
                $cv_account = isset($val['cv_account']) ? decryptIt($val['cv_account']) : '';
                $sAccountType = isset($val['account_detail']) ? ($val['account_detail'] == 'Y' ? 'Routing' : 'CC') : '';
                $name = isset($val['name']) ? substr($val['name'], 0, 21) : '';
                $consultant_number = isset($val['consultant_number']) ? $val['consultant_number'] : '';
                $sLanguage = isset($val['newsletters_design']) ? get_newsletters_design($val['newsletters_design']) : '';

                $total_due = isset($val['total_due']) ? number_format($val['total_due'], 2) : 0;
                $bal = isset($val['id_newsletter']) ? GetBalance($val['id_newsletter']) : 0;
                $due = isset($val['id_newsletter']) ? GetTotalDue($val['id_newsletter']) : 0;

                if ($due > 0) {
                    $BalDue = $due;
                } elseif ($bal != 0) {
                    $BalDue = '-' . $bal;
                } else {
                    $BalDue = 0;
                }

                $billing_alert =  isset($val['billing_alert']) ? $val['billing_alert'] : '';
                $special_credit =  isset($val['special_credit']) ? $val['special_credit'] : '';
                $package_note =  isset($val['package_note']) ? $val['package_note'] : '';
                $contract_update_date=isset($val['contract_update_date']) ? $val['contract_update_date'] : '';
                $date_created =  isset($val['date_created']) ? $val['date_created'] : '';
                $first_bill_date =  isset($val['first_bill_date']) ? $val['first_bill_date'] : '';
                $cc_number =  isset($val['cc_number']) ? $val['cc_number'] : '';
                $cc_code =  isset($val['cc_code']) ? $val['cc_code'] : '';
                $cc_expir_date =  isset($val['cc_expir_date']) ? $val['cc_expir_date'] : '';
                $cc_zip =  isset($val['cc_zip']) ? $val['cc_zip'] : '';
                $director_title =  isset($val['director_title']) ? $val['director_title'] : '';
                $invoice_note =  isset($val['invoice_note']) ? $val['invoice_note'] : '';

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $row, $routing)
                    ->setCellValue('B' . $row, $cv_account)
                    ->setCellValue('C' . $row, $sAccountType)
                    ->setCellValue('D' . $row, $name)
                    ->setCellValue('E' . $row, $consultant_number)
                    ->setCellValue('F' . $row, $total_due)
                    ->setCellValue('G' . $row, $BalDue)
                    ->setCellValue('H' . $row, $billing_alert)
                    ->setCellValue('I' . $row, $special_credit)
                    ->setCellValue('J' . $row, $package_note)
                    ->setCellValue('K' . $row, $sLanguage)
                    ->setCellValue('L' . $row, $contract_update_date)
                    ->setCellValue('M' . $row, $date_created)
                    ->setCellValue('N' . $row, $first_bill_date)
                    ->setCellValue('O' . $row, $cc_number)
                    ->setCellValue('P' . $row, $cc_code)
                    ->setCellValue('Q' . $row, $cc_expir_date)
                    ->setCellValue('R' . $row, $cc_zip)
                    ->setCellValue('S' . $row, $director_title)
                    ->setCellValue('T' . $row, $invoice_note);

                $objPHPExcel->getActiveSheet()->setCellValueExplicit('A' . $row, $routing, PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('B' . $row, $cv_account, PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('O' . $row, $cc_number, PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('P' . $row, $cc_code, PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('Q' . $row, $cc_expir_date, PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit('R' . $row, $cc_zip, PHPExcel_Cell_DataType::TYPE_STRING);
                $row++;
            }

            $objWriter = $this->saveExcelFile($objPHPExcel, 'Bank Report');

        }
    }

    function billing_changes_report(){
        $objPHPExcel = $this->setExcelStyle();
        
        $monthFrom = $this->input->post('month_from');
        $monthTo = $this->input->post('month_to');
        $current_year = $this->input->post('current_year');
        $selectedYear = $this->input->post('selectedYear');

        $data = $this->report_model->get_billing_changes_report();

        if (empty($data)) {
            $this->session->set_flashdata('error', 'Bank Record not found!!');
            redirect('billing/index');
        }else{
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', "Name")
                ->setCellValue('B1', "Consultant ID")
                ->setCellValue('C1', 'Billing Alert Box')
                ->setCellValue('D1', 'Special Credit Amount')
                ->setCellValue('E1', 'Special Credit Reason')
                ->setCellValue('F1', 'Account Credit')
                ->setCellValue('G1', 'Credit Notes')
                ->setCellValue('H1', 'Misc Charge Amount')
                ->setCellValue('I1', 'Misc Charge')
                ->setCellValue('J1', 'Unsubscribe Date')
                ->setCellValue('K1', 'Created Date')
                ->setCellValue('L1', 'First Bill Date')
                ->setCellValue('M1', 'Reffered By')
                ->setCellValue('N1', 'Invoice Note');

            $row = 2;
            $nInvoiceId = 1;

            foreach ($data as $key => $val) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $row, substr($val['name'], 0, 21))
                    ->setCellValue('B' . $row, $val['consultant_number'])
                    ->setCellValue('C' . $row, $val['billing_alert'])
                    ->setCellValue('D' . $row, $val['special_credit'])
                    ->setCellValue('E' . $row, $val['package_note'])
                    ->setCellValue('F' . $row, $val['special_creadit'])
                    ->setCellValue('G' . $row, $val['credit_notes'])
                    ->setCellValue('H' . $row, $val['misc_charge'])
                    ->setCellValue('I' . $row, $val['misc_description'])
                    ->setCellValue('J' . $row, $val['contract_update_date'])
                    ->setCellValue('K' . $row, $val['created_at'])
                    ->setCellValue('L' . $row, $val['first_bill_date'])
                    ->setCellValue('M' . $row, $val['reffered_by'])
                    ->setCellValue('N' . $row, $val['invoice_note']);
                $row++;
            }
            $objWriter = $this->saveExcelFile($objPHPExcel, 'Billing Changes');
        }
    }

    function item_report(){
        $this->load->helper('directors/report_helper');
        $objPHPExcel = $this->setExcelStyle('item_report');
        $monthFrom = $this->input->post('month_from');
        $monthTo = $this->input->post('month_to');
        $selectedYear = $this->input->post('selectedYear');

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Type')
                    ->setCellValue('B1', 'Date')
                    ->setCellValue('C1', 'Name')
                    ->setCellValue('D1', 'Item')
                    ->setCellValue('E1', 'Qty')
                    ->setCellValue('F1', 'Sales Price')
                    ->setCellValue('G1', 'Amount');

        $data = $this->report_model->get_item_report($monthFrom, $monthTo, $selectedYear);


        if (empty($data)) {
            $this->session->set_flashdata('error', 'Record not found');
            redirect('billing/reports');
        }else{
            $row = 2;
            foreach ($data as $key => $val) {
                detailed_item_report($row, $objPHPExcel, $val);
            }

            $objWriter = $this->saveExcelFile($objPHPExcel, 'Detailed Item Report', $monthFrom, $monthTo);

        }
    }

    function unsubscribed_report(){
        $objPHPExcel = $this->setExcelStyle('unsubscribed_report');

        // Create Header
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', "Name")
                ->setCellValue('B1', "Email")
                ->setCellValue('C1', "Phone Number")
                ->setCellValue('D1', "Balance")
                ->setCellValue('E1', "Due Balance")
                ->setCellValue('F1', "Billing Notes")
                ->setCellValue('G1', "Special Credit Reason");
        $row = 2;
        
        $data = $this->report_model->get_unsubcribed_invoice();

        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $nTotal = isset($val['total']) ? $val['total'] : 0;
                $nTotalPaid = isset($val['total_paid']) ? $val['total_paid'] : 0;
                $nDue = $nTotal - $nTotalPaid;
                
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $row, $val['name'])                    
                        ->setCellValue('B' . $row, $val['email'])  
                        ->setCellValue('C' . $row, $val['cell_number'])  
                        ->setCellValue('D' . $row, $nTotal)
                        ->setCellValue('E' . $row, $nDue)
                        ->setCellValue('F' . $row, $val['billing_alert'])
                        ->setCellValue('G' . $row, $val['package_note']);
                 $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'. $row, $val['cell_number'], PHPExcel_Cell_DataType::TYPE_STRING);
                $row++;
            }

            $objWriter = $this->saveExcelFile($objPHPExcel, 'Unsubscribed Client Reports');
        }
    }

    function setExcelStyle($unsubscribed_report="", $item_report=""){
        $objPHPExcel = new PHPExcel(); // Create new PHPExcel object

        if (empty($unsubscribed_report) && empty($item_report)) {
            $objPHPExcel->getProperties()->setCreator("Sigit prasetya n")
                ->setLastModifiedBy("Sigit prasetya n")
                ->setTitle("Creating file excel with php Test Document")
                ->setSubject("Creating file excel with php Test Document")
                ->setKeywords("phpexcel")
                ->setCategory("Test result file");
        }elseif (!empty($item_report)) {
            $objPHPExcel->getProperties()->setCreator("Unit Assistant")
                ->setLastModifiedBy("Unit Assistant")
                ->setTitle("Unit Assistant")
                ->setSubject("Unit Assistant")
                ->setKeywords("phpexcel")
                ->setCategory("Unit Assistant");
        }

        // create style

        $default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '1006A3'),
        );
        $style_header = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'E1E0F7'),
            ),
            'font' => array(
                'bold' => true,
                'size' => 16,
            ),
        );
        $style_content = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'eeeeee'),
            ),
            'font' => array(
                'size' => 12,
            ),
        );

        return $objPHPExcel;
    }

    function saveExcelFile($objPHPExcel, $title, $monthFrom="", $monthTo=""){

        if ($title != 'Detailed Item Report') {
            $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(140);
        }

        if ($title != 'Unsubscribed Client Reports' || $title !='Detailed Item Report') {
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('C')->setAutoSize(false);
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('D')->setAutoSize(false);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
        }

        
        $objPHPExcel->getActiveSheet()->getStyle("A1:Z1")->getFont()->setBold(true)->setName('Verdana')->setSize(10)
            ->getColor()->setRGB('6F6F6F');

            if ($title == 'Invoice Report') {
                $objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->getAlignment()->setTextRotation(0);
            }else{
                $objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->getAlignment()->setTextRotation(90);
            }
        

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle($title);
        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

        $filename = str_replace(' ', '_', $title); 

        if ($title == 'Detailed Item Report') {
            if($monthFrom == $monthTo) {
                $sDate = date("F", mktime(0, 0, 0,$monthFrom, 10));
            }else {
                $sDate = date("F", mktime(0, 0, 0,$monthFrom, 10)).'-'.date("F", mktime(0, 0, 0,$monthTo, 10));
            }
            $filename = $filename.' of '.$sDate;
        }elseif ($title=='Invoice Report') {
            $filename = $filename.'_'.date('d-M-y');
        }else{
            $filename = $filename;    
        }

       header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }

}