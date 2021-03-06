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

$route['default_controller'] = 'user/index';
$route['404_override'] = '';

$route['admin'] = 'user/index';
$route['admin/signup'] = 'user/signup';
$route['admin/create_member'] = 'user/create_member';
$route['admin/login'] = 'user/index';
$route['admin/logout'] = 'user/logout';
$route['admin/login/validate_credentials'] = 'user/validate_credentials';


$route['admin/trabajador'] = 'admin_trabajador/index';
$route['admin/trabajador/add'] = 'admin_trabajador/add';
$route['admin/trabajador/update'] = 'admin_trabajador/update';
$route['admin/trabajador/update/(:any)'] = 'admin_trabajador/update/$1';
$route['admin/trabajador/delete/(:any)'] = 'admin_trabajador/delete/$1';
$route['admin/trabajador/(:any)'] = 'admin_trabajador/index/$1'; //$1 = page number

$route['admin/tipotrab'] = 'admin_tipotraba/index';
$route['admin/tipotrab/add'] = 'admin_tipotraba/add';
$route['admin/tipotrab/update'] = 'admin_tipotraba/update';
$route['admin/tipotrab/update/(:any)'] = 'admin_tipotraba/update/$1';
$route['admin/tipotrab/delete/(:any)'] = 'admin_tipotraba/delete/$1';
$route['admin/tipotrab/(:any)'] = 'admin_tipotraba/index/$1'; //$1 = page number

$route['admin/productos'] = 'admin_productos/index';
$route['admin/productos/add'] = 'admin_productos/add';
$route['admin/productos/delete/(:any)'] = 'admin_productos/delete/$1';
$route['admin/productos/update'] = 'admin_productos/update';
$route['admin/productos/update/(:any)'] = 'admin_productos/update/$1';

$route['admin/ventas'] = 'admin_ventas/index';
$route['admin/ventas/add'] = 'admin_ventas/add';
$route['admin/ventas/delete/(:any)'] = 'admin_ventas/delete/$1';
$route['admin/ventas/update'] = 'admin_ventas/update';
$route['admin/ventas/update/(:any)'] = 'admin_ventas/update/$1';

$route['admin/reportes'] = 'admin_reportes/index';
$route['admin/reportes/exporta'] = 'admin_reportes/excel';
$route['admin/reportes/procesar'] = 'admin_reportes/procesar';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
