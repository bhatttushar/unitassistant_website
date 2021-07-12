<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Future_director_list extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('directors/future_director_list_model');
		$this->load->helper('directors/director_helper');
		$this->load->helper('directors/director_mail_helper');
		isUserLoggedIn();
	}

	function index(){
		$this->global['pageTitle'] = 'Future Director List';
		$res['data'] = $this->future_director_list_model->future_director_listing();
		loadFrontViews('directors/future-director-list', $this->global,$res, NULL);
	}
	
/*
	function AjaxData(){
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

			$res=$this->future_director_list_model->$val($data,$searchVal,$row,$rowperpage,$columnName,$columnSortOrder);

			$count = ($row + 1);
	        $return = array();
	        foreach ($res['details'] as $value) {
		        $sPackagePricing = $value['package_pricing'];
		        $hidden_newsletter = '';
		        if($value['hidden_newsletter'] == 'SB' || $value['hidden_newsletter'] == 'AB') {
		            $hidden_newsletter = $sPackageVal = "$".($sPackagePricing + 25); 
		        }
		        if($value['hidden_newsletter'] == 'SE' || $value['hidden_newsletter'] == 'AE'|| $value['hidden_newsletter'] == 'SS' || $value['hidden_newsletter'] == 'AS' || $value['hidden_newsletter'] == 'no' || $value['hidden_newsletter'] == '') {
		            $hidden_newsletter = "$".( $sPackagePricing + 0); 
		        }
		       
		       
		       	$confirm = "return confirm('Are you sure to delete this record?')";
		        $action = '<a href="'.base_url("edit-future-director/".$value['id_newsletter']).'" title="Click to edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp';

		        $action.= '<a href="'.base_url("delete-future-director/".$value['id_newsletter']).'" title="Click to delete" onclick="'.$confirm.'"><i class="fa fa-times"></i></a>&nbsp;&nbsp;&nbsp;';


				$future_package_date = date('m-d-Y', strtotime($value['future_package_date']));


		        $return[] = array( 
		            'number'=> $count,
		            'user_name'=> $value['user_name'],
		            'first_name'=>$value['first_name'],
		            'future_package_date'=> $future_package_date,
		            'contract_update_date'=>$value['contract_update_date'],
		            'newsletters_design'=> get_newsletters_design($value['newsletters_design']),
		            'name'=> $value['name'],
		            'director_title'=>$value['director_title'],
		            'beatly_url'=>$value['beatly_url'],
		            'beatly_url_one'=>$value['beatly_url_one'],
		            'beatly_url_two'=>$value['beatly_url_two'],
		            'consultant_number'=>$value['consultant_number'],
		            'intouch_password'=>$value['intouch_password'],
		            'spanish_consultant'=> empty($value['spanish_consultant']) ? '' : 'X',
		            'unit_number'=> empty($value['unit_number']) ? '' : 'X',
		            'unit_size'=>$value['unit_size'],
		            'package_pricing'=> GetPackageValue($value['package'],$value['unit_size']),
		            'package'=> empty($value['package'] ) ? 'N/A'  : $value['package'],
		            'hidden_newsletter'=> $hidden_newsletter,
		            'nsd_client'=> $value['nsd_client'],
		            'point_value'=>$value['point_value'],
		            'design_approve_status'=>Get_design_approve_status($value['design_one'], $value['design_approve_status']),
		            'approved_date'=> (empty($value['approved_date']) ? '' : $value['approved_date']),
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
	}
	*/
	function delete_director($id_newsletter){
		$result = $this->future_director_list_model->delete_director($id_newsletter);

		if($result){
           redirect('future-directors');
        }
	}


}