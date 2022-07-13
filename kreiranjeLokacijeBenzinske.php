<?php
session_start();

require("./class/funkcijeBaze.php");
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$ispisGreski = "";

$mjesto = filter_input(INPUT_POST, 'mjesto');
$ulica = filter_input(INPUT_POST, 'ulica');
$kucniBroj = filter_input(INPUT_POST, 'kucniBroj');
$postanskiBroj = filter_input(INPUT_POST, 'postanskiBroj');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($mjesto) || empty($ulica) || empty($kucniBroj) || empty($postanskiBroj)) {
        $ispisGreski .= "Niste popunili polja!<br>";
    }
    else {
        $upit = "INSERT INTO lokacija_benzinske_postaje (id_lokacije_benzinske_postaje,mjesto,ulica,kucni_broj,postanski_broj) VALUES (default, '$mjesto', '$ulica', '$kucniBroj','$postanskiBroj');";
        unosUpdate($upit);
        $ispisGreski .= "Uspješno ste kreirali novu lokaciju!<br>";
    }

    $korisnik=$_SESSION['idKorisnika'];
    $zapis="Kreirana je lokacija benzinske";
    $trenutnoVrijeme=date("Y-m-d H:i:s");
    $upit = "INSERT INTO dnevnik (id_zapisa, tip_zapisa, zapis, vrijeme, id_korisnika) VALUES (default,'Ostale radnje','$zapis','$trenutnoVrijeme','$korisnik')";
    $baza->selectDB($upit);
}
?>

<html>

<head>
    <title>Kreiranje lokacije benzinske</title>
    <meta charset="utf-8">
    <meta name="author" content="Ana Horvat">
    <meta name="keywords" content="FOI, WebDiP,Projekt 2021./2022., Benzinska postaja">
    <link rel="stylesheet" href="./css/ahorvat3.css" type="text/css">
    <meta name="description" content="Projekt benzinska postaja">
</head>

<body>
    <header id="zaglavlje">
        <a class="naslov" href="index.php">Benzinska postaja</a>
        <br>
        <a class="opis">WebDiP projekt 2021./2022.</a>
    </header>

    <nav>
        <ul id="navigacija">
            <li class="lijevo"><a href="izbornik.php">Izbornik</a></li>
            <li class="lijevo"><a href="dokumentacija.html">Dokumentacija</a></li>
            <li class="lijevo"><a href="o_autoru.html">O autorici</a></li>
            <li class="desno"><a href="./registracija.php">Registracija</a></li>
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
            <h1>Kreiranje lokacije benzinske postaje</h1>
            <form id="formaKreiranjeLokacije" method="post">
                <div id="sadrzajForme">
                    <h2>Obrazac za kreiranje lokacije</h2>

                    <label for="mjesto">Mjesto:</label>
                    <input type="text" id="mjesto" name="mjesto" placeholder="Mjesto" autofocus="autofocus">
                    <br>

                    <label for="ulica">Ulica:</label>
                    <input type="text" id="ulica" name="ulica" placeholder="Ulica">
                    <br>

                    <label for="kucniBroj">Kućni broj:</label>
                    <input type="number" id="kucniBroj" name="kucniBroj" placeholder="Kućni broj">
                    <br>

                    <label for="postanskiBroj">Poštanski broj:</label>
                    <input type="number" id="postanskiBroj" name="postanskiBroj" placeholder="Poštanski broj">
                    <br>

                    <br>
                    <input type="submit" value="Kreiraj lokaciju">
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
        <a href=""></a>
        <a href=""></a>
        <a href="https://validator.w3.org/check?uri=<?php echo $adresa ?>" target="_blank"><img class="validacija" src="./materijali/HTML5.png" alt="HTML5 validacija"></a>
        <a href="https://jigsaw.w3.org/css-validator/validator?uri=<?php echo $adresa ?>" target="_blank"> <img class="validacija" src="./materijali/CSS3.png" alt="CSS3 validacija"></a>
        <address>
            <a href="mailto:ahorvat3@foi.hr">Kontakt: pošalji mali</a>
        </address>
        <a>&copy; 2022 Ana Horvat</a>
    </footer>
</body>

</html>