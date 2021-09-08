<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

	public function __construct(){
		//invoking parent constructor
		parent::__construct();

		$this->load->model('User_model', 'user_model');
    }

    public function logout(){
    	session_destroy();
    	redirect(base_url());
    }
}