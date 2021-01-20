<?php
include "./header_navigation.php";

$baza = new Baza();
$baza->spojiDB();
$idMentor = $_GET["id"];
$naziv = $_GET["naziv"];

$idKorisnik = Sesija::dajIdKorisnika();
$korisnik = Sesija::dajKorisnika();
$datum = time();
$opis = "Kandidat " . $korisnik . " zahtjeva mentorstvo za plesnu školu: " . $naziv . "";
$sqlUpit = sprintf("INSERT INTO `zahtjev_mentorstvo`( `opis`, `status`, `korisnik_id_mentor`, `korisnik_id_korisnik`) 
                            VALUES ('%s','%s','%s','%s')",
                            $opis, 0, $idMentor, $idKorisnik);

$baza->selectDB($sqlUpit);
header('Location:index.php');

?>
