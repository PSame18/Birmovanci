<?php include dirname(__FILE__).'/../init.inc.php';
include_once dirname(__FILE__).'/../mail_handler.php';
include_once dirname(__FILE__).'/../db_handler.php';

$dbHandler = DBHandler::getInstance();
$user_id = $_SESSION["userId"];

if($_POST["submit"] == "Pridať udalosť"){
    // add event to DB
    addEvent($dbHandler);
}
else if($_POST["submit"] == "Vymazať udalosť"){
    // delete event from DB
    deleteEvent($dbHandler);
}
else{
    // invite people to event
    invitePeople($dbHandler);
}

header("Location: ../../admin.php", TRUE, 303);

function addEvent($dbHandler){

    $connect = $dbHandler->connect();

    $event_name = trim($_POST["event_name"]);
    $event_description = trim($_POST["event_description"]);
    $event_type = trim($_POST["event_type"]) == NULL ? 0 : trim($_POST["event_type"]);
    $date_from = trim($_POST["date_from"]);
    $date_to = trim($_POST["date_to"]);
    $time_from = trim($_POST["time_from"]);
    $time_to = trim($_POST["time_to"]);
    $event_place = trim($_POST["event_place"]);

    // send error log to DB to inform about manipulating with DB + all data
    $query = "INSERT INTO events (event_name, event_description, event_type, date_from, date_to, time_from, time_to, event_place)
                VALUES (?,?,?,?,?,?,?,?)";
    $values = array($event_name, $event_description, $event_type, $date_from, $date_to, $time_from, $time_to, $event_place);

    $result = $connect->run($query, $values);

}

function deleteEvent($dbHandler){

    $connect = $dbHandler->connect();

    foreach ($_POST["eventId"] as $event) {

        try{

            // send error log to DB to inform about manipulating with DB + all data
            $query = "DELETE FROM events WHERE event_id = ?";
            $values = array($event);

            $connect->run($query, $values);

        }catch(Exception $e)
        {
            error_log($e);
        }

    }

}

?>
