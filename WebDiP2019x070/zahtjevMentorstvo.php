<?php

include "./header_navigation.php";
$baza = new Baza();
$baza->spojiDB();

$korime = Sesija::dajKorisnika();
var_dump($korime);
$korisnikId = dohvatiIdKorisnik($korime,"korisnicko_ime", $baza);



$sqlUpit = sprintf("SELECT zahtjev_mentorstvo.id_zahtjev_mentorstvo, zahtjev_mentorstvo.opis, zahtjev_mentorstvo.vrijeme_zahtjeva, korisnik.ime, korisnik.prezime FROM zahtjev_mentorstvo 
                        JOIN korisnik ON id_korisnik = zahtjev_mentorstvo.korisnik_id_korisnik WHERE korisnik_id_mentor = '%s' AND zahtjev_mentorstvo.status = 0",
                        $korisnikId);
$zahtjevi = $baza->selectDB($sqlUpit);


$head = "<thead> <tr> <th>Opis</th> <th>Vrijeme</th> <th>Ime i prezime</th> <th>Potvrdi</th> </tr> </thead>";
$tablica = "";

while ($row = $zahtjevi->fetch_assoc()){
    $tablica = $tablica . "<tr> <td>" .$row["opis"]. "</td> <td>" .$row["vrijeme_zahtjeva"] . "</td> <td>" . $row["ime"] ." ".$row["prezime"]."</td> <td><a href='potvrdaZahtjevMentorstvo.php?id=".$row["id_zahtjev_mentorstvo"]."'>Potvrdi</a></td></tr>";
}

$baza->zatvoriDB();

?>

<section class="section">
    <table id="tablica" class="section" border="2">
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
</body>
</html>