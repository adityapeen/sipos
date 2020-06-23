<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'user';
$route['404_override'] = 'Forbidden/err404';
$route['translate_uri_dashes'] = FALSE;
$route['posyandu/acara/edit/(:any)'] = 'Posyandu/editkegiatan/$1';
$route['posyandu/delete'] = 'Posyandu/deletekegiatan';
$route['posyandu/timbangan/delete'] = 'Posyandu/deleteTimbangan';
$route['user/penduduk/delete'] = 'User/deletePenduduk';
$route['user/penduduk/edit/(:any)'] = 'User/editpenduduk/$1';
$route['posyandu/pengukuran/edit/(:any)'] = 'Posyandu/edittimbangan/$1';
$route['posyandu/skdn'] = 'Posyandu/skdn/0';
$route['posyandu/rekap'] = 'Posyandu/rekap/0';
$route['posyandu/dataskdn/(:any)'] = 'Posyandu/skdn/$1';
$route['posyandu/datarekap/(:any)'] = 'Posyandu/rekap/$1';
$route['puskesmas/posyandu/detail/(:any)'] = 'Puskesmas/detailposyandu/$1';
$route['puskesmas/peserta/(:any)/(:any)'] = 'Puskesmas/peserta/$1/$2';
$route['puskesmas/rekap/(:any)'] = 'Posyandu/rekap/$1';
$route['puskesmas/skdn/(:any)'] = 'Posyandu/skdn/$1';
$route['puskesmas/adduser/(:any)'] = 'Puskesmas/adduserpos/$1';
$route['puskesmas/import'] = 'Excel';
$route['about'] = 'Forbidden/about';
