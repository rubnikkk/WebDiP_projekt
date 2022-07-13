<?php
$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

require("./class/baza.class.php");

session_start();
$ispisGreski = "";

$id_goriva = htmlspecialchars($_GET['id']);
$id_postaje=$_SESSION['zaduzena'];

$baza = new Baza();
$baza->spojiDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ucijena = filter_input(INPUT_POST, 'cijena');
    $ukolicina = filter_input(INPUT_POST, 'kolicina');

        $upit = "UPDATE gorivo_na_benzinskoj SET cijena='$ucijena' WHERE id_goriva = '$id_goriva' AND id_benzinske='$id_postaje'";
        $baza->selectDB($upit);

        $upit = "UPDATE gorivo_na_benzinskoj SET kolicina='$ukolicina' WHERE id_goriva = '$id_goriva' AND id_benzinske='$id_postaje'";
        $baza->selectDB($upit);

    if($ukolicina>0){
        $upit = "UPDATE gorivo_na_benzinskoj SET status='na raspolaganju' WHERE id_goriva = '$id_goriva' AND id_benzinske='$id_postaje'";
        $baza->selectDB($upit);
    } else if ($kuolicina==0){
        $upit = "UPDATE gorivo_na_benzinskoj SET status='nije na raspolaganju' WHERE id_goriva = '$id_goriva' AND id_benzinske='$id_postaje'";
        $baza->selectDB($upit);
    }
    $ispisGreski = "Vrsta goriva je uređena!";
}

$baza->zatvoriDB();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Uređivanje benzinske</title>
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
    <a href="pregledVrstaModerator.php">Natrag na pregled vrsta na benzinskoj</a>

    <section id="sadrzaj">
        <form id="formaGorivo" method="post">
            <div id="sadrzajForme">
                <h2>Obrazac za ažuriranje goriva</h2>

                <label for="id_benzinske">ID benzinske:</label>
                <br>                
                <input type="text" name="id_benzinske" value="<?php echo $id_postaje?>" disabled/>
                <br><br>

                <label for="id_goriva">ID goriva:</label>
                <br>                
                <input type="text" name="id_goriva" value="<?php echo $id_goriva?>" disabled/>
                <br><br>
                
                <label for="cijena">Cijena:</label>
                <br>                
                <input type="number" name="cijena" id="cijena"/>
                <br><br>

                <label for="cijena">Količina:</label>
                <br>                
                <input type="number" name="kolicina" id="kolicina"/>
                <br><br>

                <br><br>
                <input type="submit" value="Ažuriraj gorivo">
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