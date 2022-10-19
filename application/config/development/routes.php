<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']   = 'login';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

$route['logout']                    = 'login/logout';
$route['admin/group']               = 'admin/user';
$route['admin/group/add']           = 'admin/user';
$route['admin/group/edit']          = 'admin/user';
$route['admin/group/delete/(:any)'] = 'admin/user';

$route['admin/user/(:any)']        = 'admin/user';
$route['admin/user/getOne/(:any)'] = 'admin/user';
$route['admin/user/delete/(:any)'] = 'admin/user';

$route['admin/profile']        = 'admin';
$route['admin/profile/(:any)'] = 'admin';

$route['guru/profile']        = 'guru';
$route['guru/profile/(:any)'] = 'guru';

$route['guru/bank_soal/add']    = 'guru/bank_soal/add';
$route['guru/bank_soal/getOne'] = 'guru/bank_soal/getOne';
$route['guru/bank_soal/edit']   = 'guru/bank_soal/edit';
$route['guru/bank_soal/delete'] = 'guru/bank_soal/delete';
$route['guru/bank_soal/(:any)'] = 'guru/bank_soal';
