<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {

	public function __construct(){
	    parent::__construct();

	    $this->load->model('Company_model', 'company_model');
    }

    public function list_companies(){
    	$data['company_list'] = $this->company_model->list_companies();
    	$this->load_inner_page('company/company_list', $data);
    }
}
?>