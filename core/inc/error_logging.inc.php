<?php

include_once dirname(__FILE__).'/../db_handler.php';

// custom handler for logging errors in MySQL DB using PDO
function log_error($error_type, $error_string, $error_file, $error_line){

    $error_type = (int)$error_type;
    $error_type = chooseErrorType($error_type);
    $error_line = (int)$error_line;
    $currentDateTime = date('Y-m-d H:i:s');

    $connect = getConnectionToDB();

    $logQuery = $connect->prepare("INSERT INTO error_logs (log_type, log_time, log_string, log_file, log_line) VALUES(?, ?, ?, ?, ?)");
    $logQuery->execute([$error_type, $currentDateTime, $error_string, $error_file, $error_line]);
}


function getConnectionToDB(){
    try{
        // new instance of DBHandler for connecting to DB
        $dbHandler = new DBHandler();
        $dbHandler->setDB_name(LOGS_DB);
        $connect = $dbHandler->connect();
        return $connect;
    }catch(Exception $e)
    {
        trigger_error($e, E_WARNING);
    }

}

//custom function for choosing which log level will be stored in DB
function chooseErrorType($e_type){

    if($e_type == E_ERROR || $e_type == E_PARSE || $e_type == E_CORE_ERROR || $e_type == E_USER_ERROR || $e_type == E_COMPILE_ERROR){
        $e_type = E_ERROR;
    }
    else if($e_type == E_WARNING || $e_type == E_CORE_WARNING || $e_type == E_COMPILE_WARNING || $e_type == E_USER_WARNING || $e_type == E_RECOVERABLE_ERROR){
        $e_type = E_WARNING;
    }
    else if($e_type == E_NOTICE || E_USER_NOTICE || E_DEPRECATED || E_USER_DEPRECATED){
        $e_type = E_NOTICE;
    }

    return $e_type;

}

?>

<!-- Note -->
<!-- require will produce a fatal error (E_COMPILE_ERROR) and stop the script -->
<!-- include will only produce a warning (E_WARNING) and the script will continue -->

<!-- trigger_error() can choose level with these constants -->
<!--    E_USER_NOTICE             // Notice (default)
        E_USER_WARNING            // Warning
        E_USER_ERROR              // Fatal Error
-->
