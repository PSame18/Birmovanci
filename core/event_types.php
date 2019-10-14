<?php include_once("db_handler.php");

class EventTypes extends DBHandler{

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

    public function getEventTypes(){
        
        try{

            // send error log to DB to inform about manipulating with DB + all data
            $query = "SELECT * FROM event_c_type";
            $values = array();

            // get data in an indexed array
            // select all data from the events table
            $stm = $this->connect()->run($query);

            // pass the PDO:FETCH_NUM style to the fetchAll() method
            $types = $stm->fetchAll(PDO::FETCH_NUM);

            return $types;

        }catch(Exception $e)
        {
           error_log($e);
        }

    }

}


?>
