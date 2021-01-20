<?php
include './header_navigation.php';

$konekcijaBaza = new Baza();

$korime = "";
$kod = "";


if(isset($_GET["korime"]) && isset($_GET["kod"])) {
    $konekcijaBaza->spojiDB();
    $korime = $_GET["korime"];
    $kod = $_GET["kod"];
    $sqlUpit = "SELECT * FROM korisnik WHERE korisnicko_ime = '" . $korime . "' AND aktivacijski_kod = '" . $kod . "'";
    $sqlDatum = "SELECT datum_uvjeti_koristenja FROM korisnik WHERE korisnicko_ime = '" . $korime . "' AND aktivacijski_kod = '" . $kod . "'";
    $redovi = $konekcijaBaza->selectDB($sqlUpit);
    $datum_kreiran = $konekcijaBaza->selectDB($sqlDatum);
    $istekao = (7 * 60 * 60);
    $datum_kreiran = $datum_kreiran + $istekao;
    if(mysqli_num_rows($redovi) > 0 && $datum_kreiran > time()) {
        $sqlAktivacija = "UPDATE korisnik SET aktiviran = '1' WHERE korisnicko_ime = '" . $korime . "'";
        $aktivacija = $konekcijaBaza->selectDB($sqlAktivacija);
        ispisiAlert("Račun je aktiviran!");
        header("Location: prijava.php");
    }
    else {

        header("Location: index.php");
    }

    $konekcijaBaza->zatvoriDB();
}


?>

