<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();
$ispisGreski="";

$baza = new Baza();

$upit = "SELECT id_korisnika, ime, prezime, korisnicko_ime FROM korisnik where id_uloge=3";
$baza->spojiDB();
$rezultat = $baza->selectDB($upit);

if($baza->pogreskaDB()){
    echo "Problem kod upita na bazu podatka!";
    exit;
}

$tablica = "<table style='width:40%'><tr><th>ID korisnika</th><th>Ime</th><th>Prezime</th><th>Korisničko ime</th></tr>\n";

while (list($id_korisnika,$ime,$prezime,$korisnicko_ime) = $rezultat->fetch_array()){
    $tablica.= "<tr><td>$id_korisnika</td><td>$ime</td><td>$prezime</td><td>$korisnicko_ime</td></tr>\n";
}

$tablica.= "</table>\n";

$rezultat->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $umoderator = filter_input(INPUT_POST, 'idNovogModeratora');
    $upit = "UPDATE korisnik SET id_uloge=2 WHERE id_korisnika='$umoderator'";
    $baza->selectDB($upit);
    $ispisGreski="Uloga moderatora uspješno dodana!";
}

$korisnik=$_SESSION['idKorisnika'];
$zapis="Kreiran je moderator";
$trenutnoVrijeme=date("Y-m-d H:i:s");
$upit = "INSERT INTO dnevnik (id_zapisa, tip_zapisa, zapis, vrijeme, id_korisnika) VALUES (default,'Ostale radnje','$zapis','$trenutnoVrijeme','$korisnik')";
$baza->selectDB($upit);

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

    <br>

    <form method="post">
        <label for="idNovogModeratora">Unesite ID korisnika kojeg želite promovirati u moderatora: </label>
        <input type="number" name="idNovogModeratora" value="idNovogModeratora">
        <input type="submit" value="Stvori moderatora">
    </form>

    <div id="greske">
        <div id="phpGreske">
            <div class="zadnji">  
                <?php
                echo $ispisGreski;
                ?>
            </div>            
        </div>
    </div>

    <h2>Popis registriranih korisnika</h2>
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