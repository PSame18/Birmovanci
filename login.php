<?php  include_once("core/init.inc.php");

// variable which is set accroding to success of login
$loginSuccess = true;

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
        <title></title>
        <!--PHP><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"><PHP!-->
        <PHP><link rel="stylesheet" href="css/style.css"><PHP>
    </head>
    <body>

        <?php

        // if login was unsuccesfull, user will see note about it
        if(!$loginSuccess){
            echo "<div class='container' id='wrong-div'>";
                echo "<p id='wrong-p'>Nesprávne meno alebo heslo!</p>";
            echo "</div>";
            session_destroy();
        }

        ?>

        <!-- form for login -->
        <div class="container form-container">
            <div class="form">
                <form action="core/forms/login_handler.php?t=<?php echo"$time"?>" method="post">
                    <label class="row" for="">
                        <input type="text" name="login" value="" placeholder="Login" required>
                    </label>
                    <label class="row" for="">
                        <input type="password" name="password" value="" placeholder="Heslo" required>
                    </label>
                    <label class="row" for="">
                        <input  class="login-btn btn btn-info" type="submit" name="submit" value="Prihlásiť sa">
                    </label>
                </form>
            </div>
        </div>
    </body>
</html>
