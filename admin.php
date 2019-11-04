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
        <link rel="stylesheet" type="text/css" href="css/style-events.css">
    </PHP>
</head>

<body id="events-body">
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
            </div>
            <div>
                <form class="form-inline my-2 my-lg-0" action="core/forms/logout_handler.php" method="post">
                    <input class="form-control mr-sm-2 btn-info logout-btn logout-button-style" type="submit" aria-label="Odhlásiť sa" name="logout" value="Odhlásiť sa">
                </form>
            </div>
        </nav>

        <!-- logos and title -->
        <div class="row logos-and-title">
            <div class="col-8 title-and-platform-info">
                <h1 class="birmovanci-title">BIRMOVANCI</h1>
                <section class="platform-info">Platforma pre vás a o vás. Nájdete tu všetky dôležité informácie o stretkách, kreditoch, akciách a mnoho ďalšieho.</section>
            </div>
            <div class="col-4 d-none d-lg-block">
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
