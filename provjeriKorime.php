<?php
    require("./class/funkcijeBaze.php");
    if(isset($_POST['korime'])){
        $korime = $_POST['korime'];
        $upit = "SELECT * FROM korisnik WHERE korisnicko_ime = '$korime'";
        $red = dohvatiRedakKaoPolje($upit);

        if($red){
            $poruka = "<span class='exists'>Korisničko ime je zauzeto!</span>";
        } else {
            $poruka = "<span class='not-exists'>Korisničko ime nije zauzeto!</span>";
        }        
    }
    echo $poruka;
    die;
?>