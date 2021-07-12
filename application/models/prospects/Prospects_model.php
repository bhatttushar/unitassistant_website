<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Prospects_model extends CI_Model {

  function prospects_listing($data='', $searchValue='', $row='', $rowperpage='', $columnName='', $columnSortOrder='') {
        $date = date("m-d-y");
        $this->db->select("id_prospect");
        $this->db->from('prospects');
        $this->db->where('deleted', '0');
        $totalRecords = $this->db->get()->num_rows();

        $searchQuery = " 1=1";
        if($searchValue != ''){
           $searchQuery .= " AND (name like '%".$searchValue."%' or phone like '%".$searchValue."%' or notes like '%".$searchValue."%' ) ";
        }

        if ($columnName == 'number') {
          if ($columnSortOrder == 'asc') {
              $columnSortOrder = 'DESC';
          }
          $columnName = 'id_prospect';
        }else {
            $columnName = $columnName;
        }

        $this->db->select("id_prospect, name, phone, updated_at");
        $this->db->from('prospects');
        $this->db->where($searchQuery);
        $this->db->where('deleted', '0');
        //$this->db->order_by($columnName, $columnSortOrder);
        //$this->db->limit($rowperpage, $row);
        $this->db->order_by('updated_at', 'DESC');
        $query = $this->db->get();
        $data = $query->result_array();
        $totalRecordwithFilter = count($data);

        return array('details'=>$data, 'query'=>$query, 'total_records'=>$totalRecords, 'total_record_filter'=>$totalRecordwithFilter);
  }

  function delete_prospects($id_prospect){
    $this->db->set('deleted', '1');
    $this->db->where('id_prospect', $id_prospect);
    return $this->db->update('prospects');
  }

  function add_prospects($data){ 
    $data['created_at'] = date('Y-m-d H:i:s');
    $this->db->insert('prospects', $data);
    return $this->db->insert_id();
  }

  function edit_prospects($data, $id_prospect){  
    $data['updated_at'] = date('Y-m-d H:i:s');
    $this->db->where('id_prospect', $id_prospect);
    return $this->db->update('prospects', $data);
  }

  function get_prospects_data($id_prospect){
    $this->db->select('id_prospect, name, phone');
    $this->db->from('prospects');
    $this->db->where( array('id_prospect'=>$id_prospect, 'deleted'=>'0'));
    return $this->db->get()->row_array();
  }

  function add_prospects_note($data){
    $dataInsert['id_user'] = CurrentUser();
    $dataInsert['id_prospect'] = $data['id_prospect'];
    $dataInsert['id_notify_user'] = $data['users'];
    $dataInsert['note'] = htmlspecialchars(addslashes(trim($data['note'])));
    $dataInsert['created_date'] = date("Y-m-d");
    $dataInsert['created_at'] = date("Y-m-d H:i:s");

    $this->db->insert('prospects_notes', $dataInsert);
    return $this->db->insert_id();
  }

  function get_user_data($id_users){
    $this->db->select('id_user, user_name, email');
    $this->db->from('users');
    $this->db->where_in('id_user', $id_users, FALSE);
    return $this->db->get()->result_array();
  }

  function add_to_email_records($sUserID, $id_prospect, $note) {
    $data = array(
      'userby'=> CurrentUser(),
      'userto'=> $sUserID,
      'id_prospect'=>$id_prospect,
      'purpose'=>'Add Prospect Note',
      'detail'=>$note,
      'created_at'=>date("Y-m-d H:i:s"),
      'updated_at'=>date("Y-m-d H:i:s"),
    );

    return $this->db->insert('email_records', $data);
  } 

  function get_prospects_notes($id_prospect){
    $sAndWhere = " 1 = 1";
    $sAndWhere .= " AND n.deleted= '0' ";
    $sAndWhere .= " AND n.id_prospect = '" . $id_prospect . "'";

    $this->db->select('n.id_notify_user, n.created_at, n.note, n.id_prospect, u.profile_pic, u.first_name, u.last_name');
    $this->db->from('prospects_notes AS n');
    $this->db->join('users AS u', 'u.id_user = n.id_user', 'left');
    $this->db->where($sAndWhere);
    $this->db->order_by('n.created_at', 'DESC');
    if ($this->input->post('all')=='') {
      $this->db->limit(8);
    }
    return $this->db->get()->result_array();
  }





}