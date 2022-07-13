<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Galerija slika</title>
    <meta charset="utf-8">
    <meta name="author" content="Ana Horvat">
    <meta name="keywords" content="FOI, WebDiP,Projekt 2021./2022., Benzinska postaja">
    <link rel="stylesheet" href="./css/ahorvat3.css" type="text/css">
    <meta name="description" content="Projekt benzinska postaja">
</head>

<body>
    <header id="zaglavlje">
        <a class="naslov" href="index.php">Benzinska postaja</a>
        <br>
        <a class="opis">WebDiP projekt 2021./2022.</a>
    </header>

    <nav>
        <ul id="navigacija">
            <li class="lijevo"><a href="izbornik.php">Izbornik</a></li>
            <li class="lijevo"><a href="dokumentacija.html">Dokumentacija</a></li>
            <li class="lijevo"><a href="o_autoru.html">O autorici</a></li>
            <li class="desno"><a href="./registracija.php">Registracija</a></li>
            <li class="desno"><a href="./prijava.php">Prijava</a></li>
        </ul>
    </nav>

    <?php
    if (session_id() == '') {
        session_start();
    }
    if (isset($_SESSION['korisnik'])) {
        echo "<a id=\"prijavljenkor\" href=\"odjava.php\">Trenutno ste prijavljeni kao korisnik $_SESSION[korisnik]. Kliknite ovdje za odjavu.</a>";
    } else {
        echo "<a id=\"prijavljenkor\">Korisnik nije prijavljen.</a>";
    }
    ?>

    <section class="centar">
        <div id="sadrzaj">
            <h1>Sustav za administraciju benzinske postaje</h1>
            <h3>Galerija slika</h3>
        </div>
    </section>

    <section>        
        <div class="galerija">
            <a target="_blank">
                <img src="https://drive.google.com/uc?export=view&id=1H59bf9omI1bNr7psNFYr5-1mgGIV1sHk" alt="Auto1" width="600" height="400">
            </a>
        </div>

        <div class="galerija">
            <a target="_blank">
                <img src="https://drive.google.com/uc?export=view&id=1sN1ZbrGhQqc9FkHmA9Z9hS5T9FUKnJCN" alt="Auto2" width="600" height="400">
            </a>
        </div>

        <div class="galerija">
            <a target="_blank">
                <img src="https://drive.google.com/uc?export=view&id=1RPduxoqsE7Cq5x1MwjJJz3zmMIp2lhRd" alt="Auto3" width="600" height="400">
            </a>
        </div>

        <div class="galerija">
            <a target="_blank">
                <img src="https://drive.google.com/uc?export=view&id=1p9N_6eW54tD7tVBsrjDFfJeNQMxxzaCB" alt="Auto4" width="600" height="400">
            </a>
        </div>

        <div class="galerija">
            <a target="_blank">
                <img src="https://drive.google.com/uc?export=view&id=1pUa2j6Ub415Ig1CEPS8VYJqAxzkgwwVR" alt="Auto5" width="600" height="400">
            </a>
        </div>
    </section>

    <footer id="podnozje">
        <a href="https://validator.w3.org/check?uri=<?php echo $adresa ?>" target="_blank"><img class="validacija" src="./materijali/HTML5.png" alt="HTML5 validacija"></a>
        <a href="https://jigsaw.w3.org/css-validator/validator?uri=<?php echo $adresa ?>" target="_blank"> <img class="validacija" src="./materijali/CSS3.png" alt="CSS3 validacija"></a>
        <address>
            <a href="mailto:ahorvat3@foi.hr">Kontakt: pošalji mali</a>
        </address>
        <a>&copy; 2022 Ana Horvat</a>
    </footer>
</body>

</html>