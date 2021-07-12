<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Unsub_director_model extends CI_Model {

  function unsub_director_listing($data='', $searchValue='', $row='', $rowperpage='', $columnName='', $columnSortOrder='') {
        $date = date("m-d-y");
        $this->db->select("ng.id_newsletter");
        $this->db->from('newsletter_general_info AS ng');
        $this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
        $this->db->where(array('nd.package_for'=>'C', 'ng.deleted'=>'1', 'ng.contract_update_date !='=>''));
        $totalRecords = $this->db->get()->num_rows();

        $searchQuery = " 1=1";
        if($searchValue != ''){
           $searchQuery .= " AND (ng.name like '%".$searchValue."%' or ng.email like '%".$searchValue."%' or ng.consultant_number like'%".$searchValue."%' or ng.cell_number like'%".$searchValue."%' or u.user_name like'%".$searchValue."%' or u.first_name like'%".$searchValue."%' or ng.director_title like'%".$searchValue."%' or ng.intouch_password like'%".$searchValue."%') ";
        }

        if ($columnName == 'number') {
            if ($columnSortOrder == 'asc') {
                $columnSortOrder = 'DESC';
            }
            $columnName = 'ng.created_at';
        }elseif ($columnName == 'user_name' || $columnName == 'first_name') {
            $columnName = 'u.'.$columnName;
        }

        $this->db->select("ng.id_newsletter, ng.cell_number, ng.contract_update_date, ng.updated_at, ng.newsletters_design, ng.name, ng.director_title, ng.consultant_number, ng.intouch_password, nd.hidden_newsletter, nd.design_one, nd.beatly_url, nd.beatly_url_one, nd.beatly_url_two, np.nsd_client, np.total_text_program, np.package, np.unit_size, np.package_pricing, np.point_value, np.last_email_update_date, no.approved_date, no.design_approve_status, u.user_name as user_name, u.first_name as first_name");

        $this->db->from('newsletter_general_info AS ng');
        $this->db->join('users AS u', 'u.id_user=ng.id_user', 'left');
        $this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
        $this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
        $this->db->join('newsletter_other_details AS no', 'no.id_newsletter=ng.id_newsletter', 'left');
        $this->db->where($searchQuery);
        $this->db->where('ng.deleted', '1');
        $this->db->where("(ng.contract_update_date ='' OR ng.contract_update_date  >".$date.")", NULL, FALSE);
        //$this->db->order_by($columnName, $columnSortOrder);
        //$this->db->limit($rowperpage, $row);
        $this->db->order_by('ng.created_at', 'DESC');
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        $data = $query->result_array();

        $totalRecordwithFilter = count($data);

        return array('details'=>$data, 'query'=>$query, 'total_records'=>$totalRecords, 'total_record_filter'=>$totalRecordwithFilter);
  }

    function get_notes_data($id_newsletter){
        $id_cc_newsletter = oldCCN($id_newsletter);

        $sAndWhere = " 1 = 1";
        $sAndWhere .= " AND n.deleted= 0";
        $sAndWhere .= " AND n.id_newsletter = '" . $id_newsletter . "'";
        if (!empty($id_cc_newsletter)) {
          $sAndWhere .= " OR n.id_cc_newsletter = '" . $id_cc_newsletter . "'";
        }
        
        $this->db->select('n.id_newsletter, n.id_cc_newsletter, n.id_notify_user, n.note, n.created_at, u.profile_pic,u.first_name,u.last_name');
        $this->db->from('notes AS n');
        $this->db->join('users AS u', 'u.id_user = n.id_user', 'left');
        $this->db->where($sAndWhere);
        $this->db->order_by('n.created_at','DESC');
        if ($this->input->post('all')=='') {
          $this->db->limit(8);
        }
        return $this->db->get()->result_array();
    }

    function getName($id_newsletter){
        $this->db->select('name');
        $this->db->from('newsletter_general_info');
        $this->db->where(array('deleted'=>'1', 'id_newsletter'=>$id_newsletter));
        return $this->db->get()->row_array();
    }

    function GetPastEmails($id_newsletter) {
        $this->db->select('n.id_newsletter as id_newsletter_client, e.*');
        $this->db->from('email_records AS e');
        $this->db->join('newsletter_general_info AS n', 'e.id_newsletter = n.id_newsletter', 'left');
        $this->db->where( array('e.id_newsletter'=>$id_newsletter, 'e.deleted'=>'0', 'n.deleted'=>'1') );
        $this->db->group_by('e.created_at');
        $this->db->order_by('e.created_at', 'DESC');
        return $this->db->get()->result_array();
      }


}