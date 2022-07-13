<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();
$ispisGreski = "";

$id_mjesta = htmlspecialchars($_GET['idMjesta']);
$korisnik = $_SESSION['idKorisnika'];

$baza = new Baza();
$baza->spojiDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ukilometri = filter_input(INPUT_POST, 'kilometri');
    $upotroseno = filter_input(INPUT_POST, 'potroseno');
    $unatoceno = filter_input(INPUT_POST, 'natoceno');
    $datum = date("Y-m-d");

    if(!empty($_POST['vozila'])){
        $id_vozila = $_POST['vozila'];
        $upit = "INSERT INTO tocenje_goriva VALUES('$korisnik','$id_vozila','$id_mjesta','$unatoceno','$ukilometri','$datum')";
        $baza->selectDB($upit);

        $upit="SELECT benzinska_postaja FROM mjesto_na_benzinskoj WHERE id_mjesta='$id_mjesta'";
        $rez=$baza->selectDB($upit);
        $id_benzinske=($rez->fetch_row())[0];

        $upit = "UPDATE gorivo_na_benzinskoj SET kolicina=kolicina-'$unatoceno' WHERE id_benzinske='$id_benzinske'";
        $baza->selectDB($upit);

        $upit = "UPDATE mjesto_na_benzinskoj SET status_mjesta='čeka naplatu' WHERE id_mjesta='$id_mjesta'";
        $baza->selectDB($upit);
        
        $upit="UPDATE benzinska_postaja SET ukupno_natoceno=ukupno_natoceno+'$unatoceno' WHERE id_benzinske_postaje='$id_benzinske'";
        $baza->selectDB($upit);

        $zapis="Evidentirano je točenje goriva";
        $trenutnoVrijeme=date("Y-m-d H:i:s");
        $upit = "INSERT INTO dnevnik (id_zapisa, tip_zapisa, zapis, vrijeme, id_korisnika) VALUES (default,'Ostale radnje','$zapis','$trenutnoVrijeme','$korisnik')";
        $baza->selectDB($upit);

        $ispisGreski="Točenje je evidentirano!";
    }
}

$baza->zatvoriDB();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Evidencija točenja</title>
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



    <section id="sadrzaj">
        <form id="formaGorivo" method="post">
            <div id="sadrzajForme">
                <h2>Obrazac za evidenciju točenja</h2>

                <label for="id_vozila">Vozilo:</label>
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
                <label for="id_mjesta">ID mjesta:</label>
                <br>                
                <input type="number" name="id_mjesta" id="id_mjesta" value="<?php echo $id_mjesta?>" disabled/>
                <br><br>
                
                <label for="kilometri">Prijeđeni kilometri:</label>
                <br>                
                <input type="number" name="kilometri" id="kilometri"/>
                <br><br>

                <label for="potroseno">Potrošeno goriva:</label>
                <br>                
                <input type="number" name="potroseno" id="potroseno"/>
                <br><br>

                <label for="natoceno">Količina natočenog:</label>
                <br>                
                <input type="number" name="natoceno" id="natoceno"/>
                <br><br>

                <br><br>
                <input type="submit" value="Evidentiraj točenje">
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