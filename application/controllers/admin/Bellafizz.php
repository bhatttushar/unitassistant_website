<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bellafizz extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/bellafizz_model');
		isAdminLoggedIn();
	}

	function index(){
		$data['bellafizz_clients'] = $this->bellafizz_model->bellafizz_list();
		$this->global['pageTitle'] = 'Bellafizz Clients';
		loadAdminViews('admin/bellafizz/bellafizz_clients', $this->global, $data, NULL);
	}

	function delete_bellafizz($id_bellafizz){
    	$result = $this->bellafizz_model->delete_bellafizz($id_bellafizz);
        if($result == true){
        	$this->session->set_flashdata('success', 'Record deleted successfully');
        }else{
        	$this->session->set_flashdata('error', 'Something went wrong try again!!');
        }
        redirect('admin/bellafizz');
	}

	function download_bellafizz_excel($id_bellafizz=""){
		$this->load->library("excel");
	    $object = new PHPExcel();

	    $object->getProperties()->setCreator("Sigit prasetya n")
		->setLastModifiedBy("Sigit prasetya n")
		->setTitle("Creating file excel with php Test Document")
		->setSubject("Creating file excel with php Test Document")
		->setKeywords("phpexcel")
		->setCategory("Test result file");
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

	    $object->setActiveSheetIndex(0);

	    $table_columns = array("Name", "Email", "Login ID", "Password", "Payment Type", "Card Number", "Security Code", "Expiration Date", "Postal Code", "Month to Start Billing", "Company / City", "Address", "City", "State", "Zip", "Website", "Facebook Link", "Referred by", "Updated At");

	    $column = 0;
	    foreach($table_columns as $field){
	      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
	      $column++;
	    }

	    $data = $this->bellafizz_model->fetch_bellafizz_data($id_bellafizz);

	    $row = 2;
	    foreach ($data as $key => $val) {
	    	$object->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $val['name']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $val['email']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $val['loginid']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $val['password']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $val['pmt_type']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $val['cc_number']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $val['cc_code']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $val['cc_expir_date']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $val['cc_zip']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $val['month_billing']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $val['c_city']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $val['address']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $val['city']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $val['state']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $val['zip']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $val['website']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $val['facebook']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(17, $row, $val['referred']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $val['updated_at']);
	      	$row++;
	    }

	    $object->getActiveSheet()->getRowDimension(1)->setRowHeight(140);
		$object->getActiveSheet()->getStyle("A1:FZ1")->getFont()->setBold(true)->setName('Verdana')->setSize(10)
			->getColor()->setRGB('6F6F6F');
		$object->getActiveSheet()->getStyle('A1:FZ1')->getAlignment()->setTextRotation(90);
		$object->getActiveSheet()->getColumnDimension('FM')->setWidth(34);
		$object->getActiveSheet()->getColumnDimension('FN')->setWidth(34);

		// Rename worksheet
		$object->getActiveSheet()->setTitle('Clients');
		$object->setActiveSheetIndex(0);
		$objWriter = new PHPExcel_Writer_Excel2007($object);
	    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
	    header('Content-Disposition: attachment;filename="bellafizz-client.xlsx"');
	    header('Cache-Control: max-age=0');
	    $objWriter->save('php://output');
	}
	

}