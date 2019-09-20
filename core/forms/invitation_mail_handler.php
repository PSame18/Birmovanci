<?php include_once dirname(__FILE__).'/../db_handler.php';

    $event_id = $_GET["event"];
    $user_mail = $_GET["user"];

    $dbHandler = DBHandler::getInstance();
    $dbHandler->setDB_name(EVENTS_DB);
    $connect = $dbHandler->connect();

    session_destroy();


    try{

        $query = "SELECT u.user_id, u.name, u.email, u.u_password, u.role_id FROM Users u WHERE u.email = ?";
        $values = array($user_mail);

        $stmt = $connect->run($query, $values);
        // pass the PDO:FETCH_NUM style to the fetchAll() method
        $user = $stmt->fetchAll(PDO::FETCH_NUM);

        // $dbHandler->sendLogMessage($query, $values);

        $user_id = $user[0][0];

        if(!isset($user_id)){
            header("Location: ../../login.php");
        }
        else{
            session_start();

            $_SESSION["userId"] = $user_id;
            $_SESSION["userName"] = $user[0][1];
            $_SESSION["userEmail"] = $user[0][2];
            $_SESSION["userpwd"] = $user[0][3];
            $_SESSION["userRole"] = $user[0][4];
            $_SESSION["loginSuccess"] = true;
            header("Location: login_handler.php");
        }

    }catch(Exceptiion $e)
    {
        trigger_error($e, E_USER_ERROR);
    }

?>
