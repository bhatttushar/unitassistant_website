<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Reggie_model extends CI_Model {

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

	function add_to_ua($data){
		
		$name = $data['first_name'].' '.$data['last_name'];
		$prevData = $this->getPrevData();

	    /* Add to general info*/
	    $generalInfo = getTableFields('general');
	    $generalData = array();
	    foreach ($data as $key => $value) {
	      if (in_array($key, $generalInfo)) {
	        $generalData[$key]=$value;
	      }
	    }

	    $prevGenData = array();
	    foreach ($prevData as $key => $value) {
	      if (in_array($key, $generalInfo)) {
	        $prevGenData[$key]=$value;
	      }
	    }

	    if (!empty($_FILES['image']['name'])) {
	      $generalData['image']=$this->uploadProfileImg();
	    }

	    $generalData['name'] = $name; 
	    $generalData['unit_color'] = empty($data['unit_color']) ? $prevGenData['unit_color'] : $data['unit_color'];

	    $generalData['seminar_affiliation'] = ($data['newsletters_design']=='3') ? '' : $data['seminar_affiliation'];

	    $current_date = date("Y-m-d");
	    $matchDate = date("Y-m-15");
        if ($current_date < $matchDate ) {
            $prevGenData['first_bill_date'] = $matchDate;
        }else{
            $prevGenData['first_bill_date'] = date('Y-m-d', strtotime ( '+1 month' , strtotime ( $matchDate ) ) );
        }
	    $generalData['first_bill_date'] = date('m-d-y', strtotime($prevGenData['first_bill_date']));

	    $generalData['select_email'] = $prevGenData['select_email'];
	    $generalData['created_at'] = date('Y-m-d H:i:s');
	    $generalData['updated_at'] = date('Y-m-d H:i:s');

	    unset($generalData['nsd_address']);
	    unset($generalData['nsd_city']);
	    unset($generalData['nsd_state']);
	    unset($generalData['nsd_zip']);

	    $this->db->insert('newsletter_general_info', $generalData);
	    $id_newsletter = $this->db->insert_id();

	    /* End general info*/
	    
	    if ($id_newsletter > 0) {
	      /* Add to newsletter_design_info */
	      $designInfo = getTableFields('design');

	      $designData = array();
	      foreach ($data as $key => $value) {
	        if (in_array($key, $designInfo)) {
	          $designData[$key]=$value;
	        }
	      }

	      $prevDesignData = array();
	      foreach ($prevData as $key => $value) {
	        if (in_array($key, $designInfo)) {
	          $prevDesignData[$key]=$value;
	        }
	      }

	      $designData['id_newsletter'] = $id_newsletter;

	      unset($prevDesignData['id_newsletter_design_info']);
	      unset($prevDesignData['id_newsletter']);
	      $designData = array_merge($prevDesignData, $designData);
	      $this->db->insert('newsletter_design_info', $designData);
	      /* End to newsletter_design_info */

	      /* Add to newsletter_emails */
	      $emailInfo = getTableFields('emails');
	      $emailsData = array();
	      foreach ($data as $key => $value) {
	        if (in_array($key, $emailInfo)) {
	          $emailsData[$key]=$value;
	        }
	      }
	      $emailsData['id_newsletter'] = $id_newsletter;
	      $this->db->insert('newsletter_emails', $emailsData);
	      /* End to newsletter_emails */

	      /* Add to newsletter_packaging */
	      $packagingInfo = getTableFields('packaging');
	      $packagingData = array();
	      foreach ($data as $key => $value) {
	        if (in_array($key, $packagingInfo)) {
	          $packagingData[$key]=$value;
	        }
	      }

	      $prevPackData = array();
	      foreach ($prevData as $key => $value) {
	        if (in_array($key, $packagingInfo)) {
	          $prevPackData[$key]=$value;
	        }
	      }

	      	unset($prevPackData['id_newsletter_packaging']);
	      	unset($prevPackData['id_newsletter']);
            unset($prevPackData['id_user']);
            unset($prevPackData['shop_link']);
            unset($prevPackData['boss_babe_link']);
            unset($prevPackData['beatly_url']);
            unset($prevPackData['beatly_url_one']);

	      	$packagingData['id_newsletter'] = $id_newsletter;
	      	$packagingData['boss_babe_link']=empty($data['p_web']) ? '' : $data['p_web'].'/en-us/sell-mary-kay?iad=topnavpws_sellmk';
			$packagingData['total_text_program7']= '1';
			$packagingData['package']= 'R';
			$packagingData['digital_biz_link'] = 'www.unitassist.com/'. str_replace(' ', '', $name); 
	      	$packagingData['cv_account'] = encryptIt($packagingData['cv_account']);

	      	$total = GetPackageValue('R', $data['unit_size']);
	      	if ($packagingData['total_text_program7'] == '1') {
                $total += (float)total_text_program7_y;
            }
            
            $data['sub_total'] = $total;
            $data['package_pricing'] = $total;

	      	$packagingData = array_merge($prevPackData, $packagingData);

	      	$this->db->insert('newsletter_packaging', $packagingData);
	      /* End to newsletter_packaging */

	      /* Add to newsletter_other_details */

		    $details = array();
		    $details['id_newsletter'] = $id_newsletter;
		    $details['ua_cc'] = '1'; 
		    $details['alt_phone'] = empty($data['alt_phone']) ? '' : $data['alt_phone']; 
		    $details['authorization'] = $data['authorization']; 
	      	$res = $this->db->insert('newsletter_other_details', $details);
	      	/* End to newsletter_other_details */

	      return $id_newsletter;
	    }

  	}

  	function getPrevData(){
  		$this->db->select('*');
  		$this->db->from('newsletters');
  		$this->db->where('id_newsletter', '-1');
  		return $this->db->get()->row_array();
  	}

  	function add_to_uacc($data, $id_newsletter){
  		$data = array(
  			'id_newsletter'=>$id_newsletter,
			'updated_by'=>'online',
			'name'=>$data['first_name'].' '.$data['last_name'],
			'email'=>$data['email'],
			'cell_number'=>$data['cell_number'],
			'consultant_number'=>$data['consultant_number'],
			'intouch_password'=>$data['intouch_password'],
			'national_area'=>$data['national_area'],
			'seminar_affiliation'=>$data['seminar_affiliation'],
			'pmt_type'=>'ACH',
			'cv_account'=>encryptIt($data['cv_account']),
			'cu_routing'=>$data['cu_routing'],
			'address'=>$data['p_address'],
			'city'=>$data['p_city'],
			'state'=>$data['p_state'],
			'zip'=>$data['p_zip'],
			'reffered_by'=>$data['reffered_by'],
			'dob'=>$data['dob'],
			'cc_newsletter'=>$data['newsletters_design'],
			'cc_director_title'=>$data['director_title'],
			'inc_tbc'=>'1',
			'digital_biz_link'=>'www.unitassist.com/'.$data['first_name'].$data['last_name'],
			'photo'=> isset($_FILES['image']) ? $_FILES['image']['name'] : '',
			'created_at'=>date('Y-m-d H:i:s'),
			'updated_at'=>date('Y-m-d H:i:s')
  		);
  		
  		$this->db->insert('cc_newsletters', $data);
  		return $this->db->insert_id();
  	}

  	function get_mail_data($id_newsletter){
  		$this->db->select('ng.name, ng.cell_number, ng.email, ng.newsletters_design, ng.director_title, ng.closing_ecards, ng.dob, ng.unit_web_site, ng.unit_color, ng.consultant_number, ng.mk_director, ng.intouch_password, ng.unit_number, ng.unit_name, ng.unit_goal, ng.reffered_by, ng.national_area, ng.seminar_affiliation, nd.hidden_newsletter, nd.distribution_one, nd.birthday_one, nd.status_one, nd.status_two, nd.status_five, nd.status_six, nd.status_eight, nd.last_one, nd.consultant_two, nd.p_name, nd.p_address, nd.p_city, nd.p_state, nd.p_zip, nd.p_phone, nd.p_email, nd.p_web, np.package, np.package_pricing, np.unit_size, np.cu_routing, np.cv_account, np.point_value, no.alt_phone');

  		$this->db->from('newsletter_general_info AS ng');
  		$this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
  		$this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
  		$this->db->join('newsletter_other_details AS no', 'no.id_newsletter=ng.id_newsletter', 'left');
  		$this->db->where('ng.id_newsletter', $id_newsletter);
  		$this->db->query('SET SQL_BIG_SELECTS=1'); 
  		return $this->db->get()->row_array();
  	}

  	function get_client_messages(){
  		$this->db->select('*');
  		$this->db->from('client_messages');
  		return $this->db->get()->row_array();
  	}

  	function add_to_email_records($id_newsletter, $id_cc_newsletter){
  		$data = array(
  			'userby'=>empty($this->session->userdata('id_user')) ? '0' : $this->session->userdata('id_user'), 
  			'userto'=>'0', 
  			'id_newsletter'=>$id_newsletter, 
  			'id_cc_newsletter'=>$id_cc_newsletter, 
  			'id_admin'=>'0', 
  			'purpose'=>'Registered by reggie UA form', 
  			'detail'=>'Welcome message has been sent.',
  			'created_at'=>date("Y-m-d H:i:s"),
  			'updated_at'=>date("Y-m-d H:i:s")
  		);
  		$this->db->insert('email_records', $data);
  		return $this->db->insert_id();
  	}
}