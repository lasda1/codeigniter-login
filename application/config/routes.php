<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['users']='users/index';
$route['create']='users/create';
$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'users/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
