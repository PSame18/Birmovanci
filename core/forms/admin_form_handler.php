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
else if($_POST["submit"] == "Pridať typ"){
    // delete event from DB
    addEventType($dbHandler);
}
else if($_POST["submit"] == "Pridať používateľa"){
    // delete event from DB
    addUser($dbHandler);
}
else{

}

header("Location: ../../domov", TRUE, 303);

function addEvent($dbHandler){

    $connect = $dbHandler->connect();

    $event_name = trim($_POST["event_name"]);
    $event_desc = trim($_POST["event_desc"]);
    $event_type = trim($_POST["event_type"]) == NULL ? 0 : trim($_POST["event_type"]);
    $date_from = trim($_POST["date_from"]);
    $date_to = trim($_POST["date_to"]);
    $time_from = trim($_POST["time_from"]);
    $time_to = trim($_POST["time_to"]);
    $event_place = trim($_POST["event_place"]);
    $event_group = trim($_POST["event_group"]);
    $event_area = trim($_POST["event_area"]);
    $date_created = date("Y-m-d h:i:sa");
    $event_img = null;

    $name = $_FILES['file']['name'];
    $target_dir = "../../pictures/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if(in_array($imageFileType,$extensions_arr) ){

        // Insert record
        $event_img = $name;

        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$name);

    }

    $date_from = strlen($date_from) == 0 ? NULL : $date_from;
    $date_to = strlen($date_to) == 0 ? NULL : $date_to;
    $time_from = strlen($time_from) == 0 ? NULL : $time_from;
    $time_to = strlen($time_to) == 0 ? NULL : $time_to;

    // send error log to DB to inform about manipulating with DB + all data
    $query = "INSERT INTO events (event_name, event_desc, event_type, date_from, date_to, time_from, time_to, event_place, event_group, event_area, date_created, event_img)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $values = array($event_name, $event_desc, $event_type, $date_from, $date_to, $time_from, $time_to, $event_place, $event_group, $event_area, $date_created, $event_img);

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

function addEventType($dbHandler){

    $connect = $dbHandler->connect();

    $event_type_name = trim($_POST["event_type_name"]);
    $event_credits = trim($_POST["event_credits"]);

    $query = "INSERT INTO event_c_type (event_type_name, event_credits)
                VALUES (?,?)";
    $values = array($event_type_name, $event_credits);

    $result = $connect->run($query, $values);

}

function addUser($dbHandler){


    $connect = $dbHandler->connect();

    $user_name = trim($_POST["user_name"]);
    $user_login = trim($_POST["user_login"]);
    $user_pwd = trim($_POST["user_pwd"]);
    $user_status = trim($_POST["user_status"]);
    $user_group = trim($_POST["user_group"]);
    $user_address_area = $_POST["user_address_area"];

    $query = "INSERT INTO users (user_name, user_login, user_pwd, user_status, user_group, user_address_area)
                VALUES (?,?,?,?,?,?)";
    $values = array($user_name, $user_login, $user_pwd, $user_status, $user_group, $user_address_area);

    $result = $connect->run($query, $values);

}

?>
