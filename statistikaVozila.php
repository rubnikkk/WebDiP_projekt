<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();

$tablica="";
$baza = new Baza();
$baza->spojiDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tablica = "<table style='width:40%'><tr><th>ID vozila</th><th>Kilometri</th><th>Datum</th></tr>\n";
    if(!empty($_POST['vozila'])){
        $id_vozila = $_POST['vozila'];
        $upit = "SELECT id_vozila, kilometri, datum FROM tocenje_goriva WHERE id_vozila='$id_vozila'";
        $rezultat = $baza->selectDB($upit);
        while (list($id_vozila,$kilometri,$datum) = $rezultat->fetch_array()){
            $tablica.= "<tr><td>$id_vozila</td><td>$kilometri</td><td>$datum</td></tr>\n";
        }
    }
    $tablica.= "</table>\n";
}

$baza->zatvoriDB();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Statistika prema vozilu</title>
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
    
    <section id="sadrzaj">
        <form id="formaGorivo" method="post">
            <div id="sadrzajForme">

                <label for="vozila">Odaberi vozilo:</label>
                <br>                

                <select name="vozila" id="vozila">
                    <?php
                        $upit = "SELECT id_vozila, registracija FROM vozilo";
                        $baza->spojiDB();
                        $rezultat = $baza->selectDB($upit);
                        while (list($id_vozila,$registracija) = $rezultat->fetch_array()){
                            echo "<option value='$id_vozila'>$registracija</option>";
                        }
                        $baza->zatvoriDB();
                    ?>
                </select>

                <br><br>
                <input type="submit" value="Prikaži pređene kilometre">
                <br><br>
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