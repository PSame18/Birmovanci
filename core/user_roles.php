<?php include_once("db_handler.php");

class UserRoles extends DBHandler{

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

    public function getAllRoles(){
        try{

            // send error log to DB to inform about manipulating with DB + all data
            $query = "SELECT role_id FROM user_roles";
            $values = array();

            // get data in an indexed array
            // select all data from the events table
            $this->setDB_name(EVENTS_DB);
            $stm = $this->connect()->run($query);

            // pass the PDO:FETCH_NUM style to the fetchAll() method
            $roles = $stm->fetchAll(PDO::FETCH_NUM);

            // $this->sendLogMessage($query, $values);

            return $roles;

        }catch(Exception $e)
        {
            trigger_error($e, E_USER_ERROR);
        }

    }
}


?>
