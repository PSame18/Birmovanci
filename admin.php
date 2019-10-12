<?php

include_once("core/init.inc.php");
include_once("core/events.php");
include_once("core/event_types.php");

// kontrola udajov, zabezpecenie
//if(isset($_SESSION["loginSuccess"]) && $_SESSION["loginSuccess"] == false){
//	header("Location: login.php");
//}
// admin ma status 1, ak to neplati, presmerovat znova na login
//if(isset($_SESSION["userStatus"]) && $_SESSION["userStatus"] != 1){
//	header("Location: login.php");
//}
// nahodou ak niekto sa dostane na stranku bez loginu
//if(!isset($_SESSION["userName"])){
//	header("Location: login.php");
//}

$events = Events::getInstance();
$eventsRows = $events->getAllEvents();

$event_types = EventTypes::getInstance();
$typeRows = $event_types->getEventTypes();

?>

<html>
	<head>
		<!-- styling -->
		<PHP><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"></PHP>
		<PHP><link rel="stylesheet" type="text/css" href="css/style.css"><PHP>
	</head>
	<body>
		
		<div class="container-fluid">
			
			<div>
				<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
					<a class="navbar-brand" href="#">Domov</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse"
					data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
						<div class="navbar-nav">
							<a class="nav-item nav-link" href="#udalosti">Udalosti</a>
							<a class="nav-item nav-link" href="#">Skupinky</a>
							<a class="nav-item nav-link right-free" href="#">Rodičia</a>
						</div>
						<form class="form-inline my-2 my-lg-0"
							action="core/forms/logout_handler.php"
							method="post">
							<input class="form-control mr-sm-2 btn-info"
							type="submit"
							aria-label="Odhlásiť sa"
							name="logout"
							value="Odhlásiť sa">
						</form>
					</div>
				</nav>
			</div>
			

			<!-- tu sa budu zobrazovat udalosti a moznost pridavania udalosti a editovanie ich -->
			<div id="udalosti" style="padding: 20px; margin: 20px;">
				<div class="container">
					
					<!-- NIC NEVIDIM CEZ TEN BLBY NAVBAR-->
					<div style="width: 100%; height:  200px; background-color: blue;">
						
					</div>

					<!-- Tu budu zobrazene vsetky udalosti -->
					<div>
						
					<?php

						foreach ($eventsRows as $eventRow) {
							printEventPost($eventRow);
						}

					?>

					</div>

					<!-- Formular pre pridavanie udalosti -->
					<div>						
						<form action='core/forms/admin_form_handler.php' method='post'>
							<label class='row'>
								<input class='input' type='hidden' name='event_id' value=''>
							</label>
							<label class='row'>Názov udalosti
								<input class='input' type='text' name='event_name' value='' placeholder='Názov udalosti' required>
							</label>
							<label class='row'>Opis udalosti
								<textarea class='input' rows='4' cols='50' type='text' name='event_description' value='' placeholder='Opis udalosti'></textarea>
							</label>
							<label for="row">Typ udalosti
								<select name='event_type'>
									<?php
										foreach ($typeRows as $typeRow) {
											echo "<option value='$typeRow[0]'> $typeRow[1]</option>";
										}
									?>
								</select>
							</label>
							<label for="row">Dátum začiatku
								<input class='input' type="date" name="date_from" value="" placeholder="Dátum začiatku">
							</label>
							<label for="row">Dátum konca
								<input class='input' type="date" name="date_to" value="" placeholder="Dátum konca">
							</label>
							<label for="row">Čas začiatku
								<input class='input' type="time" name="time_from" value="" placeholder="Čas začiatku">
							</label>
							<label for="row">Čas konca
								<input class='input' type="time" name="time_to" value="" placeholder="Čas konca">
							</label>
							<label class='row'>Miesto udalosti
								<input class='input' type='text' name='event_place' value='' placeholder='Miesto udalosti'>
							</label>
							<label class='row'>
								<input class='input btn btn-info' type='submit' name='submit' value='Pridať udalosť'>
							</label>
						</form>
					</div>

					<!-- Formular pre vymazanie udalosti -->
					<div>
						<form action="core/forms/admin_form_handler.php" method="post">

							<?php
							foreach ($eventsRows as $eventRow) {
								echo "<label class='row'>";
									echo"<input class='input' type='checkbox' name='eventId[]' value='$eventRow[0]'> $eventRow[1]";
								echo "</label>";
							}
							?>

							<label class='row'>
								<input class='input btn btn-info' type='submit' name='submit' value='Vymazať udalosť'>
							</label>
						</form>
					</div>
					
				</div>
			</div>
			<div>
				
			</div>
		</div>
		<PHP><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script><PHP>
		<PHP><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script><PHP>
		<PHP><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script><PHP>
	</body>
</html>

<!-- ////////////// -->
<!-- HELP FUNCTIONS -->
<!-- ////////////// -->

<?php

	function printEventPost($eventRow){

		echo "<div class='container' style='background-color: red; color: black;'>"; // div1

			echo "<div class='row'>"; // div2

				echo "<br>";
				echo "<h3>Nazov: $eventRow[1]</h3>";
				echo "<br>";
				echo "<p>Popis: $eventRow[2]<p>";
				echo "<br>";
				echo "<p>Typ: $eventRow[9] ($eventRow[10] kreditov)<p>";
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