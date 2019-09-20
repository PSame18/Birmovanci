<?php

include_once dirname(__FILE__).'/../db_handler.php';
include_once dirname(__FILE__).'/../user_roles.php';

if(!isset($_SESSION["userName"])){
    $_SESSION["userName"] = $_POST["name"];
}
if(!isset($_SESSION["userEmail"])){
    // trigger_error("userEmail session not set", E_USER_NOTICE);
    $_SESSION["userEmail"] = $_POST["email"];
}
if(!isset($_SESSION["userpwd"])){
    $_SESSION["userpwd"] = md5($_POST["password"]);
}

$_SESSION["loginSuccess"] = true;

// new instance to connect to DB using PDO
// $dbHandler = DBHandler::getInstance();
$dbHandler = DBHandler::getInstance();
$dbHandler->setDB_name(EVENTS_DB);
$connect = $dbHandler->connect();

// if user is not in DB, insert him into DB
if(!isUserInDB($dbHandler)){

    $connect = $dbHandler->connect();

    try{

        // send error log to DB to inform about manipulating with DB + all data
        $query = "INSERT INTO Users (name, email, u_password, role_id) VALUES (?, ?, ?, ?)";
        $values = array($_SESSION["userName"],  $_SESSION["userEmail"], $_SESSION["userpwd"], USER_DEFAULT_ROLE);

        $connect->run($query, $values);

        // set SESSION values
        $user_id = $connect->lastInsertId();
        $_SESSION["userId"] = $user_id;
        $_SESSION["userRole"] = USER_DEFAULT_ROLE;
        $_SESSION["loginSuccess"] = true;

        echo "Login successfull";
        header("Location: ../../welcome.php?user=$user_id");
    }
    catch(Exception $e){
        trigger_error($e);
    }
}
else{
    // check if user wrote all input right
    checkFormInput($dbHandler);

}

// /////////////////
// HELP FUNCTIONS //
// /////////////////

// returns Integer that describes role of user
function checkUserRole($dbHandler){

    $connect = $dbHandler->connect();

    try{

        // send error log to DB to inform about manipulating with DB + all data
        $query = "SELECT role_id FROM Users WHERE email = ?";
        $values = array($_SESSION["userEmail"]);

        $stmt = $connect->run($query, $values);
        $userRole = $stmt->fetch(PDO::FETCH_NUM);

        // $dbHandler->sendLogMessage($query, $values);

        // $email = $_SESSION["userEmail"];

        $userRoles = new UserRoles();
        // function which store all role_ids in array
        $allRoles = $userRoles->getAllRoles();

        // foreach loop with if #row[4] (role_id) match with some role_id from DB user_roles
        // return this value;
        foreach ($allRoles as $role) {
            if($userRole[0] == $role[0]){
                return $role[0];
            }
        }

    }catch(Exception $e)
    {
        trigger_error($e, E_USER_ERROR);
    }

}

function isUserInDB($dbHandler){

    $connect = $dbHandler->connect();

    try{

        // send error log to DB to inform about manipulating with DB + all data
        $query = "SELECT COUNT(*) FROM Users WHERE email = ?";
        $values = array($_SESSION["userEmail"]);

        // check if user with email (PK in DB users) is already in DB
        $stmt = $connect->run($query, $values);
        $count = $stmt->fetchColumn();

        // $dbHandler->sendLogMessage($query, $values);

        if($count >= 1){

            // check role of user
            $_SESSION["userRole"] = checkUserRole($dbHandler);

            return true;
        }
        else{
            return false;
        }

    }catch(Exception $e)
    {
        trigger_error($e);
    }

}

function checkFormInput($dbHandler){

    $connect = $dbHandler->connect();

    // send error log to DB to inform about manipulating with DB + all data
    $query = "SELECT user_id, name, email, u_password FROM Users WHERE email = ?";
    $values = array($_SESSION["userEmail"]);

    // get data in an indexed array
    // select all data from the events table
    $stmt = $connect->run($query, $values);
    // pass the PDO:FETCH_NUM style to the fetchAll() method
    $rows = $stmt->fetchAll(PDO::FETCH_NUM);

    // $dbHandler->sendLogMessage($query, $values);

    foreach ($rows as $row) {
        if($row[1] == $_SESSION["userName"] && $row[3] == $_SESSION["userpwd"]){
            $_SESSION["loginSuccess"] = true;
            $user_id = $row[0];
            $_SESSION["userId"] = $user_id;
            header("Location: ../../welcome.php?user=$user_id");
        }
        else{

            $_SESSION["loginSuccess"] = false;
            trigger_error("Wrong name or password from user!", E_USER_NOTICE);
            header("Location: ../../login.php");
        }
    }



}

?>
