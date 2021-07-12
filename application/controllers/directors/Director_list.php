<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Director_list extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('directors/director_list_model');
		$this->load->helper('directors/director_helper');
		$this->load->helper('directors/director_mail_helper');
		isUserLoggedIn();
	}

	function index(){
		$this->global['pageTitle'] = 'Director List';
		$res['data']=$this->director_list_model->director_listing();
		loadFrontViews('directors/director-list', $this->global,$res, NULL);
	}
	

	/*function AjaxData(){
		if (!empty($this->input->post()) && !empty($this->input->post('Records')) ) {
			$val = $this->input->post('Records');
			$data = $this->input->post();
			$searchValue = $data['search']['value']; // Search value
	        $draw = $data['draw'];
	        $row = $data['start'];
	        $rowperpage = $data['length']; // Rows display per page
	        $columnIndex = $data['order'][0]['column']; // Column index
	        $columnName = $data['columns'][$columnIndex]['data']; // Column name
	        $columnSortOrder = $data['order'][0]['dir']; // asc or desc

			$res=$this->director_list_model->$val($data,$searchValue,$row,$rowperpage,$columnName,$columnSortOrder);
			$count = ($row + 1);
	        $return = array();
	        foreach ($res['details'] as $value) {
	            $action = '';
	            if($value['design_approve_status'] == 3) { 
	                $action .= '<a href="viewDetail.php?id_client_newsletter='.$value['id_newsletter'].'" title="Click to view clients requested changes"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;';
	            }
	            $action .= '<a href="'.base_url("edit-director/".$value['id_newsletter']).'" title="Click to edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
	            <a href="'.base_url("client-emails/".$value['id_newsletter']).'" title="Click to view client emails"><i class="fa fa-list"></i></a>&nbsp;&nbsp;&nbsp;';
	            
	            if (IsInTbc($value['consultant_number']) <= 0) {
	                $action .= '<button type="button" data-id="'.$value['id_newsletter'].'" class="btn btn-sm add-in-uacc btn-warning">Add UACC</button>';
	            }

	            if(!empty((int)$value['updated_at'])) {
	                $date = date_create($value['updated_at']);
	                $update_date = date_format($date,"m-d-Y");       
	            }else {  
	                $update_date = '';
	            }

	            $return[] = array( 
	                'number'=> $count,
	                'action'=>$action,
	                'created_at'=> (empty($value['created_at']) ? '' : date('m/d/Y', strtotime($value['created_at']))),
	                'updated_by'=>$value['updated_by'],
	                'updated_at'=>$update_date,
	                'contract_update_date'=>$value['contract_update_date'],
	                'newsletters_design'=> get_newsletters_design($value['newsletters_design']),
	                'name'=> $value['name'],
	                'director_title'=>$value['director_title'],
	                'beatly_url'=>$value['beatly_url'],
	                'beatly_url_one'=>$value['beatly_url_one'],
	                'beatly_url_two'=>$value['beatly_url_two'],
	                'consultant_number'=>$value['consultant_number'],
	                'intouch_password'=>$value['intouch_password'],
	                'unit_size'=>$value['unit_size'],
	                'package_pricing'=> GetPackageValue($value['package'],$value['unit_size']),
	                't_package'=>$value['package_pricing'],
	                'total_text_program'=>Get_total_text_program($value['package'], $value['total_text_program']),
	                'total_text_program7'=>Get_total_text_program7($value['package'], $value['total_text_program7']),
	                'point_value'=>$value['point_value'],
	                'design_one'=> Get_design_approve_status($value['design_one'], $value['design_approve_status']),
	                'last_email_update_date'=>(empty($value['last_email_update_date']) ? '' : $value['last_email_update_date']),
	                'approved_date'=> (empty($value['approved_date']) ? '' : $value['approved_date'])
	            );
	            $count++;    
	        }
	        $response = array(
	          "draw" => intval($draw),
	          "query" => $res['query'],
	          "iTotalRecords" => $res['total_record_filter'],
	          "iTotalDisplayRecords" => $res['total_records'],
	          "aaData" => $return
	        );

	        echo json_encode( $response );
			exit();
		}
	}*/

	function addToUACC($id_newsletter){
		$return = $this->director_list_model->getDirectorData($id_newsletter);
	
		if ($return > 0) {
			$this->session->set_flashdata('UACCsuccess', 'Record added successfully in UACC');
			redirect('directors','refresh');
			exit();
		}else {
			$this->session->set_flashdata('UACCerror', 'Record not added successfully in UACC');
			redirect('directors','refresh');
			exit();
		}
	}


	function client_emails($id_newsletter) {
		$data['emails'] = $this->director_list_model->get_client_emails($id_newsletter);
		$this->global['pageTitle'] = 'Client Emails';
		loadFrontViews('directors/ClientEmails', $this->global, $data, NULL);
	}

	function view_client_email($id_newsletter, $purpose) {
		$purpose = str_replace('%20', ' ', $purpose);
		$data['data'] = $this->director_list_model->get_view_client_email($id_newsletter, $purpose);
		$this->global['pageTitle'] = 'View Client Emails';
		loadFrontViews('directors/EmailsDetails', $this->global, $data, NULL);
	}


}