<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();

$datumOd = filter_input(INPUT_POST, 'datumOd');
$datumDo = filter_input(INPUT_POST, 'datumDo');

$tablica = "";


$baza = new Baza();
$upit = "SELECT * FROM lokacija_benzinske_postaje";
$baza->spojiDB();
$rezultat = $baza->selectDB($upit);

if($baza->pogreskaDB()){
    echo "Problem kod upita na bazu podatka!";
    exit;
}

$tablica = "<table style='width:65%'><tr><th>ID lokacije</th><th>Mjesto</th><th>Ulica</th><th>Kućni broj</th><th>Poštanski broj</th></tr>\n";

while (list($id_lokacije_benzinske_postaje,$mjesto,$ulica,$kucni_broj,$postanski_broj) = $rezultat->fetch_array()){
    $tablica.= "<tr><td>$id_lokacije_benzinske_postaje</td><td>$mjesto</td><td>$ulica</td><td>$kucni_broj</td><td>$postanski_broj</td><td><a href='urediLokaciju.php?id=$id_lokacije_benzinske_postaje'>Uredi</a></td><td><a href='izbrisiLokaciju.php?id=$id_lokacije_benzinske_postaje'>Izbriši</a></tr>\n";
}

$tablica.= "</table>\n";

$rezultat->close();

$baza->zatvoriDB();


?>

<!DOCTYPE html>
<html>

<head>
    <title>Pregled lokacija</title>
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
    
    <a href="kreiranjeLokacijeBenzinske.php">Kreiraj novu lokaciju</a>

    <h2>Popis lokacija benzinskih postaja</h2>
    <div class="zadnji">
        <?php
            echo $tablica;
        ?>
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