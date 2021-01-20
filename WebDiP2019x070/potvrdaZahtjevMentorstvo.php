<?php
include "./header_navigation.php";

$baza = new Baza();
$baza->spojiDB();

$idZahtjev = $_GET["id"];

$sqlUpit = "UPDATE `zahtjev_mentorstvo` SET `status`= 1 WHERE id_zahtjev_mentorstvo = " .$idZahtjev ."";

$baza->selectDB($sqlUpit);
header('Location:zahtjevMentorstvo.php');
?>