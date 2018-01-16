<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['usuarios'] = 'usuario';
$route['usuarios/cadastrar'] = 'usuario/cadastrar';


$route['sites'] = 'site';

$route['relatorios'] = 'relatorio';

$route['preventivas'] = 'preventiva';