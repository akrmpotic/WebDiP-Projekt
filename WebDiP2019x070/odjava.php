<?php
include ("sesija.class.php");
$korisnik= sesija::dajKorisnika();
if (isset($_SESSION[sesija::KORISNIK])){
    sesija::obrisiSesiju();
    header("Location: index.php");
}
?>
