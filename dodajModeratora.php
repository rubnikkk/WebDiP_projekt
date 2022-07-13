<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();
$ispisGreski="";
$id_benzinske = htmlspecialchars($_GET['id']);

$baza = new Baza();
$baza->spojiDB();

$upit = "SELECT id_korisnika, ime, prezime FROM korisnik WHERE id_uloge=2";

$rezultat = $baza->selectDB($upit);

$tablica = "<table style='width:30%'><tr><th>ID korisnika</th><th>Ime</th><th>Prezime</th></tr>\n";

while (list($id_korisnika,$ime,$prezime) = $rezultat->fetch_array()){
    $tablica.= "<tr><td>$id_korisnika</td><td>$ime</td><td>$prezime</td></tr>\n";
}

$tablica.= "</table>\n";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_moderatora = filter_input(INPUT_POST, 'idModeratora');
    $upit = "UPDATE benzinska_postaja SET moderator='$id_moderatora' WHERE id_benzinske_postaje='$id_benzinske'";
    $baza->selectDB($upit);
    $ispisGreski = "Moderator uspješno dodan!";
}

$baza->zatvoriDB();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Statistika odabranog korisnika</title>
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

    <h2>Popis moderatora</h2>
        <?php
            echo $tablica;
        ?>

    <br>
    <form method="post">
        <label for="idModeratora">ID moderatora:</label>
        <input type="text" id="idModeratora" name="idModeratora" placeholder="Upišite ID moderatora">
        <input type="submit" value="Pridruži moderatora">
        <label for="idBenzinske"> benzinskoj postaji <?php echo $id_benzinske?></label>
    </form>

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