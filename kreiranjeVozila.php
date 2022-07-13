<?php
session_start();

require("./class/funkcijeBaze.php");
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$ispisGreski = "";

if (isset($_SESSION["idKorisnika"])) {
    $idKorisnika = $_SESSION["idKorisnika"];

    $marka = filter_input(INPUT_POST, 'marka');
    $vrsta = filter_input(INPUT_POST, 'vrsta');
    $potrosnja = filter_input(INPUT_POST, 'potrosnja');
    $reg = filter_input(INPUT_POST, 'registracija');
    $broj = filter_input(INPUT_POST, 'brojac');


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($marka) || empty($vrsta) || empty($potrosnja)) {
            $ispisGreski .= "Niste popunili polja!<br>";
        } else {
            $upit = "INSERT INTO vozilo (id_vozila,korisnik,marka,vrsta,potrosnja,registracija,brojac) VALUES (default, '$idKorisnika','$marka', '$vrsta','$potrosnja','$reg','$broj');";
            unosUpdate($upit);
            $ispisGreski .= "Uspješno ste kreirali novo vozilo!<br>";
        }
    }

    $zapis="Kreirano je vozilo";
    $trenutnoVrijeme=date("Y-m-d H:i:s");
    $upit = "INSERT INTO dnevnik (id_zapisa, tip_zapisa, zapis, vrijeme, id_korisnika) VALUES (default,'Ostale radnje','$zapis','$trenutnoVrijeme','$idKorisnika')";
    $baza->selectDB($upit);
}

?>

<html>

<head>
    <title>Kreiranje vozila</title>
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

    <br>
    <a href="popisVozila.php">Popis vozila</a>

    <section class="centar">
        <div id="sadrzaj">
            <h1>Kreiranje vozila</h1>
            <form id="formaKreiranjeVozila" method="post">
                <div id="sadrzajForme">
                    <h2>Obrazac za kreiranje vozila</h2>

                    <label for="marka">Marka vozila:</label>
                    <input type="text" id="marka" name="marka" placeholder="Marka" autofocus="autofocus">
                    <br>

                    <label for="vrsta">Vrsta vozila:</label>
                    <input type="text" id="vrsta" name="vrsta" placeholder="Vrsta">
                    <br>

                    <label for="potrosnja">Potrošnja:</label>
                    <input type="text" id="potrosnja" name="potrosnja" placeholder="Potrošnja">
                    <br>

                    <label for="registracija">Registracija:</label>
                    <input type="text" id="registracija" name="registracija" placeholder="Registracija">
                    <br>

                    <label for="brojac">Brojač:</label>
                    <input type="text" id="brojac" name="brojac" placeholder="Brojač">
                    <br>

                    <br>
                    <input type="submit" value="Kreiraj vozilo">
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