<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//CMS
$route['default_controller'] = 'Auth';
/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
/*### API ###*/

//Support
$route['api/get-background']['GET'] 	= 'api/C_background/getAll';
$route['api/update-status']['POST'] 	= 'api/C_background/updateStatus';