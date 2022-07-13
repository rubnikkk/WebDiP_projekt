<?php
session_start();

require("./class/funkcijeBaze.php");

$korime = $_SESSION['korisnik'];

$upit = "SELECT * FROM korisnik WHERE korisnicko_ime='$korime'";
$vraceniRedak = dohvatiRedakKaoPolje($upit);
$id_korisnika= $vraceniRedak["id_korisnika"];

$zapis = "Odjavio se korisnik $korime";
$trenutnoVrijeme = date("Y-m-d H:i:s");
$upit = "INSERT INTO dnevnik (id_zapisa, tip_zapisa, zapis, vrijeme, id_korisnika) VALUES (default,'Prijava/odjava','$zapis','$trenutnoVrijeme','$id_korisnika')";
unosUpdate($upit);

if (session_id() != "") {
    session_unset();
    session_destroy();
}
header('Location: prijava.php');
