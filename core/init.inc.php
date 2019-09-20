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
if (!defined('EVENTS_DB')) define('EVENTS_DB', 'events_db');
if (!defined('LOGS_DB')) define('LOGS_DB', 'error_log_db');

if (!defined('USER_DEFAULT_ROLE')) define('USER_DEFAULT_ROLE', 2);

if (!defined('UNLIMITED_PLACES')) define('UNLIMITED_PLACES', INF);

// SET ERROR LOGS
include_once("{$path}/inc/error_logging.inc.php");

set_error_handler('log_error', E_ALL);

?>
