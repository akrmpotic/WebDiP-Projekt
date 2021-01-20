<?php

include("baza.class.php");

$baza = new Baza();
$baza->spojiDB();

$korisnici = $baza->selectDB("SELECT * FROM korisnik");

$korisniciArray = array();
while($row = $korisnici->fetch_assoc()) {
    array_push($korisniciArray, $row["korisnicko_ime"]);
}

header('Content-Type: application:/json');
echo json_encode($korisniciArray);

$baza->zatvoriDB();
?>