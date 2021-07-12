<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Bellafizz_model extends CI_Model {

  function bellafizz_listing($data='', $searchValue='', $row='', $rowperpage='', $columnName='', $columnSortOrder='') {
        $date = date("m-d-y");
        $this->db->select("id_bellafizz");
        $this->db->from('bellafizz');
        $this->db->where('deleted', '0');
        $totalRecords = $this->db->get()->num_rows();

        $searchQuery = " 1=1";
        if($searchValue != ''){
           $searchQuery .= " AND (name like '%".$searchValue."%' or email like '%".$searchValue."%' or rep_id like '%".$searchValue."%' or updated_at like '%".$searchValue."%'  or phone like '%".$searchValue."%' or c_city like '%".$searchValue."%'  or month_billing like '%".$searchValue."%' ) ";
        }

        if ($columnName == 'number') {
          if ($columnSortOrder == 'asc') {
              $columnSortOrder = 'DESC';
          }
          $columnName = 'updated_at';
        }else {
            $columnName = $columnName;
        }

        $this->db->select("id_bellafizz, updated_at, name, email, rep_id, phone, c_city, month_billing");
        $this->db->from('bellafizz');
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

  function delete_bellafizz($id_bellafizz){
    $this->db->set(array('deleted'=>'1', 'updated_at'=>date('Y-m-d H:i:s')));
    $this->db->where('id_bellafizz', $id_bellafizz);
    return $this->db->update('bellafizz');
  }

  function add_bellafizz($data){ 
    $data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');
    $this->db->insert('bellafizz', $data);
    return $this->db->insert_id();
  }

  function edit_bellafizz($data, $id_bellafizz){ 
    $data['updated_at'] = date('Y-m-d H:i:s');
    $this->db->where('id_bellafizz', $id_bellafizz);
    return $this->db->update('bellafizz', $data);
  }

  function get_bellafizz_data($id_bellafizz){
    $this->db->select('*');
    $this->db->from('bellafizz');
    $this->db->where( array('id_bellafizz'=>$id_bellafizz, 'deleted'=>'0'));
    return $this->db->get()->row_array();
  }

  function add_bellafizz_note($data){
    $dataInsert['id_user'] = CurrentUser();
    $dataInsert['id_bellafizz'] = $data['id_bellafizz'];
    $dataInsert['id_notify_user'] = $data['users'];
    $dataInsert['note'] = htmlspecialchars(addslashes(trim($data['note'])));
    $dataInsert['created_date'] = date("Y-m-d");
    $dataInsert['created_at'] = date("Y-m-d H:i:s");

    $this->db->insert('bellafizz_notes', $dataInsert);
    return $this->db->insert_id();
  }

  function get_user_data($id_users){
    $this->db->select('id_user, user_name, email');
    $this->db->from('users');
    $this->db->where_in('id_user', $id_users, FALSE);
    return $this->db->get()->result_array();
  }

  function add_to_email_records($sUserID, $id_bellafizz, $note) {
    $data = array(
      'userby'=> CurrentUser(),
      'userto'=> $sUserID,
      'id_bellafizz'=>$id_bellafizz,
      'purpose'=>'Add Bellafizz Note',
      'detail'=>$note,
      'created_at'=>date("Y-m-d H:i:s"),
      'updated_at'=>date("Y-m-d H:i:s"),
    );

    return $this->db->insert('email_records', $data);
  } 

  function get_bellafizz_notes($id_bellafizz){
    $sAndWhere = " 1 = 1";
    $sAndWhere .= " AND n.deleted= '0' ";
    $sAndWhere .= " AND n.id_bellafizz = '" . $id_bellafizz . "'";

    $this->db->select('n.id_notify_user, n.created_at, n.note, n.id_bellafizz, u.profile_pic, u.first_name, u.last_name');
    $this->db->from('bellafizz_notes AS n');
    $this->db->join('users AS u', 'u.id_user = n.id_user', 'left');
    $this->db->where($sAndWhere);
    $this->db->order_by('n.created_at', 'DESC');
    if ($this->input->post('all')=='') {
      $this->db->limit(8);
    }
    return $this->db->get()->result_array();
  }

  function checkRepExist($id_bellafizz="", $rep_id){
      $this->db->select('rep_id');
      $this->db->from('bellafizz');
      if(empty($id_bellafizz)) {
          $this->db->where(array('rep_id'=>$rep_id));
      }else {
          $this->db->where(array('rep_id'=>$rep_id, 'id_bellafizz !='=>$id_bellafizz));
      }
      $Count = $this->db->get()->num_rows();
      return ($Count > 0) ? '1' : '0';
  }

  function checkEmailExists($email, $id_bellafizz=""){
      $this->db->select('email');
      if(!empty($id_bellafizz)) {
          $this->db->where('id_bellafizz !=',$id_bellafizz);
      }
      $this->db->where('email',$email);
      $Count = $this->db->get('bellafizz')->num_rows();       
      return ($Count > 0) ? 'Email Address must be unique!!' : '0';
  }


}