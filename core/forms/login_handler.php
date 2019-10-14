<?php

include_once ('../db_handler.php');
include_once ('../user_roles.php');

$path = dirname(__FILE__);

if(!isset($_SESSION["userLogin"])){
    $_SESSION["userLogin"] = $_POST["login"];
}
if(!isset($_SESSION["userPwd"])){
    $_SESSION["userPwd"] = $_POST["password"];
}

$_SESSION["loginSuccess"] = true;

// new instance to connect to DB using PDO
// $dbHandler = DBHandler::getInstance();
$dbHandler = DBHandler::getInstance();

// check if user wrote all input right
checkFormInput($dbHandler);

// /////////////////
// HELP FUNCTIONS //
// /////////////////

function checkFormInput($dbHandler){

    try{
        $connect = $dbHandler->connect();

        // send error log to DB to inform about manipulating with DB + all data
        $query = "SELECT user_id, user_login, user_pwd, user_status, user_group,
                         user_address_area, user_name, user_credits 
                  FROM users 
                  WHERE user_login = ? AND user_pwd = ?";
        $values = array($_SESSION["userLogin"], $_SESSION["userPwd"]);

        // get data in an indexed array
        // select all data from the events table
        $stmt = $connect->run($query, $values);

        if($stmt !== false){
            // pass the PDO:FETCH_NUM style to the fetchAll() method
            $row = $stmt->fetch(PDO::FETCH_NUM);
        }
        else{
            echo "Problem autentifikovat, ci ste to vy!!!";
        }
    }catch(PDOExcpetion $e){
        error_log($e);
    }
        
        
    
    if($row[1] == $_SESSION["userLogin"] && $row[2] == $_SESSION["userPwd"]){
        $user_id = $row[0];
        $user_status = $row[3];
        $user_group = $row[4];
        $user_address_area = $row[5];
        $user_name = $row[6];
        $_SESSION["loginSuccess"] = true;
        $_SESSION["userId"] = $user_id;
        $_SESSION["userStatus"] = $user_status;
        $_SESSION["userGroup"] = $user_group;
        $_SESSION["userAddressArea"] = $user_address_area;
        $_SESSION["userName"] = $user_name;

        switch ($user_status) {
            case 1:
                header("Location: ../../home", TRUE, 307);
                break;
            case 2:
                header("Location: ../../animator.php", TRUE, 307);
                break;
            case 3:
                header("Location: ../../host.php", TRUE, 307);
                break;
            case 4:
                header("Location: ../../birmovanec.php", TRUE, 307);
                break;
            default:
                header("Location: ../../login", TRUE, 307);
                break;
        }

    }
    else{

        $_SESSION["loginSuccess"] = false;
        header("Location: ../../login");

    }

}

?>
