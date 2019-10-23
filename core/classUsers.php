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
            $stm = $this->connect()->run($query);

            // pass the PDO:FETCH_NUM style to the fetchAll() method
            $rows = $stm->fetchAll(PDO::FETCH_NUM);

            return $rows;

        }catch(Exception $e)
        {
            trigger_error($e, E_USER_WARNING);
        }

    }

    public function getUsersByGroup($group){

        try{

            // send error log to DB to inform about manipulating with DB + all data
            $query = "SELECT user_id, user_name, user_status, user_group, user_credits FROM users WHERE user_group = ?;";
            $values = array($group);

            // get data in an indexed array
            // select all data from the events table
            $stm = $this->connect()->run($query, $values);

            // pass the PDO:FETCH_NUM style to the fetchAll() method
            $rows = $stm->fetchAll(PDO::FETCH_NUM);

            return $rows;

        }
        catch(Exception $e)
        {
            trigger_error($e, E_USER_WARNING);
        }

    }

}

 ?>
