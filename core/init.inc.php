<?php

$path = dirname(__FILE__);

if(!isset($_SESSION))
{
    session_start();
}

// INIT DATABASE CONNECTION
if (!defined('SERVERNAME')) define('SERVERNAME', 'localhost');
if (!defined('USERNAME')) define('USERNAME', 'root');
if (!defined('PASSWORD')) define('PASSWORD', '');
if (!defined('BIRMOVANCI')) define('BIRMOVANCI', 'birmovanci');

if (!defined('USER_DEFAULT_ROLE')) define('USER_DEFAULT_ROLE', 1);

?>
