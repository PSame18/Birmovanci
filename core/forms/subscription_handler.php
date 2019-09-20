<?php

include dirname(__FILE__).'/../init.inc.php';
include_once dirname(__FILE__).'/../db_handler.php';

$event_id = $_POST["event_id"];
$user_id = $_POST["user_id"];

// new instance of DBHandler for connecting to DB
$dbHandler = DBHandler::getInstance();
$dbHandler->setDB_name(EVENTS_DB);

// check if user is in DB table subscriptions
$userSubscribed = checkSubscription($dbHandler, $event_id, $user_id);

if(isset($_POST['subscribe'])){

    $connect = $dbHandler->connect();

    try{
        if(!$userSubscribed){

            $subscription_datetime = date('Y-m-d H:i:s'); //format 2019-08-13 14:00:00

            // send error log to DB to inform about manipulating with DB + all data
            // $query = "INSERT INTO subscription (event_id, user_id, subscription_date_time) VALUES (?, ?, ?)";
            $query = "CALL subscribe_user_to_event(?, ?, ?)";
            $values = array($event_id, $user_id, $subscription_datetime);

            $connect->run($query, $values);

        }
        else{
            trigger_error("Invalid request for subscription from event", E_USER_WARNING);
        }
    }
    catch(Exception $e){
        trigger_error($e, E_USER_WARNING);
    }

}

if(isset($_POST['unsubscribe'])){

    $connect = $dbHandler->connect();

    try{
        if($userSubscribed){

            // send error log to DB to inform about manipulating with DB + all data
            $query = "DELETE FROM subscription WHERE user_id = ? AND event_id = ?";
            $values = array($user_id, $event_id);

            $connect->run($query, $values);

        }
        else{
            trigger_error("Invalid request for unsubscription from event", E_USER_WARNING);
        }
    }catch(Exception $e){
        trigger_error($e, E_USER_WARNING);
    }

}

header("Location: ../../welcome.php?user=$user_id");

function checkSubscription($dbHandler, $event_id, $user_id){

    $connect = $dbHandler->connect();

    try{

        // send error log to DB to inform about manipulating with DB + all data
        // $query = "SELECT COUNT(*) FROM `subscription` s WHERE s.user_id = ? AND s.event_id = ?";
        $query = "CALL checkSubscription(?, ?, @count)";
        $values = array($user_id, $event_id);

        // first procedure checkSubscription is executed
        $stmt = $connect->run($query, $values);

        // we must call the method closeCursor() of the PDOStatement object in order to execute the next SQL statement
        $stmt->closeCursor();

        $count;
        $query = "SELECT @count AS count";
        $row = $connect->run($query)->fetch(PDO::FETCH_ASSOC);
        if($row){
            $count = $row !== false ? $row['count'] : null;
        }

        if($count == 0){
            return false;
        }
        else{
            return true;
        }

    }catch(Exception $e)
    {
        trigger_error($e, E_USER_WARNING);
    }

}

?>
