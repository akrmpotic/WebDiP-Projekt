<?php

include('sesija.class.php');
include('baza.class.php');
include('pomocneFunkcije.php');


$value = "Prihvaćeni uvjeti korištenja";
if (!isset($_COOKIE["Uvjeti_Koristenja"])) {
    setcookie("Uvjeti_Koristenja", $value, time() + (3600 * 24 * 2));
    ispisiAlert("Korištenjem ove stranice prihvaćate spremanje kolačića za poboljšanje iskustva.");
}

if (!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on") {

    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);

    exit;
}

error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
?>

<html>
<head>
    <title>WebDiP2019x070</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="naslov" content="Index stranica">
    <meta name="autor" content="Andrija Krmpotić">

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/akrmpotic.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <link rel="stylesheet" type="text/css" href="css/navigation.css">
    <link rel="stylesheet" type="text/css" href="css/background.css">
    <link rel="stylesheet" type="text/css" href="css/section.css">
</head>
<body>
<header>
    <nav id="nav_neregistrirani" class="navcontainer">
        <ul>
            <?php
            $tipKorisnika = Sesija::dajTipKorisnika();
            if(Sesija::dajTipKorisnika()){
                $tipKorisnika = Sesija::dajTipKorisnika(); // Sesija::dajTipKorisnika();
            }else{
                $tipKorisnika = "korisnik";
            }


            ispisiNavigaciju($tipKorisnika);
            ?>
        </ul>
    </nav>
</header>

<?php

function ispisiNavigaciju($tipKorisnika)
{
    echo "<li><a href ='index.php'>Početna</a></li>
          <li><a href ='popis_plesneSkole.php'>Popis škola</a></li>
          <li><a href ='popis_mentori.php'>Mentori</a></li>";
    if ($tipKorisnika == "korisnik") {
        echo "
            <li><a href ='prijava.php'>Prijava</a></li>
            <li><a href ='registracija.php'>Registracija</a></li>";
    }elseif ($tipKorisnika == "registrirani_korisnik"){
        echo "<li><a href ='slobodniMentori.php'>Slobodni mentori</a></li>
              <li><a href ='popisTermin.php'>Termini</a></li>
              <li><a href ='zahtjevZaIspit.php'>Zahtjev ispita</a></li>
              <li><a href ='odjava.php'>Odjava</a></li>";
    }elseif($tipKorisnika == "moderator"){
        echo "<li><a href ='zahtjevMentorstvo.php'>Zahtjevi mentorstva</a></li> 
              <li><a href ='popisRacuna.php'>Popis računa</a></li>
              <li><a href ='odjava.php'>Odjava</a></li>";
        //TODO napraviti popisRacuna.php
        //ni sam ne znam kak da to napravim
    }elseif($tipKorisnika == "administrator"){
        echo "<li><a href ='zahtjevMentorstvo.php'>Zahtjevi mentorstva</a></li>
              <li><a href ='kreirajSkolu.php'>Kreiraj školu</a></li>
              <li><a href ='kreirajCjenik.php'>Kreiraj cjenik</a></li>
              <li><a href ='zahtjeviIspit.php'>Zahtjevi ispit</a></li>
              <li><a href ='zakljucaniKorisnici.php'>Zaključani korisnici</a></li>
              <li><a href ='odjava.php'>Odjava</a></li>";

        //TODO napraviti kreirajCjenik.php
        //napraviti formu za kreiranje cjenika
        //TODO napraviti zahtjeviIspit.php
        //napraviti tablicu za pregled svih zahtjeva za ispit i kad se klikne na jednog da moze dati prolaz ili pad
        //upis u bazu pod status
    }


}

?>
