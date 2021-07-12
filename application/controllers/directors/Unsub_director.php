<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Unsub_director extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('directors/unsub_director_model');
		isUserLoggedIn();
	}

	function index(){
		$this->global['pageTitle'] = 'Unsubscribed Director List';
		$res['data']=$this->unsub_director_model->unsub_director_listing();
		loadFrontViews('directors/unsub-director-list', $this->global,$res, NULL);
	}

	/*function AjaxData(){
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

			$res=$this->unsub_director_model->$val($data,$searchVal,$row,$rowperpage,$columnName,$columnSortOrder);

			$count = ($row + 1);
	        $return = array();
	        foreach ($res['details'] as $value) {

	        	if($value['updated_at'] != '') {
		            $date = date_create($value['updated_at']);
		                $update_date = date_format($date,"m-d-Y");       
		        }else {
		            $update_date = $value['updated_at'];    
		        }

		        $sPackagePricing = $value['package_pricing'];
		        $hidden_newsletter = '';
		        if($value['hidden_newsletter'] == 'SB' || $value['hidden_newsletter'] == 'AB') {
		            $hidden_newsletter = $sPackageVal = "$".($sPackagePricing + 25); 
		        }
		        if($value['hidden_newsletter'] == 'SE' || $value['hidden_newsletter'] == 'AE'|| $value['hidden_newsletter'] == 'SS' || $value['hidden_newsletter'] == 'AS' || $value['hidden_newsletter'] == 'no' || $value['hidden_newsletter'] == '') {
		            $hidden_newsletter = "$".( $sPackagePricing + 0); 
		        }
		       
		       
		       	$notes = '<a href="'.base_url('unsub-director-note/'.$value['id_newsletter']).'" class="btn btn-sm btn-primary">Add Note</a>';
		       	$this->load->helper('directors/director_helper');
		        $return[] = array( 
		            'number'=> $count,
		            'user_name'=> $value['user_name'],
		            'first_name'=>$value['first_name'],
		            'updated_at'=>$update_date,
		            'contract_update_date'=>$value['contract_update_date'],
		            'name'=> $value['name'],
		            'director_title'=>$value['director_title'],
		            'beatly_url'=>$value['beatly_url'],
		            'beatly_url_one'=>$value['beatly_url_one'],
		            'beatly_url_two'=>$value['beatly_url_two'],
		            'cell_number'=>$value['cell_number'],
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
		            'design_approve_status'=> Get_design_approve_status($value['design_one'], $value['design_approve_status']),
		            'notes'=> $notes
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
	function unsub_director_note($id_newsletter){
		$this->global['pageTitle'] = 'Unsubscribed Director Note';
		$data['data'] = $this->unsub_director_model->getName($id_newsletter);
		$data['notedata'] = $this->unsub_director_model->get_notes_data($id_newsletter);
		$data['past_emails'] = $this->unsub_director_model->GetPastEmails($id_newsletter);
		$data['users'] = get_users();
		loadFrontViews('directors/addNoteForUnsubscribe', $this->global, $data, NULL);	
	}

}