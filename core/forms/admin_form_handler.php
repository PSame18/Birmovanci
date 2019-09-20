<?php include dirname(__FILE__).'/../init.inc.php';
include_once dirname(__FILE__).'/../mail_handler.php';
include_once dirname(__FILE__).'/../db_handler.php';

$dbHandler = DBHandler::getInstance();
$dbHandler->setDB_name(EVENTS_DB);
$user_id = $_SESSION["userId"];

if($_POST["submit"] == "Add"){
    // add event to DB
    addEvent($dbHandler);
}
else if($_POST["submit"] == "Delete"){
    // delete event from DB
    deleteEvent($dbHandler);
}
else{
    // invite people to event
    invitePeople($dbHandler);
}

header("Location: ../../welcome.php?user=$user_id");

function addEvent($dbHandler){

    $connect = $dbHandler->connect();

    try{

        if($_POST["max_participants"] == null){

            // send error log to DB to inform about manipulating with DB + all data
            $query = "INSERT INTO Events (name, date_time, description, place) VALUES (?, ?, ?, ?)";
            $values = array($_POST["name"], $_POST["date_time"], $_POST["description"], $_POST["place"]);

            $connect->run($query, $values);

        }
        else{

            // send error log to DB to inform about manipulating with DB + all data
            $query = "INSERT INTO Events (name, date_time, description, place, participants_max_num) VALUES (?, ?, ?, ?, ?)";
            $values = array($_POST["name"], $_POST["date_time"], $_POST["description"], $_POST["place"], $_POST["max_participants"]);

            $connect->run($query, $values);
        }

    }catch(Exception $e)
    {
        trigger_error($e, E_USER_WARNING);
    }


}

function deleteEvent($dbHandler){

    $connect = $dbHandler->connect();

    foreach ($_POST["eventId"] as $event) {

        try{

            // send error log to DB to inform about manipulating with DB + all data
            $query = "DELETE FROM Events WHERE event_id = ?";
            $values = array($event);

            $connect->run($query, $values);

            // //////////////////////////////////////

            // send error log to DB to inform about manipulating with DB + all data
            $query = "DELETE FROM Subscription WHERE event_id = ?";
            $values = array($event);

            $connect->run($query, $values);

        }catch(Exception $e)
        {
            trigger_error($e, E_USER_WARNING);
        }

    }

}

function invitePeople($dbHandler){

    $event_id = $_POST["event_id"];
    $invited_person_name = $_POST["personName"];
    $invited_person_mail = $_POST["personEmail"];

    $connect = $dbHandler->connect();
    $emailHandler = MailHandler::getInstance();

    // get event info to send it to email adresses of invited people
    try{

        $query = "SELECT e.name, e.date_time, e.description, e.place FROM `events` e WHERE e.event_id = ?";
        $values = array($event_id);

        $stmt = $connect->run($query, $values);
        // pass the PDO:FETCH_NUM style to the fetchAll() method
        $event_data = $stmt->fetchAll();

        // $dbHandler->sendLogMessage($query, $values);

        $event_name = $event_data[0][0];
        $event_date_time = $event_data[0][1];
        $event_desc = $event_data[0][2];
        $event_place = $event_data[0][3];

        $url = "http://localhost/event_booking/core/forms/invitation_mail_handler.php?event=$event_id&user=$invited_person_mail";

        // create Email data
        $subject = "Invitation to $event_name event";
        $message = "
        <html>
        <head>
            <title>Invitation to $event_name.</title>
        </head>
        <body>
            <h1>Hello $invited_person_name!</h1>
            <p> You were invited to $event_name event
                that takes place in $event_place at $event_date_time.</p>
            <p>More info about it? Here is description from the page: $event_desc.</p>

            <p>If you want to subscribe to event or see more, click on this
                <a href='$url'>link</a>
            </p>

        </body>
        </html>";

        $invited_people[] = $invited_person_name;
        $invited_people[] = $invited_person_mail;

        $emailHandler->sendEmail($invited_people, $subject, $message);

    }catch(Exception $e)
    {
        trigger_error($e, E_USER_ERROR);
    }

}

?>
