<?php

class Dashboard_Model extends MY_Model
{

   public function __construct(){
		parent::__construct();
	}

   public function getMenus($role_id){
      $qry= $this->db->select('m.*')
                     ->from('user_permission p')
                     ->join('menu_master m','m.menu_id=p.menu_id','left')
                     ->where('p.role_id',$role_id)
                     ->get();
      if($qry->num_rows()){
         return $qry->result_array();
       }else{
        return FALSE;
       }
   }

   public function total_companies($condition = array()){

		$sql = "SELECT 
					 COUNT(company_id) AS numberOfCompanies
				FROM 
					companies AS c
				INNER JOIN 
					users u ON 
						u.user_id = c.company_admin_user_id
				WHERE
					c.company_status in ('ACTIVE', 'IN_ACTIVE')";
						
		return $this->run_query($sql);
   }

   public function getUserDetails($userId){
      $sql = "SELECT 
                  u.user_id,
                  u.email_id,
                  u.first_name,
                  u.middle_name,
                  u.last_name,u.gender,u.phone,u.address,d.department_name,dn.designation_name,
                  CONCAT_WS(' ',u.first_name, u.middle_name, u.last_name) AS user_full_name,
                  u.user_type
               FROM 
                  users AS u
                  INNER JOIN department d on d.department_id = u.department_id
                  INNER JOIN designations dn on dn.designation_id = u.designation_id
                  WHERE u.user_id = '$userId' and u.is_active =1
                  ";

      return $this->run_query($sql);                  
   }





}

?>