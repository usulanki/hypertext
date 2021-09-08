<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends MY_Controller {

	public function __construct(){
		//invoking parent constructor
		parent::__construct();

		$this->load->model('User_model', 'user_model');
    }

    public function index(){
    	$this->load->view('authentication/login');
    }

    public function submit_login(){

    	/*
			1. Validation.
			2. Check email id and password from  database.
			3. Create session.
			4. Redirect page to dashboard.
    	*/
    	$this->form_validation->set_rules('email_id', 'email_id', 'required');
    	$this->form_validation->set_rules('password', 'password', 'required');

    	if(validate_fields() == false){
    		//validation failed.
    		return;
    	}

    	$condition['email_id'] = $this->input->post('email_id');		
		$condition['password'] = $this->input->post('password');
    	$user_details = $this->user_model->get_user_details($condition);

		if(empty($user_details)){
			return setResponse(false, '', "Username/Password does not match");
		}

		$user_details = $user_details[0];

		//basic details
		$this->session->set_userdata('user_id', $user_details['user_id']);
		$this->session->set_userdata('user_type', $user_details['user_type']);
		//$this->session->set_userdata('company_id', $user_details['company_id']);
		//$this->session->set_userdata('company_name', $user_details['company_name']);
		$this->session->set_userdata('email_id', $user_details['email_id']);
		$this->session->set_userdata('user_full_name', $user_details['user_full_name']);
		

		$output['user_id'] = $user_details['user_id'];
		return setResponse(true, $output, 'Logged In Successfully');
    }
}
