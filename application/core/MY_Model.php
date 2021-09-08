<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Purpose: General crud operations  
 */
class MY_Model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}

	/*
		Function: run_query
		Purpose: To run the sql query
	*/
	public function run_query($sql_query){
		return $this->db->query($sql_query)->result_array();
	}

	/*
		Function: insert
		Purpose: To insert an array data by passing 
		table name & data array as arguments.
	*/
	public function insert($table_name, $new_row_data){
		$new_row_data['created_at'] = get_utc_datetime();
		if($this->db->insert($table_name, $new_row_data)){
			$this->insert_id = $this->db->insert_id();
			return true;
		}
		return false;
	}

	/*
		Function: lists
		Purpose: To get array data by passing table name
		& condition as arguments.
	*/
 	public function lists($table, $condition = array()){
 		if($condition) $this->db->where($condition);
 		return $this->db->get($table)->result_array();
 	}

 	/*
		Function: update
		Purpose: To update an array data by passing
		table name, condition & array data as arguments
 	*/
 	public function update($data, $condition, $table){
 		$this->db->where($condition);
 		return $this->db->update($table, $data);
 	}
}
?>