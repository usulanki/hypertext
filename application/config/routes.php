<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Authentication';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//Authentication modules.
$route['submit_login'] = 'Authentication/submit_login'; //ajax call.

//Settings
$route['logout'] = 'Settings/logout';

//Dashboard
$route['dashboard'] = 'Dashboard/load_dashboard';

//Companies.
$route['list_companies'] = 'Company/list_companies';
$route['add_company'] = 'Company/add_company';

//booking
$route['booking'] = 'Booking/index';
$route['booking/(:any)/(:any)'] = 'Booking/listSeatsByRoomDate/$1/$2';
$route['canteen/(:any)/(:any)'] = 'Booking/viewCanteenBookings/$1/$2';
$route['api/booking/listBuildingFloors'] = 'Booking/getBuildingFloorDetails';
$route['api/booking/listFloorRooms'] = 'Booking/getFloorRooms';
$route['api/booking/listFloorRoomsSeats'] = 'Booking/getRoomSeats';
$route['api/booking/userBooking'] = 'Booking/postUserBooking';
$route['api/booking/userBookingDetails'] = 'Booking/getUserDetailsBySeatIdAndDate';
$route['api/booking/userBookingsCountByMonth'] = 'Booking/numberOfUserBookedByMonth';
$route['api/booking/getListOfAvailableSlots'] = 'Booking/getListOfAvailableSlots';