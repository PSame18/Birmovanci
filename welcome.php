//////////////////////////////////////////////////////
// File for all user that wil come from rkc website //
// ------------------------------------------------ //
// > here will be some up to date events and info //
// > and login possibility which will lead to //
// login.php page //
//////////////////////////////////////////////////////

// to know how to code in .php file, see README.md
<?php

// default settings for database connection
include_once("core/init.inc.php");

?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Prihlásenie</title>

    <PHP>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </PHP>

    <PHP>
        <link rel="stylesheet" href="css/style.css">
    </PHP>

    <PHP>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,800&display=swap" rel="stylesheet">
    </PHP>

    <PHP>
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,500&display=swap" rel="stylesheet">
    </PHP>

</head>

<body id="login-body">

    <?php

        // if login was unsuccesfull, user will see note about it
        if(!$loginSuccess){
            echo "<div class='container' id='wrong-div'>";
                echo "<p id='wrong-p'>Nesprávne meno alebo heslo!</p>";
            echo "</div>";
            session_destroy();
        }

        ?>

    <div class="container-fluid">
        <div class="row">

            <!-- logos and title -->
            <div class="col-md-8">
                <h1 class="birmovanci-title">BIRMOVANCI</h1>
                <img class="img-fluid logos" src="pictures/logos.png" alt="Logá farností">
            </div>

            <!-- form for login -->
            <div class="col-md-4">
                <div class="form">
                    <form action="core/forms/login_handler.php" method="post">
                        <h3 class="prihlasenie">PRIHLÁSENIE</h3>
                        <label class="row">
                            <input class="login-name" type="text" name="login" value="" placeholder="Meno" required>
                        </label>
                        <label class="row">
                            <input class="login-password" type="password" name="password" value="" placeholder="Heslo" required>
                        </label>
                        <label class="row">
                            <input class="login-btn btn btn-info" type="submit" name="submit" value="Prihlásiť sa">
                        </label>
                    </form>
                </div>
            </div>

        </div>
    </div>



    <!--JAVASCRIPT-->
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
