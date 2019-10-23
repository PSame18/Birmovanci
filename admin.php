<?php
include_once("core/init.inc.php");
include_once("core/classEvents.php");
include_once("core/classEventTypes.php");
include_once("core/classUsers.php");

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
<html>
	<head>
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
			<div>
				<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
						<div class="navbar-nav">
							<a class="nav-item nav-link active" href="domov">Domov</a>
							<a class="nav-item nav-link" href="udalosti">Udalosti</a>
							<a class="nav-item nav-link" href="skupinky">Skupinky</a>
							<a class="nav-item nav-link" href="rodicia">Rodičia</a>
						</div>
						<form class="form-inline my-2 my-lg-0" action="core/forms/logout_handler.php" method="post">
							<input class="form-control mr-sm-2 btn-info" type="submit" aria-label="Odhlásiť sa" name="logout" value="Odhlásiť sa">
						</form>
					</div>
				</nav>
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
