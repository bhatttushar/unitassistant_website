<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Director_model extends CI_Model {

  public function director_list() {
    $date = date("m-d-y");
    $this->db->select("ng.id_newsletter, ng.updated_by, ng.name, ng.updated_at, ng.consultant_number, np.unit_size, np.package_pricing, np.point_value, np.last_email_update_date, no.approved_date, nd.design_one, no.design_approve_status, u.user_name as user_name");
    $this->db->from('newsletter_general_info AS ng');
    $this->db->join('users AS u', 'u.id_user=ng.id_user', 'left');
    $this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
    $this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
    $this->db->join('newsletter_other_details AS no', 'no.id_newsletter=ng.id_newsletter', 'left');
    $this->db->where(array('ng.deleted'=>'0'));
    $this->db->where("(ng.contract_update_date ='' OR ng.contract_update_date >".$date.")", NULL, FALSE);
    $this->db->order_by('ng.created_at', 'DESC');
    $this->db->query('SET SQL_BIG_SELECTS=1');
    return $this->db->get()->result_array();
  }

  function get_cc_newsletter_data($consultant_number){
    $sAndWhere  = " 1 = 1";
    $sAndWhere .= " AND contract_update_date !=''";
    $sAndWhere .= " AND deleted = 1";
    $sAndWhere .= " AND contract_update_date < DATE_SUB(NOW(), INTERVAL 90 DAY)";
    $sAndWhere .= " AND consultant_number = '" .$consultant_number. "'";
    $sAndWhere .= " AND consultant_number != ''";

    $this->db->select('id_cc_newsletter');
    $this->db->from('cc_newsletters');
    $this->db->where($sAndWhere);
    return $this->db->get()->num_rows();
  }

  function update_design_approve_status($id_newsletter){
    $this->db->set(array('design_approve_status'=>'1', 'approved_date'=>date('Y-m-d H:i:s')));
    $this->db->where('id_newsletter', $id_newsletter);
    return $this->db->update('newsletter_other_details');
  }

  function update_design_dis_approve_status($id_newsletter){
    $this->db->set(array('design_approve_status'=>'2', 'approved_date'=>date('Y-m-d H:i:s')));
    $this->db->where('id_newsletter', $id_newsletter);
    return $this->db->update('newsletter_other_details');
  }

  function add_approve_log($id_newsletter,$is_approve,$is_send_mail,$approve_using,$error_log){
    $data = array('id_newsletter'=>$id_newsletter, 'is_approve'=>$is_approve, 'is_send_mail'=>$is_send_mail,'approve_using'=>$approve_using, 'error_log'=>$error_log);
    return $this->db->insert('approve_log', $data);
  }

  function delete_director($id_newsletter){
    $this->db->set(array('deleted'=>'1', 'updated_by'=>'admin', 'updated_at'=>date('Y-m-d H:i:s')));
    $this->db->where('id_newsletter', $id_newsletter);
    return $this->db->update('newsletter_general_info');
  }

  // Fetching director history detail
  function director_history($nNewsLetterId){
    $this->db->select('u.user_name, hg.id_history, hg.id_newsletter, hg.updated_by, hg.name, hg.unit_number, hg.director_title, hp.point_value, hp.cv_account, hg.updated_at');
    $this->db->from('history_general_info AS hg');
    $this->db->join('users AS u', 'hg.id_user=u.id_user', 'left');
    $this->db->join('history_packaging AS hp', 'hp.id_history=hg.id_history', 'left');
    $this->db->where(array('hg.id_newsletter'=>$nNewsLetterId, 'hg.activated'=>'1', 'hg.deleted'=>'0'));
    $this->db->order_by('hg.created_at','DESC');
    return $this->db->get()->result_array();
  }

  function view_director_history($id_history){
    $this->db->select('hg.*, hd.*, hp.*');
    $this->db->from('history_general_info AS hg');
    $this->db->join('history_design_info AS hd', 'hd.id_history=hg.id_history', 'left');
    $this->db->join('history_packaging AS hp', 'hp.id_history=hg.id_history', 'left');
    $this->db->where(array('hg.id_history'=>$id_history, 'hg.activated'=>'1', 'hg.deleted'=>'0'));
    return $this->db->get()->row_array();
  }

  function get_email_details($id_newsletter){
    $this->db->select('n.id_newsletter as id_newsletter_client, e.*, u.id_user');
    $this->db->from('email_records AS e');
    $this->db->join('newsletter_general_info AS n', 'n.id_newsletter=e.id_newsletter', 'left');
    $this->db->join('users AS u', 'u.id_user=e.userto', 'left');
    $this->db->where('e.id_newsletter', $id_newsletter);
    $this->db->group_by('e.purpose');
    $this->db->order_by('e.created_at', 'DESC');
    return $this->db->get()->result_array();
  }

  function getViewEmailDetails($id_newsletter, $purpose){
    $purpose = urldecode($purpose);
    $sAndWhere  = " 1 = 1";
    $sAndWhere .= " AND e.id_newsletter = '".$id_newsletter."'";
    $sAndWhere .= " AND e.purpose = '".$purpose."'";

    $this->db->select('n.id_newsletter AS id_newsletter_client, e.*, u.id_user');
    $this->db->from('email_records AS e');
    $this->db->join('newsletter_general_info AS n', 'e.id_newsletter=n.id_newsletter', 'left');
    $this->db->join('users AS u', 'e.userby=u.id_user', 'left');

    if ($purpose=='Add Note') {
      $sAndWhere .= " AND u.deleted = 0";
      $sAndWhere .= " AND e.deleted = 0";
      $sAndWhere .= " AND n.deleted = 0";
      $this->db->where($sAndWhere); 
      $this->db->group_by('e.created_at');
    }else if ($purpose == 'Reminder') {
      $this->db->where($sAndWhere); 
      $this->db->group_by('e.detail');
    }else{
      $this->db->where($sAndWhere);
    }
    $this->db->order_by('e.created_at', 'DESC');
    return $this->db->get()->result_array();
  }

  function saveClientNewsDetails($aLanguage){
    $this->db->select("ng.*, np.*, nd.*, no.design_approve_status");
    $this->db->from('newsletter_general_info AS ng');
    $this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
    $this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
    $this->db->join('newsletter_other_details AS no', 'no.id_newsletter=ng.id_newsletter', 'left');
    $this->db->where( array('ng.deleted'=>'0', 'ng.id_newsletter'=>$aLanguage['id_newsletter']));
    $this->db->query('SET SQL_BIG_SELECTS=1');
    $detail = $this->db->get()->result_array();
    $result = newsletter_message_mail($detail, $aLanguage);
    if ($result == TRUE) {
      return TRUE;
    }
  }

  function saveNewsletterMsg($newsletter_messages){
    $aMessage = $this->db->get_where('newsletter_messages', array('id_newsletter_message'=>'1') )->result_array();
    unset($newsletter_messages['save_newsletter_messages']);
    $newsletter_messages['english'] = htmlspecialchars(addcslashes($newsletter_messages['english'], "W"));
    $newsletter_messages['spanish'] = htmlspecialchars(addcslashes($newsletter_messages['spanish'], "W"));
    $newsletter_messages['french'] = htmlspecialchars(addcslashes($newsletter_messages['french'], "W"));

    if (empty($aMessage)) {
      return $this->db->insert('newsletter_messages', $newsletter_messages);
    }else{
      $this->db->set($newsletter_messages);
      $this->db->where('id_newsletter_message', '1');
      return $this->db->update('newsletter_messages');
    }
  }

  function delete_history($id_history){
    $this->db->set(array('deleted'=>'1', 'updated_at'=>date('Y-m-d H:i:s')));
    $this->db->where('id_history', $id_history);
    return $this->db->update('history_general_info');
  }

  function delete_all_history($id_history){
    $nHistoryId = explode(',', $id_history);
    $this->db->set(array('deleted'=>'1', 'updated_at'=>date('Y-m-d H:i:s')));
    $this->db->where_in('id_history', $nHistoryId);
    return $this->db->update('history_general_info');
  }

  function delete_selected_director($id_newsletter){
    $this->db->set(array('deleted'=>'1', 'updated_by'=>'users_file2', 'updated_at'=>date('Y-m-d H:i:s')));
    $this->db->where('id_newsletter', $id_newsletter);
    return $this->db->update('newsletter_general_info');
  }

  function get_name_and_consultant_number($id_newsletter){
    $this->db->select('ng.name, ng.consultant_number, no.id_newsletter');
    $this->db->from('newsletter_general_info AS ng');
    $this->db->join('newsletter_other_details AS no', 'no.id_newsletter=ng.id_newsletter', 'left');
    $this->db->where(array('ng.id_newsletter'=>$id_newsletter, 'ng.deleted'=>'0', 'no.design_approve_status !='=>'1'));
    return $this->db->get()->row_array();
  }   

  // Fetching future client list
  function getFutureUpdateList(){
    $date = date("m-d-y");
    $sAndWhere  = " 1 = 1";
    $sAndWhere .= " AND fd.package_for='F'";
    $sAndWhere .= " AND fd.future_package_date >= '".$date."'";
    $sAndWhere .= " AND fg.deleted = '0'";

    $this->db->select('fg.id_newsletter, fg.updated_by, fg.name, fg.consultant_number, fp.point_value, fp.unit_size, fp.package_pricing, fd.hidden_newsletter, fd.design_one, fd.future_package_date, fo.design_approve_status, u.user_name');
    $this->db->from('future_general_info AS fg');
    $this->db->join('users AS u', 'u.id_user=fg.id_user');
    $this->db->join('future_packaging AS fp', 'fp.id_future_newsletter=fg.id_future_newsletter');
    $this->db->join('future_design_info AS fd', 'fd.id_future_newsletter=fg.id_future_newsletter');
    $this->db->join('future_other_details AS fo', 'fo.id_future_newsletter=fg.id_future_newsletter');
    $this->db->where($sAndWhere);
    $this->db->order_by('fg.created_at', 'DESC');
    $this->db->query('SET SQL_BIG_SELECTS=1');
    return $this->db->get()->result_array();
  }

  function getFutureHistory($id_newsletter){
    $this->db->select('fg.*, fd.*, fp.*');
    $this->db->from('future_general_info AS fg');
    $this->db->join('future_design_info AS fd', 'fd.id_future_newsletter=fg.id_future_newsletter', 'left');
    $this->db->join('future_packaging AS fp', 'fp.id_future_newsletter=fg.id_future_newsletter', 'left');
    $this->db->where(array('fg.id_newsletter'=>$id_newsletter, 'fg.activated'=>'1', 'fg.deleted'=>'0'));
    return $this->db->get()->row_array();
  }

  function deleteFutureClient($id_newsletter) {
    $this->db->set(array('deleted' => '1', 'updated_by'=>'admin_future_up', 'updated_at' => date('Y-m-d H:i:s')));
    $this->db->where('id_newsletter', $id_newsletter);
    return $this->db->update('future_general_info');
  }

  function deleteSelectedFutureClient($id_newsletters) {
    $id_newsletters = explode(',', $id_newsletters);
    $this->db->set(array('deleted' => '1', 'updated_by'=>'admin_future_up2','updated_at' => date('Y-m-d H:i:s')));
    $this->db->where_in('id_newsletter', $id_newsletters);
    return $this->db->update('future_general_info');
  }

  function get_archieved_clients(){
    $this->db->select('u.user_name, ng.id_newsletter, ng.updated_by, ng.name, ng.unit_number, ng.updated_at, np.unit_size, np.package_pricing, nd.hidden_newsletter, nd.design_one, np.point_value, np.cv_account, no.design_approve_status');
    $this->db->from('newsletter_general_info AS ng');
    $this->db->join('users AS u', 'u.id_user=ng.id_user', 'left');
    $this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
    $this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
    $this->db->join('newsletter_other_details AS no', 'no.id_newsletter=ng.id_newsletter', 'left');
    $this->db->where('ng.deleted', '1');
    $this->db->order_by('ng.created_at', 'DESC');
    $this->db->query('SET SQL_BIG_SELECTS=1');
    return $this->db->get()->result_array();
  }

  function revert_client($id_newsletter) {
    $this->db->set(array('deleted' => '0', 'updated_at' => date('Y-m-d H:i:s')));
    $this->db->where_in('id_newsletter', $id_newsletter);
    return $this->db->update('newsletter_general_info');
  }

  function revert_to_client_list($id_newsletter) {
    $this->db->set(array('deleted' => '0', 'revert_date' => date('Y-m-d H:i:s'), 'contract_update_date'=>''));
    $this->db->where_in('id_newsletter', $id_newsletter);
    return $this->db->update('newsletter_general_info');
  }

  function get_unsuscribed_clients(){
    $sAndWhere  = " 1 = 1";
    $sAndWhere .= " AND ng.contract_update_date !=''";
    $sAndWhere .= " AND nd.package_for = 'C'";
    $sAndWhere .= " AND ng.deleted = '1'";
    $sAndWhere .= " AND ng.contract_update_date < DATE_SUB(NOW(), INTERVAL 90 DAY)";

    $this->db->select('ng.name, ng.contract_update_date');
    $this->db->from('newsletter_general_info AS ng');
    $this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
    $this->db->where($sAndWhere);
    $this->db->order_by('ng.created_at', 'DESC');
    return $this->db->get()->result_array();
  }


}