<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['users/login']='users/login';
$route['users/register']='users/register';


$route['tags']='tags/index';
$route['tags/create']='tags/create';
$route['tags/update']='tags/update';
$route['tags/(:any)']='tags/show/$1';


$route['categories']='categories/index';
$route['categories/create']='categories/create';
$route['categories/update']='categories/update';
$route['categories/(:any)']='categories/show/$1';

$route['posts/postsByCategory']='posts/postsByCategory';
$route['posts/search_keyword']='posts/search_keyword';
$route['posts/index']='posts/index';
$route['posts']='posts/index';
$route['posts/create']='posts/create';
$route['posts/update']='posts/update';
$route['posts/(:any)']='posts/show/$1';



$route['default_controller'] = 'pages/view';
$route['(:any)']='pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
