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
|	https://codeigniter.com/userguide3/general/routing.html
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
| When you set this option to TRUE, it will replace ALL dashes with
| underscores in the controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'C_auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['auth'] 			 			 	= "C_auth/index";
$route['auth/(:num)'] 			= "C_auth/index/$1";
$route['auth/(:any)'] 			= 'C_auth/$1';

$route['dashboard'] 			 	= "C_dashboard/index";
$route['dashboard/(:num)'] 	= "C_dashboard/index/$1";
$route['dashboard/(:any)'] 	= 'C_dashboard/$1';

$route['ormawa'] 			 			= "C_ormawa/index";
$route['ormawa/(:num)'] 		= "C_ormawa/index/$1";
$route['ormawa/(:any)'] 		= 'C_ormawa/$1';

$route['master_acara'] 			 			= "C_master_acara/index";
$route['master_acara/(:num)'] 		= "C_master_acara/index/$1";
$route['master_acara/(:any)'] 		= 'C_master_acara/$1';

$route['pemilihan'] 			 					= "C_pemilihan/index";
$route['pemilihan/(:num)'] 					= "C_pemilihan/index/$1";
$route['pemilihan/(:any)'] 					= 'C_pemilihan/$1';
$route['pemilihan/(:any)/(:num)'] 	= 'C_pemilihan/$1/$2';
