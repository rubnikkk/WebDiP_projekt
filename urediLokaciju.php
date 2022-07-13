<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();
$ispisGreski = "";
$id_lokacije = htmlspecialchars($_GET['id']);

$baza = new Baza();
$baza->spojiDB();


$upit = "SELECT * FROM lokacija_benzinske_postaje WHERE id_lokacije_benzinske_postaje = '$id_lokacije'";
$rezultat = $baza->selectDB($upit);

list($id_lokacije_benzinske_postaje,$mjesto,$ulica,$kucni_broj,$postanski_broj) = $rezultat->fetch_array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $umjesto = filter_input(INPUT_POST, 'mjesto');
    $uulica = filter_input(INPUT_POST, 'ulica');
    $ukucni = filter_input(INPUT_POST, 'kucniBroj');
    $upostanski = filter_input(INPUT_POST, 'postanskiBroj');

    $upit = "UPDATE lokacija_benzinske_postaje SET mjesto='$umjesto' WHERE id_lokacije_benzinske_postaje = '$id_lokacije'";
    $rezultat = $baza->selectDB($upit);

    $upit = "UPDATE lokacija_benzinske_postaje SET ulica='$uulica' WHERE id_lokacije_benzinske_postaje = '$id_lokacije'";
    $rezultat = $baza->selectDB($upit);

    $upit = "UPDATE lokacija_benzinske_postaje SET kucni_broj='$ukucni' WHERE id_lokacije_benzinske_postaje = '$id_lokacije'";
    $rezultat = $baza->selectDB($upit);

    $upit = "UPDATE lokacija_benzinske_postaje SET postanski_broj='$upostanski' WHERE id_lokacije_benzinske_postaje = '$id_lokacije'";
    $rezultat = $baza->selectDB($upit);

    $ispisGreski = "Lokacija je uređena!";
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
            <h1>Uređivanje lokacije benzinske postaje</h1>
            <form id="formaKreiranjeLokacije" method="post">
                <div id="sadrzajForme">
                    <h2>Obrazac za uređivanje lokacije</h2>

                    <label for="mjesto">Mjesto:</label>
                    <input type="text" id="mjesto" name="mjesto" placeholder="Mjesto" autofocus="autofocus" value="<?php echo $mjesto;?>">
                    <br>

                    <label for="ulica">Ulica:</label>
                    <input type="text" id="ulica" name="ulica" placeholder="Ulica" value="<?php echo $ulica;?>">
                    <br>

                    <label for="kucniBroj">Kućni broj:</label>
                    <input type="number" id="kucniBroj" name="kucniBroj" placeholder="Kućni broj" value="<?php echo $kucni_broj;?>">
                    <br>

                    <label for="postanskiBroj">Poštanski broj:</label>
                    <input type="number" id="postanskiBroj" name="postanskiBroj" placeholder="Poštanski broj" value="<?php echo $postanski_broj;?>">
                    <br>

                    <br>
                    <input type="submit" value="Uredi lokaciju">
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