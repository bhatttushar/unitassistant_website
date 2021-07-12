<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Future_director_list_model extends CI_Model {

  function future_director_listing($data='', $searchValue='', $row='', $rowperpage='', $columnName='', $columnSortOrder='') {
        $date = date("m-d-y");
        $this->db->select("fg.id_newsletter");
        $this->db->from('future_general_info AS fg');
        $this->db->join('future_design_info AS fd', 'fd.id_future_newsletter=fg.id_future_newsletter', 'left');
        $this->db->where(array('fd.package_for'=>'F', 'fg.deleted'=>'0', 'fd.future_package_date >='=>$date));
        $totalRecords = $this->db->get()->num_rows();

        $searchQuery = " 1=1";
        if($searchValue != ''){
           $searchQuery .= " AND (fg.name like '%".$searchValue."%' or fg.email like '%".$searchValue."%' or fg.consultant_number like'%".$searchValue."%' or fg.cell_number like'%".$searchValue."%' or u.user_name like'%".$searchValue."%' or u.first_name like'%".$searchValue."%' or fg.director_title like'%".$searchValue."%' or fg.intouch_password like'%".$searchValue."%') ";
        }

        $this->db->select("fg.id_newsletter");
        $this->db->from('future_general_info AS fg');
        $this->db->join('future_design_info AS fd', 'fd.id_future_newsletter=fg.id_future_newsletter', 'left');
        $this->db->join('users AS u', 'u.id_user=fg.id_user', 'left');
        $this->db->where($searchQuery);
        $this->db->where(array('fd.package_for'=>'F', 'fg.deleted'=>'0', 'fd.future_package_date >='=>$date));
        $totalRecordwithFilter = $this->db->get()->num_rows();

        if ($columnName == 'number') {
            if ($columnSortOrder == 'asc') {
                $columnSortOrder = 'DESC';
            }
            $columnName = 'fg.created_at';
        }elseif ($columnName == 'user_name' || $columnName == 'first_name') {
            $columnName = 'u.'.$columnName;
        }

        $this->db->select("fg.id_newsletter, fg.contract_update_date, fg.updated_at, fg.newsletters_design, fg.name, fg.director_title, fg.consultant_number, fg.intouch_password, fd.future_package_date, fd.hidden_newsletter, fd.design_one, fd.beatly_url, fd.beatly_url_one, fd.beatly_url_two, fp.nsd_client, fp.total_text_program, fp.package, fp.unit_size, fp.package_pricing, fp.point_value, fo.design_approve_status, u.user_name as user_name, u.first_name as first_name");

        $this->db->from('future_general_info AS fg');
        $this->db->join('users AS u', 'u.id_user=fg.id_user', 'left');
        $this->db->join('future_packaging AS fp', 'fp.id_future_newsletter=fg.id_future_newsletter', 'left');
        $this->db->join('future_design_info AS fd', 'fd.id_future_newsletter=fg.id_future_newsletter', 'left');
        $this->db->join('future_other_details AS fo', 'fo.id_future_newsletter=fg.id_future_newsletter', 'left');
        $this->db->where($searchQuery);
        $this->db->where(array('fd.package_for'=>'F', 'fg.deleted'=>'0', 'fd.future_package_date >='=>$date));
        //$this->db->order_by($columnName, $columnSortOrder);
        //$this->db->limit($rowperpage, $row);
        $this->db->order_by('fd.future_package_date', 'DESC');
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $query = $this->db->get();
        $data = $query->result_array();

        return array('details'=>$data, 'query'=>$query, 'total_records'=>$totalRecords, 'total_record_filter'=>$totalRecordwithFilter);
  }

    function delete_director($id_newsletter){
        $data=array('deleted'=>'1', 'updated_by'=>$this->session->userdata('username'), 'updated_at'=>date('Y-m-d H:i:s'));
        $this->db->set($data);
        $this->db->where('id_newsletter', $id_newsletter);
        return $this->db->update('future_general_info');
    }  

}