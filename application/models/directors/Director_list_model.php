<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Director_list_model extends CI_Model {

  function director_listing($data='', $searchValue='', $row='', $rowperpage='', $columnName='', $columnSortOrder='') {
        $date = date("m-d-y");
        $this->db->select("ng.id_newsletter");
        $this->db->from('newsletter_general_info AS ng');
        $this->db->join('users AS u', 'u.id_user=ng.id_user', 'left');
        $this->db->where('ng.deleted', '0');
        $this->db->where("(ng.contract_update_date ='' OR ng.contract_update_date >".$date.")", NULL, FALSE);
        $this->db->order_by('ng.created_at', 'DESC');
        $totalRecords = $this->db->get()->num_rows();

        $searchQuery = " 1=1";
        if($searchValue != ''){
           $searchQuery .= " AND (ng.name like '%".$searchValue."%' or ng.email like '%".$searchValue."%' or ng.consultant_number like'%".$searchValue."%' or ng.cell_number like'%".$searchValue."%' or u.user_name like'%".$searchValue."%' or u.first_name like'%".$searchValue."%' or ng.director_title like'%".$searchValue."%' or ng.intouch_password like'%".$searchValue."%') ";
        }

        $this->db->select("ng.id_newsletter");
        $this->db->from('newsletter_general_info AS ng');
        $this->db->join('users AS u', 'u.id_user=ng.id_user', 'left');
        $this->db->where($searchQuery);
        $this->db->where('ng.deleted', '0');
        $this->db->where("(ng.contract_update_date ='' OR ng.contract_update_date  >".$date.")", NULL, FALSE);
        $this->db->order_by('ng.created_at', 'DESC');
        $totalRecordwithFilter = $this->db->get()->num_rows();

        if ($columnName == 'number') {
            if ($columnSortOrder == 'asc') {
                $columnSortOrder = 'DESC';
            }
            $columnName = 'ng.created_at';
        }elseif ($columnName == 'user_name' || $columnName == 'first_name') {
            $columnName = 'u.'.$columnName;
        }elseif ($columnName == 't_package') {
            $columnName = 'package_pricing';
        }

        $this->db->select("ng.id_newsletter, ng.updated_by, ng.name, ng.director_title, ng.contract_update_date, ng.updated_at, ng.created_at, ng.consultant_number, ng.intouch_password, ng.newsletters_design, np.total_text_program, np.total_text_program7, np.package, np.unit_size, np.package_pricing, np.point_value, np.last_email_update_date, no.approved_date, nd.design_one, nd.beatly_url, nd.beatly_url_one, nd.beatly_url_two, no.design_approve_status, u.user_name as user_name, u.first_name as first_name");

        $this->db->from('newsletter_general_info AS ng');
        $this->db->where($searchQuery);
        $this->db->where('ng.deleted', '0');
        $this->db->where("(ng.contract_update_date ='' OR ng.contract_update_date  >".$date.")", NULL, FALSE);
        $this->db->order_by('ng.created_at', 'DESC');
        //$this->db->order_by($columnName, $columnSortOrder);
        //$this->db->limit($rowperpage, $row);
        $this->db->join('users AS u', 'u.id_user=ng.id_user','left');
        $this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter','left');
        $this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter','left');
        $this->db->join('newsletter_other_details AS no', 'no.id_newsletter=ng.id_newsletter','left');
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        $data = $query->result_array();
        
        return array('details'=>$data, 'query'=>$query, 'total_records'=>$totalRecords, 'total_record_filter'=>$totalRecordwithFilter);
  }

  function getDirectorData($id_newsletter){
    $generalInfo = getTableFields('general');
    $designInfo = getTableFields('design');
    $packagingInfo = getTableFields('packaging');
    $otherInfo = array('ua_cc');

    $uaccFields=array('id_newsletter', 'id_user', 'updated_by', 'name', 'email', 'cell_number', 'consultant_number', 'intouch_password', 'national_area', 'seminar_affiliation', 'cv_account', 'cu_routing', 'reffered_by', 'question_comment', 'cc_only', 'cc', 'ua_cc', 'fb_link', 'pmt_type', 'cc_number', 'cc_code', 'cc_expir_date', 'cc_zip', 'client_note', 'm_bill_date', 'misc_charge', 'billing_alert', 'contract_update_date', 'director_title', 'cc_chargefree','note', 'send_mail', 'ua_client', 'recurring_check','recurring_fullname','recurring_merchant','recurring_amount', 'recurring_sign', 'recurring_today_date', 'created_at', 'updated_at','dob','p_address','p_city','p_state','p_zip','image','digital_biz_link','catalog_link','shop_link','boss_babe_link','digital_biz_card', 'inc_tbc', 'socialM', 'account_detail');

    $allData = array();
    foreach ($uaccFields as $key => $value) {
      if (in_array($value, $generalInfo)) {
        $this->db->select($value);
        $this->db->from('newsletter_general_info');
        $this->db->where('id_newsletter', $id_newsletter);
        $allData[$value]=$this->db->get()->row()->$value;
      }

      if (in_array($value, $designInfo)) {
        $this->db->select($value);
        $this->db->from('newsletter_design_info');
        $this->db->where('id_newsletter', $id_newsletter);
        $allData[$value]=$this->db->get()->row()->$value;
      }

      if (in_array($value, $packagingInfo)) {
        $this->db->select($value);
        $this->db->from('newsletter_packaging');
        $this->db->where('id_newsletter', $id_newsletter);
        $allData[$value]=$this->db->get()->row()->$value;
      }

      if (in_array($value, $otherInfo)) {
        $this->db->select($value);
        $this->db->from('newsletter_other_details');
        $this->db->where('id_newsletter', $id_newsletter);
        $allData[$value]=$this->db->get()->row()->$value;
      }
    }

    if ($allData['image'] != '') {
          @copy('assets/images/profile_img/'.$allData['image'],'assets/images/uacc_img/'.$allData['image']);
      }
      
      if ($allData['digital_biz_link'] != '') {
          $allData['digital_biz_link'] = "https://www.unitassist.com/tbc/".str_replace(' ', '', $allData['name']);
      }else {
          $allData['digital_biz_link'] = '';
      }

    $social = unserialize($allData['socialM']);
    $facebook=(isset($social['Sfacebook']) ? $social['Sfacebook'] : '');
    $pmt_type = ($allData['account_detail'] == 'Y' ? 'ACH' : 'CC');
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $remainCCFields = array('question_comment'=>'', 'cc_only'=>'1', 'cc'=>'Y', 'fb_link'=>$facebook, 
      'pmt_type'=>$pmt_type, 'cc_director_title'=>$allData['director_title'], 'cc_chargefree'=>'0', 'recurring_amount'=>29.99, 'address'=>$allData['p_address'], 'city'=>$allData['p_city'], 'state'=>$allData['p_state'], 'zip'=>$allData['p_zip'], 'photo'=>$allData['image'], 'inc_tbc'=>'1','created_at'=>$created_at, 'updated_at'=>$updated_at);
    
    unset($allData['socialM'], $allData['Sfacebook'], $allData['account_detail'], $allData['director_title'], $allData['p_address'], $allData['p_city'], $allData['p_state'], $allData['p_zip'], $allData['image']);

    $allData = array_merge($allData, $remainCCFields);
    
    $res = $this->db->insert('cc_newsletters', $allData);
    if ($res) {
      return $this->db->insert_id();
    }
  }

  function get_client_emails($id_newsletter){
    $this->db->select('purpose, created_at');
    $this->db->from('email_records');
    $this->db->group_by('purpose');
    $this->db->where(array('deleted'=>'0','id_newsletter'=>$id_newsletter));
    $this->db->order_by('created_at', 'DESC');
    return $this->db->get()->result_array();
  }

  function get_view_client_email($id_newsletter, $purpose) {
    $this->db->select('n.id_newsletter as id_newsletter_client, e.*');
    $this->db->from('email_records AS e');
    $this->db->join('newsletter_general_info AS n', 'e.id_newsletter = n.id_newsletter', 'left');
    $this->db->where(array('e.id_newsletter'=>$id_newsletter, 'e.deleted'=>'0', 'n.deleted'=>'0', 'e.purpose'=>$purpose));
      
    if ($purpose=='Reminder') {
      $this->db->group_by('e.detail');
    }else{
      $this->db->group_by('e.created_at');
    }

    $this->db->order_by('e.created_at', 'DESC');
    return $this->db->get()->result_array();
  }

}