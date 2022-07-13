<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();

$baza = new Baza();

$upit = "SELECT * FROM korisnik";
$baza->spojiDB();
$rezultat = $baza->selectDB($upit);

if($baza->pogreskaDB()){
    echo "Problem kod upita na bazu podatka!";
    exit;
}

$tablica = "<table style='width:100%'><tr><th>ID korisnika</th><th>ID uloge</th><th>Ime</th><th>Prezime</th><th>Godina rođenja</th><th>Korisničko ime</th><th>Lozinka</th><th>Lozinka sha256</th><th>Email</th><th>Broj telefona</th><th>Datum registracije</th><th>Status</th><th>Broj neuspješnih prijava</th><th>Uvjeti korištenja</th><th>Aktitvacijski kod</th></tr>\n";

while (list($id_korisnika,$id_uloge,$ime,$prezime,$godina_rodenja,$korisnicko_ime,$lozinka,$lozinka_sha256,$email,$broj_telefona,$datum_registracije,$status,$broj_neuspjesnih_prijava,$uvjeti_koristenja,$aktivacijski_kod) = $rezultat->fetch_array()){
    $tablica.= "<tr><td>$id_korisnika</td><td>$id_uloge</td><td>$ime</td><td>$prezime</td><td>$godina_rodenja</td><td>$korisnicko_ime</td><td>$lozinka</td><td>$lozinka_sha256</td><td>$email</td><td>$broj_telefona</td><td>$datum_registracije</td><td>$status</td><td>$broj_neuspjesnih_prijava</td><td>$uvjeti_koristenja</td><td>$aktivacijski_kod</td></tr>\n";
}

$tablica.= "</table>\n";

$rezultat->close();
$baza->zatvoriDB();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Statistika odabranog korisnika</title>
    <meta charset="utf-8">
    <meta name="author" content="Ana Horvat">
    <meta name="keywords" content="FOI, WebDiP,Projekt 2021./2022., Benzinska postaja">
    <link rel="stylesheet" href="./css/ahorvat3.css" type="text/css" media="screen">
    <link rel="stylesheet" href="./css/print.css" type="text/css" media="print">
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

    <h2>Popis svih korisnika računa</h2>
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