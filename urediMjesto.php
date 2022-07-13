<?php
session_start();

require("./class/funkcijeBaze.php");

$id_zaduzene = $_SESSION['zaduzena'];

$id_mjesta = htmlspecialchars($_GET['id']);
$gorivo = htmlspecialchars($_GET['gorivo']);

$adresa = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$ispisGreski = "";

$status = filter_input(INPUT_POST, 'status');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $upit = "UPDATE mjesto_na_benzinskoj SET status_mjesta='$status' WHERE id_mjesta='$id_mjesta'";
    unosUpdate($upit);
    $ispisGreski .= "Mjesto je uređeno!<br>";
}
?>

<html>

<head>
    <title>Kreiranje mjesta na benzinskoj</title>
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
    <a href="pregledSvihMjesta.php">Natrag na pregled svih mjesta</a>

    <section class="centar">
        <div id="sadrzaj">
            <h1>Uređivanje mjesta na benzinskoj</h1>
            <form id="formaKreiranjeLokacije" method="post">
                <div id="sadrzajForme">
                    <h2>Obrazac za uređivanje mjesta</h2>

                    <label for="benzinska">ID benzinske:</label>
                    <input type="number" id="benzinska" name="benzinska" placeholder="ID benzinske" value="<?php echo $id_mjesta?>" disabled>
                    <br>

                    <label for="benzinska">ID benzinske:</label>
                    <input type="number" id="benzinska" name="benzinska" placeholder="ID benzinske" value="<?php echo $id_zaduzene?>" disabled>
                    <br>

                    <label for="gorivo">Vrsta goriva:</label>
                    <input type="text" id="gorivo" name="gorivo" placeholder="Gorivo" value="<?php echo $gorivo?>" disabled>
                    <br>

                    <label for="status">Status:</label>
                    <input type="text" id="status" name="status" placeholder="Status">
                    <h5>Status: zatvorena, otvorena, u kvaru, čeka naplatu</h5>
                    <br>

                    <br>
                    <input type="submit" value="Uredi mjesto">
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
        <a href="https://validator.w3.org/check?uri=<?php echo $adresa ?>" target="_blank"><img class="validacija" src="./materijali/HTML5.png" alt="HTML5 validacija"></a>
        <a href="https://jigsaw.w3.org/css-validator/validator?uri=<?php echo $adresa ?>" target="_blank"> <img class="validacija" src="./materijali/CSS3.png" alt="CSS3 validacija"></a>
        <address>
            <a href="mailto:ahorvat3@foi.hr">Kontakt: pošalji mali</a>
        </address>
        <a>&copy; 2022 Ana Horvat</a>
    </footer>
</body>

</html>