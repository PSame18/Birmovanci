<?php

$path = dirname(__FILE__);

// used to store temporary data about logged user and other stuff
if(!isset($_SESSION))
{
    session_start();
}

// INIT DATABASE CONNECTION
if (!defined('SERVERNAME')) define('SERVERNAME', 'dw10.nameserver.sk');
if (!defined('USERNAME')) define('USERNAME', 'rkcpoprad_birm');
if (!defined('PASSWORD')) define('PASSWORD', 'dbBirmovanci13');
if (!defined('BIRMOVANCI')) define('BIRMOVANCI', 'rkcpoprad_birm');

if (!defined('USER_DEFAULT_ROLE')) define('USER_DEFAULT_ROLE', 1);

?>
