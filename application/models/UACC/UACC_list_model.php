<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class UACC_list_model extends CI_Model {

  function uacc_listing($data='', $searchValue='', $row='', $rowperpage='', $columnName='', $columnSortOrder='') {
        $date = date("m-d-y");
        $this->db->select("id_cc_newsletter");
        $this->db->from('cc_newsletters');
        $this->db->where(array('cc'=>'Y', 'deleted'=>'0'));
        $totalRecords = $this->db->get()->num_rows();

        $searchQuery = " 1=1";
        if($searchValue != ''){
           $searchQuery .= " AND (name like '%".$searchValue."%' or email like '%".$searchValue."%' or consultant_number like'%".$searchValue."%' or cell_number like'%".$searchValue."%' or intouch_password like'%".$searchValue."%' or contract_update_date like'%".$searchValue."%' or national_area like'%".$searchValue."%' or seminar_affiliation like'%".$searchValue."%') ";
        }

        if ($columnName == 'number') {
          if ($columnSortOrder == 'asc') {
              $columnSortOrder = 'DESC';
          }
          $columnName = 'created_at';
        }elseif($columnName == 'isUa') {
            $columnName = 'consultant_number';
        }

        $this->db->select("name, email, status_done, m_bill_date, created_at, contract_update_date, cell_number, consultant_number, intouch_password, national_area, seminar_affiliation, id_cc_newsletter, digital_biz_card, reffered_by");
        $this->db->from('cc_newsletters');
        $this->db->where($searchQuery);
        $this->db->where(array('cc'=>'Y', 'deleted'=>'0'));
        //$this->db->order_by($columnName, $columnSortOrder);
        //$this->db->limit($rowperpage, $row);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        $data = $query->result_array();
        $totalRecordwithFilter = count($data);

        return array('details'=>$data, 'query'=>$query, 'total_records'=>$totalRecords, 'total_record_filter'=>$totalRecordwithFilter);
  }

  function get_uacc_client_emails($id_cc_newsletter){
    $this->db->select('purpose, created_at');
    $this->db->from('email_records');
    $this->db->group_by('purpose');
    $this->db->where(array('deleted'=>'0','id_cc_newsletter'=>$id_cc_newsletter));
    $this->db->order_by('created_at', 'DESC');
    return $this->db->get()->result_array();
  }

  function get_view_uacc_client_email($id_cc_newsletter, $purpose) {
    $this->db->select('n.id_cc_newsletter as id_cc_newsletter_client, e.*');
    $this->db->from('email_records AS e');
    $this->db->join('cc_newsletters AS n', 'e.id_cc_newsletter = n.id_cc_newsletter', 'left');
    $this->db->where(array('e.id_cc_newsletter'=>$id_cc_newsletter, 'e.deleted'=>'0', 'n.deleted'=>'0', 'e.purpose'=>$purpose));
      
    if ($purpose=='Reminder') {
      $this->db->group_by('e.detail');
    }else{
      $this->db->group_by('e.created_at');
    }

    $this->db->order_by('e.created_at', 'DESC');
    return $this->db->get()->result_array();
  }

  function unsub_uacc_listing($data='', $searchValue='', $row='', $rowperpage='', $columnName='', $columnSortOrder='') {
        
        $sAndWhere  = " 1 = 1";
        $sAndWhere .= " AND contract_update_date != ''";
        $sAndWhere .= " AND deleted = 1";
        $sAndWhere .= " AND contract_update_date < DATE_SUB(NOW(), INTERVAL 90 DAY)";

        $this->db->select("id_cc_newsletter");
        $this->db->from('cc_newsletters');
        $this->db->where($sAndWhere);
        $totalRecords = $this->db->get()->num_rows();

        $searchQuery = " ";
        if($searchValue != ''){
           $searchQuery .= " AND (name like '%".$searchValue."%' or email like '%".$searchValue."%' or consultant_number like'%".$searchValue."%' or cell_number like'%".$searchValue."%' or intouch_password like'%".$searchValue."%' or contract_update_date like'%".$searchValue."%' or national_area like'%".$searchValue."%' or seminar_affiliation like'%".$searchValue."%') ";
        }

        if ($columnName == 'number') {
            if ($columnSortOrder == 'asc') {
                $columnSortOrder = 'DESC';
            }
            $columnName = 'contract_update_date';
        }else {
            $columnName = $columnName;
        }

        /*if ($columnName == 'contract_update_date') {
            $columnName = "STR_TO_DATE(contract_update_date, '%m-%d-%Y')";
        }*/

        $this->db->select("id_cc_newsletter, name, email, contract_update_date, cell_number, consultant_number, intouch_password, national_area, seminar_affiliation");
        $this->db->from('cc_newsletters');
        $this->db->where($sAndWhere.' '.$searchQuery);
        //$this->db->order_by($columnName, $columnSortOrder);
        //$this->db->limit($rowperpage, $row);
        $this->db->order_by('contract_update_date', 'DESC');
        $query = $this->db->get();
        $data = $query->result_array();
        $totalRecordwithFilter = count($data);
        return array('details'=>$data, 'query'=>$query, 'total_records'=>$totalRecords, 'total_record_filter'=>$totalRecordwithFilter);
    }

}