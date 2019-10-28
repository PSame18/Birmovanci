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

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Birmovanci - Domov</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- styling -->
    <PHP>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </PHP>
    <PHP>
        <link rel="stylesheet" type="text/css" href="css/style-index.css">
    </PHP>
    <PHP>
        <link rel="stylesheet" type="text/css" href="css/style-gallery.css">
    </PHP>
    <PHP>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,800&display=swap" rel="stylesheet">
    </PHP>
    <PHP>
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,500&display=swap" rel="stylesheet">
    </PHP>
</head>

<body id="events-body">
    <div class="container-fluid header">

        <!-- navbar -->
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
            </div>
            <div>
                <form class="form-inline my-2 my-lg-0" action="login" method="post">
                    <input class="form-control mr-sm-2 btn-info logout-btn logout-button-style" type="submit" aria-label="Prihlásiť sa" name="login" value="Prihlásiť sa">
                </form>
            </div>
        </nav>

        <!-- logos and title -->
        <div class="row logos-and-title">
            <div class="col-8 title-and-platform-info">
                <h1 class="birmovanci-title">BIRMOVANCI</h1>
                <section class="platform-info">Platforma pre vás a o vás. Nájdete tu všetky dôležité informácie o stretkách, kreditoch, akciách a mnoho ďalšieho.</section>
            </div>
            <div class="col-4">
                <img class="img-fluid logos" src="pictures/logos.png" alt="Logá farností">
            </div>
        </div>

    </div>

    <!-- footer -->
    <footer>
        <div class="row footer-div">
            <div class="col-11">
                Farnosti <a class="footer-links" href="https://www.rkcpoprad.sk">Poprad Mesto</a> a <a class="footer-links" href="http://www.rkcpopradjuh.sk">Poprad Juh</a>
            </div>
        </div>
    </footer>

    <PHP>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
    </PHP>
    <PHP>
        <script src="js/inputLabelChanger.js"></script>
    </PHP>
    <PHP>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    </PHP>
    <PHP>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </PHP>
</body>

</html>

<?php

function printEventDetail(){

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
    		echo "<p class='card-text'>$eventRow[2]</p>";

  		echo "</div>";
	echo "</div>";

}

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
	else{
		echo "<a class='nav-item nav-link active' href='/'>Domov</a>";
		echo "<a class='nav-item nav-link' href='aktuality'>Aktuality</a>";
		echo "<a class='nav-item nav-link' href='info'>Informácie a podmienky";
		echo "<a class='nav-item nav-link' href='rodicia'>Pre rodičov</a>";
	}

}

?>