<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();
$ispisGreski = "";
$tablica="";

$baza = new Baza();
$baza->spojiDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tablica = "<table style='width:50%'><tr><th>ID korisnika</th><th>ID vozila</th><th>ID mjesta</th><th>Količina</th><th>Kilometri</th><th>Datum</th></tr>\n";
    if(!empty($_POST['korisnici'])){
        $id_korisnika = $_POST['korisnici'];
        $upit = "SELECT * FROM tocenje_goriva WHERE id_korisnika='$id_korisnika'";
        $rezultat = $baza->selectDB($upit);
        while (list($id_korisnika,$id_vozila,$id_mjesta_na_benzinskoj,$kolicina,$kilometri,$datum) = $rezultat->fetch_array()){
            $tablica.= "<tr><td>$id_korisnika</td><td>$id_vozila</td><td>$id_mjesta_na_benzinskoj</td><td>$kolicina</td><td>$kilometri</td><td>$datum</td></tr>\n";
        }
    }
    $tablica.= "</table>\n";
}

$baza->zatvoriDB();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Statistika prema korisniku</title>
    <meta charset="utf-8">
    <meta name="author" content="Ana Horvat">
    <meta name="keywords" content="FOI, WebDiP,Projekt 2021./2022., Benzinska postaja">
    <link rel="stylesheet" href="./css/ahorvat3.css" type="text/css" media="screen">
    <link rel="stylesheet" href="./css/print.css" type="text/css" media="print">
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
    <a href="cijelaEvidencija.php">Prikaži cijelu evidenciju točenja</a>

    <section id="sadrzaj">
        <form id="formaGorivo" method="post">
            <div id="sadrzajForme">

                <label for="korisnici">Odaberi korisnika:</label>
                <br>                

                <select name="korisnici" id="korisnici">
                    <?php
                        $upit = "SELECT id_korisnika, ime, prezime, korisnicko_ime FROM korisnik";
                        $baza->spojiDB();
                        $rezultat = $baza->selectDB($upit);
                        while (list($id_korisnika,$ime,$prezime,$korime) = $rezultat->fetch_array()){
                            echo "<option value='$id_korisnika'>$ime $prezime ($korime)</option>";
                        }
                        $baza->zatvoriDB();
                    ?>
                </select>

                <br><br>
                <input type="submit" value="Prikaži evidenciju točenja">
                <br><br>
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

    <div class="zadnji">
        <?php
            echo $tablica;
        ?>
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