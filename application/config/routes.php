<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'Admin/login';
$route['dashboard'] = 'Admin/dashboard';
$route['install'] = 'Admin/install';
$route['logout'] = 'Admin/logout';
$route['checkout'] = 'checkout/index';
$route['approvelistuser'] = 'Admin/userlogin';
$route['profile'] = 'Userlist/profile';
$route['userpost'] = 'Userlist/userpost';
$route['userlistapprove'] = 'Userlist/userlistaprove';
$route['userpostapprove'] = 'Userlist/userpostaprove';