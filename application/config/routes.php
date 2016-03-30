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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';


$route['member'] = "member/manage";
$route['member/login'] = "member/manage/login";
$route['member/logout'] = "member/manage/logout";

$route['adminpanel'] = "adminpanel/manage";
$route['adminpanel/manage/go_(:num)'] = "adminpanel/manage/go/$1";
$route['adminpanel/login'] = "adminpanel/manage/login";

$route['projectadmin'] = "projectadmin/manage";
$route['projectadmin/manage/go_(:num)'] = "projectadmin/manage/go/$1";
$route['projectadmin/login'] = "projectadmin/manage/login";

$route['marketadmin'] = "marketadmin/manage";
$route['marketadmin/manage/go_(:num)'] = "marketadmin/manage/go/$1";
$route['marketadmin/login'] = "marketadmin/manage/login";

$route['useradmin'] = "useradmin/manage";
$route['useradmin/manage/go_(:num)'] = "useradmin/manage/go/$1";
$route['useradmin/login'] = "useradmin/manage/login";

$route['user'] = "user/manage";
$route['user/manage/go_(:num)'] = "user/manage/go/$1";
$route['user/login'] = "user/manage/login";

$route['guest'] = "guest/manage";
$route['guest/manage/go_(:num)'] = "guest/manage/go/$1";
$route['guest/login'] = "guest/manage/login";

$route['translate_uri_dashes'] = FALSE;
