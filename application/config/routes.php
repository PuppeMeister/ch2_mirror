<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] 				= "index";
$route['404_override'] 						= '';

$route['poc_availability'] 					= "availability/index";
$route['poc_availability/region/all'] 		= "availability/index";
$route['poc_availability/region'] 			= "availability/region";
$route['poc_availability/region_view'] 		= "availability/region_view";
$route['poc_availability/sitedetail'] 		= "availability/siteDetail";

$route['gis_alarm/online'] 					= "map/index";
$route['gis_alarm/online/vipsite'] 			= "map/vipsite";
$route['gis_alarm/online/jalurlebaran']		= "map/jalurlebaran";
$route['gis_alarm/online/event']			= "map/event";
$route['gis_alarm/offline'] 				= "map/offline_index";
$route['gis_alarm/alarmdetail'] 			= "map/getSiteAlarmDetail";
$route['gis_alarm/sitestatus'] 				= "map/getSiteStatusWithinRadius";
$route['gis_alarm/sitedetail_ajax']			= "map/getSiteDetailAjax";
$route['gis_alarm/check_site'] 				= "map/getSiteStatus";
$route['gis_alarm/vipsitestatus'] 			= "map/getVIPSiteStatus";
$route['gis_alarm/get_route_ajax/(:any)/(:any)']			= "map/ajaxroute/$1/$2";
$route['gis_alarm/get_jalur_lebaran_map_data/(:any)/(:any)/(:any)/(:any)'] = "map/getSelectedJalurLebaranRouteStatus/$1/$2/$3/$4";

$route['subscriber-trend-movement/regional-view']= "subscriber_trend/index";
$route['subscriber-trend-movement/detail-view']= "subscriber_trend/detail";

$route['mass-check']						= "mass_check";
$route['mass-check/check']					= "mass_check/check_by_text";

//administrator route
$route['app/user_groups'] 					= "group/index";
$route['app/user_groups/create'] 			= "group/create";
$route['app/user_groups/doCreate'] 			= "group/store";
$route['app/user_groups/update/(:num)']		= "group/update/$1";
$route['app/user_groups/doUpdate']			= "group/doUpdate";
$route['app/user_groups/view']				= "group/view";
$route['app/user_groups/delete/(:num)']		 	= "group/delete/$1";

$route['app/users'] 						= "user/index";
$route['app/users/create'] 					= "user/create";
$route['app/users/doCreate'] 				= "user/store";
$route['app/users/update']					= "user/update";
$route['app/users/doUpdate/(:num)']			= "user/doUpdate/($1)";
$route['app/users/view']					= "user/view";
$route['app/users/delete']		 			= "user/delete";


/* End of file routes.php */
/* Location: ./application/config/routes.php */