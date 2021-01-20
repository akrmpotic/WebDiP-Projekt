<?php
require_once ('baza.class.php');

function upisiDnevnik($aktivnost , $opis ,  $korisnik_id, $baza){
    $unosZapisa = sprintf("INSERT INTO `dnevnik`(`aktivnost`, `opis`, `korisnik_id`) VALUES
                                     ('%s', '%s', '%s')",
                                    $aktivnost, $opis, $korisnik_id);
    $baza->selectDB($unosZapisa);
}

function dohvatiIdKorisnik($vrijednost, $stupac, $baza)
{
    $sqlSelect = "SELECT * FROM `korisnik` WHERE " . $stupac . "='" . $vrijednost . "'";

    $result = $baza->selectDB($sqlSelect);
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            return $row["id_korisnik"];
        }
    }
    return null;
}

function ispisiAlert($poruka){
    echo '<script type="text/javascript">',
    'alert('.$poruka.')',
    '</script>';
}

function vratiVrijeme(){
    $pomak = 0;
    $vrijeme = time();//+ $pomak; //TODO dodati pomak vremena
    return $vrijeme;

}
?>