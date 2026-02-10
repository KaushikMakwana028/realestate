
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
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['register'] = 'login/register';
$route['profile'] = 'profile';
$route['logout'] = 'login/logout';
$route['site'] = 'site';
$route['inquiry'] = 'dashboard/inquiry';
$route['attedance'] = 'dashboard/attedance';


$route['add_site'] = 'site/add_site';
$route['add_expenses'] = 'site/add_expenses';

$route['edit_site/(:num)'] = 'site/edit_site/$1';
$route['expenses/(:num)'] = 'site/expenses/$1';


$route['plots'] = 'plots/index';
$route['plots/(:num)'] = 'plots/index/$1';

$route['add_plot'] = 'plots/add_plot';
$route['plot/edit_plot/(:num)'] = 'plots/edit_plot/$1';
$route['plots/buyer_details/(:num)'] = 'plots/buyer_details/$1';

$route['users'] = 'user';
$route['add_user'] = 'user/add_user';
$route['add_upad'] = 'user/add_upad';

$route['edit_user/(:num)'] = 'user/edit_user/$1';
$route['payment_data/(:num)'] = 'plots/payment_data/$1';
// $route['profile'] = 'user/add_upad';

$route['superadmin/admins'] = 'superadmin/admins';
$route['superadmin/sites'] = 'superadmin/sites';
$route['superadmin/get_admins'] = 'superadmin/get_admins';
$route['superadmin/get_admin_detail/(:num)'] = 'superadmin/get_admin_detail/$1';
$route['superadmin/get_all_sites'] = 'superadmin/get_all_sites';
$route['superadmin/get_site_detail/(:num)'] = 'superadmin/get_site_detail/$1';
$route['superadmin/upload_site_map'] = 'superadmin/upload_site_map';
$route['superadmin/site_images_pending'] = 'superadmin/site_images_pending';
$route['superadmin/site_images_action'] = 'superadmin/site_images_action';






// api Route
$route['api/login'] = 'api/login';
$route['api/logout'] = 'api/logout';
$route['api/dashboard'] = 'api/dashboard';

$route['api/get_sites'] = 'api/get_sites';
$route['api/get_plots/(:num)'] = 'api/get_plots/$1';
$route['api/search_sites'] = 'api/search_sites';
$route['api/plot_details/(:num)'] = 'api/plot_details/$1';
$route['api/plot_status'] = 'api/change_plot_status';
$route['api/add_buyer'] = 'api/add_buyer';
$route['api/payment_log'] = 'api/payment_log';

$route['api/add_expenses'] = 'api/add_expenses';
$route['api/get_expenses'] = 'api/get_expenses';
$route['api/get_profile'] = 'api/get_profile';
$route['api/upload_document'] = 'api/upload_document';
$route['api/get_document'] = 'api/get_document';
$route['api/add_inquiry'] = 'api/add_inquiry';
$route['api/inquiry_list'] = 'api/inquiry_list';
$route['api/inquiry_search'] = 'api/inquiry_search';
$route['api/add_attendance'] = 'api/add_attendance';
$route['api/get_attendance'] = 'api/get_attendance';
$route['api/get_sallary'] = 'api/get_sallary';































// $route['update_subcategory/(:num)'] = 'admin/category/update_subcategory/$1';






$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
