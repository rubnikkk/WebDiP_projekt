<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();
$ispisGreski = "";
$id_vozila = htmlspecialchars($_GET['id']);
$id_korisnik = htmlspecialchars($_GET['korisnik']);

$baza = new Baza();
$baza->spojiDB();

$upit="SELECT * FROM vozilo WHERE korisnik='$id_korisnik' AND id_vozila='$id_vozila'";
$rez=$baza->selectDB($upit);
list($id_vozila,$korisnik,$marka,$vrsta,$potrosnja,$registracija,$brojac) = $rez->fetch_array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $umarka = filter_input(INPUT_POST, 'marka');
    $uvrsta = filter_input(INPUT_POST, 'vrsta');
    $upotrosnja = filter_input(INPUT_POST, 'potrosnja');
    $uregistracija = filter_input(INPUT_POST, 'registracija');
    $ubrojac = filter_input(INPUT_POST, 'brojac');

    $upit = "UPDATE vozilo SET marka='$umarka' WHERE id_vozila = '$id_vozila'";
    $rezultat = $baza->selectDB($upit);

    $upit = "UPDATE vozilo SET vrsta='$uvrsta' WHERE id_vozila = '$id_vozila'";
    $rezultat = $baza->selectDB($upit);

    $upit = "UPDATE vozilo SET potrosnja='$upotrosnja' WHERE id_vozila = '$id_vozila'";
    $rezultat = $baza->selectDB($upit);

    $upit = "UPDATE vozilo SET registracija='$uregistracija' WHERE id_vozila = '$id_vozila'";
    $rezultat = $baza->selectDB($upit);

    $upit = "UPDATE vozilo SET brojac='$ubrojac' WHERE id_vozila = '$id_vozila'";
    $rezultat = $baza->selectDB($upit);

    $ispisGreski = "Vozilo je uređeno!";
}

$baza->zatvoriDB();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Uređivanje vozila</title>
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
    <a href="popisVozila.php">Natrag na popis vozila</a>

    <section class="centar">
        <div id="sadrzaj">
            <h1>Uređivanje vozila</h1>
            <form id="formaKreiranjeLokacije" method="post">
                <div id="sadrzajForme">
                    <h2>Obrazac za uređivanje vozila</h2>

                    <label for="idVozila">ID vozila:</label>
                    <input type="text" value="<?php echo $id_vozila?>" disabled>
                    <br>

                    <label for="idKorisnika">ID korisnika:</label>
                    <input type="text" value="<?php echo $id_korisnik?>" disabled>
                    <br>

                    <label for="marka">Marka vozila:</label>
                    <input type="text" id="marka" name="marka" placeholder="Marka" autofocus="autofocus" value="<?php echo $marka?>">
                    <br>

                    <label for="vrsta">Vrsta vozila:</label>
                    <input type="text" id="vrsta" name="vrsta" placeholder="Vrsta" value="<?php echo $vrsta?>">
                    <br>

                    <label for="potrosnja">Potrošnja:</label>
                    <input type="text" id="potrosnja" name="potrosnja" placeholder="Potrošnja" value="<?php echo $potrosnja?>">
                    <br>

                    <label for="registracija">Registracija:</label>
                    <input type="text" id="registracija" name="registracija" placeholder="Registracija" value="<?php echo $registracija?>">
                    <br>

                    <label for="brojac">Brojač:</label>
                    <input type="text" id="brojac" name="brojac" placeholder="Brojač" value="<?php echo $brojac?>">
                    <br>

                    <br>
                    <input type="submit" value="Ažuriraj vozilo">
                    <br>

                </div>
            </form>
        </div>        
    </section>

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