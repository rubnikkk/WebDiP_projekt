<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();
$ispisGreski = "";
$id_vrste = htmlspecialchars($_GET['id']);

$baza = new Baza();
$baza->spojiDB();


$upit = "SELECT * FROM vrsta_goriva WHERE id_vrste_goriva = '$id_vrste'";
$rezultat = $baza->selectDB($upit);

list($id_vrste_goriva,$naziv_vrste_goriva,$dobavljac) = $rezultat->fetch_array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unaziv = filter_input(INPUT_POST, 'nazivVrste');
    $udobavljac = filter_input(INPUT_POST, 'dobavljac');

    $upit = "UPDATE vrsta_goriva SET naziv_vrste_goriva='$unaziv' WHERE id_vrste_goriva = '$id_vrste'";
    $rezultat = $baza->selectDB($upit);

    $upit = "UPDATE vrsta_goriva SET dobavljac='$udobavljac' WHERE id_vrste_goriva = '$id_vrste'";
    $rezultat = $baza->selectDB($upit);

    $ispisGreski = "Vrsta goriva je uređena!";
}

$baza->zatvoriDB();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Uređivanje lokacije</title>
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

    <section class="centar">
        <div id="sadrzaj">
            <h1>Uređivanje vrste goriva</h1>
            <form id="formaKreiranjeVrsteGoriva" method="post">
                <div id="sadrzajForme">
                    <h2>Obrazac za uređivanje vrste goriva</h2>

                    <label for="nazivVrste">Naziv goriva:</label>
                    <input type="text" id="nazivVrste" name="nazivVrste" placeholder="Naziv" autofocus="autofocus" value="<?php echo $naziv_vrste_goriva;?>">
                    <br>

                    <label for="dobavljac">Dobavljač:</label>
                    <input type="text" id="dobavljac" name="dobavljac" placeholder="Dobavljač" value="<?php echo $dobavljac;?>">
                    <br>

                    <br>
                    <input type="submit" value="Uredi vrstu goriva">
                    <br>

                </div>

                <div id="greske">
                    <div id="phpGreske">
                        <?php
                        echo $ispisGreski;
                        ?>
                    </div>
                </div>
            </form>
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