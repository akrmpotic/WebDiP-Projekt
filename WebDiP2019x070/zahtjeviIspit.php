<?php

include "./header_navigation.php";
$baza = new Baza();
$baza->spojiDB();
$sqlUpit = "SELECT zahtjev_ispit.id_zahtjev_ispit, zahtjev_ispit.opis, zahtjev_ispit.vrijeme_zahtjeva, korisnik.ime, korisnik.prezime, plesna_skola.naziv FROM
            zahtjev_ispit JOIN korisnik ON zahtjev_ispit.korisnik_id_korisnik = korisnik.id_korisnik 
            JOIN mentorstvo ON korisnik.id_korisnik = mentorstvo.korisnik_id_korisnik 
            JOIN plesna_skola ON mentorstvo.plesna_skola_id = plesna_skola.id_plesna_skola WHERE zahtjev_ispit.status = 0";

$ispiti = $baza->selectDB($sqlUpit);

$head = "<thead> <tr><th>-------</th><th>Opis</th> <th>Vrijeme</th> <th>Ime i prezime</th> <th>Plesna škola</th> <th>------</th> </tr> </thead>";
$tablica = "";

while ($row = $ispiti->fetch_assoc()) {
    $tablica = $tablica . "<tr><td>" . $row["id_zahtjev_ispit"] . "</td>
                           <td>" . $row["opis"] . " </td>
                           <td>" . $row["vrijeme_zahtjeva"] . "</td> 
                           <td>" . $row["ime"] . " " . $row["prezime"] . "</td>
                           <td>" . $row["naziv"] . "</td>
                           <td><a href = 'potvrdiIspit.php?id=" . $row["id_zahtjev_ispit"]  . "'>Ocjeni</a></td></tr>";
}

$baza->zatvoriDB();
?>

<section class="section">
    <table id="tablica" border="2">
        <?php
        echo $head;
        ?>
        <tbody>
        <?php
        echo $tablica;
        ?>
        </tbody>
    </table>
</section>
<footer>
    <?php
        include "./footer.php";
    ?>
</footer>
