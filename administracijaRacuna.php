<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();

$ispisGreski="";

$baza = new Baza();
$upit = "SELECT id_korisnika, id_uloge, ime, prezime, lozinka FROM korisnik WHERE status = 0";
$baza->spojiDB();
$rezultat = $baza->selectDB($upit);

if($baza->pogreskaDB()){
    echo "Problem kod upita na bazu podatka!";
    exit;
}

$tablica = "<table><tr><th>ID korisnika</th><th>Uloga</th><th>Ime</th><th>Prezime</th><th>Lozinka</th></tr>\n";

while (list($id_korisnika,$id_uloge,$ime,$prezime,$lozinka) = $rezultat->fetch_array()){
    switch($id_uloge){
        case 1:
            $id_uloge = "Administrator";
            break;
        case 2:
            $id_uloge = "Moderator";
            break;
        case 3:
            $id_uloge = "Registrirani korisnik";
            break;
        case 4:
            $id_uloge = "Neregistrirani korisnik";
            break;
    }
    $tablica.= "<tr><td>$id_korisnika</td><td>$id_uloge</td><td>$ime</td><td>$prezime</td><td>$lozinka</td></tr>\n";
}

$tablica.= "</table>\n";

$rezultat->close();

$upit = "SELECT id_korisnika, id_uloge, ime, prezime, lozinka FROM korisnik WHERE status = 1";
$baza->spojiDB();
$rezultat = $baza->selectDB($upit);

if($baza->pogreskaDB()){
    echo "Problem kod upita na bazu podatka!";
    exit;
}

$rezultat->close();

$id = filter_input(INPUT_POST, 'id');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($id)) {
        $ispisGreski .= "Niste popunili polje!<br>";
    } else {
        $upit = "UPDATE korisnik SET korisnik.status=1 WHERE id_korisnika=$id";
        $baza->selectDB($upit);
        $ispisGreski .="Račun je otključan!";
    }
}

$baza->zatvoriDB();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Administracija računa</title>
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

    <h2>Popis zaključanih računa</h2>
    <?php
        echo $tablica;
    ?>

    <br><br>
  
    <form name="formOtkljucaj" method="post">
        <label for="id">Upišite ID korisnika kojeg želite otključati:</label>
        <input type="number" name="id" id="id">
        <input type="submit" value="Otključaj račun">
    </form>

    <br><br>

    <div id="greske">
        <div id="phpGreske">
            <div class="zadnji">  
                <?php
                echo $ispisGreski;
                ?>
            </div>            
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