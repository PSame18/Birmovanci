<?php
include_once("core/init.inc.php");
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
$users = Users::getInstance();
$allUsersRows = $users->getAllUsers();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Birmovanci - Skupinky</title>
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
			<h1>Skupinky</h1>
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
								Všetky skupinky
								</button>
								</h2>
							</div>
							<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
								<div class="card-body">
									<?php
										printGroupCollapse($users);
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

function printGroupCollapse($users){

	echo "<div class='container'>";
		echo "<div class='accordion' id='accordionGroups'>";

			for($idx = 1; $idx <= 20; $idx++){

				// CARD
				echo "<div class='card'>";

					echo "<div class='card-header' id='header" . $idx . "'>";
						echo "<h2 class='mb-0'>";
							echo "<button class='btn btn-link' type='button' data-toggle='collapse' data-target='#collapse" . $idx. "' aria-expanded='true' aria-controls='collapse" . $idx . "'>
											$idx
							</button>";
						echo "</h2>";
					echo "</div>";

					echo "<div id='collapse" . $idx . "' class='collapse' aria-labelledby='header" . $idx . "' data-parent='#accordionGroups'>";
						echo "<div class='card-body'>";
							printGroupTable($users, $idx);
						echo "</div>";
					echo "</div>";

				echo "</div>"; // CARD

			} // FOR LOOP


		echo "</div>";
	echo "</div>";
}


function printGroupTable($users, $number){

	echo "<table class='table'>";
		echo "<thead class='thead-light'>";
    		echo "<tr>";
      			echo "<th scope='col'>#</th>";
      			echo "<th scope='col'>Meno a Priezvisko</th>";
      			echo "<th scope='col'>Počet kreditov</th>";
    		echo "</tr>";
  		echo "</thead>";
  		echo "<tbody>";

  		$groupUsersRows = $users->getUsersByGroup($number);

		foreach ($groupUsersRows as $groupUserRow) {
			echo "<tr>";
				echo "<th scope='row'>$groupUserRow[0]</th>";
				echo "<td>$groupUserRow[1]</td>";
				echo "<td>$groupUserRow[4]</td>";
			echo "</tr>";
		}
		echo "</tbody>";
	echo "</table>";

}

?>