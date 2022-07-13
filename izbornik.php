<?php
    if (isset($_SERVER['HTTPS'])) {
        $http_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header("Location: $http_url");
        exit();
    }

    require("./class/funkcijeBaze.php");

    $adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

    $brojacGreski = 0;
    $ispisGreski = "";

    session_start();

    if (isset($_SESSION['uloga'])){

        if ($_SESSION['uloga']<=4) {
            $ispisGreski .= "<h2>Neregistrirani korisnik</h2>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'galerijaSlika.php'>Galerija slika</a><br>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'rangLista.php'>Rang lista benzinskih postaja</a><br>";
        }
        if ($_SESSION['uloga']<=3) {
            $ispisGreski .= "<h2>Registrirani korisnik</h2>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'kreiranjeVozila.php'>Kreiranje vozila</a><br>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'popisBenzinskihPostaja.php'>Popis benzinskih postaja (evidencija točenja)</a><br>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'popisVozila.php'>Popis vozila</a><br>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'statistikaVozila.php'>Statistika vozila</a><br>";
        }
        if ($_SESSION['uloga']<=2) {
            $ispisGreski .= "<h2>Moderator</h2>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'pregledSvihMjesta.php'>Pregled mjesta na postaji</a><br>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'pregledVrstaModerator.php'>Pregled vrsta goriva na postaji (dodavanje na mjesto)</a><br>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'statistikaTocenjaPremaKorisniku.php'>Statistika točenja prema korisniku</a><br>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'cijelaEvidencija.php'>Cijela evidencija točenja goriva</a><br>";
        }
        if ($_SESSION['uloga']<=1) {
            $ispisGreski .= "<h2>Administrator</h2>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'pregledLokacija.php'>Pregled lokacija benzinskih postaja</a><br>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'pregledVrsta.php'>Pregled vrsta goriva</a><br>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'pregledModeratora.php'>Dodaj moderatora benzinskoj</a><br>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'kreirajModeratora.php'>Kreiraj moderatora</a><br>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'otkljucajRacun.php'>Otključaj račun</a><br>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'zakljucajRacun.php'>Zaključaj račun</a><br>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'pregledDnevnika.php'>Pregled dnevnika</a><br>";
            $ispisGreski .= "<a class='klikIzbornik' href = 'pregledSvihKorisnika.php'>Pregled svih korisnika</a><br>";
        }
    }
    else {
        $ispisGreski .= "Pristup ostalim dijelovima sustava dozvoljen je isključivo registriranim korisnicima.<br>";
        $ispisGreski .= "<h2>Neregistrirani korisnik</h2>";
        $ispisGreski .= "<a class='klikIzbornik' href = 'galerijaSlika.php'>Galerija slika</a><br>";
        $ispisGreski .= "<a class='klikIzbornik' href = 'rangLista.php'>Rang lista benzinskih postaja</a><br>";
    }
?>

<html>

<head>
    <title>Izbornik</title>
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
            <li class="lijevo"><a class="trenutna" href="izbornik.php">Izbornik</a></li>
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

    <section id="sadrzaj" style="padding-bottom: 150px;">
        <div>
            <h1>Izbornik</h1>
            <div class="klikIzbornik">
                <?php echo $ispisGreski; ?>
            </div>
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