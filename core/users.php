<?php include_once("db_handler.php");

class Users extends DBHandler{

    // single instance of self shared among all instances
    private static $instance = null;

    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getAllUsers(){
        try{

            // send error log to DB to inform about manipulating with DB + all data
            $query = "SELECT user_id, user_name FROM users";
            $values = array();

            // get data in an indexed array
            // select all data from the events table
            $this->setDB_name(BIRMOVANCI);
            $stm = $this->connect()->run($query);

            // pass the PDO:FETCH_NUM style to the fetchAll() method
            $rows = $stm->fetchAll(PDO::FETCH_NUM);

            return $rows;

        }catch(Exception $e)
        {
            trigger_error($e, E_USER_WARNING);
        }

    }

    public function getSubscribedUsers($event_id){

        try{

            // send error log to DB to inform about manipulating with DB + all data
            $query = "SELECT u.user_name, u.user_id FROM `users` u JOIN `subscription` s WHERE u.user_id = s.user_id AND s.event_id = ?";
            $values = array($event_id);

            $this->setDB_name(BIRMOVANCI);
            $stm = $this->connect()->run($query, $values);
            // pass the PDO:FETCH_NUM style to the fetchAll() method
            $rows = $stm->fetchAll(PDO::FETCH_NUM);

            // $this->sendLogMessage($query, $values);

            return $rows;
        }
        catch(PDOException $e){
            trigger_error($e, E_USER_ERROR);
        }

    }

    public function getUserId(){
        try{

            // send error log to DB to inform about manipulating with DB + all data
            $query = "SELECT u.user_id FROM `users` u WHERE u.user_name = ?";
            $values = array($_SESSION["userName"]);

            $this->setDB_name(BIRMOVANCI);
            $stm = $this->connect()->run($query, $values);
            // pass the PDO:FETCH_NUM style to the fetchAll() method
            $userId = $stm->fetch(PDO::FETCH_NUM);

            // $this->sendLogMessage($query, $values);

            return $userId;

        }catch(PDOException $e)
        {
            trigger_error($e, E_USER_ERROR);
        }
    }

    public function getUserRole(){
        try{

            // send error log to DB to inform about manipulating with DB + all data
            $query = "SELECT u.role_id FROM `users` u WHERE u.email = ?";
            $values = array($_SESSION["userEmail"]);

            $this->setDB_name(BIRMOVANCI);
            $stm = $this->connect()->run($query, $values);
            // pass the PDO:FETCH_NUM style to the fetchAll() method
            $user_role_id = $stm->fetch(PDO::FETCH_NUM);

            // $this->sendLogMessage($query, $values);

            return $user_role_id;

        }catch(PDOException $e)
        {
            trigger_error($e, E_USER_ERROR);
        }
    }

    public function getUserById($user_id){

        try{

            $query = "SELECT u.user_name FROM `users` u WHERE u.user_id = ?";
            $values = array($user_id);

            $this->setDB_name(BIRMOVANCI);
            $stm = $this->connect()->run($query, $values);
            // pass the PDO:FETCH_NUM style to the fetchAll() method
            $user = $stm->fetch(PDO::FETCH_NUM);

            // $this->sendLogMessage($query, $values);

            return $user;

        }catch(EXception $e){

            trigger_error($e, E_USER_ERROR);

        }

    }

}

 ?>
