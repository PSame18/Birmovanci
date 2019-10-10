<?php
include_once("core/init.inc.php");
// kontrola udajov, zabezpecenie
if(isset($_SESSION["loginSuccess"]) && $_SESSION["loginSuccess"] == false){
	header("Location: login.php");
}
if(isset($_SESSION["userStatus"]) && $_SESSION["userStatus"] != 1){
	header("Location: login.php");
}
if(!isset($_SESSION["userName"])){
	header("Location: login.php");
}
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
			<div id="udalosti" class="row">

				

			</div>
			<div>
				
			</div>
		</div>
		<PHP><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script><PHP>
		<PHP><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script><PHP>
		<PHP><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script><PHP>
	</body>
</html>