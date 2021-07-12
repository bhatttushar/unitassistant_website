<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UACC_list extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('UACC/UACC_list_model');
		$this->load->helper('UACC/uacc');
		isUserLoggedIn();
	}

	function index(){
		$this->global['pageTitle'] = 'Customer Communication List';
		$res['data']=$this->UACC_list_model->uacc_listing();
		loadFrontViews('UACC/UACC-list', $this->global,$res, NULL);
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
	        if($data['order'][0]['column'] == 0){
		        $columnName = 'id_cc_newsletter'; // Column name
		        $columnSortOrder = 'DESC'; // asc or desc   
		    }else{
		        $columnName = $data['columns'][$columnIndex]['data']; // Column name
		        $columnSortOrder = $data['order'][0]['dir']; // asc or desc         
		    }

			$res=$this->UACC_list_model->$val($data,$searchValue,$row,$rowperpage,$columnName,$columnSortOrder);

			$count = ($row + 1);
	        $return = array();
	        foreach ($res['details'] as $value) {

        		$IsUA = is_ua($value['consultant_number']);
        		$IsUA = empty($IsUA) ? '' : 'X';

	            $action = '<a href="'.base_url('edit-uacc/'.$value['id_cc_newsletter']).'" title="Click to edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
	            	
	            	<a href="'.base_url('uacc-client-emails/'.$value['id_cc_newsletter']).'" title="View Email History"><i class="fa fa-list"></i></a>&nbsp;&nbsp;&nbsp;';

	            $return[] = array( 
	                'number'=> $count,
		            'action'=> $action,
		            'name'=> $value['name'],
		            'email'=> $value['email'],
		            'cell_number'=> $value['cell_number'],
		            'contract_update_date'=>$value['contract_update_date'],
		            'status_done'=> ($value['status_done'] == '1' ? "X" : ''),
		            'consultant_number'=>$value['consultant_number'],
		            'intouch_password'=>$value['intouch_password'],
		            'national_area'=>$value['national_area'],
		            'seminar_affiliation'=>$value['seminar_affiliation'],
		            'm_bill_date'=> $value['m_bill_date'],
		            'isUa' =>$IsUA,
		            'created_at'=> $value['created_at'],
		            'reffered_by'=>$value['reffered_by'],
		            'digital_biz_card'=>($value['digital_biz_card']=='1' ? 'X' : '')
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

	function uacc_client_emails($id_cc_newsletter) {
		$data['emails'] = $this->UACC_list_model->get_uacc_client_emails($id_cc_newsletter);
		$this->global['pageTitle'] = 'UACC Client Emails';
		loadFrontViews('UACC/UACC-client-emails', $this->global, $data, NULL);
	}

	function view_uacc_client_email($id_cc_newsletter, $purpose) {
		$purpose = str_replace('%20', ' ', $purpose);
		$data['data'] = $this->UACC_list_model->get_view_uacc_client_email($id_cc_newsletter, $purpose);
		$this->global['pageTitle'] = 'View UACC Client Emails';
		loadFrontViews('UACC/UACC-email-details', $this->global, $data, NULL);
	}

	// Unsub UACC List
	function Unsub_uacc_list(){
		$this->global['pageTitle'] = 'Unsubscribed UACC List';
		$res['data']=$this->UACC_list_model->unsub_uacc_listing();
		loadFrontViews('UACC/unsub-uacc-list', $this->global,$res, NULL);
	}

	/*function Unsub_uacc_AjaxData(){
		if (!empty($this->input->post()) && !empty($this->input->post('Records')) ) {
			$val = $this->input->post('Records');
			$data = $this->input->post();
			$searchVal = $data['search']['value']; // Search value
	        $draw = $data['draw'];
	        $row = $data['start'];
	        $rowperpage = $data['length']; // Rows display per page
	        $columnIndex = $data['order'][0]['column']; // Column index
	        $columnName = $data['columns'][$columnIndex]['data']; // Column name
	        $columnSortOrder = $data['order'][0]['dir']; // asc or desc

			$res=$this->UACC_list_model->$val($data,$searchVal,$row,$rowperpage,$columnName,$columnSortOrder);

			$count = ($row + 1);
	        $return = array();
	        foreach ($res['details'] as $value) {
		       
		       	$action = '<a href="'.base_url('unsub-uacc-note/'.$value['id_cc_newsletter']).'" class="btn btn-sm btn-primary">Add Note</a>';

		        $return[] = array( 
		            'number'=> $count,
		            'name'=> $value['name'],
		            'email'=> $value['email'],
		            'contract_update_date'=>$value['contract_update_date'],
		            'cell_number'=> $value['cell_number'],
		            'consultant_number'=>$value['consultant_number'],
		            'intouch_password'=>$value['intouch_password'],
		            'national_area'=>$value['national_area'],
		            'seminar_affiliation'=>$value['seminar_affiliation'],
		            'action'=> $action
		        );
		        $count++;    
	        }
	        $response = array(
	          "draw" => intval($draw),
		      "query" => '',
		      "iTotalRecords" => $res['total_record_filter'],
		      "iTotalDisplayRecords" => $res['total_records'],
		      "aaData" => $return
	        );

	        echo json_encode( $response );
			exit();
		}
	}*/
}