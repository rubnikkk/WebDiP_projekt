<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/funkcijeBaze.php");

$ispisGreski = "";
$brojacGreski = 0;

$ime = filter_input(INPUT_POST, 'ime');
$prezime = filter_input(INPUT_POST, 'prezime');
$godinaRodenja = filter_input(INPUT_POST, 'godinaRodenja');
$email = filter_input(INPUT_POST, 'email');
$korime = filter_input(INPUT_POST, 'korime');
$lozinka = filter_input(INPUT_POST, 'lozinka');
$potvrdaLozinke = filter_input(INPUT_POST, 'potvrdaLozinke');
$brojTelefona = filter_input(INPUT_POST, 'brojTelefona');


session_start();

if (isset($_SESSION['korisnik'])) {
    header("Location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $brojacGreski = 0;
    foreach ($_POST as $k => $vr) {
        if (empty($vr)) {
            $brojacGreski = 1;
        }
    }
    if ($brojacGreski != 0) {
        $ispisGreski = "Poslužitelj: Niste popunili sva polja obrasca!</br>";
    } else {
        $rizraz = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u";
        if (!preg_match($rizraz, $ime)) {
            $ispisGreski .= "Poslužitelj: Ime je neispravno! </br>";
            $brojacGreski++;
        }

        $rizraz = "/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u";
        if (!preg_match($rizraz, $prezime)) {
            $ispisGreski .= "Poslužitelj: Prezime je neispravno! <br>";
            $brojacGreski++;
        }

        if ($godinaRodenja < 1960 || $godinaRodenja > 2004) {
            $ispisGreski .= "Poslužitelj: Godina nije u rasponu 1960-2004!<br>";
            $brojacGreski++;
        }

        if (!is_numeric($godinaRodenja)) {
            $ispisGreski .= "Poslužitelj: Godina nije broj!<br>";
            $brojacGreski++;
        }

        if (strlen($email) > 40) {
            $ispisGreski .= "Poslužitelj: E-mail je predugačak!<br>";
            $brojacGreski++;
        }

        if ($lozinka != $potvrdaLozinke) {
            $ispisGreski .= "Poslužitelj: Lozinke se ne podudaraju!<br>";
            $brojacGreski++;
        }

        $upit = "SELECT email FROM korisnik WHERE email='" . $email . "';";
        if (provjeriPostojiRedak($upit) == 1) {
            $ispisGreski .= "Poslužitelj: E-mail adresa je zauzeta!<br>";
            $brojacGreski++;
        }
    }

    if ($brojacGreski == 0) {

        $lozinkaKriptirana = hash('md5', $lozinka);
        $datum = date("Y-m-d H:i:s");
        $status = 0;
        $pokusaji = 0;
        $uvjeti = "prihvaćeni";
        $kod = $korime . $datum;
        $kod = hash('md5', $kod);

        $upit = "INSERT INTO korisnik VALUES(default,'3','$ime', '$prezime', '$godinaRodenja','$korime', '$lozinka', '$lozinkaKriptirana','$email','$brojTelefona','$datum','$status','$pokusaji','$uvjeti','$kod');";
        unosUpdate($upit);

        $upit = "SELECT * FROM korisnik WHERE korisnicko_ime='$korime'";
        $vraceniRedak = dohvatiRedakKaoPolje($upit);

        $id_korisnika= $vraceniRedak["id_korisnika"];
        $zapis = "Zahtjev za registraciju $korime";
        $trenutnoVrijeme = date("Y-m-d H:i:s");

        $upit = "INSERT INTO dnevnik (id_zapisa, tip_zapisa, zapis, vrijeme, id_korisnika) VALUES (default,'Rad s bazom','$zapis','$trenutnoVrijeme','$id_korisnika')";
        unosUpdate($upit);

        $ispisGreski .= "Poslužitelj: Uspješno ste podnijeli zahtjev za registraciju!<br>"; 



        $mail_to = $email;
        $mail_from = "From: ahorvat3@foi.hr";
        $mail_subject = "Benzinska postaja - aktivacija računa";
        $mail_body = "Uspjesno ste se registrirali! Aktivirajte racun na linku: https://barka.foi.hr/WebDiP/2021_projekti/WebDiP2021x037/aktivacija.php?korisnik=" . $korime . "&kod=" . $kod . "";


        if (mail($mail_to, $mail_subject, $mail_body, $mail_from)) {
            $ispisGreski .= "Poslužitelj: Poslana poruka za: '$mail_to'!<br>";
        } else {
            $ispisGreski .= "Poslužitelj: Problem kod poruke za: '$mail_to'!<br>";
        }
    }
}
?>

<!DOCTYPE>
<html>

<head>
    <title>Registracija</title>
    <meta charset="utf-8">
    <meta name="author" content="Ana Horvat">
    <meta name="keywords" content="FOI, WebDiP,Projekt 2021./2022., Benzinska postaja">
    <link rel="stylesheet" href="./css/ahorvat3.css" type="text/css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <meta name="description" content="Projekt benzinska postaja">
    <script src="https://www.google.com/recaptcha/api.js"></script>
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
            <li class="desno"><a class="trenutna" href="./registracija.php">Registracija</a></li>
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
        <form novalidate id="formaRegistracija" name="formaRegistracija" method="post">
            <div id="sadrzajForme">
                <h2>Obrazac za registraciju</h2>

                <label for="ime">Ime:</label>
                <input type="text" id="ime" name="ime" placeholder="Ime">
                <br><br>

                <label for="prezime">Prezime:</label>
                <input type="text" id="prezime" name="prezime" placeholder="Prezime">
                <br><br>

                <label for="godinaRodenja">Godina rođenja:</label>
                <input type="number" id="godinaRodenja" name="godinaRodenja" placeholder="Godina rođenja">
                <br><br>

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="johnsnow@email.com">
                <br><br>

                <label for="brojTelefona">Broj telefona:</label>
                <input type="text" id="brojTelefona" name="brojTelefona" placeholder="Broj telefona">
                <br><br>

                <label for="korime">Korisničko ime:</label>
                <input type="text" id="korime" name="korime" placeholder="Korisničko ime">
                <div id="ajaxProvjera"></div>
                <br><br>

                <label for="lozinka">Lozinka:</label>
                <input type="password" id="lozinka" name="lozinka" placeholder="Lozinka">
                <br><br>

                <label for="potvrdaLozinke">Ponovite lozinku:</label>
                <input type="password" id="potvrdaLozinke" name="potvrdaLozinke" placeholder="Potvrda lozinke">
                <br><br>

                <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>

                <br><br>

                <input type="submit" value="Registriraj se">

            </div>

            <script>
                $(document).ready(function() {
                    $('#korime').keyup(function() {
                        var korime = $(this).val().trim();
                        if(korime != ''){
                            $.ajax({
                                url: 'provjeriKorime.php',
                                type: 'post',
                                data: {korime: korime},
                                success: function(poruka){
                                    $('#ajaxProvjera').html(poruka);
                                }
                            });
                        }else{
                            $("#ajaxProvjera").html("");
                        }
                    });
                });
            </script>

            <div id="greske">
                <div id="jsGreske">
                </div>
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

    <script type="text/javascript" src="./js/registracijaValidacija.js"></script>
</body>

</html>