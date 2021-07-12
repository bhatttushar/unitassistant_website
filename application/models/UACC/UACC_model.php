<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class UACC_model extends CI_Model {

  function uploadProfileImg() {
    if(!empty($_FILES['photo']['name'])) {
      $config['upload_path']='assets/images/profile_img/';
      $config['allowed_types']='gif|jpg|png';
      $this->load->library('upload', $config);

      if($this->upload->do_upload('photo')) {
        $sImage = $this->upload->data('file_name');
      }
    }else {
      $sImage = '';
    }
    return $sImage;
  }

  function add_uacc($data){    
    if (!empty($_FILES['photo']['name'])) {
      $data['photo']=$this->uploadProfileImg();
    }
    unset($data['alt_photo']);
    unset($data['hidden_newsletter']);
    $data['cv_account'] = encryptIt($data['cv_account']);
    $data['discount_code'] = '';
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');
    $this->db->insert('cc_newsletters', $data);
    return $this->db->insert_id();
  }

  function edit_uacc($data, $id_cc_newsletter){    

    if (!empty($_FILES['photo']['name'])) {
      $data['photo']=$this->uploadProfileImg();
    }

    $uncheckedFields = getUncheckedFields('cc_newsletters');
    $uncheckData = array();
    foreach ($uncheckedFields as $key => $value) {
      if (!isset($data[$value])) {
        $uncheckData[$value] = '0';
      }
    }

    $data['cv_account'] = encryptIt($data['cv_account']);
    $data = array_merge($data, $uncheckData);
    
    unset($data['alt_photo']);
    unset($data['hidden_newsletter']);

    $data['discount_code'] = '';
    $data['updated_at'] = date('Y-m-d H:i:s');
    $this->db->set($data);
    $this->db->where('id_cc_newsletter', $id_cc_newsletter);
    return $this->db->update('cc_newsletters');
  }

  function get_uacc_data($id_cc_newsletter){
    $this->db->select('*');
    $this->db->from('cc_newsletters');
    $this->db->where( array('id_cc_newsletter'=>$id_cc_newsletter, 'deleted'=>'0'));
    return $this->db->get()->row_array();
  }

  function add_cc_history($data){
    /*$this->unsetField($data);*/
    unset($data['discount_code']);
    unset($data['hear_us']);
    unset($data['ua_client']);
    unset($data['recurring_check']);
    unset($data['recurring_fullname']);
    unset($data['recurring_merchant']);
    unset($data['recurring_amount']);
    unset($data['recurring_day']);
    unset($data['recurring_sign']);
    unset($data['recurring_today_date']);
    unset($data['revert_date']);
    unset($data['app_login']);
    unset($data['app_last_login']);
    unset($data['fcm']);
    unset($data['app']);
    return $this->db->insert('cc_histories', $data);
  }

  /*function unsetField($data){
    unset($data['discount_code']);
    unset($data['hear_us']);
  }*/


  function delete_cc_client($id_cc_newsletter, $contract_update_date){
    $date = date("m-d-y");
    if($date == $contract_update_date) {
      $data=array('deleted'=>'1','updated_by'=>$this->session->userdata('id_user'),'updated_at'=>date('Y-m-d H:i:s'));
      $this->db->where('id_cc_newsletter', $id_cc_newsletter);
      $this->db->update('cc_newsletters', $data);
    }
  }


  function get_mail_content(){
    $this->db->select('*');
    $this->db->from('tbc_client_messages');
    return $this->db->get()->row_array();
  }

  function get_email_setting(){
    $this->db->select('email_setting');
    $this->db->from('email_setting');
    return $this->db->get()->row()->email_setting;
  }

  function send_mail($data, $mail_content, $edit_client="") {
    $message = send_uacc_mail($data, $mail_content);
    if ($message) {
      $sDetail = htmlentities(($message), ENT_QUOTES);
      $dataInsert = array();
      $dataInsert['userby'] = $this->session->userdata('username');
      $dataInsert['id_cc_newsletter'] = $data['id_cc_newsletter'];
      $dataInsert['purpose'] =  ($edit_client=='') ? 'Add client' : 'Update client';
      $dataInsert['detail'] = $sDetail;
      $dataInsert['created_at'] = date("Y-m-d H:i:s");
      return $this->db->insert('email_records',$dataInsert);
    }
  }

  function get_uacc_past_emails($id_cc_newsletter, $unsub="") {

    $this->db->select('n.id_cc_newsletter as id_cc_newsletter_client, e.*');
    $this->db->from('email_records AS e');
    $this->db->join('cc_newsletters AS n', 'e.id_cc_newsletter = n.id_cc_newsletter', 'left');
    $this->db->where( array('e.id_cc_newsletter'=>$id_cc_newsletter, 'e.deleted'=>'0') );

    if (empty($unsub)) {
      $this->db->where('n.deleted', '0');
    }else{
      $this->db->where('n.deleted', '1');
    }

    $this->db->group_by('e.created_at');
    $this->db->order_by('e.created_at', 'DESC');
    return $this->db->get()->result_array();
  }

  function get_uacc_notes($id_cc_newsletter){

    $id_newsletter = GetNewsletterId($id_cc_newsletter);

    $sAndWhere = " 1 = 1";
    $sAndWhere .= " AND n.deleted= '0' ";
    $sAndWhere .= " AND n.id_cc_newsletter = '" . $id_cc_newsletter . "'";
    if (!empty($id_newsletter)) {
      $sAndWhere .= " OR n.id_newsletter = '" . $id_newsletter . "'";
    }

    $this->db->select('n.id_notify_user, n.created_at, n.note, n.id_cc_newsletter, u.profile_pic, u.first_name, u.last_name');
    $this->db->from('notes AS n');
    $this->db->join('users AS u', 'u.id_user = n.id_user', 'left');
    $this->db->where($sAndWhere);
    $this->db->order_by('n.id_note', 'DESC');
    $this->db->limit(8);
    return $this->db->get()->result_array();
  }

  function add_cc_note($data){

    $dataInsert['id_user'] = CurrentUser();
    $dataInsert['id_cc_newsletter'] = $data['id_cc_newsletter'];
    $dataInsert['id_notify_user'] = $data['users'];
    $dataInsert['note'] = htmlspecialchars(addslashes(trim($data['note'])));
    $dataInsert['created_date'] = date("Y-m-d");
    $dataInsert['created_at'] = date("Y-m-d H:i:s");

    $this->db->insert('notes', $dataInsert);
    return $this->db->insert_id();
  }

  function SendCCNoteEmail($id_cc_newsletter, $data) {
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
    $sSend = sendCCNoteMail($emails, $data, $Assignnames);
   
    if ($sSend) {
      $insertErecords['userby'] = CurrentUser();
      $insertErecords['userto'] = $sUserID;
      $insertErecords['id_cc_newsletter'] = $id_cc_newsletter;
      $insertErecords['purpose'] = 'Add Note';
      $insertErecords['detail'] = $data['note'];
      $insertErecords['created_at'] = date("Y-m-d H:i:s");
      $insertErecords['updated_at'] = date("Y-m-d H:i:s");
      $this->db->insert('email_records',$insertErecords);
    }

  }

  function get_uacc_name($id_cc_newsletter){
    $this->db->select('name');
    $this->db->from('cc_newsletters');
    $this->db->where(array('deleted'=>'1', 'id_cc_newsletter'=>$id_cc_newsletter));
    return $this->db->get()->row_array();
  } 

      

}