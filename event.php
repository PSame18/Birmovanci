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
	//header("Location: domov");
}

$eventRow = $events->getEventById($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Birmovanci</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- styling -->
    <PHP>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </PHP>
    <PHP>
		<link rel="stylesheet" type="text/css" href="css/style-events.css">
    </PHP>
</head>

<body>
    <div class="container-fluid header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                	<?php
                		printNavLinks();
                	?>
                </div>
                <form class="form-inline my-2 my-lg-0" action="core/forms/logout_handler.php" method="post">
                    <input class="form-control mr-sm-2 btn-info logout-button" type="submit" aria-label="Odhlásiť sa" name="logout" value="Odhlásiť sa">
                </form>
            </div>
        </nav>
    </div>

<?php

$parts1 = explode(':', $eventRow[6]);
	$parts2 = explode(':', $eventRow[7]);

	// ak sa datumy rovnaju, zobrazi sa len jeden
	if($eventRow[4] == $eventRow[5]){

		// datum od nie je rovny NULL
		if($eventRow[4] != null){
			$date = $eventRow[4];
		}
		else{
			$date = null;
		}

		// cas od nie je rovny NULL
		if($eventRow[6] != null){
			$time  = "$parts1[0]:$parts1[1]";
		}
		else{
			$time = null;
		}

	}
	// datumy sa nerovnaju, zobrazia sa oba
	else{
		$date = $eventRow[4] . " - " . $eventRow[5];
		$time  = "$parts1[0]:$parts1[1] - $parts2[0]:$parts2[1]";
	}

	if($eventRow[9] != 0){
		$group = "Pre skupinu: " . $eventRow[9];
	}
	else{
		$group = null;
	}

	if($eventRow[10] != 'N'){
		if($eventRow[10] == 'J'){
			$area = "Pre farnosť Poprad-Juh";
		}
		else{
			$area = "Pre farnosť Poprad-Mesto";
		}
	}
	else{
		$area = null;
	}

	$image = $eventRow[14];
	$image_src = "pictures/" . $image;

	echo "<div class='card mb-4 shadow-sm'>";
		if($image != null){
			echo "<img src='$image_src' class='card-img-top'>";
		}
  		echo "<div class='card-body'>";
    		echo "<h5 class='card-title'>$eventRow[1]</h5>";
    		if($date != null && $time != null){
    			echo "<h6 class='card-subtitle mb-2 text-muted'>$date, $time, $eventRow[8]</h6>";
    		}
    		if($group != null){
    			echo "<h6 class='card-subtitle mb-2 text-muted'>$group</h6>";
    		}
    		if($area != null){
    			echo "<h6 class='card-subtitle mb-2 text-muted'>$area</h6>";
    		}
   			echo "<p class='card-text'>" . strlen($eventRow[2]) > 50 ? substr($eventRow[2],0,50) . "..." : $eventRow[2] . "</p>";
    		//echo "<p class='card-text'>$eventRow[2]</p>";
    		echo "<a href='event.php?id=$eventRow[0]' class='btn btn-primary'>Viac info</a>";
  		echo "</div>";
	echo "</div>";

?>

<?php

function printNavLinks(){

	// ADMIN
	if(isset($_SESSION["userStatus"]) && $_SESSION["userStatus"] == 1){
		echo "<a class='nav-item nav-link active' href='domov'>Domov</a>";
		echo "<a class='nav-item nav-link' href='udalosti'>Udalosti</a>";
		echo "<a class='nav-item nav-link' href='skupinky'>Skupinky</a>";
		echo "<a class='nav-item nav-link' href='info'>Informácie a podmienky";
		echo "<a class='nav-item nav-link' href='rodicia'>Pre rodičov</a>";
	}
	else if(isset($_SESSION["userStatus"]) && $_SESSION["userStatus"] == 2){
		echo "<a class='nav-item nav-link active' href='domov'>Domov</a>";
		echo "<a class='nav-item nav-link' href='udalosti'>Udalosti</a>";
		echo "<a class='nav-item nav-link' href='skupinky'>Moja skupinka</a>";
		echo "<a class='nav-item nav-link' href='info'>Informácie a podmienky";
		echo "<a class='nav-item nav-link' href='rodicia'>Pre rodičov</a>";
	}
	else if(isset($_SESSION["userStatus"]) && $_SESSION["userStatus"] == 4){
		echo "<a class='nav-item nav-link active' href='domov'>Domov</a>";
		echo "<a class='nav-item nav-link' href='udalosti'>Udalosti</a>";
		echo "<a class='nav-item nav-link' href='profil'>Profil</a>";
		echo "<a class='nav-item nav-link' href='info'>Informácie a podmienky";
		echo "<a class='nav-item nav-link' href='rodicia'>Pre rodičov</a>";
	}

}

?>