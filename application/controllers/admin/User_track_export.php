<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_track_export extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/user_track_export_model');
        $this->load->library("excel");
    }
    
    function index(){
        
    }

    function download_whole_track($id_user){
        $objPHPExcel = $this->setExcelStyle();

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Id')
            ->setCellValue('B1', 'User Name')
            ->setCellValue('C1', 'Date')
            ->setCellValue('D1', 'Login Time')
            ->setCellValue('E1', 'Logout Time')
            ->setCellValue('F1', 'Hours');

        $result = $this->user_track_export_model->get_whole_track($id_user);

        $row = 2;
        $nCount = 1;
        foreach($result as $key => $val){
            $date = date("d-m-Y H:i:s", strtotime($val['created_at']));
            $nLoginTime = date('h:i A', strtotime($val['login_time']));  
            $nLogoutTime = date('h:i A', strtotime($val['logout_time']));

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'. $row, $nCount)
                ->setCellValue('B'. $row, $val['first_name'])
                ->setCellValue('C'. $row, $date)
                ->setCellValue('D'. $row, $nLoginTime)
                ->setCellValue('E'. $row, $nLogoutTime)
                ->setCellValue('F'. $row, $val['total_time']);
            $row++;
            $nCount++;
        }
        $objWriter = $this->saveExcelFile($objPHPExcel, 'User Whole Track');
    }

    function download_daily_track($id_user){
        $objPHPExcel = $this->setExcelStyle();

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Id')
            ->setCellValue('B1', 'User Name')
            ->setCellValue('C1', 'Date')
            ->setCellValue('D1', 'Login Count')
            ->setCellValue('E1', 'Logout Count')
            ->setCellValue('F1', 'Hours');

        $result = $this->user_track_export_model->get_track_data($id_user);

        $row = 2;
        $nCount = 1;
        foreach($result as $key => $val){
            $date = date("d-m-Y H:i:s", strtotime($val['created_at']));
            $hours = dayLogsTimeInfo($val['created_at'], $id_user, 'Daily');

            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$row, $nCount)
                        ->setCellValue('B'.$row, $val['first_name'])
                        ->setCellValue('C'.$row, $date)
                        ->setCellValue('D'.$row, $val['login_count'])
                        ->setCellValue('E'.$row, $val['logout_count'])
                        ->setCellValue('F'.$row,  date("H:i:s", $hours));
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$row, $val['created_at'], PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('F'.$row, date("H:i:s", $hours), PHPExcel_Cell_DataType::TYPE_STRING);
            $row++;
            $nCount++;
        }

        $objWriter = $this->saveExcelFile($objPHPExcel, 'User Daily Track');
    }

     function download_weekly_track($id_user){
        $objPHPExcel = $this->setExcelStyle();

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Id')
            ->setCellValue('B1', 'User Name')
            ->setCellValue('C1', 'Date')
            ->setCellValue('D1', 'Login Count')
            ->setCellValue('E1', 'Logout Count')
            ->setCellValue('F1', 'Hours');

        $result = $this->user_track_export_model->get_track_data($id_user, 'weekly');
        
        $row = 2;
        $nCount = 1;
        foreach($result as $key => $val){
            $date = date("d-m-Y H:i:s", strtotime($val['created_at']));
            $hours = dayLogsTimeInfo($val['created_at'], $id_user, 'weekly');

            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$row, $nCount)
                        ->setCellValue('B'.$row, $val['first_name'])
                        ->setCellValue('C'.$row, $date)
                        ->setCellValue('D'.$row, $val['login_count'])
                        ->setCellValue('E'.$row, $val['logout_count'])
                        ->setCellValue('F'.$row,  date("H:i:s", $hours));
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$row, $val['created_at'], PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('F'.$row, date("H:i:s", $hours), PHPExcel_Cell_DataType::TYPE_STRING);
            $row++;
            $nCount++;
        }

        $objWriter = $this->saveExcelFile($objPHPExcel, 'User Weekly Track');
    }    

    function setExcelStyle(){
        $objPHPExcel = new PHPExcel(); // Create new PHPExcel object

        $objPHPExcel->getProperties()->setCreator("Sigit prasetya n")
                ->setLastModifiedBy("Sigit prasetya n")
                ->setTitle("Unsubscribed Client Reports")
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

        return $objPHPExcel;
    }

    function saveExcelFile($objPHPExcel, $title){
        $objPHPExcel->getActiveSheet()->getStyle("A1:Z1")->getFont()->setBold(true)->setName('Verdana')->setSize(10)
            ->getColor()->setRGB('6F6F6F');
        $objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->getAlignment()->setTextRotation(90);
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle($title);
        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $filename = str_replace(' ', '_', $title); 
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
        header('Content-Disposition: attachment;filename="'.$filename.'-'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }


}