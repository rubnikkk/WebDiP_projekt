<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();

$baza = new Baza();
$baza->spojiDB();

$id_goriva = htmlspecialchars($_GET['id']);

$id_korisnika = $_SESSION['idKorisnika'];
$upit = "SELECT id_benzinske_postaje FROM benzinska_postaja WHERE moderator='$id_korisnika'";
$rez = $baza->selectDB($upit);
$id_zaduzene = ($rez->fetch_row())[0];
$_SESSION['zaduzena'] = $id_zaduzene;

$upit = "INSERT INTO mjesto_na_benzinskoj VALUES(default,'$id_zaduzene','$id_goriva','otvorena')";
$baza->selectDB($upit);

$ispisGreski="Gorivo je dodano na mjesto!";

$baza->zatvoriDB();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Pregled mjesta</title>
    <meta charset="utf-8">
    <meta name="author" content="Ana Horvat">
    <meta name="keywords" content="FOI, WebDiP,Projekt 2021./2022., Benzinska postaja">
    <link rel="stylesheet" href="./css/ahorvat3.css" type="text/css">
    <meta name="description" content="Projekt benzinska postaja">
</head>

<body>
    <header id="zaglavlje">
        <a class="naslov" href="./index.php">Benzinska postaja</a>
        <br>
        <a class="opis">WebDiP projekt 2021./2022.</a>
    </header>

    <nav>
        <ul id="navigacija">
            <li class="lijevo"><a href="izbornik.php">Izbornik</a></li>
            <li class="lijevo"><a href="dokumentacija.html">Dokumentacija</a></li>
            <li class="lijevo"><a href="o_autoru.html">O autorici</a></li>
            <li class="desno"><a href="registracija.php">Registracija</a></li>
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

    <br>

    <a href="pregledSvihMjesta.php">Pregledaj sva mjesta na benzinskoj</a>
    
    <div id="greske">
        <div id="phpGreske">
            <?php
            echo $ispisGreski;
            ?>
        </div>
    </div>

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