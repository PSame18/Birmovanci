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

    public function getAllEvents(){
        try{

            // send error log to DB to inform about manipulating with DB + all data
            $query = "SELECT e.*, t.event_type_name, t.event_credits
                        FROM events e
                        LEFT JOIN event_c_type t ON e.event_type = t.event_type_id;";
            $values = array();

            // get data in an indexed array
            // select all data from the events table
            $stm = $this->connect()->run($query);

            // pass the PDO:FETCH_NUM style to the fetchAll() method
            $rows = $stm->fetchAll(PDO::FETCH_NUM);

            return $rows;

        }catch(Exception $e)
        {
            error_log($e);
        }

    }

    // return 3 events that will be soon
    public function getCurrentEvents(){

        unset($allEvents);
        $allEvents = $this->getAllEvents();

        usort($allEvents, array("Events", "sortEventsByDate"));
        $upToDateEvents = array_slice($allEvents, 0, 3);

        return $upToDateEvents;

    }

    public function getEventsByGroup($group){

        try{

            // send error log to DB to inform about manipulating with DB + all data
            $query = "SELECT e.*, t.event_type_name, t.event_credits
                        FROM events e
                        LEFT JOIN event_c_type t ON e.event_type = t.event_type_id
                        WHERE e.event_group = ?;";
            $values = array($group);

            // get data in an indexed array
            // select all data from the events table
            $stm = $this->connect()->run($query, $values);

            // pass the PDO:FETCH_NUM style to the fetchAll() method
            $rows = $stm->fetchAll(PDO::FETCH_NUM);

            return $rows;

        }catch(Exception $e)
        {
            error_log($e);
        }

    }

    public function getEventsByArea($area){

        try{

            // send error log to DB to inform about manipulating with DB + all data
            $query = "SELECT e.*, t.event_type_name, t.event_credits
                        FROM events e
                        LEFT JOIN event_c_type t ON e.event_type = t.event_type_id
                        WHERE e.event_area = ?;";
            $values = array($area);

            // get data in an indexed array
            // select all data from the events table
            $stm = $this->connect()->run($query, $values);

            // pass the PDO:FETCH_NUM style to the fetchAll() method
            $rows = $stm->fetchAll(PDO::FETCH_NUM);

            return $rows;

        }catch(Exception $e)
        {
            error_log($e);
        }

    }

    public function sortEventsByDate($event1, $event2){

        if($event1[4] == $event2[4])
        {
            return 0;
        }

        return ($event1[4] < $event2[4]) ? -1 : 1;

    }
}

?>
