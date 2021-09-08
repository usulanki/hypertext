<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
	    parent::__construct();
	    header('Access-Control-Allow-Origin: *');
	    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    }

	public function index()
	{
		$this->load->view('login');
	}


	public function authenticateUser(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');


		$this->db->select('u.user_id,u.first_name,u.middle_name,u.last_name,u.email,u.role_id');
		$this->db->from('users u');
		$this->db->from('role_master r','u.user_id=r.user_id','left');
		$this->db->where('u.email',$email);
		$this->db->where('u.password',md5($password));
		$qry = $this->db->get();
        
        if($qry->num_rows()>0){

        	$user_data = $qry->row_array();

        	$redirect_url = base_url()."dashboard";

        	$this->session->set_userdata('user_id',$user_data['user_id']);
        	$this->session->set_userdata('role_id',$user_data['role_id']);
        	$this->session->set_userdata('user_data',$user_data);

        	$return_data = array('status' => true, 'redirect_url' => $redirect_url);

        }else{
        	$return_data = array('status' => false);
        }

        echo json_encode($return_data);

	}
}
