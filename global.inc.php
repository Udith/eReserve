<?php

define('ROOT_DIR', './');
define('institute', 'University of Hogwarts');  //name of the institute
define('SCRIPTS_DIR', ROOT_DIR . 'php_scripts/');

include_once 'classes/User.php';
include_once 'classes/UserHelper.php';
include_once 'classes/Hall.php';
include_once 'classes/HallHelper.php';

require_once 'classes/DB.php';
