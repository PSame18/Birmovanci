<?php
include_once("core/init.inc.php");
include_once("core/events.php");
include_once("core/event_types.php");
include_once("core/users.php");

// kontrola udajov, zabezpecenie
if(isset($_SESSION["loginSuccess"]) && $_SESSION["loginSuccess"] == false){
	header("Location: login");
}

// admin ma status 1, ak to neplati, presmerovat znova na login
//if(isset($_SESSION["userStatus"]) && $_SESSION["userStatus"] != 1){
//	header("Location: login");
//fire}

// nahodou ak niekto sa dostane na stranku bez loginu
if(!isset($_SESSION["userName"])){
	header("Location: login");
}

$events = Events::getInstance();
$allEventsRows = $events->getAllEvents();

$event_types = EventTypes::getInstance();
$typeRows = $event_types->getEventTypes();

$users = Users::getInstance();
$allUsersRows = $users->getAllUsers();

?>

<?php
$title = "Domov";
require "core/header.php";
?>


<?php
require "core/footer.php";
?>