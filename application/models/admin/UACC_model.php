<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class UACC_model extends CI_Model {

  public function uacc_list() {
    $date = date("m-d-y");
    $this->db->select("id_cc_newsletter, id_newsletter, name, email, consultant_number, intouch_password, cv_account, cu_routing");
    $this->db->from('cc_newsletters');
    $this->db->where(array('deleted'=>'0', 'cc'=>'Y'));
    $this->db->order_by('name', 'ASC');
    return $this->db->get()->result_array();
  }

  function get_newsletter_data($consultant_number){
    $sAndWhere  = " 1 = 1";
    $sAndWhere .= " AND ng.contract_update_date !=''";
    $sAndWhere .= " AND nd.package_for = 'C'";
    $sAndWhere .= " AND ng.deleted = 1";
    $sAndWhere .= " AND ng.contract_update_date < DATE_SUB(NOW(), INTERVAL 90 DAY)";
    $sAndWhere .= " AND ng.consultant_number = '" . $consultant_number . "'";
    $sAndWhere .= " AND ng.consultant_number != ''";
    $this->db->select('ng.id_newsletter, nd.id_newsletter');
    $this->db->from('newsletter_general_info AS ng');
    $this->db->join('newsletter_design_info as nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
    $this->db->where($sAndWhere);
    $this->db->query('SET SQL_BIG_SELECTS=1');
    return $this->db->get()->num_rows();
  }

  function delete_uacc($id_cc_newsletter){
    $this->db->set(array('deleted'=>'1', 'updated_by'=>'admin', 'updated_at'=>date('Y-m-d H:i:s')));
    $this->db->where('id_cc_newsletter', $id_cc_newsletter);
    return $this->db->update('cc_newsletters');
  }

  function delete_selected_uacc($id_cc_newsletter){
    $id_cc_newsletter = explode(',', $id_cc_newsletter);
    $this->db->set(array('deleted'=>'1', 'updated_by'=>'admin', 'updated_at'=>date('Y-m-d H:i:s')));
    $this->db->where_in('id_cc_newsletter', $id_cc_newsletter);
    return $this->db->update('cc_newsletters');
  }

  // Fetching director history detail
  function get_uacc_history($id_cc_newsletter){
    $this->db->select('u.user_name, h.id_cc_history, h.updated_by,h.name,h.cc_director_title,h.cv_account, h.updated_at');
    $this->db->from('cc_histories AS h');
    $this->db->join('users AS u', 'h.id_user=u.id_user', 'left');
    $this->db->where(array('h.id_cc_newsletter'=>$id_cc_newsletter, 'h.activated'=>'1', 'h.deleted'=>'0'));
    $this->db->order_by('h.created_at','DESC');
    return $this->db->get()->result_array();
  }

  function delete_uacc_history($id_cc_history){
    $this->db->set(array('deleted'=>'1', 'updated_at'=>date('Y-m-d H:i:s')));
    $this->db->where('id_cc_history', $id_cc_history);
    return $this->db->update('cc_histories');
  }

  function delete_selected_uacc_history($id_cc_history){
    $id_cc_history = explode(',', $id_cc_history);
    $this->db->set(array('deleted'=>'1', 'updated_at'=>date('Y-m-d H:i:s')));
    $this->db->where_in('id_cc_history', $id_cc_history);
    return $this->db->update('cc_histories');
  }

  function view_uacc_history($id_cc_history){
    $this->db->select('*');
    $this->db->from('cc_histories');
    $this->db->where(array('id_cc_history'=>$id_cc_history, 'activated'=>'1', 'deleted'=>'0'));
    return $this->db->get()->row_array();
  }

  function get_archieved_uacc_clients(){
    $this->db->select('u.user_name,n.id_cc_newsletter,n.updated_by,n.name, n.updated_at, n.package_pricing,n.cv_account');
    $this->db->from('cc_newsletters AS n');
    $this->db->join('users AS u', 'u.id_user=n.id_user', 'left');
    $this->db->where('n.deleted', '1');
    $this->db->order_by('n.created_at', 'DESC');
    return $this->db->get()->result_array();
  }

  function revert_uacc_client($id_cc_newsletter) {
    $this->db->set(array('deleted' => '0', 'updated_at' => date('Y-m-d H:i:s')));
    $this->db->where_in('id_cc_newsletter', $id_cc_newsletter);
    return $this->db->update('cc_newsletters');
  }

  function revert_to_uacc_client_list($id_cc_newsletter) {
    $this->db->set(array('deleted' => '0', 'revert_date' => date('Y-m-d H:i:s'), 'contract_update_date'=>''));
    $this->db->where_in('id_cc_newsletter', $id_cc_newsletter);
    return $this->db->update('cc_newsletters');
  }  

  function get_unsuscribed_uacc_clients(){
    $sAndWhere  = " 1 = 1";
    $sAndWhere .= " AND contract_update_date !=''";
    $sAndWhere .= " AND deleted = '1'";
    $sAndWhere .= " AND contract_update_date < DATE_SUB(NOW(), INTERVAL 90 DAY)";

    $this->db->select('name, contract_update_date');
    $this->db->from('cc_newsletters');
    $this->db->where($sAndWhere);
    $this->db->order_by('created_at', 'DESC');
    return $this->db->get()->result_array();
  }
  

}