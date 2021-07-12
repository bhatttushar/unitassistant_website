<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_uacc_excel extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('UACC_billing/upload_uacc_excel_model');
        $this->load->library('excel');
	}

    function upload_credit_excel(){
        if (!empty($_FILES['credit_excel']['name'])) {
            $config['upload_path'] = 'assets/uploads/UACC/upload_credit_excel/';
            $config['allowed_types'] = 'xlsx|xls';
            $this->load->library('upload', $config);
            $sInputFileName = '';
            if ($this->upload->do_upload('credit_excel')) {
                $data = $this->upload->data();
                $sInputFileName = $config['upload_path'].$data['file_name'];
            }

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($sInputFileName);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $nHighestRow = $objWorksheet->getHighestRow();
            $nHighestColumn = $objWorksheet->getHighestColumn();
            $nHighestColumnIndex = PHPExcel_Cell::columnIndexFromString($nHighestColumn);
            for ($nRow = 2; $nRow <= $nHighestRow; ++$nRow) {
                $aRows = array();
                for ($nCol = 0; $nCol <= $nHighestColumnIndex; ++$nCol) {
                    $aRows[] = $objWorksheet->getCellByColumnAndRow($nCol, $nRow)->getValue();
                }
                $sUpdate = $this->upload_uacc_excel_model->update_uacc($aRows[0], $aRows[1]);
            }
            redirect('uacc-billing/clients');
        }
    }

    function upload_UACC_balance_excel(){
        if (!empty($_FILES['excel_price']['name'])) {
            
            $config['upload_path'] = 'assets/uploads/UACC/upload_balance_excel/';
            $config['allowed_types'] = 'xlsx|xls';
            $this->load->library('upload', $config);
            $sInputFileName = '';
            if ($this->upload->do_upload('excel_price')) {
                $data = $this->upload->data();
                $sInputFileName = $config['upload_path'].$data['file_name'];
            }
            try {
                $inputFileType = PHPExcel_IOFactory::identify($sInputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($sInputFileName);
            } catch(Exception $e) {
                die('Error loading file "' . pathinfo($sInputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            }

            $objPHPExcel = $objReader->load($sInputFileName);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $nHighestRow = $objWorksheet->getHighestRow();
            $nHighestColumn = $objWorksheet->getHighestColumn();
            $nHighestColumnIndex = PHPExcel_Cell::columnIndexFromString($nHighestColumn);

            for ($nRow = 2; $nRow <= $nHighestRow; $nRow++) {
                $aRows = array();
                for ($nCol = 0; $nCol <= $nHighestColumnIndex; ++$nCol) {
                    $aRows[] = $objWorksheet->getCellByColumnAndRow($nCol, $nRow)->getValue();
                }
                $aTotal = $this->upload_uacc_excel_model->getTotal($aRows[0]);

                $amount = $aRows[1];

                if ($aTotal['last_paid'] != $amount || $aTotal['due_amount'] > 0) {
                    if (!empty($aTotal)) {
                        if ($aTotal['due_amount'] > 0 || $aTotal['payment_status'] != 'S') {
                            $fTotalpaid = (float) $aTotal['total_paid'] + (float) $amount;
                            $nFinalTotal = (float) $aTotal['total'] - $fTotalpaid;
                            if ($aTotal['total'] <= $fTotalpaid) {
                                $bal = $fTotalpaid - $aTotal['total'];
                                $sPayStatus = 'S';
                                $fTotalpaid = $aTotal['total'];
                                $nFinalTotal = 0;
                            } else {
                                $sPayStatus = 'R';
                                $bal = 0;
                            }
                            $sUpdate = $this->upload_uacc_excel_model->update_invoice($amount, $nFinalTotal, $fTotalpaid, $sPayStatus, $aTotal['id_cc_invoice']);
                            if ($bal > 0) {
                                $Ocount = $this->upload_uacc_excel_model->get_invoice_count($aTotal['id_cc_newsletter']);
                                if ($Ocount['cont'] > 0) {
                                    for ($i = 1; $i <= $Ocount['cont']; $i++) {
                                        if ((float) $bal > 0) {
                                            $GetOld=$this->upload_uacc_excel_model->get_old_invoice($aTotal['id_cc_newsletter']);
                                            if (count($GetOld) > 0) {
                                                $OTotalpaid = (float) $GetOld['total_paid'] + $bal;
                                                $OFinalTotal = (float) $GetOld['total'] - $OTotalpaid;
                                                if ($GetOld['total'] <= $OTotalpaid) {
                                                    $OPayStatus = 'S';
                                                    if ($GetOld['due_amount'] < $OTotalpaid) {
                                                        $OFinalTotal = 0;
                                                        $OTotalpaid = $GetOld['total'];
                                                        $Obal = $bal - $GetOld['total'];
                                                    }
                                                } else {
                                                    $OTotalpaid = (float) $GetOld['total_paid'] + $bal;
                                                    $OFinalTotal = (float) $GetOld['total'] - $OTotalpaid;
                                                    $OPayStatus = 'R';
                                                    $Obal = $bal - $GetOld['total'];
                                                }
                                                $sUpdate = $this->upload_uacc_excel_model->update_invoice($amount, $OFinalTotal, $OTotalpaid, $OPayStatus, $GetOld['id_cc_invoice']);
                                            } else {
                                                SetCCBalance($aTotal['id_cc_newsletter'], $bal);
                                            }
                                            $bal = 0;
                                        }
                                    }
                                } else {
                                    $bal = (float) $aTotal['total'] - $fTotalpaid;
                                    $TotBAL = abs($bal);
                                    SetCCBalance($aTotal['id_cc_newsletter'], $TotBAL);
                                }
                            }
                        } else {
                            //Paid and success
                            $GOLD = GetCCBalance($aTotal['id_cc_newsletter']);
                            $bal = $amount + $GOLD;
                            SetCCBalance($aTotal['id_cc_newsletter'], $bal);
                            if ($bal > 0) {
                                $Ocount = $this->upload_uacc_excel_model->get_invoice_count($aTotal['id_cc_newsletter']);
                                if ($Ocount['cont'] > 0) {
                                    for ($i = 1; $i <= $Ocount['cont']; $i++) {
                                        if (GetCCBalance($aTotal['id_cc_newsletter']) > 0) {
                                            $GetOld=$this->upload_uacc_excel_model->get_old_invoice($aTotal['id_cc_newsletter']);
                                            if (count($GetOld) > 0) {
                                                $OTotalpaid = (float) $GetOld['total_paid'] + $bal;
                                                $OFinalTotal = (float) $GetOld['total'] - $OTotalpaid;
                                                if ($GetOld['total'] <= $OTotalpaid) {
                                                    $OPayStatus = 'S';
                                                    $Obal = abs($OFinalTotal);
                                                    $OFinalTotal = 0;
                                                    $OTotalpaid = $GetOld['total'];
                                                } else {
                                                    $OTotalpaid = (float) $GetOld['total_paid'] + $bal;
                                                    $OFinalTotal = (float) $GetOld['total'] - $OTotalpaid;
                                                    $OPayStatus = 'R';
                                                    $Obal = $bal - $GetOld['total'];
                                                }
                                                $sUpdate = $this->upload_uacc_excel_model->update_invoice($amount, $OFinalTotal, $OTotalpaid, $OPayStatus, $GetOld['id_cc_invoice']);
                                                SetCCBalance($aTotal['id_cc_newsletter'], $Obal);
                                            }
                                        }
                                    }
                                } else {
                                    $bal = (float) $aTotal['total'] - $fTotalpaid;
                                    $TotBAL = abs($bal);
                                    SetCCBalance($aTotal['id_cc_newsletter'], $TotBAL);
                                }
                            }
                        }
                    }
                }
            }

            //if (count($aTotal) > 0) {
                redirect('uacc-billing/clients');
            // }
            
        }
    }

}