<?php

class Company_Model extends MY_Model{

	public function __construct(){
		parent::__construct();
	}

	public function list_companies($condition = array()){

		/*$where_condition = '';
		if(isset($condition['company_status'])){
			$where_condition .= " c.company_status in ('ACTIVE', 'IN_ACTIVE')"; 
		}*/

		$sql = "SELECT 
					c.company_id,
					c.company_name,
					CONCAT_WS(' ',u.first_name, u.middle_name, u.last_name) AS company_admin_name,
					u.email_id as company_admin_email_id,
					c.company_status,
					c.company_validity_start_date,
					c.company_validity_end_date
				FROM 
					companies AS c
				INNER JOIN 
					users u ON 
						u.user_id = c.company_admin_user_id
				WHERE
					c.company_status in ('ACTIVE', 'IN_ACTIVE')";
						
		return $this->run_query($sql);
	}
}

?>