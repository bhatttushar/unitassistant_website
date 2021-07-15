<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Director_add_model extends CI_Model {

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

  function add_director($data, $is_future=""){
    //echo pre($data);
    // Add to general info
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

    $generalData['created_at'] = date('Y-m-d H:i:s');
    $generalData['updated_at'] = date('Y-m-d H:i:s');
    $general_table = ($is_future=='future') ? 'future_general_info' : 'newsletter_general_info';
    $this->db->insert($general_table, $generalData);
    $last_insert_id = $this->db->insert_id();
    // End general info
    
    if ($last_insert_id > 0) {
      // Add to newsletter_design_info
      $designInfo = getTableFields('design');

      $details = array();
      if ($is_future=='future') {
        array_push($designInfo, 'future_package_date');
        $design_table = 'future_design_info';
        $emails_table = 'future_emails';
        $packaging_table = 'future_packaging';
        $other_details_table = 'future_other_details';
        $details['id_future_newsletter'] = $last_insert_id;
        $infoTable = 'future_general_info';
        $nIdNewsletter = $data['id_newsletter'];
      }else{
        $design_table = 'newsletter_design_info';
        $emails_table = 'newsletter_emails';
        $packaging_table = 'newsletter_packaging';
        $other_details_table = 'newsletter_other_details';
        $details['id_newsletter'] = $last_insert_id;
        $infoTable = 'newsletter_general_info';
        $nIdNewsletter = $last_insert_id;
      }

      $designData = array();
      foreach ($data as $key => $value) {
        if (in_array($key, $designInfo)) {
          $designData[$key]=$value;
        }
      }
      
      if ($is_future=='future') {
        $designData['id_future_newsletter'] = $last_insert_id;
        unset($designData['id_newsletter']);
      }else{
        $designData['id_newsletter'] = $last_insert_id;
      }
      
      $this->db->insert($design_table, $designData);
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
        $emailsData['id_future_newsletter'] = $last_insert_id;
        unset($emailsData['id_newsletter']);
      }else{
        $emailsData['id_newsletter'] = $last_insert_id;
      }

      $this->db->insert($emails_table, $emailsData);
      // End to newsletter_emails


      // Add to newsletter_packaging
      $packagingInfo = getTableFields('packaging');
      $packagingData = array();
      foreach ($data as $key => $value) {
        if (in_array($key, $packagingInfo)) {
          $packagingData[$key]=$value;
        }
      }

      if ($is_future=='future') {
        $packagingData['id_future_newsletter'] = $last_insert_id;
        unset($packagingData['id_newsletter']);
      }else{
        $packagingData['id_newsletter'] = $last_insert_id;
      }
      
      $packagingData['package_value'] = GetPackageValue($data['package'], $data['unit_size']);
      $packagingData['socialM'] = serialize($packagingData['socialM']);
      
      $packagingData['cv_account'] = encryptIt($packagingData['cv_account']);
      $this->db->insert($packaging_table, $packagingData);
      // End to newsletter_packaging


      // Add to newsletter_other_details
      $res = $this->db->insert($other_details_table, $details);
      // End to newsletter_other_details

      // Delete user
      $this->DeleteUser($nIdNewsletter, $generalData['contract_update_date'], $infoTable);
      // Delete user

      // Add to history_general_info
      if ($res) {
        if ($is_future=='future') {
          unset($designData['future_package_date']);
        }
        $this->addDirectorHistory($nIdNewsletter, $generalData, $designData, $emailsData, $packagingData, $details);  
      }
      // End to history_general_info

      $nsd_client = isset($packagingData['nsd_client']) ? $packagingData['nsd_client'] : '0';
      $this->InsertReports($nIdNewsletter, $packagingData['package'], $nsd_client);
      
      $designReports=$this->InsertDesignReports($designData, $packagingData['cu_routing'], $packagingData['cv_account']);

      if ($designReports) {
        $designData['name'] = $data['name'];
        $DesignChangedMail = sendDesignChangedMail($designData);

        if ($DesignChangedMail) {
          $accountRoutingChangedMail =  sendAccountRoutingChangedMail($generalData['name'], $packagingData['cv_account'], $packagingData['cu_routing']);
        }

      }
      return $nIdNewsletter;
    }
  }

  function addDirectorHistory($id_newsletter, $generalData, $designData, $emailsData, $packagingData, $details){
    $generalData['id_newsletter'] = $id_newsletter;
    $this->db->insert('history_general_info', $generalData);

    $id_history = $this->db->insert_id();

    if ($id_history > 0) {
      
      if (isset($designData['id_future_newsletter'])) {
        unset($designData['id_future_newsletter']);
      }

      if (isset($emailsData['id_future_newsletter'])) {
        unset($emailsData['id_future_newsletter']);
      }

      if (isset($packagingData['id_future_newsletter'])) {
        unset($packagingData['id_future_newsletter']);
      }

      if (isset($details['id_future_newsletter'])) {
        unset($details['id_future_newsletter']);
      }

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

  function InsertDesignReports($designData, $cu_routing, $cv_account) {
    $designReportInfo = getTableFields('design_reports');

    $designReportData = array();
    foreach ($designData as $key => $value) {
      if (in_array($key, $designReportInfo)) {
        $designReportData[$key]=$value;
      }
    }
    $designReportData['cu_routing'] = $cu_routing;
    $designReportData['cv_account'] = $cv_account;
    $designReportData['created_at'] = date('Y-m-d H:i:s');
    $designReportData['updated_at'] = date('Y-m-d H:i:s');
    return $this->db->insert('newsletter_design_reports', $designReportData);
  }

  function InsertReports($id_newsletter, $package, $nsd_client) {
    $reportData = array('id_newsletter'=>$id_newsletter, 'package'=>$package, 'nsd_client'=>$nsd_client, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s'));
    return $this->db->insert('reports', $reportData);
  }

  

  function SendFullEmail($id_newsletter, $data) {
    $message = directorMail($data);
    if ($message) {
      $sDetail = htmlentities(($message), ENT_QUOTES);
      $dataInsert = array();
      $dataInsert['userby'] = $this->session->userdata('username');
      $dataInsert['id_newsletter'] = $id_newsletter;
      $dataInsert['purpose'] = 'Update client';
      $dataInsert['detail'] = $sDetail;
      $dataInsert['created_at'] = date("Y-m-d H:i:s");
      $this->db->insert('email_records',$dataInsert);
      $add_to_email_records = $this->db->insert_id();

      if ($add_to_email_records > 0) {
        $this->db->set('select_email', 'C');
        $this->db->where('id_newsletter', $id_newsletter);
        return $this->db->update('newsletter_general_info');
      }
    }
  }

      

}