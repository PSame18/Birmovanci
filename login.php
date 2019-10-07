<?php  include_once("core/init.inc.php");

// variable which is set accroding to success of login
$loginSuccess = true;

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
                echo "<p id='wrong-p'>Wrong Name or Password!</p>";
            echo "</div>";
            session_destroy();
        }

        ?>

        <!-- form for login -->
        <div class="container form-container">
            <div class="form">
                <form action="core/forms/login_handler.php" method="post">
                    <label class="row" for="">
                        <input type="text" name="name" value="" placeholder="Name" required>
                    </label>
                    <label class="row" for="">
                        <input type="email" name="email" value="" placeholder="E-mail" required>
                    </label>
                    <label class="row" for="">
                        <input type="password" name="password" value="" placeholder="Password" required>
                    </label>
                    <label class="row" for="">
                        <input  class="login-btn btn btn-info" type="submit" name="submit" value="Log in">
                    </label>
                </form>
            </div>
        </div>
    </body>
</html>
