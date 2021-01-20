<?php
include "./header_navigation.php";

$baza = new Baza();
$baza->spojiDB();

$korisnikId = $_GET["id"];


$sqlUpit = sprintf ("UPDATE `korisnik` SET `neuspjesni_pokusaji` = 0 WHERE `id_korisnik` = '%s'", $korisnikId);

$baza->selectDB($sqlUpit);

ispisiAlert("Korisnik je odblokiran!");
$baza->zatvoriDB();

header("Location: zakljucaniKorisnici.php");

?>
