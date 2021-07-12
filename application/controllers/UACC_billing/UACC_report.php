<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UACC_report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UACC_billing/UACC_report_model');
        $this->load->helper('UACC/uacc_billing_helper');
        $this->load->library("excel");
    }
    
    function index(){
        $this->global['pageTitle'] = 'UACC Billing Reports';
        UACC_billing_views("UACC_billing/reports", $this->global, NULL, NULL);
    }

    // Fetching UA clients to export to excel
    function download_year_UACC_report($id_cc_newsletter){
        $objPHPExcel = $this->setExcelStyle();

        // Create Header
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', "Invoice Number")
                    ->setCellValue('B1', "Consultant ID")
                    ->setCellValue('C1', 'Client Name')
                    ->setCellValue('D1', 'Month/Year')
                    ->setCellValue('E1', 'Total')
                    ->setCellValue('F1', 'Total Paid')
                    ->setCellValue('G1', 'Due Amount')
                    ->setCellValue('H1', 'Language')
                    ->setCellValue('I1', 'Unsubscribe Date');

        $result = $this->UACC_report_model->get_yearly_report($id_cc_newsletter);

        $row = 2;
        $nInvoiceId = 1;
        foreach($result['data'] as $key => $val){
            $date = strtotime($val['invoice_date']);
            $sDates = date('M/y ', $date);
            $sLanguage = get_newsletters_design($val['cc_newsletter']);
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $nInvoiceId)
                ->setCellValue('B' . $row, $val['consultant_number'])
                ->setCellValue('C' . $row, $val['name'])
                ->setCellValue('D' . $row, $sDates)
                ->setCellValue('E' . $row, $val['total'])
                ->setCellValue('F' . $row, $val['total_paid'])
                ->setCellValue('G' . $row, $val['due_amount'])
                ->setCellValue('H' . $row, $sLanguage)
                ->setCellValue('I' . $row, $val['contract_update_date']);
            $row++;
            $nInvoiceId++;
        }

        foreach($result['total'] as $key => $val){
            $row++;
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('D' . $row, 'Grand Total')
                ->setCellValue('E' . $row, number_format($val['total_amounts'], 2))
                ->setCellValue('F' . $row, number_format($val['total_paids'], 2))
                ->setCellValue('G' . $row, number_format(($val['total_amounts'] - $val['total_paids']), 2));
            $objPHPExcel->getActiveSheet()->getStyle('D' . $row . ':' . 'G' . $row)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $row . ':' . 'D' . $row)->getFont()->setSize(11);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $row . ':' . 'G' . $row)->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $row . ':' . 'G' . $row)->getFont()->setSize(12);
        }

        $objWriter = $this->saveExcelFile($objPHPExcel, 'UACC Invoice Report');
    }

    function all_UACC_invoice_report($time=""){
        $objPHPExcel = $this->setExcelStyle();
        
        $monthFrom = $this->input->post('month_from');
        $monthTo = $this->input->post('month_to');
        $selectedYear = $this->input->post('selectedYear');

        $data = $this->UACC_report_model->get_all_invoice_report($time, $monthFrom, $monthTo, $selectedYear);
        $total = $this->UACC_report_model->get_all_invoice_total($time, $monthFrom, $monthTo, $selectedYear);

        if (empty($data)) {
            $this->session->set_flashdata('error', 'Record not found!!');

            if (empty($time)) {
                redirect('uacc-billing/clients');
            }else{
                redirect('uacc-billing/reports');
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
                ->setCellValue('H1', 'Language')
                ->setCellValue('I1', 'Unsubscribe Date');

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

                $sLanguage = get_newsletters_design($val['cc_newsletter']);

                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A' . $row, $nInvoiceId)
                            ->setCellValue('B' . $row, $val['consultant_number'])
                            ->setCellValue('C' . $row, $val['name'])
                            ->setCellValue('D' . $row, $sDatesmonth)
                            ->setCellValue('E' . $row, number_format($val['total'], 2))
                            ->setCellValue('F' . $row, number_format($val['total_paid'], 2))
                            ->setCellValue('G' . $row, $due_txt)
                            ->setCellValue('H' . $row, $sLanguage)
                            ->setCellValue('I' . $row, $val['contract_update_date']);
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
            $objWriter = $this->saveExcelFile($objPHPExcel, 'All UACC Invoice Report');
        }
    } 

    function total_bank_UACC_report(){
        $objPHPExcel = $this->setExcelStyle('total_bank_report');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', "Account Type")
            ->setCellValue('B1', "Name")
            ->setCellValue('C1', "Detail ID")
            ->setCellValue('D1', 'Amount')
            ->setCellValue('E1', 'Last month invoice total')
            ->setCellValue('F1', 'Language')
            ->setCellValue('G1', 'Unsubscribe Date');
        $data = $this->UACC_report_model->get_total_bank_report();
        $row = 2;
        foreach ($data as $key => $val) {
            $sAccountType = $val['pmt_type'] == 'ACH' ? 'Routing' : 'UACC';
            $sLanguage = get_newsletters_design($val['cc_newsletter']);
            $last_total = $this->UACC_report_model->get_last_total($val['id_cc_newsletter']);
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $sAccountType)  
                ->setCellValue('B' . $row, substr($val['name'], 0,21))
                ->setCellValue('C' . $row, $val['consultant_number'])
                ->setCellValue('D' . $row, number_format($val['total'],2))    
                ->setCellValue('E' . $row, $last_total)    
                ->setCellValue('F' . $row, $sLanguage)
                ->setCellValue('G' . $row, $val['contract_update_date']);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'. $row, $val['consultant_number'], PHPExcel_Cell_DataType::TYPE_STRING);
            $row++;
        }
        $objWriter = $this->saveExcelFile($objPHPExcel, 'All UACC Invoice Totals');
    }

    function bank_UACC_report($time=""){
        $objPHPExcel = $this->setExcelStyle();

        $monthFrom = $this->input->post('month_from');
        $monthTo = $this->input->post('month_to');
        $year_month = $this->input->post('year_month');
        $selectedYear = $this->input->post('selectedYear');

        $data = $this->UACC_report_model->get_bank_report($time, $monthFrom, $monthTo, $year_month, $selectedYear);

        if (empty($data)) {
            $this->session->set_flashdata('error', 'Bank Record not found!!');
            redirect('uacc-billing/reports');
        }else{
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', "Routing")
                ->setCellValue('B1', "Account")
                ->setCellValue('C1', "Account Type")
                ->setCellValue('D1', "Name")
                ->setCellValue('E1', "Detail ID")
                ->setCellValue('F1', 'Month Amount')
                ->setCellValue('G1', 'Account Balance')
                ->setCellValue('H1', 'Billing Alert box')
                ->setCellValue('I1', 'Language')
                ->setCellValue('J1', 'Unsubscribe Date')
                ->setCellValue('K1', 'Created Date')
                ->setCellValue('L1', 'First Bill Date')
                ->setCellValue('M1', 'Start Date')
                ->setCellValue('N1', 'Who Referred You?')
                ->setCellValue('O1', 'Account Credit')
                ->setCellValue('P1', 'Misc charge')
                ->setCellValue('Q1', 'Card Number')
                ->setCellValue('R1', 'Security Code')
                ->setCellValue('S1', 'Expiration Date')
                ->setCellValue('T1', 'Postal Code')
                ->setCellValue('U1', 'Director Title');

                

            $row = 2;
            $nInvoiceId = 1;

            foreach ($data as $key => $val) {
                $sAccountType = $val['pmt_type'] == 'CC' ? 'UACC' : 'Routing';

                $sLanguage = get_newsletters_design($val['cc_newsletter']);

                $bal = GetCCBalance($val['id_cc_newsletter']);
                $due = GetCCTotalDue($val['id_cc_newsletter']);
                if ($due > 0) {
                    $BalDue = $due;
                } elseif ($bal != 0) {
                    $BalDue = '-' . $bal;
                } else {
                    $BalDue = 0;
                }

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $row, $val['cu_routing'])                    
                    ->setCellValue('B' . $row, decryptIt($val['cv_account']))  
                    ->setCellValue('C' . $row, $sAccountType)  
                    ->setCellValue('D' . $row, substr($val['name'], 0, 21))
                    ->setCellValue('E' . $row, $val['consultant_number'])
                    ->setCellValue('F' . $row, number_format($val['total'],2))
                    ->setCellValue('G' . $row, $BalDue)
                    ->setCellValue('H' . $row, $val['billing_alert'])
                    ->setCellValue('I' . $row, $sLanguage)
                    ->setCellValue('J' . $row, $val['contract_update_date'])
                    ->setCellValue('K' . $row, $val['date_created'])
                    ->setCellValue('L' . $row, $val['m_bill_date'])
                    ->setCellValue('M' . $row, $val['month_mailing'])
                    ->setCellValue('N' . $row, $val['reffered_by'])
                    ->setCellValue('O' . $row, $val['special_credit'])
                    ->setCellValue('P' . $row, $val['misc_charge'])
                    ->setCellValue('Q' . $row, $val['cc_number'])
                    ->setCellValue('R' . $row, $val['cc_code'])
                    ->setCellValue('S' . $row, $val['cc_expir_date'])
                    ->setCellValue('T' . $row, $val['cc_zip'])
                    ->setCellValue('U' . $row, $val['cc_director_title']);

                $objPHPExcel->getActiveSheet()->setCellValueExplicit('A'. $row, $val['cu_routing'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $objPHPExcel->getActiveSheet()->setCellValueExplicit('B'. $row, decryptIt($val['cv_account']), PHPExcel_Cell_DataType::TYPE_STRING);
                $row++;
            }

            $objWriter = $this->saveExcelFile($objPHPExcel, 'Bank UACC Report');

        }
    }

    function item_UACC_report(){
        $this->load->helper('UACC/uacc_helper');
        $objPHPExcel = $this->setExcelStyle();
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

        $data = $this->UACC_report_model->get_item_report($monthFrom, $monthTo, $selectedYear);
        

        if (empty($data)) {
            $this->session->set_flashdata('error', 'Record not found');
            redirect('uacc-billing/reports');
        }else{
            $row = 2;
            foreach ($data as $key => $val) {
                detailed_item_report($row, $objPHPExcel, $val);
            }
            $objWriter = $this->saveExcelFile($objPHPExcel, 'Detailed Item UACC Report', $monthFrom, $monthTo);
        }
    }

    function unsubscribed_UACC_report(){
        $objPHPExcel = $this->setExcelStyle('unsubscribed_UACC_report');

        // Create Header
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', "Name")
                ->setCellValue('B1', "Email")
                ->setCellValue('C1', "Phone Number")
                ->setCellValue('D1', "Balance")
                ->setCellValue('E1', "Due Balance");
        $row = 2;
        $data = $this->UACC_report_model->get_unsubcribed_invoice();

        foreach ($data as $key => $val) {
            $nTotal = isset($val['total']) ? $val['total'] : 0;
            $nTotalPaid = isset($val['total_paid']) ? $val['total_paid'] : 0;
            $nDue = $nTotal - $nTotalPaid;
            
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $row, $val['name'])                    
                    ->setCellValue('B' . $row, $val['email'])  
                    ->setCellValue('C' . $row, $val['cell_number'])  
                    ->setCellValue('D' . $row, $nTotal)
                    ->setCellValue('E' . $row, $nDue);

             $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'. $row, $val['cell_number'], PHPExcel_Cell_DataType::TYPE_STRING);
            $row++;
        }

        $objWriter = $this->saveExcelFile($objPHPExcel, 'Unsub UACC Reports');
    }

    function setExcelStyle($unsubscribed_UACC_report="", $total_bank_report=""){
        $objPHPExcel = new PHPExcel(); // Create new PHPExcel object

        if (empty($unsubscribed_UACC_report) && empty($total_bank_report)) {
            $objPHPExcel->getProperties()->setCreator("Sigit prasetya n")
                ->setLastModifiedBy("Sigit prasetya n")
                ->setTitle("Unsubscribed Client Reports")
                ->setSubject("Creating file excel with php Test Document")
                ->setKeywords("phpexcel")
                ->setCategory("Test result file");
        }else{
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

        if ($title != 'Detailed Item UACC Report') {
            $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(140);
        }

        if ($title != 'Unsubscribed UACC Client Reports' || $title !='Detailed Item UACC Report') {
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('C')->setAutoSize(false);
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('D')->setAutoSize(false);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
        }

        
        $objPHPExcel->getActiveSheet()->getStyle("A1:Z1")->getFont()->setBold(true)->setName('Verdana')->setSize(10)
            ->getColor()->setRGB('6F6F6F');
        $objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->getAlignment()->setTextRotation(90);
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle($title);
        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $filename = str_replace(' ', '_', $title); 

        if ($title == 'Detailed Item UACC Report') {
            if($monthFrom == $monthTo) {
                $sDate = date("F", mktime(0, 0, 0,$monthFrom, 10));
            }else {
                $sDate = date("F", mktime(0, 0, 0,$monthFrom, 10)).'-'.date("F", mktime(0, 0, 0,$monthTo, 10));
            }
            $filename = $filename.' of '.$sDate;
        }elseif ($title=='UACC Invoice Report') {
            $filename = $filename.'_'.date('d-M-y');
        }else{
            $filename = $filename;    
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }

}