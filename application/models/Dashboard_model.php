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





}

?>