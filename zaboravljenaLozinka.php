<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/funkcijeBaze.php");
$brojacGreski = 0;
$ispisGreski = "";
$email = filter_input(INPUT_POST, 'email');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($email)) {
        $ispisGreski .= "GREŠKA! Niste unijeli e-mail adresu!</br>";
        $brojacGreski++;
    } else {
        $upit = "SELECT * FROM korisnik WHERE email='$email'";
        if (provjeriPostojiRedak($upit)) {

            $vrijeme = date("Y-m-d H:i:s");
            $lozinka = $email . $vrijeme;
            $lozinka = hash('crc32', $lozinka);
            $upit = "UPDATE korisnik SET lozinka='$lozinka' WHERE email='$email'";
            unosUpdate($upit);

            $mail_to = $email;
            $mail_from = "From: ahorvat3@foi.hr";
            $mail_subject = "Benzinska postaja - nova lozinka";
            $mail_body = "Vasa nova lozinka je: " . $lozinka . "";

            $upit = "SELECT * FROM korisnik WHERE email='$email'";
            $vraceniRedak = dohvatiRedakKaoPolje($upit);

            $id_korisnika= $vraceniRedak["id_korisnika"];
            $korime = $vraceniRedak["korisnicko_ime"];
            $zapis = "Zatražena nova lozinka za $korime";
            $trenutnoVrijeme = date("Y-m-d H:i:s");

            $upit = "INSERT INTO dnevnik (id_zapisa, tip_zapisa, zapis, vrijeme, id_korisnika) VALUES (default,'Ostale radnje','$zapis','$trenutnoVrijeme','$id_korisnika')";
            unosUpdate($upit);

            if (mail($mail_to, $mail_subject, $mail_body, $mail_from)) {
                $ispisGreski .= "Poslana je nova lozinka na: '$mail_to'!</br>";
            } else {
                $ispisGreski .= "Problem kod poruke za: '$mail_to'!</br>";
            }
        } else {
            $ispisGreski .= "GREŠKA! Nepostojeća e-mail adresa!</br>";
            $brojacGreski++;
        }
    }
}
?>
<html>

<head>
    <title>Zaboravljena lozinka</title>
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

    <section id="sadrzaj">
        <form novalidate id="formaZaboravljenaLozinka" name="formaZaboravljenaLozinka" method="post">
            <div id="sadrzajForme">
                <h2>Zaboravljena lozinka</h2>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Email">
                <br>

                <input type="submit" value="Pošalji">
            </div>

            <div id="greske">
                <div id="phpGreske">
                    <?php
                    echo $ispisGreski;
                    ?>
                </div>
            </div>

        </form>
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