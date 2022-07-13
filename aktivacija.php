<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/funkcijeBaze.php");
$obavijest = "";

if ((isset($_GET["kod"]) && isset($_GET["korisnik"]))) {
    $primljeniKod = $_GET["kod"];
    $primljeniKorisnik = $_GET["korisnik"];

    $upit = "UPDATE korisnik SET status = 1 WHERE korisnicko_ime = '$primljeniKorisnik'";
    unosUpdate($upit);

    $upit = "SELECT * FROM korisnik WHERE korisnicko_ime='$primljeniKorisnik'";
    $vraceniRedak = dohvatiRedakKaoPolje($upit);

    $id_korisnika= $vraceniRedak["id_korisnika"];
    $zapis = "Aktiviran račun $primljeniKorisnik";
    $trenutnoVrijeme = date("Y-m-d H:i:s");

    $upit = "INSERT INTO dnevnik (id_zapisa, tip_zapisa, zapis, vrijeme, id_korisnika) VALUES (default,'Rad s bazom','$zapis','$trenutnoVrijeme','$id_korisnika')";
    unosUpdate($upit);

    $brojac = 0;

    if ($brojac == 0) {
        $obavijest .= "U roku od 10 sekundi biti ćete preusmjereni na prijavu.<br>";
        header("refresh:10;url=prijava.php");
    } else {
        $obavijest .= "U roku od 10 sekundi biti ćete preusmjereni na početnu stranicu.<br>";
        header("refresh:10;url=index.php");
    }
} else {
    $obavijest = "GREŠKA! Skripti nisu proslijeđeni parametri!";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Aktivacija</title>
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
            <h1>Stranica za aktivaciju</h1>
            <a>
                <?php
                    echo $obavijest;
                ?>
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