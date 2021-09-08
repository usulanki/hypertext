<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();

		//check wether user is logged in
		if($this->router->fetch_class() == 'Authentication'){
			if(check_is_user_logged_in() == true){
				redirect(base_url('dashboard'));
			}
		}
		else{
			if(check_is_user_logged_in() == false){
				redirect(base_url());
			}
		}
	}

	public function load_inner_page($page, $data = ''){
		$this->load->view('common/head', $data);
		$this->load->view('common/header', $data);
		$this->load->view($page, $data);
		$this->load->view('common/footer', $data);
	}
}
?>