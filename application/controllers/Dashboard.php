<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct(){
	    parent::__construct();
		
		$this->load->model('Dashboard_model', 'dashboard_model');
	    /*header('Access-Control-Allow-Origin: *');
	    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");*/
    }

    public function load_dashboard(){
    	$logged_user_type = $this->session->userdata('user_type');
    	
    	if($logged_user_type == 'SUPER_ADMIN'){
    		$this->load_super_admin_dashboard();
    	}
    	elseif($logged_user_type == 'COMPANY_ADMIN'){
    		$this->load_company_admin_dashboard();
    	}
    	elseif($logged_user_type == 'COMPANY_EMPLOYEE'){
    		$this->load_company_employee_dashboard();
    	}
    }

    public function load_super_admin_dashboard(){
		$data['totalCompanies'] = $this->dashboard_model->total_companies();
    	$this->load_inner_page('dashboard/super_admin_dashboard',$data);
    }

    public function load_company_admin_dashboard(){
    	$this->load_inner_page('dashboard/company_admin_dashboard');
    }

    public function load_company_employee_dashboard(){

        $data['menus'] = $this->dashboard_model->getMenus('5');
    	$this->load_inner_page('dashboard/company_employee_dashboard',$data);
    }

	public function loadProfile(){

		$data['userDetails'] = $this->dashboard_model->getUserDetails($this->session->user_id);
		$this->load_inner_page('common/profile',$data);
	}

	/*public function index()
	{    
        $role_id =  $this->session->userdata('role_id');
        $this->load->model('dashboard_model');
        $menus = $this->dashboard_model->getMenus($role_id);

		$this->load->view('dashboard',['menus' => $menus]);
	}*/
}
