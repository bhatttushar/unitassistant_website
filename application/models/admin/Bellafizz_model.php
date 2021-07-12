<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Bellafizz_model extends CI_Model {

  public function bellafizz_list() {
    $this->db->select('id_bellafizz, name, email, loginid, updated_at');
    $this->db->from('bellafizz');
    $this->db->where('deleted', '0');
    $this->db->order_by('created_at', 'DESC');
    return $this->db->get()->result_array();
  }

  function delete_bellafizz($id_bellafizz){
    $this->db->set(array('deleted'=>'1', 'updated_at'=>date('Y-m-d H:i:s')));
    $this->db->where('id_bellafizz', $id_bellafizz);
    return $this->db->update('bellafizz');
  }  

  function fetch_bellafizz_data($id_bellafizz=""){
    $this->db->select('c_city, name, address, city, state, zip, email, loginid, password, pmt_type, cc_number, cc_code, cc_expir_date, cc_zip, month_billing, website, facebook, referred, updated_at');
    $this->db->from('bellafizz');

    if (!empty($id_bellafizz)) {
      $this->db->where('id_bellafizz', $id_bellafizz);
    }

    $this->db->where('deleted', '0');
    $this->db->order_by('name', 'ASC');
    return $this->db->get()->result_array();
  }

}