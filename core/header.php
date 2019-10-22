<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>
			<?php

				if(isset($title) && !empty($title)) {
   					echo "Birmovanci - " . $title;
				}
				else {
   					echo "Birmovanci";
				}
   			?>

   		</title>
		<!-- styling -->
		<PHP>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		</PHP>
		<PHP>
			<link rel="stylesheet" type="text/css" href="/css/style.css">
		</PHP>
		<PHP>
        	<link rel="stylesheet" type="text/css" href="/css/style-events.css">
        </PHP>
	</head>
	<body>
		<div class="container-fluid">
			<div>
				<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
					<a class="navbar-brand" href="domov">Domov</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
						<div class="navbar-nav">
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