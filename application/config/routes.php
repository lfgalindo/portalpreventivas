<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 				= 'login';
$route['404_override'] 						= '';
$route['translate_uri_dashes'] 				= FALSE;
	
$route['logout'] 							= 'login/logout';

$route['usuarios'] = 'usuario';
$route['usuarios/cadastrar'] 				= 'usuario/cadastrar';
$route['usuarios/editar/(:any)'] 			= 'usuario/editar/$1';
$route['usuarios/remover/(:any)'] 			= 'usuario/remover/$1';
$route['usuarios/visualizar/(:any)'] 		= 'usuario/visualizar/$1';

$route['sites'] 							= 'site';
$route['sites/cadastrar'] 					= 'site/cadastrar';
$route['sites/editar/(:any)'] 				= 'site/editar/$1';
$route['sites/remover/(:any)'] 				= 'site/remover/$1';
$route['sites/visualizar/(:any)'] 			= 'site/visualizar/$1';
$route['ajax/listar_sites'] 				= 'site/ajax_listar_sites';
$route['ajax/selecionar_site'] 				= 'site/ajax_selecionar_site';

$route['preventivas'] 						= 'preventiva';
$route['preventivas/cadastrar'] 			= 'preventiva/cadastrar';
$route['preventivas/editar/(:any)'] 		= 'preventiva/editar/$1';
$route['preventivas/remover/(:any)'] 		= 'preventiva/remover/$1';
$route['preventivas/visualizar/(:any)'] 	= 'preventiva/visualizar/$1';
$route['preventivas/executar/(:any)'] 		= 'preventiva/executar/$1';

$route['arquivos/(:any)/(:any)']					= 'arquivo/listar/$1/$2';
$route['arquivos/visualizar/(:any)/(:any)'] 		= 'arquivo/visualizar/$1/$2';
$route['arquivos/enviar/(:any)/(:any)'] 			= 'arquivo/enviar/$1/$2';
$route['arquivos/baixar/(:any)/(:any)'] 			= 'arquivo/baixar/$1/$2';
$route['arquivos/aprovar/(:any)/(:any)'] 			= 'arquivo/aprovar/$1/$2';
$route['arquivos/recusar/(:any)/(:any)'] 			= 'arquivo/recusar/$1/$2';
$route['arquivos/cancelar_aprov_rec/(:any)/(:any)'] = 'arquivo/cancelar_aprov_rec/$1/$2';
$route['arquivos/remover/(:any)/(:any)'] 			= 'arquivo/remover/$1/$2';

$route['configuracoes']			= 'configuracao';
$route['configuracoes/editar']	= 'configuracao/editar';

//$route['relatorios'] 						= 'relatorio';