<?php

class Booking_Model extends MY_Model
{

   public function getListOfCompanyBuildingsByLocation($cid,$lid){

      $sql = "SELECT 
               b.*
               FROM 
                 company_buildings as b
               WHERE
               b.building_status in ('ACTIVE') AND 
               b.company_id=".$cid. " AND  b.location_id=". $lid ;

      return $this->run_query($sql);
   }

   public function getListOfFloorsByBuilding($bid){

      $sql = "SELECT 
               f.*
               FROM 
                 building_floors as f
               WHERE
               f.floor_status in ('ACTIVE') AND 
               f.building_id=".$bid ;                     

      return $this->run_query($sql);       
   }

   public function getListOfFloorsRooms($fid){

      $sql = "SELECT 
               r.*
               FROM 
                 rooms as r
               WHERE
               r.room_status in ('ACTIVE') AND 
               r.floor_id=".$fid ;                       

      return $this->run_query($sql); 
   }

   public function getListOfRoomSeats($rid,$fid){

      $sql = "SELECT 
               s.*
               FROM 
                 seats as s
               WHERE
               s.seat_status in ('ACTIVE') AND 
               s.floor_id=".$fid." AND s.room_id=".$rid ;                       

      return $this->run_query($sql);
   }

   public function getFloorRoomDetailsById($fid){

      $sql = "SELECT 
               r.*
               FROM 
                 rooms as r
               WHERE
               r.room_status in ('ACTIVE') AND 
               r.floor_id=".$fid ;                      

      return $this->run_query($sql);
   }

   public function getBuildingFloorDetailsById($fid){

      $sql = "SELECT 
               f.*
               FROM 
                 building_floors as f
               WHERE
               f.floor_status in ('ACTIVE') AND 
               f.floor_id=".$fid ;                     

      return $this->run_query($sql);       
   }   

   public function listAllUserBookings(){
      $sql = "SELECT 
              b.*
              FROM              
              user_bookings as b
              ";
      return $this->run_query($sql);              
   }

   public function listBookingsByUserid($userId){
      $sql = "SELECT 
              b.*
              FROM              
              user_bookings as b
              WHERE b.user_id = ".$userId
              ;
      return $this->run_query($sql);              
   }

   public function listAllUserBookingsByDate($date,$shiftId=''){
      if(!empty($shiftId)){
         $addSql = "ub.meal_id = $shiftId  AND ";
      }else{
         $addSql = '';
      }
      $sql = "SELECT 
               u.*,ub.*
               FROM              
               users as u JOIN
               user_bookings as ub
               ON u.user_id = ub.user_id
               WHERE $addSql ub.booked_for_date >= '". $date . "' AND ub.booked_for_date <= '". $date . " 23:59' "
               ;
     // echo $sql;exit;
      return $this->run_query($sql);
   }

   public function listUserDetailsBookingsByDateRoomIdFloorId($seatId,$date){
      $sql = "SELECT 
               u.*,ub.*
               FROM              
               users as u JOIN
               user_bookings as ub
               ON u.user_id = ub.user_id
               WHERE  ub.seat_id = '$seatId' AND ub.booked_for_date >= '". $date . "' AND ub.booked_for_date <= '". $date . " 23:59' "
               ;
      
      return $this->run_query($sql);
   }

   public function listAllUserBookingsByBetweenDate($startDate,$endDate,$ids){
      $and = '';
      if(!empty($ids)){
         $and = "NOT IN ($ids) ";
      }
      
      $sql = "SELECT 
               u.*,ub.*
               FROM              
               users as u JOIN
               user_bookings as ub
               ON u.user_id = ub.user_id
               WHERE ub.booked_for_date >= '". $endDate . "' AND ub.booked_for_date <= '". $startDate . " 23:59' 
               AND ub.booking_id $and
               "
               ;
//               echo $sql;exit;
      return $this->run_query($sql);
   }

   public function listUserBookingsByDate($date,$userId){
      $sql = "SELECT 
               b.*
               FROM              
               user_bookings as b
               WHERE b.booked_for_date  >= '". $date . "' AND b.booked_for_date <= '". $date . " 23:59' 
               AND b.user_id = ".$userId
               ;
      return $this->run_query($sql);
   }

   public function listUserSeatBydate($date,$userId,$seatId){

      $sql = "SELECT 
               b.*
               FROM              
               user_bookings as b
               WHERE b.booked_for_date  >= '". $date . "' AND b.booked_for_date <= '". $date . " 23:59' 
               AND b.seat_id =" .$seatId. "  
               AND b.user_id = ".$userId
               ;
      return $this->run_query($sql);

   }

   public function saveUserBooking($userId,$seatId,$bookedForDate,$mealId,$bookedById){

      $data = array(
         'user_id'=>$userId,
         'seat_id'=>$seatId,
         'booked_for_date'=>$bookedForDate,
         'booking_status'=>'1',
         'meal_id'=>$mealId,
         'booked_by'=>$bookedById
     );
   return $this->insertReturnId('user_bookings',$data);

   }

   public function deleteUserBooking($userId,$seatId){

     return $this->db->delete('user_bookings', array('user_id'=>$userId,
     'seat_id'=>$seatId));

   }

   public function listNoOfUsersBookedByMonth($date,$forDate){

      $sql = "SELECT 
              COUNT(b.user_id) as totalUsers
               FROM              
               user_bookings as b
               WHERE b.booked_for_date  >= '". $forDate . "' AND b.booked_for_date <= '". $forDate . " 23:59' "
               ;
      $result = $this->run_query($sql);
      return $result[0]['totalUsers'];

   } 

   public function listOfShits($ids){

      $sql = "SELECT 
               * FROM
               shifts where shift_id NOT IN (".$ids.") "
               ;

      return $this->run_query($sql);

   }
   public function listOfAllShits(){

      $sql = "SELECT 
               * FROM
               shifts "
               ;

      return $this->run_query($sql);

   }

   public function listSeatsBySlotTime($date){
      $sql = "SELECT 
               b.meal_id
               FROM              
               user_bookings as b
               WHERE b.booked_for_date  >= '". $date . "' AND b.booked_for_date <= '". $date . " 23:59' 
               AND b.meal_id IS NOT NULL  "
               ;

      return $this->run_query($sql);      
   }

}
