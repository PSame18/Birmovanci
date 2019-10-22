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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Birmovanci - Udalosti</title>
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
                    <a class="nav-item nav-link" href="domov">Domov</a>
                    <a class="nav-item nav-link active" href="udalosti">Udalosti</a>
                    <a class="nav-item nav-link" href="skupinky">Skupinky</a>
                    <a class="nav-item nav-link" href="rodicia">Rodičia</a>
                </div>
                <form class="form-inline my-2 my-lg-0" action="core/forms/logout_handler.php" method="post">
                    <input class="form-control mr-sm-2 btn-info logout-button" type="submit" aria-label="Odhlásiť sa" name="logout" value="Odhlásiť sa">
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



    <!-- tu sa budu zobrazovat udalosti a moznost pridavania udalosti a editovanie ich -->
    <div id="udalosti" style="padding: 20px; margin: 20px;">
        <div class="container">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Všetky udalosti a akcie
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <?php
									foreach ($allEventsRows as $eventRow) {
										printEventPost($eventRow);
									}
									?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Pridať udalosť
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <?php
									addEvent($typeRows);
									?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Pridať typ udalosti
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <?php
									addEventType();
									?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Vymazať udalosť
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                            <?php
									deleteEvents($allEventsRows);
									?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <PHP>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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
function printEventPost($eventRow){

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

	echo "<div class='card'>";
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
    		echo "<a href='#' class='btn btn-primary'>Go somewhere</a>";
  		echo "</div>";
	echo "</div>";
}
?>

<?php
function deleteEvents($allEventsRows){
	echo "<form action='core/forms/admin_form_handler.php' method='post'>";
		foreach ($allEventsRows as $eventRow) {
			echo "<label class='row'>";
					$type =  htmlspecialchars($eventRow[1], ENT_NOQUOTES, "UTF-8");
					echo"<input class='input' type='checkbox' name='eventId[]' value='$eventRow[0]'> $type";
			echo "</label>";
		}
		echo "<label class='row'>";
			echo "<input class='input btn btn-info' type='submit' name='submit' value='Vymazať udalosť'>";
		echo "</label>";
	echo "</form>";
}
?>

<?php
function addEventType(){
	echo "<form action='core/forms/admin_form_handler.php' method='post' accept-charset='utf-8'>";
			echo "<input type='text' name='event_type_name' value='' placeholder='Názov'>";
			echo "<input type='number' name='event_credits' value='' placeholder='Počet kreditov'>";
			echo "<input type='submit' name='submit' value='Pridať typ'>";
	echo "</form>";
}
?>

<?php
function addEvent($typeRows){
	echo "<form action='core/forms/admin_form_handler.php' method='post' accept-charset='utf-8' enctype='multipart/form-data'>";

		echo "<div class='form-group'>";
			echo "<label for='event_name'>Názov udalosti</label>";
			echo "<input class='form-control' type='text' id='event_name' name='event_name' required>";
		echo "</div>"; // form-group

		echo "<div class='form-group'>";
			echo "<label for='event_desc'>Opis udalosti</label>";
			echo "<textarea class='form-control' id='event_desc' name='event_desc' rows='4' cols='50' required></textarea>";
		echo "</div>"; // form-group

		echo "<div class='form-group'>";
			echo "<label for='event_type'>Typ udalosti</label>";
			echo "<select class='form-control' id='event_type' name='event_type'>";
				foreach ($typeRows as $typeRow) {
					echo "<option value='$typeRow[0]'> $typeRow[1] </option>";
				}
			echo "</select>";
		echo "</div>"; // form-group

		echo "<div class='form-group'>";
			echo "<label for='date_from'>Dátum začiatku</label>";
			echo "<input class='form-control' type='date' id='date_from' name='date_from'>";
		echo "</div>"; // form-group

		echo "<div class='form-group'>";
			echo "<label for='date_to'>Dátum konca</label>";
			echo "<input class='form-control' type='date' id='date_to' name='date_to'>";
		echo "</div>"; // form-group

		echo "<div class='form-group'>";
			echo "<label for='time_from'>Čas začiatku</label>";
			echo "<input class='form-control' type='time' id='time_from' name='time_from'>";
		echo "</div>"; // form-group

		echo "<div class='form-group'>";
			echo "<label for='time_to'>Čas konca</label>";
			echo "<input class='form-control' type='time' id='time_to' name='time_to'>";
		echo "</div>"; // form-group

		echo "<div class='form-group'>";
			echo "<label for='event_place'>Miesto udalosti</label>";
			echo "<input class='form-control' type='text' id='event_place' name='event_place'>";
		echo "</div>"; // form-group

		echo "<div class='form-group'>";
			echo "<label for='event_group'>Skupina, ktorej sa týka udalosť</label>";
			echo "<input class='form-control' type='number' min='1' max='20' id='event_group' name='event_group'>";
		echo "</div>"; // form-group

		echo "<div class='form-group'>";
			echo "<label for='event_area'>Farnosť, ktorej sa týka udalosť</label>";
			echo "<select class='form-control' id='event_area' name='event_area'>";
				echo "<option value='N'> Nezadaná </option>";
				echo "<option value='J'> Poprad-Juh </option>";
				echo "<option value='M'> Poprad-Mesto </option>";
			echo "</select>";
		echo "</div>"; // form-group

		echo "<div class='form-group'>";
			echo "<input class='form-control' type='file' id='event_img' name='file' placeholder='Pridaj titulný obrázok'>";
			echo "<label id='event_img_label' for='event_img'>Pridaj titulný obrázok</label>";
		echo "</div>"; // form-group

		echo "<div class='form-group'>";
			echo "<label for='submit'></label>";
			echo "<input class='form-control btn btn-info' type='submit' id='submit' name='submit'  value='Pridať udalosť'>";
		echo "</div>"; // form-group

	echo "</form>";
}
?>
