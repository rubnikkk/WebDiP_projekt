<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();

$datumOd = filter_input(INPUT_POST, 'datumOd');
$datumDo = filter_input(INPUT_POST, 'datumDo');

$tablica = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baza = new Baza();
    $upit = "SELECT * FROM dnevnik WHERE vrijeme>='$datumOd' AND vrijeme<='$datumDo'";
    $baza->spojiDB();
    $rezultat = $baza->selectDB($upit);

    if($baza->pogreskaDB()){
        echo "Problem kod upita na bazu podatka!";
        exit;
    }

    $tablica = "<table style='width:65%'><tr><th>ID zapisa</th><th>Tip zapisa</th><th>Zapis</th><th>Vrijeme</th><th>ID korisnika</th></tr>\n";

    while (list($id_zapisa,$tip_zapisa,$zapis,$vrijeme,$id_korisnika) = $rezultat->fetch_array()){
        $tablica.= "<tr><td>$id_zapisa</td><td>$tip_zapisa</td><td>$zapis</td><td>$vrijeme</td><td><a href='statistikaJednogKorisnika.php?id=$id_korisnika'>$id_korisnika</a></td></tr>\n";
    }

    $tablica.= "</table>\n";

    $rezultat->close();

    $baza->zatvoriDB();
} else {
    
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Zapisi iz dnevnika</title>
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

    <section>
        <form method="post">
            <h4>Odaberite datum za prikaz korisnika</h4>
            <label for="datumOd">Od:</label>
            <input type="date" id="datumOd" name="datumOd">

            <label for="datumDo">Do:</label>
            <input type="date" id="datumDo" name="datumDo">

            <input type="submit" id="prikaziKorisnike" name="prikaziKorisnike" value="Prikaži korisnike">
        </form>        
    </section>

    <h2>Kronologija rada svih korisnika</h2>
    <div class="zadnji">
        <?php
            echo $tablica;
        ?>
    </div>

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