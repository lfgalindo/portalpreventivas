<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 			= 'login';
$route['404_override'] 					= '';
$route['translate_uri_dashes'] 			= FALSE;

$route['logout'] 						= 'login/logout';

$route['usuarios'] = 'usuario';
$route['usuarios/cadastrar'] 			= 'usuario/cadastrar';
$route['usuarios/editar/(:any)'] 		= 'usuario/editar/$1';
$route['usuarios/remover/(:any)'] 		= 'usuario/remover/$1';
$route['usuarios/visualizar/(:any)'] 	= 'usuario/visualizar/$1';

$route['sites'] 						= 'site';
$route['sites/cadastrar'] 				= 'site/cadastrar';
$route['sites/editar/(:any)'] 			= 'site/editar/$1';
$route['sites/remover/(:any)'] 			= 'site/remover/$1';
$route['sites/visualizar/(:any)'] 		= 'site/visualizar/$1';

$route['preventivas'] 					= 'preventiva';
$route['preventivas/cadastrar'] 		= 'preventiva/cadastrar';
$route['preventivas/editar/(:any)'] 	= 'preventiva/editar/$1';
$route['preventivas/remover/(:any)'] 	= 'preventiva/remover/$1';
$route['preventivas/visualizar/(:any)'] = 'preventiva/visualizar/$1';

$route['relatorios'] 					= 'relatorio';