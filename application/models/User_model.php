<?php

class User_Model extends MY_Model{

	public function __construct(){
		parent::__construct();
	}

	public function get_user_details($condition = array()){

		/* Condition to check email id */
		$where_condition = '';
		if(isset($condition['email_id'])){
			$where_condition .= " u.email_id = '" . $condition['email_id'] . "'"; 
		}

		/* Condition to check password */
		if(isset($condition['password'])){
			$where_condition .= " AND u.password = '" . md5($condition['password']) . "'"; 
		}

		/* Condition to check user status id */
		//$user_status_id_cond = " u.is_active IN (1)";
		//$user_status_id_cond = (isset($condition['user_status_id'])) ? " u.user_status_id IN (".$condition['user_status_id'].") AND " : " u.user_status_id = 1 AND " ;

		/* Default condition to check, company id. */
		/*$company_id_cond = '';
		if($this->session->has_userdata('company_id')){
			$company_id_cond = " c.company_id = ".$this->session->userdata('company_id')." AND ";
		}*/

		$sql = " SELECT 
					u.user_id,
					u.email_id,
					u.first_name,
					u.middle_name,
					u.last_name,
					CONCAT_WS(' ',u.first_name, u.middle_name, u.last_name) AS user_full_name,
					u.user_type
				FROM 
					users AS u
				WHERE
					$where_condition";
						

		return $user_details = $this->run_query($sql);
	}
}

?>