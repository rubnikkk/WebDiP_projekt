<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();

$datumOd = filter_input(INPUT_POST, 'datumOd');
$datumDo = filter_input(INPUT_POST, 'datumDo');

$id_benzinske = htmlspecialchars($_GET['id']);

$tablica = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $baza = new Baza();
    $upit = "SELECT * FROM gorivo_na_benzinskoj WHERE datum>='$datumOd' AND datum<='$datumDo' AND id_benzinske='$id_benzinske'";
    $baza->spojiDB();
    $rezultat = $baza->selectDB($upit);

    if($baza->pogreskaDB()){
        echo "Problem kod upita na bazu podatka!";
        exit;
    }

    $tablica = "<table style='width:65%'><tr><th>ID zapisa</th><th>ID benzinske</th><th>Naziv goriva</th><th>Cijena</th><th>Količina</th><th>Status</th><th>Datum</th></tr>\n";

    while (list($id_zapisa,$id_benzinske,$id_goriva,$cijena,$kolicina,$status,$datum) = $rezultat->fetch_array()){
        $upit = "SELECT naziv_vrste_goriva from vrsta_goriva WHERE id_vrste_goriva='$id_goriva'";
        $rez = $baza->selectDB($upit);
        $naziv = ($rez->fetch_row())[0];

        $tablica.= "<tr><td>$id_zapisa</td><td>$id_benzinske</td><td>$naziv</td><td>$cijena</td><td>$kolicina</td><td>$status</td><td>$datum</td></tr>\n";
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

    <section>
        <form method="post">
            <h4>Odaberite datum za prikaz cijena</h4>
            <label for="datumOd">Od:</label>
            <input type="date" id="datumOd" name="datumOd">

            <label for="datumDo">Do:</label>
            <input type="date" id="datumDo" name="datumDo">

            <input type="submit" id="prikaziCijene" name="prikaziCijene" value="Prikaži cijene">
        </form>        
    </section>

    <h2>Cijene goriva</h2>
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