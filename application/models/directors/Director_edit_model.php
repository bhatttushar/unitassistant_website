<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Director_edit_model extends CI_Model {

  function get_newsletter_data($id_newsletter, $table){
    $id = ($table=='future') ? 'id_future_newsletter' : 'id_newsletter';

    $this->db->from($table.'_general_info AS ng');
    $this->db->join($table.'_packaging AS np', 'np.'.$id.'=ng.'.$id, 'left');
    $this->db->join($table.'_design_info AS nd', 'nd.'.$id.'=ng.'.$id, 'left');
    $this->db->join($table.'_other_details AS no', 'no.'.$id.'=ng.'.$id, 'left');
    $this->db->join($table.'_emails AS ne', 'ne.'.$id.'=ng.'.$id, 'left');
    $this->db->where(array('ng.id_newsletter'=>$id_newsletter, 'ng.deleted'=>'0'));
    $this->db->query('SET SQL_BIG_SELECTS=1'); 
    return $this->db->get()->row_array();
  }

  function get_user_email_details($id_newsletter, $table){
    $this->db->select('ng.id_newsletter as id_newsletter_client, e.id_newsletter');
    $this->db->from($table.'_general_info AS ng');
    $this->db->join('email_records AS e', 'e.id_newsletter=ng.id_newsletter', 'left');
    $this->db->where(array('e.id_newsletter'=>$id_newsletter, 'e.deleted'=>'0', 'ng.deleted'=>'0'));
    $this->db->group_by('e.created_at');
    $this->db->order_by('e.created_at', 'DESC');
    return $this->db->get()->row_array();
  }

  function get_client_data($id_newsletter, $table){
    $approved_date = ($table=='future') ? '' : 'no.approved_date';
    $id = ($table=='future') ? 'id_future_newsletter' : 'id_newsletter';

    $this->db->select('ng.id_newsletter, '.$approved_date.', nd.design_one, no.design_approve_status');
    $this->db->from($table.'_general_info AS ng');
    $this->db->join($table.'_packaging AS np', 'np.'.$id.'=ng.'.$id, 'left');
    $this->db->join($table.'_design_info AS nd', 'nd.'.$id.'=ng.'.$id, 'left');
    $this->db->join($table.'_other_details AS no', 'no.'.$id.'=ng.'.$id, 'left');
    $this->db->where('ng.id_newsletter', $id_newsletter);
    return $this->db->get()->row_array();
  }

  function get_cc_exists($consultant_number){
    $this->db->select('id_newsletter');
    $this->db->from('cc_newsletters');
    $this->db->where(array('deleted'=>'0', 'consultant_number'=>$consultant_number));
    return $this->db->get()->num_rows();
  }

  function get_purpose($id_newsletter){
    $this->db->select('purpose');
    $this->db->from('email_records');
    $this->db->where('id_newsletter', $id_newsletter);
    $this->db->group_start(); //start group
    $this->db->like('purpose', 'Logged in from Android');
    $this->db->or_like('purpose', 'Logged in from iPhone');
    $this->db->group_end(); //close group
    return $this->db->get()->row_array(); 
  }

  function get_future_date($id_newsletter){
    $dDate = date("m/d/y");
    $this->db->select('fd.future_package_date');
    $this->db->from('future_general_info AS fg');
    $this->db->join('future_design_info AS fd', 'fd.id_future_newsletter=fg.id_future_newsletter', 'left');
    $this->db->where(array('fg.deleted'=>'0', 'fg.id_newsletter'=>$id_newsletter));
    $this->db->where(array('fd.package_for'=>'F', 'fd.future_package_date >='=>$dDate));
    return $this->db->get()->row_array();
  }

  function get_notes_data($id_newsletter){
    $id_cc_newsletter = oldCCN($id_newsletter);

    $sAndWhere = " 1 = 1";
    $sAndWhere .= " AND n.deleted=0";
    $sAndWhere .= " AND n.id_newsletter = '" . $id_newsletter . "'";
    if (!empty($id_cc_newsletter)) {
      $sAndWhere .= " OR n.id_cc_newsletter = '" . $id_cc_newsletter . "'";
    }
    
    $this->db->select('n.id_newsletter, n.id_cc_newsletter, n.id_notify_user, n.note, n.created_at, u.profile_pic,u.first_name,u.last_name');
    $this->db->from('notes AS n');
    $this->db->join('users AS u', 'u.id_user = n.id_user', 'left');
    $this->db->where($sAndWhere);
    $this->db->order_by('n.id_note','DESC');
    if ($this->input->post('all')=='') {
      $this->db->limit(8);
    }
    return $this->db->get()->result_array();
  }

  function add_note($data){
    $dataInsert['id_user'] = CurrentUser();
    $dataInsert['id_newsletter'] = $data['id_newsletter'];
    $dataInsert['id_notify_user'] = $data['users'];
    $dataInsert['note'] = htmlspecialchars(addslashes(trim($data['note'])));
    $dataInsert['created_date'] = date("Y-m-d");
    $dataInsert['created_at'] = date("Y-m-d H:i:s");

    $this->db->insert('notes', $dataInsert);
    return $this->db->insert_id();
  }


  function UploadProfile($user_image) {
    if(!empty($_FILES['image']['name'])) {
      $config['upload_path']          = './assets/images/profile_pic/';
      $config['allowed_types']        = 'gif|jpg|png';
      $this->load->library('upload', $config);

      if($this->upload->do_upload('image')) {
        $sImage = $this->upload->data('file_name');
      }
    }else {
      $sImage = $user_image;
    }
    return $sImage;
  }


  function edit_director($data, $is_future=""){

    $id_newsletter = $data['id_newsletter'];
    // Edit to general info
    $generalInfo = getTableFields('general');
    $generalData = array();
    foreach ($data as $key => $value) {
      if (in_array($key, $generalInfo)) {
        $generalData[$key]=$value;
      }
    }

    if (!empty($_FILES['image']['name'])) {
      $generalData['image']=$this->uploadProfileImg();
    }

    $generalData['updated_at'] = date('Y-m-d H:i:s');
    $this->db->where('id_newsletter', $id_newsletter);
    $general_table = ($is_future=='future') ? 'future_general_info' : 'newsletter_general_info';
    $result = $this->db->update($general_table, $generalData);
    // End general info
    
    if ($result == TRUE) {
      // Edit to newsletter_design_info
      $designInfo = getTableFields('design');

      $details = array();
      $where = "1 = 1";
      if ($is_future=='future') {
        array_push($designInfo, 'future_package_date');
        $this->db->select('id_future_newsletter');
        $this->db->from('future_general_info');
        $this->db->where(array('deleted'=>'0', 'id_newsletter'=>$id_newsletter));
        $id_future = $this->db->get()->row_array();

        $where .= " AND id_future_newsletter=".$id_future['id_future_newsletter'];
        $design_table = 'future_design_info';
        $emails_table = 'future_emails';
        $packaging_table = 'future_packaging';
        $packagingData['id_future_newsletter'] = $id_future['id_future_newsletter'];
        $other_details_table = 'future_other_details';
        $details['id_future_newsletter'] = $id_future['id_future_newsletter'];
      }else{
        $where .= " AND id_newsletter=".$id_newsletter;
        $design_table = 'newsletter_design_info';
        $emails_table = 'newsletter_emails';
        $packaging_table = 'newsletter_packaging';
        $packagingData['id_newsletter'] = $id_newsletter;
        $other_details_table = 'newsletter_other_details';
        $details['id_newsletter'] = $id_newsletter;
      }

      $designData = array();
      foreach ($data as $key => $value) {
        if (in_array($key, $designInfo)) {
          $designData[$key]=$value;
        }
      }

      $designUncheckedFields = getUncheckedFields('design');
      $uncheckDesign = array();
      foreach ($designUncheckedFields as $key => $value) {
        if (!isset($designData[$value])) {
          $uncheckDesign[$value]='0';
        }
      }

      $designData = array_merge($designData, $uncheckDesign);

      if ($is_future=='future') {
        unset($designData['id_newsletter']);
      }

      $this->db->where($where);
      $update_design = $this->db->update($design_table, $designData);

      if ($designData['package_for']=='F' && $update_design==true ) {
        $this->db->set('updated_at', date('Y-m-d H:i:s'));
        $this->db->where('id_newsletter', $id_newsletter);
        $update_at = $this->db->update('future_general_info');

        if ($update_at == true) {
          $this->db->select('id_future_newsletter');
          $this->db->from('future_general_info');
          $this->db->order_by('updated_at', 'DESC');
          $this->db->limit(1);
          $id_future_newsletter = $this->db->get()->row()->id_future_newsletter;

          $future_design_data = array('package_for'=>$designData['package_for'], 'future_package_date'=>$designData['future_package_date']);

          $this->db->set($future_design_data);
          $this->db->where('id_future_newsletter', $id_future_newsletter);
          $this->db->update('future_design_info');  
        }

      }

      // End to newsletter_design_info 

      // Add to newsletter_emails
      $emailInfo = getTableFields('emails');
      $emailsData = array();
      foreach ($data as $key => $value) {
        if (in_array($key, $emailInfo)) {
          $emailsData[$key]=$value;
        }
      }

      if ($is_future=='future') {
        unset($emailsData['id_newsletter']);
      }

      $this->db->where($where);
      $this->db->update($emails_table, $emailsData);
      // End to newsletter_emails

      // Edit to newsletter_packaging
      $packagingInfo = getTableFields('packaging');
      $packagingData = array();
      foreach ($data as $key => $value) {
        if (in_array($key, $packagingInfo)) {
          $packagingData[$key]=$value;
        }
      }

      $packagUncheckedFields = getUncheckedFields('packaging');
      $uncheckPackage = array();
      foreach ($packagUncheckedFields as $key => $value) {
        if (!isset($packagingData[$value])) {
          $uncheckPackage[$value] = '0';
        }
      }

      $packagingData = array_merge($packagingData, $uncheckPackage);
      
      $packagingData['package_value'] = GetPackageValue($data['package'], $data['unit_size']);
      $packagingData['socialM'] = serialize($packagingData['socialM']);
      $packagingData['cv_account'] = encryptIt($packagingData['cv_account']);

      if ($is_future=='future') {
        unset($packagingData['id_newsletter']);
      }

      $this->db->where($where);
      $this->db->update($packaging_table, $packagingData);
      
      // End to newsletter_packaging
      
      // update to cc_newsletters
      $UACC_data = array(
                  'shop_link'=>$packagingData['shop_link'],
                  'boss_babe_link'=>$packagingData['boss_babe_link'],
                  'fb_link'=>$data['socialM']['Sfacebook'],
                  'updated_at'=>date('Y-m-d')
                );

      $this->db->where('id_newsletter', $id_newsletter);
      $this->db->update('cc_newsletters', $UACC_data);
      //End to cc_newsletters

      // Edit to newsletter_other_details
      $this->db->where($where);
      $res = $this->db->update($other_details_table, $details);
      // End to newsletter_other_details

      // Delete user
      if ($is_future=='future') {
        $this->DeleteUser($id_newsletter, $generalData['contract_update_date'], 'future_general_info');
      }else{
        $this->DeleteUser($id_newsletter, $generalData['contract_update_date'], 'newsletter_general_info');
      }
      // Delete user

      // Add to history_general_info
      if ($res) {
        if ($is_future=='future') {
          unset($designData['future_package_date']);
        }
        $this->addDirectorHistory($id_newsletter, $generalData, $designData, $emailsData, $packagingData);  
      }
      // End to history_general_info
      if (isset($packagingData['nsd_client'])) {
        $this->updateReports($id_newsletter, $packagingData['package'], $packagingData['nsd_client']);
      }else{
        $this->updateReports($id_newsletter, $packagingData['package'], '0');
      }

      $newsletterReport = $this->get_newsletter_design_reports($id_newsletter);

      if (!empty($newsletterReport)) {
        if (($data['hidden_newsletter'] != $newsletterReport['hidden_newsletter']) || ($data['design_two'] != $newsletterReport['design_two']) || ($data['wholesale_amount'] != $newsletterReport['wholesale_amount']) || ($data['wholesale_section'] != $newsletterReport['wholesale_section']) || ($data['court_sale'] != $newsletterReport['court_sale']) || ($data['court_sale_director'] != $newsletterReport['court_sale_director']) || ($data['court_sharing'] != $newsletterReport['court_sharing']) || ($data['court_sharing_director'] != $newsletterReport['court_sharing_director']) || ($data['birthday_rec'] != $newsletterReport['birthday_rec']) || ($data['birthday_anniversary'] != $newsletterReport['birthday_anniversary']) || ($data['wholesale_remove_name'] != $newsletterReport['wholesale_remove_name']) || ($data['wholesale_remove'] != $newsletterReport['wholesale_remove']) || ($data['special_news_request'] != $newsletterReport['special_news_request']) || ($data['beatly_url'] != $newsletterReport['beatly_url']) || ($data['beatly_url_one'] != $newsletterReport['beatly_url_one'])) {
          
          $designReports=$this->updateDesignReports($id_newsletter, $designData, $packagingData['cu_routing'], $packagingData['cv_account']);
            if ($designReports == TRUE) {
              $designData['name'] = $data['name'];
              $DesignChangedMail = sendDesignChangedMail($designData);
            }
        }

        if($data['cu_routing']!=$newsletterReport['cu_routing'] || $data['cv_account']!=$newsletterReport['cv_account']){
          $designReportData['cu_routing'] = $data['cu_routing'];
          $designReportData['cv_account'] = $data['cv_account'];
          $designReportData['updated_at'] = date('Y-m-d H:i:s');

          $this->db->where('id_newsletter', $id_newsletter);
          $newsletter_design_reports = $this->db->update('newsletter_design_reports', $designReportData);

          if ($newsletter_design_reports == TRUE) {
            $accountRoutingChangedMail =  sendAccountRoutingChangedMail($generalData['name'], $packagingData['cv_account'], $packagingData['cu_routing']);
          }
        }
      }
      return TRUE;
    }
  }

  function get_newsletter_design_reports($id_newsletter){
    $this->db->select('*');
    $this->db->from('newsletter_design_reports');
    $this->db->where('id_newsletter', $id_newsletter);
    $this->db->order_by('id_newsletter_design_report', 'DESC');
    $this->db->limit(1);
    return $this->db->get()->row_array();
  }

  function addDirectorHistory($id_newsletter, $generalData, $designData, $emailsData, $packagingData){
    $generalData['id_newsletter'] = $id_newsletter;
    $this->db->insert('history_general_info', $generalData);
    $id_history = $this->db->insert_id();

    if ($id_history > 0) {
      $designData['id_history'] = $id_history;
      unset($designData['id_newsletter']);
      $this->db->insert('history_design_info', $designData);

      $emailsData['id_history'] = $id_history;
      unset($emailsData['id_newsletter']);
      $this->db->insert('history_emails', $emailsData);

      $packagingData['id_history'] = $id_history;
      unset($packagingData['id_newsletter']);
      $this->db->insert('history_packaging', $packagingData);

      $details = array();
      $details['id_history'] = $id_history;
      $this->db->insert('history_other_details', $details);
    }
    
  }
  
  function DeleteUser($id_newsletter, $contract_update_date, $table){
    $date = date("m-d-y");
    if($date == $contract_update_date) {
      $details=array('deleted'=>'1','updated_by'=>$this->session->userdata('id_user'),'updated_at'=>date('Y-m-d H:i:s'));
      $this->db->where('id_newsletter', $id_newsletter);
      $this->db->update($table, $details);
    }
  }

  function updateDesignReports($id_newsletter, $designData, $cu_routing, $cv_account){
    $designReportInfo = getTableFields('design_reports');

    $designReportData = array();
    foreach ($designData as $key => $value) {
      if (in_array($key, $designReportInfo)) {
        $designReportData[$key]=$value;
      }
    }
    $designReportData['cu_routing'] = $cu_routing;
    $designReportData['cv_account'] = $cv_account;
    $designReportData['updated_at'] = date('Y-m-d H:i:s');

    $this->db->where('id_newsletter', $id_newsletter);
    return $this->db->update('newsletter_design_reports', $designReportData);
  }

  function updateReports($id_newsletter, $package, $nsd_client) {
    $dataInsert['package'] =  empty($package) ? 'N' : $package;
    $dataInsert['updated_at'] = date('Y-m-d H:i:s');
    $this->db->where('id_newsletter', $id_newsletter);
    $this->db->update('reports', $dataInsert);
  }

  function SendNoteEmail($id_newsletter, $data) {
    $this->db->where_in('id_user', $data['users'], FALSE);
    $users = $this->db->get('users')->result_array();

    $AssignnamesArray = array();
    $emails = array();
    $aUserID = array();

    foreach ($users as $key => $value) {
      $AssignnamesArray[]= $value['user_name'];
      $emails[]= $value['email'];
      $aUserID[] = $value['id_user'];
    }

    $Assignnames = implode(',', $AssignnamesArray);
    $emails = implode(',', $emails);
    $sUserID = implode(',', $aUserID);
    $sSend = sendNoteMail($emails, $data, $Assignnames);
   
    if ($sSend) {
      $insertErecords['userby'] = CurrentUser();
      $insertErecords['userto'] = $sUserID;
      $insertErecords['id_newsletter'] = $id_newsletter;
      $insertErecords['purpose'] = 'Add Note';
      $insertErecords['detail'] = $data['note'];
      $insertErecords['created_at'] = date("Y-m-d H:i:s");
      $insertErecords['updated_at'] = date("Y-m-d H:i:s");
      $this->db->insert('email_records',$insertErecords);
    }

  } 

 function SendFullEmail($id_newsletter, $data) {
    $message = directorMail($data);
    if ($message) {
      $sDetail = htmlentities(($message), ENT_QUOTES);
      $dataInsert = array();
      $dataInsert['userby'] = CurrentUser();
      $dataInsert['id_newsletter'] = $id_newsletter;
      $dataInsert['purpose'] = 'Update client';
      $dataInsert['detail'] = $sDetail;
      $dataInsert['created_at'] = date("Y-m-d H:i:s");
      return $this->db->insert('email_records',$dataInsert);
    }
  }

  function GetPastEmails($id_newsletter, $table) {
    $this->db->select('n.id_newsletter as id_newsletter_client, e.*');
    $this->db->from('email_records AS e');
    $this->db->join($table.'_general_info AS n', 'e.id_newsletter = n.id_newsletter', 'left');
    $this->db->where( array('e.id_newsletter'=>$id_newsletter, 'e.deleted'=>'0', 'n.deleted'=>'0') );
    $this->db->group_by('e.created_at');
    $this->db->order_by('e.created_at', 'DESC');
    return $this->db->get()->result_array();
  }

  function is_future_director_exists($id_newsletter){
    $this->db->select('id_newsletter');
    $this->db->from('future_general_info');
    $this->db->where(array('deleted'=>'0', 'id_newsletter'=>$id_newsletter));
    return $this->db->get()->result_array();
  }
      

}