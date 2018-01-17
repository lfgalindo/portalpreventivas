<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['usuarios'] = 'usuario';
$route['usuarios/cadastrar'] 		= 'usuario/cadastrar';
$route['usuarios/editar/(:any)'] 	= 'usuario/editar/$1';
$route['usuarios/remover/(:any)'] 	= 'usuario/remover/$1';


$route['sites'] = 'site';

$route['relatorios'] = 'relatorio';

$route['preventivas'] = 'preventiva';