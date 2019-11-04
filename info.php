<?php
include_once("core/init.inc.php");

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Birmovanci - Aktuality</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- styling -->
    <PHP>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </PHP>
    <PHP>
        <link rel="stylesheet" type="text/css" href="css/style-info.css">
    </PHP>
    <PHP>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,800&display=swap" rel="stylesheet">
    </PHP>
    <PHP>
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,500&display=swap" rel="stylesheet">
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
                    <a class='nav-item nav-link' href='/'>Domov</a>
                    <a class='nav-item nav-link' href='aktuality'>Aktuality</a>
                    <a class='nav-item nav-link active' href='info'>Informácie a podmienky</a>
                    <a class='nav-item nav-link' href='rodicia'>Pre rodičov</a>

                </div>
            </div>
            <div>
                <form class="form-inline my-2 my-lg-0" action="login" method="post">
                    <input class="form-control mr-sm-2 btn-info logout-btn logout-button-style" type="submit" aria-label="Prihlásiť sa" name="login" value="Prihlásiť sa">
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


    <!-- main -->
    <main class="container-fluid body-main">
        <h2 class="title-pages">Podmienky</h2>
        <div class="col-6">
            1. Účasť na nedeľnej sv. omši, prikázaných sviatkoch a birmovaneckej sv. omši.
            <br><br>
            2. Mesačná sv. spoveď v určenom čase.
            <br><br>
            3. Účasť na birmovaneckých stretnutiach (je povolená len jedna neúčasť na stretnutí, okrem vážneho dôvodu, napr. choroby – ospravedlnená zo strany rodiča).
            <br><br>
            4. Úspešné zvládnutie birmovaneckej skúšky.
            <br><br>
            5. Získanie stanoveného počtu kreditov (100).
            <br><br>
            6. Odporúčanie katechétu.
        </div>

        <h2 class="title-pages questions">Otázky na birmovaneckú skúšku</h2>
        <object data="birmovka.pdf" type="application/pdf" width="60%" height="100%" class="justify-content-center container-fluid otazky-a-odpovede">
            <p>Pravdepodobne Váš prehliadač nepodporuje zobrazovanie PDF súborov. Nevadí. <a class="not-showing-pdf" href="birmovka.pdf">Kliknite tu a stiahnite si tento PDF súbor</a>.</p>
        </object>
    </main>

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
