<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Booking extends MY_Controller
{

	private $bookingService;

	public function __construct()
	{
		parent::__construct();

		//		$this->bookingService = new BookingService();

		$this->load->model('Booking_model', 'booking_model');
	}

	/**
	 * load the booking view
	 * 
	 */
	public function index()
	{

		$buildingDetails = $this->booking_model->getListOfCompanyBuildingsByLocation(1, 1);
		$floorDetails = $this->booking_model->getListOfFloorsByBuilding(1);
		$arr = array();
		$jsArr = addJs($arr, base_url('assets/js/booking/booking.js'));
		$this->load_inner_page('booking/booking', ['buildingData' => $buildingDetails, "floorsData" => $floorDetails, 'jsArr' => $jsArr]);
	}

	public function listSeatsByRoomDate($roomId = '', $floorId = '')
	{
		$floorRoomSeatDetails = $this->booking_model->getListOfRoomSeats($roomId, $floorId);
		$floorRoomDetails = $this->booking_model->getFloorRoomDetailsById($floorId);
		$buildingFloorDetails = $this->booking_model->getBuildingFloorDetailsById(1);
		$bookingRoomMessage = $floorRoomDetails[0]['room_name']. " > ". $buildingFloorDetails[0]['floor_name'];

		$todayDate = date("Y-m-d");
		$twoDaysAgo = date('Y-m-d', strtotime('-1 days', strtotime($todayDate)));
		$userBookings =  $this->booking_model->listAllUserBookingsByDate($todayDate);
		$ids = array();
		if(!empty($userBookings)){
			foreach ($userBookings as $key => $value) {
				array_push($ids,$value['booking_id']);
			}
		}
		$userBookingsTwoDaysAgo =  $this->booking_model->listAllUserBookingsByBetweenDate($todayDate,$twoDaysAgo,implode(',',$ids));		
		$floorRoomDetails = $this->booking_model->getListOfRoomSeats($roomId, $floorId);
		$newBookingData = array();
		$i=0;
		foreach ($floorRoomSeatDetails as $key => $eachFloorRoomDetails) {
			$newBookingData[$i][$key] = $eachFloorRoomDetails;
				foreach ($userBookings as $eachBookings) {
					if ($eachFloorRoomDetails['seat_id'] == $eachBookings['seat_id']) {
						$newBookingData[$i][$key]['bookings'] =  $eachBookings;
					}
				}				
				foreach ($userBookingsTwoDaysAgo as $eachBookingsTwodays) {
					if ($eachFloorRoomDetails['seat_id'] == $eachBookingsTwodays['seat_id']) {
						$newBookingData[$i][$key]['bookings'] =  $eachBookingsTwodays;
						$newBookingData[$i][$key]['bookings']['booking_status'] = '3';
					}
				}							

			if( ($key % 40) == 0   && $key!=0 ){
				$i++;
			} 
		}
		//echo array_search($userBookings[0]['seat_id'],$floorRoomDetails);exit;
		$output['floorRoomDetails'] = $newBookingData;
		$arr = array();
		$jsArr = addJs($arr, base_url('assets/js/booking/booking.js'));
		$jsArr = addJs($jsArr, base_url('assets/js/booking/user-booking.js'));
		$this->load_inner_page('booking/seatbooking', ["floorSeatData" => $newBookingData,'todayDate'=>$todayDate,'bookingRoomMessage'=>$bookingRoomMessage, 'jsArr' => $jsArr]);
	}

	public function viewCanteenBookings($roomId = '', $floorId = ''){
		$floorRoomSeatDetails = $this->booking_model->getListOfRoomSeats($roomId, $floorId);
		$floorRoomDetails = $this->booking_model->getFloorRoomDetailsById($floorId);
		$buildingFloorDetails = $this->booking_model->getBuildingFloorDetailsById(1);
		$bookingRoomMessage = $floorRoomDetails[0]['room_name']. " > ". $buildingFloorDetails[0]['floor_name'];
		$shiftId = '';
		$todayDate = date("Y-m-d");
		$twoDaysAgo = date('Y-m-d', strtotime('-1 days', strtotime($todayDate)));
		$userBookings =  $this->booking_model->listAllUserBookingsByDate($todayDate,$shiftId);
		$ids = array();
		if(!empty($userBookings)){
			foreach ($userBookings as $key => $value) {
				array_push($ids,$value['booking_id']);
			}
		}
		$userBookingsTwoDaysAgo =  $this->booking_model->listAllUserBookingsByBetweenDate($todayDate,$twoDaysAgo,implode(',',$ids));		
		$floorRoomDetails = $this->booking_model->getListOfRoomSeats($roomId, $floorId);
		$newBookingData = array();
		$i=0;
		foreach ($floorRoomSeatDetails as $key => $eachFloorRoomDetails) {
			$newBookingData[$i][$key] = $eachFloorRoomDetails;

				foreach ($userBookings as $eachBookings) {
					if ($eachFloorRoomDetails['seat_id'] == $eachBookings['seat_id']) {
						$newBookingData[$i][$key]['bookings'] =  $eachBookings;
					}
				}				

				foreach ($userBookingsTwoDaysAgo as $eachBookingsTwodays) {
					if ($eachFloorRoomDetails['seat_id'] == $eachBookingsTwodays['seat_id']) {
						$newBookingData[$i][$key]['bookings'] =  $eachBookingsTwodays;
						$newBookingData[$i][$key]['bookings']['booking_status'] = '3';
					}
				}					
		


			if( ($key % 40) == 0   && $key!=0 ){
				$i++;
			} 
		}
		//echo array_search($userBookings[0]['seat_id'],$floorRoomDetails);exit;
		$output['floorRoomDetails'] = $newBookingData;

		$arr = array();
		$jsArr = addJs($arr, base_url('assets/js/booking/booking.js'));
		$jsArr = addJs($jsArr, base_url('assets/js/booking/canteen-booking.js'));
		$this->load_inner_page('booking/canteenbooking', ["floorSeatData" => $newBookingData,'todayDate'=>$todayDate,'bookingRoomMessage'=>$bookingRoomMessage, 'jsArr' => $jsArr]);		
	}

	/**
	 * List the building floor details
	 * 
	 */
	public function getBuildingFloorDetails()
	{

		try {
			$buildingId = $this->input->post('buildingId');
			$floorDetails = $this->booking_model->getListOfFloorsByBuilding($buildingId);
			$output['floorDetails'] = $floorDetails;
			return setResponse(true, $output, 'Floor Details');
		} catch (Exception $e) {
			return setResponse(false, $output, $e);
		}
	}

	/**
	 * List the building floor room details
	 * 
	 */
	public function getFloorRooms()
	{

		try {
			$floorId = $this->input->post('floorId');
			$floorRoomDetails = $this->booking_model->getListOfFloorsRooms($floorId);
			$output['floorRoomDetails'] = $floorRoomDetails;
			return setResponse(true, $output, 'Floor Room Details');
		} catch (Exception $e) {
			return setResponse(false, $output, $e);
		}
	}

	/**
	 * List the building floor room seats
	 * 
	 */
	public function getRoomSeats()
	{
		try {
			$data = json_decode(file_get_contents('php://input'), true);
			if (empty($_POST)) {
				if (empty($data)) {
					return setResponse(false, 'Invalid Request');
				}
				$roomId = $data['roomId'];
				$floorId = $data['floorId'];
				$seatsForDate = $data['seatsForDate'];
				$shiftId = isset($data['shiftId']) ? $data['shiftId'] : '';
			} else {
				$roomId = $this->input->post('roomId');
				$floorId = $this->input->post('floorId');
				$seatsForDate = $this->input->post('seatsForDate');
				$shiftId = $this->input->post('shiftId');
			}
			$shiftId = isset($shiftId) ? $shiftId : '';
			$ids = array();
			$twoDaysAgo = date('Y-m-d', strtotime('-1 days', strtotime($seatsForDate)));
			$userBookings =  $this->booking_model->listAllUserBookingsByDate($seatsForDate,$shiftId);
			if(!empty($userBookings)){
				foreach ($userBookings as $key => $value) {
					array_push($ids,$value['booking_id']);
				}
			}
			$userBookingsTwoDaysAgo =  $this->booking_model->listAllUserBookingsByBetweenDate($seatsForDate,$twoDaysAgo,implode(',',$ids));
			// echo "<pre>";print_r($userBookings);exit;
			$floorRoomDetails = $this->booking_model->getListOfRoomSeats($roomId, $floorId);
			$newBookingData = array();
			$i=0;
			foreach ($floorRoomDetails as $key => $eachFloorRoomDetails) {
				
				$newBookingData[$i][$key] = $eachFloorRoomDetails;
					foreach ($userBookings as $eachBookings) {
						if ($eachFloorRoomDetails['seat_id'] == $eachBookings['seat_id']) {
							$newBookingData[$i][$key]['bookings'] =  $eachBookings;
						}
					}
					foreach ($userBookingsTwoDaysAgo as $eachBookingsTwodays) {
						if ( ($eachFloorRoomDetails['seat_id'] == $eachBookingsTwodays['seat_id']) && empty($shiftId) ) {
							$newBookingData[$i][$key]['bookings'] =  $eachBookingsTwodays;
							$newBookingData[$i][$key]['bookings']['booking_status'] = '3';
						}
					}									

				if( ($key % 40) == 0   && $key!=0 ){
				 $i++;
				} 

			}
			//echo array_search($userBookings[0]['seat_id'],$floorRoomDetails);exit;
			$output['floorRoomDetails'] = $newBookingData;
			//$output['userBookings'] = $userBookings;
			return setResponse(true, $output, 'Floor Room Details');
		} catch (Exception $e) {
			return setResponse(false, $output, $e);
		}
	}

	/**
	 * user booking floor room seats
	 * 
	 */
	public function postUserBooking()
	{
		try {

			$data = json_decode(file_get_contents('php://input'), true);
			if (empty($_POST)) {
				if (empty($data)) {
					return setResponse(false, 'Invalid Request');
				}
				$fromUserId = $data['fromUserId'];
				$toUserId = $data['toUserId'];
				$bookingfordate = $data['bookingfordate'];
				$seatId = $data['seatId'];
				$revokeBooking = $data['revokeBooking'];
				$mealId = $data['shiftId'];
			} else {
				$fromUserId = $this->session->userdata('user_id');
				$toUserId = $this->input->post('toUserId');
				$bookingfordate = $this->input->post('bookingfordate');
				$seatId = $this->input->post('seatId');
				$revokeBooking = $this->input->post('revokeBooking');
				$mealId = $this->input->post('shiftId');
			}
			$logged_user_type = $this->session->userdata('user_type');
			$allowedUserTypes = array('SUPER_ADMIN', 'COMPANY_ADMIN');
			$isAllowedToBook = in_array($logged_user_type, $allowedUserTypes);
			$mealId = isset($mealId) ? $mealId : null;

			$today = date("Y-m-d H:i:s");
			
			if ($bookingfordate > $today && $isAllowedToBook && !$revokeBooking) {
				
				$isUserAlreadyBookedForDate =  $this->booking_model->listUserBookingsByDate($bookingfordate, $toUserId);
				//echo "<pre>";print_r($isUserAlreadyBookedForDate);exit();
				$isSeatAvailable = $this->booking_model->listUserSeatBydate($bookingfordate, $toUserId, $seatId);
				if(empty($isSeatAvailable) && $mealId != '0'){
					$userBookingResult = $this->booking_model->saveUserBooking($toUserId, $seatId, $bookingfordate,$mealId, $fromUserId);

					$messageSucess = 'Booked Done for '.$toUserId.' at ' . $bookingfordate;					
				} elseif ( (empty($isSeatAvailable) && empty($isUserAlreadyBookedForDate) ) ) {
					$userBookingResult = $this->booking_model->saveUserBooking($toUserId, $seatId, $bookingfordate,null, $fromUserId);

					$messageSucess = 'Booked Done for '.$toUserId.' at ' . $bookingfordate;
				}else{
					$messageErr = 'Selected seat is not free or you have selected a seat today already';
				}
			}else{
				if($revokeBooking) {
					$userBookingResult = $this->booking_model->deleteUserBooking($toUserId,$seatId);
					$messageSucess = 'Booking revoked';
				}else{
					if(!$isAllowedToBook) {
						$messageErr = 'You dont have access to book seat ';
				   }else{
					   $messageErr = 'Please Select Date greater than today';	
				   }
				}

				
			}
			$output['bookingDetails'] = '';
			if(!empty($messageErr)){
				return setResponse(false, $output, $messageErr);
			}
			$output['bookingDetails'] = $userBookingResult;
			
			//$output['userBookings'] = $userBookings;
			return setResponse(true, $output, $messageSucess);
		} catch (Exception $e) {
			return setResponse(false, $output, $e);
		}
	}

	public function getUserDetailsBySeatIdAndDate(){

		try {
			$data = json_decode(file_get_contents('php://input'), true);
			if (empty($_POST)) {
				if (empty($data)) {
					return setResponse(false, 'Invalid Request');
				}
				$seatId = $data['seatId'];
				$seatsForDate = $data['seatsForDate'];
			} else {
				$seatId = $this->input->post('seatId');
				$seatsForDate = $this->input->post('seatsForDate');
			}		
			$userBookingDetailsBySeatId = $this->booking_model->listUserDetailsBookingsByDateRoomIdFloorId($seatId,$seatsForDate);
			$message = '';
			$output['userBookingDetails'] = $userBookingDetailsBySeatId;
			return setResponse(true, $output, $message);
		} catch (Exception $e) {
			return setResponse(false, $output, $e);	
		}		
	}

	public function numberOfUserBookedByMonth(){

		try {
			$data = json_decode(file_get_contents('php://input'), true);
			if (empty($_POST)) {
				if (empty($data)) {
					return setResponse(false, 'Invalid Request');
				}
				$buildingId = $data['buildingId'];
				$forMonth = $data['forMonth'];
				$forYear = $data['forYear'];
			} else {
				$buildingId = $this->input->post('buildingId');
				$forMonth = $this->input->post('forMonth');
				$forYear = $this->input->post('forYear');
			}
			$datesList=array();
			
			for($d=1; $d<=31; $d++)
			{
				$time=mktime(12, 0, 0, $forMonth, $d, $forYear);          
				if (date('m', $time)==$forMonth){
					$datesList[]=date('Y-m-d', $time);
					$noOfUsersBookedByMonth[$d] = $this->booking_model->listNoOfUsersBookedByMonth($buildingId,date('Y-m-d', $time));
				}       
					
			}
			$output['totalUserByMonth'] = $noOfUsersBookedByMonth;
			$message = '';
			return setResponse(true, $output, $message);
			

		} catch (Exception $e) {
			
		}
	}

	public function getListOfAvailableSlots(){

		try {
			$data = json_decode(file_get_contents('php://input'), true);
			if (empty($_POST)) {
				if (empty($data)) {
					return setResponse(false, 'Invalid Request');
				}
				// $buildingId = $data['buildingId'];
				// $forMonth = $data['forMonth'];
				$forDate = $data['forDate'];
			} else {
				// $buildingId = $this->input->post('buildingId');
				// $forMonth = $this->input->post('forMonth');
				$forDate = $this->input->post('forDate');
			}
			$ids = array();
			$listOfSlots = array();
			//$bookingDetails = $this->booking_model->listSeatsBySlotTime($forDate);
			$bookingDetails = '';
			if(!empty($bookingDetails)){
				foreach ($bookingDetails as $key => $value) {
					array_push($ids,$value['meal_id']);
				}
	
				$listOfSlots = $this->booking_model->listOfShits(implode(',',$ids));
			}else{
				$listOfSlots = $this->booking_model->listOfAllShits();
			}

			$output['listOfSlots'] = $listOfSlots;
			$message = '';
			return setResponse(true, $output, $message);
			

		} catch (Exception $e) {
			
		}
	}

	public function getListUserBookingsDetailsByDate(){

		$userId = $this->session->userdata('user_id');
		$date = '2021-09-05';
		$message = '';
		if(empty($userId)) { $message = 'Invalid Request'; }
		$userBookingDetails = $this->booking_model->listOfUserBookingsDate($userId,$date);
		$newUserBookingDetails = array();
		$newUserBookedByDetails = array();
		foreach ($userBookingDetails as $key => $value) {
			$newUserBookingDetails[$key] = $value;
			$seatDetails = $this->booking_model->getFloorRoomDetailsBySeatId($value['seat_id']);

			$roomDetails = $this->booking_model->getFloorsRoomsDetails($seatDetails['0']['room_id']);
			$floorDetails = $this->booking_model->getBuildingFloorDetailsById($seatDetails['0']['floor_id']);
			$newUserBookingDetails[$key]['roomDetails'] = $roomDetails['0'];
			$newUserBookingDetails[$key]['floorDetails'] = $floorDetails['0'];
			$newUserBookingDetails[$key]['seatDetails'] = $seatDetails['0'];

		}
		$userBookingByDetails = $this->booking_model->listOfUserBookingsByDate($userId,$date);
		foreach ($userBookingByDetails as $key => $value) {
			$newUserBookedByDetails[$key] = $value;
			$seatDetails = $this->booking_model->getFloorRoomDetailsBySeatId($value['seat_id']);

			$roomDetails = $this->booking_model->getFloorsRoomsDetails($seatDetails['0']['room_id']);
			$floorDetails = $this->booking_model->getBuildingFloorDetailsById($seatDetails['0']['floor_id']);
			$newUserBookedByDetails[$key]['roomDetails'] = $roomDetails['0'];
			$newUserBookedByDetails[$key]['floorDetails'] = $floorDetails['0'];
			$newUserBookedByDetails[$key]['seatDetails'] = $seatDetails['0'];

		}
		$output['userBookingDetails'] = $newUserBookingDetails;
		$output['userBookedByDetails'] = $newUserBookedByDetails;

		$arr = array();
		$jsArr = addJs($arr, base_url('assets/js/booking/userbooking_details.js'));
		$this->load_inner_page('booking/userbookings', ['userBookingData' => $output] );
		//return setResponse(true, $output, $message);
		
	}


}
