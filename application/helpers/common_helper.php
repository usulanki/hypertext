<?php
/*
	Purpose: setResponse is to convert array data into json response  
*/
if(! function_exists('setResponse')){
	
	function setResponse($status, $data = array(), $message = ''){
		$result = array(
					'status' => $status,
					'data' => isset($data) ? $data : new stdClass(),
					'message' => $message
					);
		header('Content-Type: application/json');
		echo json_encode($result);
	}
}

/*
	Purpose: validate requested params
*/
if(! function_exists('validate_fields')){
	function validate_fields($form = ""){
		
		//get instance of main codeigniter object
		$c =& get_instance();
		
		if(!$c->form_validation->run($form)){
			$data['error'] = $c->form_validation->error_array();
			setResponse(false, $data, 'validation failed');
			return false;
		}
		return true;
	}
}

/*
	Purpose: helper function to get utcdatetime
*/
if ( ! function_exists('get_utc_datetime'))
{
	function get_utc_datetime(){
		date_default_timezone_set('UTC');
		return date('Y-m-d H:i:s');
	}
}

/*
	Purpose to check whether user is logged in or not.
*/
function check_is_user_logged_in(){
	$c = & get_instance();
	if($c->session->has_userdata('user_id') && $c->session->has_userdata('user_type')){
		return true;
	}
	return false;
}


function addJS($arr ,$jsfile){
	array_push($arr, $jsfile);
	return $arr;
}

?>