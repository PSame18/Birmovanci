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
			<link rel="stylesheet" type="text/css" href="css/style.css">
		</PHP>
	</head>
	<body>
		<div class="container-fluid">
			<h1>Udalosti</h1>
			<div>
				<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
					<a class="navbar-brand" href="domov">Domov</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
					</span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
						<div class="navbar-nav">
							<a class="nav-item nav-link" href="udalosti">Udalosti</a>
							<a class="nav-item nav-link" href="skupinky">Skupinky</a>
							<a class="nav-item nav-link right-free" href="rodicia">Rodičia</a>
						</div>
						<form class="form-inline my-2 my-lg-0" action="core/forms/logout_handler.php" method="post">
							<input class="form-control mr-sm-2 btn-info" type="submit" aria-label="Odhlásiť sa" name="logout" value="Odhlásiť sa">
						</form>
					</div>
				</nav>
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
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		</PHP>
		<PHP>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		</PHP>
	</body>
</html>

<?php
function printEventPost($eventRow){
	echo "<div class='container' style='background-color: red; color: black;'>"; // div1
		echo "<div class='row'>"; // div2
			echo "<br>";
			echo "<h3>Nazov: $eventRow[1]</h3>";
			echo "<br>";
			echo "<p>Popis: $eventRow[2]<p>";
			echo "<br>";
			echo "<p>Typ: $eventRow[11] ($eventRow[12] kreditov)<p>";
			echo "<br>";
			echo "<p>Datum od: $eventRow[4]<p>";
			echo "<br>";
			echo "<p>Datum do: $eventRow[5]<p>";
			echo "<br>";
			echo "<p>Cas od: $eventRow[6]<p>";
			echo "<br>";
			echo "<p>Cas do: $eventRow[7]<p>";
			echo "<br>";
			echo "<p>Miesto: $eventRow[8]<p>";
			echo "<br>";
			echo "<hr>";
			echo "</div>"; // div2
		echo "</div>";	//  div1
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
	echo "<form action='core/forms/admin_form_handler.php' method='post' accept-charset='utf-8'>";
			echo "<label class='row'>";
				echo "<input class='input' type='hidden' name='event_id' value=''>";
			echo "</label>";
			echo "<label class='row'>Názov udalosti";
				echo "<input class='input' type='text' name='event_name' value='' placeholder='Názov udalosti' required>";
			echo "</label>";
			echo "<label class='row'>Opis udalosti";
				echo "<textarea class='input' rows='4' cols='50' type='text' name='event_desc' value='' placeholder='Opis udalosti'></textarea>";
			echo "</label>";
			echo "<label for='row'>Typ udalosti";
				echo "<select name='event_type'>";
					foreach ($typeRows as $typeRow) {
					echo "<option value='$typeRow[0]'> $typeRow[1]</option>";
					}
				echo "</select>";
			echo "</label>";
			echo "<label for='row'>Dátum začiatku";
					echo "<input class='input' type='date' name='date_from' value='' placeholder='Dátum začiatku'>";
			echo "</label>";
			echo "<label for='row'>Dátum konca";
					echo "<input class='input' type='date' name='date_to' value='' placeholder='Dátum konca'>";
			echo "</label>";
			echo "<label for='row'>Čas začiatku";
					echo "<input class='input' type='time' name='time_from' value='' placeholder='Čas začiatku'>";
			echo "</label>";
			echo "<label for='row'>Čas konca";
					echo "<input class='input' type='time' name='time_to' value='' placeholder='Čas konca'>";
			echo "</label>";
			echo "<label class='row'>Miesto udalosti";
					echo "<input class='input' type='text' name='event_place' value='' placeholder='Miesto udalosti'>";
			echo "</label>";
			echo "<label class='row'>Skupina, ktorej sa týka udalosť";
					echo "<input class='input' type='number' name='event_group' value='' placeholder=''>";
			echo "</label>";
			echo "<label class='row'>";
					echo "<input class='input btn btn-info' type='submit' name='submit' value='Pridať udalosť'>";
			echo "</label>";
	echo "</form>";
}
?>