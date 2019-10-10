<?php

$path = dirname(__FILE__);

// used to store temporary data about logged user and other stuff
if(!isset($_SESSION))
{
    session_start();
}

// INIT DATABASE CONNECTION
if (!defined('SERVERNAME')) define('SERVERNAME', '127.0.0.1');
if (!defined('USERNAME')) define('USERNAME', 'root');
if (!defined('PASSWORD')) define('PASSWORD', '');
if (!defined('BIRMOVANCI')) define('BIRMOVANCI', 'birmovanci');

if (!defined('USER_DEFAULT_ROLE')) define('USER_DEFAULT_ROLE', 1);

?>
