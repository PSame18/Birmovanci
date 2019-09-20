<?php
include_once("db_handler.php");

class Events extends DBHandler{

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

    public function getEvents(){
        try{

            // send error log to DB to inform about manipulating with DB + all data
            $query = "SELECT event_id, name, date_time, place, description, participants_max_num FROM events";
            $values = array();

            // get data in an indexed array
            // select all data from the events table
            $this->setDB_name(EVENTS_DB);
            $stm = $this->connect()->run($query);

            // pass the PDO:FETCH_NUM style to the fetchAll() method
            $rows = $stm->fetchAll(PDO::FETCH_NUM);

            return $rows;
        }catch(Exception $e)
        {
            trigger_error($e, E_USER_WARNING);
        }

    }

    public function getSubscribedEvents($user_id){
        try{

            // send error log to DB to inform about manipulating with DB + all data
            $query = "SELECT e.name FROM `events` e JOIN `subscription` s WHERE s.user_id = ? AND s.event_id = e.event_id";
            $values = array($user_id);

            $this->setDB_name(EVENTS_DB);
            $stm = $this->connect()->run($query, $values);
            // pass the PDO:FETCH_NUM style to the fetchAll() method
            $rows = $stm->fetchAll(PDO::FETCH_NUM);

            return $rows;

        }catch(Exception $e)
        {
            trigger_error($e, E_USER_ERROR);
        }
    }
}

?>
