<?php  include_once("core/init.inc.php");

// variable which is set accroding to success of login
$loginSuccess = true;

// time used to push browser to update website every time, time has changed
$time = time();

// session variable which is set in login_handler.php
// store data about success of loginSuccess
// used to show div with info about wrong login
if(isset($_SESSION["loginSuccess"])){
    $loginSuccess = $_SESSION["loginSuccess"];
}

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

    <div class="container">

        <!-- logos and title -->
        <div class="container">
            <h1 class="birmovanci-title">BIRMOVANCI</h1>
            <img class="img-fluid logos" src="pictures/logos.png" alt="Logá farností">
        </div>

        <!-- form for login -->
        <div class="form">
            <form action="core/forms/login_handler.php" method="post">
                <h3 class="prihlasenie">PRIHLÁSENIE</h3>
                <label class="row" for="">
                    <input class="login-name" type="text" name="login" value="" placeholder="Meno" required>
                </label>
                <label class="row" for="">
                    <input class="login-password" type="password" name="password" value="" placeholder="Heslo" required>
                </label>
                <label class="row" for="">
                    <input class="login-btn btn btn-info" type="submit" name="submit" value="Prihlásiť sa">
                </label>
            </form>
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
