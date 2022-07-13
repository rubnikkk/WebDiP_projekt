<?php
if (!isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off') {
        $https_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header("Location: $https_url");
        exit();
}

$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/funkcijeBaze.php");

$brojacGreski = 0;
$ispisGreski = "";

$korime = filter_input(INPUT_POST, 'korime');
$lozinka = filter_input(INPUT_POST, 'lozinka');

session_start();

if(isset($_SESSION['korisnik'])){
        header("Location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($korime) || empty($lozinka)) {
        $ispisGreski .= "Niste popunili polja!<br>";
        $brojacGreski++;
    } else {
        $upit = "SELECT * FROM korisnik WHERE korisnicko_ime='$korime'";
        if (provjeriPostojiRedak($upit)) {
            $vraceniRedak = dohvatiRedakKaoPolje($upit);
            if ($vraceniRedak['lozinka'] == $lozinka) {
                if ($vraceniRedak['status'] == 1) {
                    if ($vraceniRedak['broj_neuspjesnih_prijava'] < 3) {
                        $ispisGreski .= "Uspješno ste se prijavili.<br>";

                        $_SESSION['korisnik'] = $korime;
                        $_SESSION['uloga'] = $vraceniRedak["id_uloge"];
                        $_SESSION['idKorisnika'] = $vraceniRedak["id_korisnika"];

                        $upit = "UPDATE korisnik SET broj_neuspjesnih_prijava=0 WHERE korisnicko_ime='$korime'";
                        unosUpdate($upit);

                        $id_korisnika= $vraceniRedak["id_korisnika"];
                        $zapis = "Prijavio se korisnik $korime";
                        $trenutnoVrijeme = date("Y-m-d H:i:s");
                        $upit = "INSERT INTO dnevnik (id_zapisa, tip_zapisa, zapis, vrijeme, id_korisnika) VALUES (default,'Prijava/odjava','$zapis','$trenutnoVrijeme','$id_korisnika')";
                        unosUpdate($upit);

                        if(!empty($_POST["remember"])) {
                            setcookie ("zapamtiMe",$_POST["korime"],time()+ (10 * 365 * 24 * 60 * 60));
                            
                        } else {
                            unset($_COOKIE['zapamtiMe']);
                            setcookie('zapamtiMe', null); 
                        }

                        if(!empty($_POST["uvjeti"])) {
                            setcookie ("uvjeti",$_POST["korime"],time()+ 3600);
                            $upit = "UPDATE korisnik SET uvjeti_koristenja=1 WHERE korisnicko_ime='$korime'";
                            unosUpdate($upit);
                        } else {
                            unset($_COOKIE['uvjeti']);
                            setcookie('uvjeti', null); 
                        }

                    } else{
                        $ispisGreski .= "GREŠKA! Korisnički račun je zaključan!<br>";
                        $upit = "UPDATE korisnik SET status=0 WHERE korisnicko_ime='$korime'";
                        unosUpdate($upit);
                        $brojacGreski++;
                    }
                } else {
                    $ispisGreski .= "GREŠKA! Korisnički račun nije aktiviran!<br>";
                    $brojacGreski++;
                }
            } else {
                $upit = "UPDATE korisnik SET broj_neuspjesnih_prijava=broj_neuspjesnih_prijava+1 WHERE korisnicko_ime='$korime'";
                unosUpdate($upit);

                $upit = "SELECT * FROM korisnik WHERE korisnicko_ime='$korime'";
                $vraceniRedak = dohvatiRedakKaoPolje($upit);

                $id_korisnika= $vraceniRedak["id_korisnika"];
                $zapis = "Neuspješna prijava $korime";
                $trenutnoVrijeme = date("Y-m-d H:i:s");

                $upit = "INSERT INTO dnevnik (id_zapisa, tip_zapisa, zapis, vrijeme, id_korisnika) VALUES (default,'Prijava/odjava','$zapis','$trenutnoVrijeme','$id_korisnika')";
                unosUpdate($upit);

                $brojNeuspjesnihPrijava = $vraceniRedak["broj_neuspjesnih_prijava"];

                $ispisGreski .= "GREŠKA! Pogrešna lozinka! Broj neuspješnih prijava: $brojNeuspjesnihPrijava<br>";

                if ($brojNeuspjesnihPrijava==3){
                    $upit = "UPDATE korisnik SET status=0 WHERE korisnicko_ime='$korime'";
                    unosUpdate($upit);
                    $ispisGreski .= "GREŠKA! Korisnički račun je zaključan!<br>";
                }
                $brojacGreski++;
            }
        } else {
            $ispisGreski .= "GREŠKA! Nepostojeće korisničko ime!<br>";
            $brojacGreski++;
        }
    }
}
?>

<!DOCTYPE>
<html>

<head>
    <title>Prijava</title>
    <meta charset="utf-8">
    <meta name="author" content="Ana Horvat">
    <meta name="keywords" content="FOI, WebDiP,Projekt 2021./2022., Benzinska postaja">
    <link rel="stylesheet" href="./css/ahorvat3.css" type="text/css">
    <meta name="description" content="Projekt benzinska postaja">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
            <li class="desno"><a class="trenutna" href="./prijava.php">Prijava</a></li>
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
        <form id="formaPrijava" method="post">
            <div id="sadrzajForme">
                <h2>Obrazac za prijavu</h2>

                <label for="korime">Korisničko ime:</label>
                <br>
                
                <input type="text" name="korime" value="<?php if (isset($_COOKIE["zapamtiMe"])) echo $_COOKIE["zapamtiMe"]; ?>"/>
                <br><br>

                <label for="lozinka">Lozinka:</label>
                <br>
                <input type="password" name="lozinka"/>
                <br><br>
                
                <input type="checkbox" name="uvjeti" id="uvjeti" <?php if(isset($_COOKIE["uvjeti"])) { ?> hidden <?php } ?> />
                <label for="uvjeti">Uvjeti korištenja</label>
                <br><br>
            
                <input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["zapamtiMe"])) { ?> checked <?php } ?> />
                <label for="remember">Zapamti me</label>               

                <br><br>
                <input type="submit" value="Prijavi se">
                <br><br>

                <a href="zaboravljenaLozinka.php">Zaboravljena lozinka</a>

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