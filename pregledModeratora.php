<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();

$baza = new Baza();

$upit = "SELECT * FROM benzinska_postaja";
$baza->spojiDB();
$rezultat = $baza->selectDB($upit);

if($baza->pogreskaDB()){
    echo "Problem kod upita na bazu podatka!";
    exit;
}

$tablica = "<table style='width:65%'><tr><th>ID benzinske</th><th>Lokacija</th><th>Radno vrijeme</th><th>Broj mjesta</th><th>ID moderatora</th><th>Ukupno natočeno</th></tr>\n";

while (list($id_benzinske_postaje,$lokacija,$radno_vrijeme,$broj_mjesta,$moderator,$ukupno_natoceno) = $rezultat->fetch_array()){
    $upit = "SELECT mjesto FROM lokacija_benzinske_postaje WHERE id_lokacije_benzinske_postaje = '$lokacija'";
    $rez = $baza->selectDB($upit);
    $mjesto = $rez->fetch_row();
    $tablica.= "<tr><td>$id_benzinske_postaje</td><td>$mjesto[0]</td><td>$radno_vrijeme</td><td>$broj_mjesta</td><td>$moderator</td><td>$ukupno_natoceno</td><td><a href='dodajModeratora.php?id=$id_benzinske_postaje'>Dodaj moderatora</a></td></tr>\n";
}

$tablica.= "</table>\n";

$rezultat->close();
$baza->zatvoriDB();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pregled benzinskih postaja</title>
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

    <h2>Popis svih benzinskih postaja</h2>
    <?php
        echo $tablica;
    ?>

    <br><br>

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