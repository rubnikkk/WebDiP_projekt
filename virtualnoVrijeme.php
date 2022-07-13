<?php
require("./class/funkcijeBaze.php");

$json_file = file_get_contents('http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=json');
$jfo = json_decode($json_file, true);
$pomak = $jfo['WebDiP']['vrijeme']['pomak']['brojSati'];
echo $pomak;
$trenutno_vrijeme = date("Y-m-d H:i:s");

$upit = "UPDATE vvrijeme set pomak='".$pomak."', trenutno='".$trenutno_vrijeme."' WHERE id_vvrijeme=1;";
unosUpdate($upit);

$obavijest = "U roku od 2 sekunde bit ćete preusmjereni na početnu stranicu administratora.<br>";
echo $obavijest;
header("Location: izbornik.php");
?>