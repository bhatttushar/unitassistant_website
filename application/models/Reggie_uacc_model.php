<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Reggie_uacc_model extends CI_Model {

	function uploadProfileImg() {
	    if(!empty($_FILES['image']['name'])) {
	      $config['upload_path']='assets/images/profile_img/';
	      $config['allowed_types']='gif|jpg|png';
	      $this->load->library('upload', $config);

	      if($this->upload->do_upload('image')) {
	        $sImage = $this->upload->data('file_name');
	      }
	    }else {
	      $sImage = '';
	    }
	    return $sImage;
	}


  	function add_to_uacc($data){

  		$details = array(
			'updated_by'=>'online',
			'name'=>$data['name'],
			'email'=>$data['email'],
			'cell_number'=>$data['cell_number'],
			'consultant_number'=>$data['consultant_number'],
			'intouch_password'=>$data['intouch_password'],
			'national_area'=>$data['national_area'],
			'seminar_affiliation'=>$data['seminar_affiliation'],
			'cv_account'=> isset($data['cv_account']) ? encryptIt($data['cv_account']) : '',
			'cu_routing'=> isset($data['cu_routing']) ? $data['cu_routing'] : '',
			'reffered_by'=>$data['reffered_by'],
			'cc_only'=>'1',
			'cc'=>'Y',
			'ua_cc'=>'1',
			'mary_kay_website'=>$data['mary_kay_website'],
			'fb_link'=>$data['fb_link'],
			'pmt_type'=>$data['pmt_type'],
			'cc_director_title'=>$data['cc_director_title'],
			'cv_prospect'=>$data['cv_prospect'],
			'digital_biz_card'=>$data['digital_biz_card'],
			'inc_tbc'=>'1',
			'digital_biz_link'=>$data['digital_biz_link'],
			'recurring_sign'=>$data['recurring_sign'],
			'recurring_today_date'=>$data['recurring_today_date'],
			'dob'=>$data['birthday'],
			'discount_code'=>$data['discount_code'],
			'address'=>$data['address'],
			'city'=>$data['city'],
			'state'=>$data['state'],
			'zip'=>$data['zip'],
			'photo'=> empty($_FILES['photo']['name']) ? '' :  $this->uploadProfileImg(),
			'hear_us'=> $data['hear_us'],
			'cc_newsletter'=>$data['language'],
			'created_at'=>date('Y-m-d H:i:s'),
			'updated_at'=>date('Y-m-d H:i:s')
  		);
  		
  		$this->db->insert('cc_newsletters', $details);
  		return $this->db->insert_id();
  	}

  	function get_UACC_client_messages(){
  		$this->db->select('*');
  		$this->db->from('tbc_client_messages');
  		return $this->db->get()->row_array();
  	}

  	function add_to_email_records($id_cc_newsletter, $msg){
  		$data = array(
  			'userby'=> empty($this->session->userdata('id_user')) ? '0' : $this->session->userdata('id_user'), 
  			'userto'=>'0', 
  			'id_newsletter'=>'0', 
  			'id_cc_newsletter'=>$id_cc_newsletter, 
  			'id_admin'=>'0', 
  			'purpose'=>'Add New Client', 
  			'detail'=>htmlentities(($msg), ENT_QUOTES),
  			'created_at'=>date("Y-m-d H:i:s"),
  			'updated_at'=>date("Y-m-d H:i:s")
  		);
  		$this->db->insert('email_records', $data);
  		return $this->db->insert_id();
  	}
}