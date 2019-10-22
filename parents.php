<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Birmovanci - Rodičia</title>
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
		<h1>Rodičia</h1>
		<div>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">

					</span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav">
						<a class="nav-item nav-link" href="domov">Domov</a>
						<a class="nav-item nav-link" href="udalosti">Udalosti</a>
						<a class="nav-item nav-link" href="skupinky">Skupinky</a>
						<a class="nav-item nav-link active" href="rodicia">Rodičia</a>
					</div>
					<form class="form-inline my-2 my-lg-0" action="core/forms/logout_handler.php" method="post">
						<input class="form-control mr-sm-2 btn-info" type="submit" aria-label="Odhlásiť sa" name="logout" value="Odhlásiť sa">
					</form>
				</div>
			</nav>
		</div>
	</div>
</body>
</html>