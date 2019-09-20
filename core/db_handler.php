<?php include("init.inc.php");

class DBHandler {

    private $servername = SERVERNAME;
    private $username = USERNAME;
    private $password = PASSWORD;
    private $db_name = EVENTS_DB;
    private $db;

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

    public function setDB_name($dbName){
        $this->db_name = $dbName;
    }

    public function connect(){

        try {

            // create new PDO object only if doesn't exist
            if($this->db == null){
                // to create a connection string to the database
                $this->db = new LoggedPDO("mysql:host=$this->servername;dbname=$this->db_name", $this->username, $this->password);
                // set the PDO error mode to exception
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

            // echo "Connected successfully";
            return $this->db;
            }
        catch(PDOException $e)
        {
            trigger_error($e, E_USER_ERROR);
        }

    }
}

class LoggedPDO extends PDO{

    public function __construct($dsn, $username = null, $password = null) {
        parent::__construct($dsn, $username, $password);
    }

    public function run($sql, $args = []){
        if(!$args){
            $this->sendLogMessage($sql, $args);
            return $this->query($sql);
        }
        else{
            $stmt = $this->prepare($sql);
            $pos = 1;
            foreach ($args as $arg) {
                $stmt->bindValue($pos, $arg);
                $pos++;
            }
            $stmt->execute();
            $this->sendLogMessage($sql, $args);
            return $stmt;
        }
    }

    public function sendLogMessage($sql, $args){

        $data = print_r($args, true);

        $dataArray = $sql . ' with values: ' . $data;
        $statement = print_r($dataArray, true);

        trigger_error("MYSQL: $statement", E_USER_NOTICE);

    }

}

?>
