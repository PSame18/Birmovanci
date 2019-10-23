<?php

include_once("core/init.inc.php");
include_once("core/classEvents.php");
include_once("core/classEventTypes.php");

$events = Events::getInstance();
$event_types = EventTypes::getInstance();

if(isset($_GET['id']) && $_GET['id'] != null){
	$id = $_GET['id'];
}
else{
	header("Location: domov");
}

$eventRow = $events->getEventById($id);

echo "Nazov: " . $eventRow[1];

?>