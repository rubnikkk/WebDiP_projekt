<?php
    require("./class/baza.class.php");

    function provjeriPostojiRedak($upit){
        $postoji = 0;

        $baza = new Baza();
        $baza->spojiDB();

        $rezultatUpita = $baza->selectDB($upit);

        if ($baza->pogreskaDB()){
            echo "Problem kod upita na bazu!";
            exit;
        }
        if ($rezultatUpita->num_rows != 0){
            $postoji = 1;
        }

        $rezultatUpita->close();
        $baza->zatvoriDB();

        return $postoji;
    }

    function unosUpdate($upit){
        $baza = new Baza();
        $baza->spojiDB();

        $rezultatUpita = $baza->selectDB($upit);

        if($baza->pogreskaDB()){
            echo "Problem kod upita na bazu!";
            exit;
        }

        $baza->zatvoriDB();
    }

    function dohvatiRedakKaoPolje($upit){
        $baza = new Baza();
        $baza->spojiDB();

        $rezultatUpita = $baza->selectDB($upit);

        if($baza->pogreskaDB()){
            echo "Problem kod upita na bazu!";
            exit;
        }

        $redak = $rezultatUpita->fetch_array();

        $rezultatUpita->close();
        $baza->zatvoriDB();

        return $redak;
    }

    function dohvatiRetke($upit){
        $baza = new Baza();
        $baza->spojiDB();

        $rezultatUpita = $baza->selectDB($upit);

        if($baza->pogreskaDB()){
            echo "Problem kod upita na bazu!";
            exit;
        }

        while ($red = $rezultatUpita->fetch_assoc()){
            $redovi[] = $red;
        }

        $rezultatUpita->close();
        $baza->zatvoriDB();

        return $redovi;
    }

    function dohvatiPomakVirtualnogVremena(){
        $upit = "SELECT pomak FROM vvrijeme WHERE idvvrijeme=1";

        $baza = new Baza();
        $baza->spojiDB();

        $rezultatUpita = $baza->selectDB($upit);

        if($baza->pogreskaDB()){
            echo "Problem kod upita na bazu!";
            exit;
        }

        $red = $rezultatUpita->fetch_array();

        $rezultatUpita->close();
        $baza->zatvoriDB();

        return $red[0];
    }

    function virtualnoVrijeme(){
        $pomak = dohvatiPomakVirtualnogVremena();
        $virtualnoVrijeme = date("Y-m-d H:i:s", strtotime("+"."$pomak"."hours"));

        return $virtualnoVrijeme;
    }
?>