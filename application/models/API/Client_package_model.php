<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Client_package_model extends CI_Model {

	function get_client_data($id_client){
		$this->db->select('ng.name, np.unit_size, np.emailing, np.facebook, np.email_newsletter, np.package, np.total_text_program, np.total_text_program7, np.package_pricing, np.personal_unit_app, np.personal_website, np.personal_unit_app_ca, np.personal_url, np.subscription_updates, np.app_color, nd.distribution_one, nd.distribution_two, nd.birthday_one, nd.anniversary_one, nd.status_one, nd.status_two, nd.status_three, nd.status_four, nd.status_five, nd.status_six, nd.status_seven, nd.status_seven1, nd.status_eight, nd.status_nine, nd.last_one, nd.gift_one, nd.gift_two, nd.gift_three, nd.gift_five, nd.consultant_one, nd.consultant_two, nd.consultant_two1, nd.consultant_three, nd.consultant_five, nd.consultant_six, nd.consultant_seven, nd.hidden_newsletter, nd.n_zero, nd.n_one, nd.n_two, nd.n_three, nd.a_one, nd.a_two, nd.a_three, nd.i_one, nd.i_two, nd.i_three, nd.t_one, nd.t_two, nd.t_three, nd.t_four, nd.star_program, nd.design_one');
		$this->db->from('newsletter_general_info AS ng');
		$this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
		$this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
		$this->db->where(array('ng.id_newsletter'=>$id_client, 'ng.deleted'=>'0'));
		$this->db->query('SET SQL_BIG_SELECTS=1'); 
		return $this->db->get()->row_array();
	}

	

}

?>