<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'pages/';
$route['(:any)'] = 'pages/view/$1';
