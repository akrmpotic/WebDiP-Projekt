<?php

include "./header_navigation.php";

$baza = new Baza();
$baza->spojiDB();
$idKorisnik = Sesija::dajIdKorisnika();
$sqlUpit = sprintf("SELECT k.id_korisnik, k.ime, k.prezime, k.email, k.max_polaznik, ps.naziv FROM korisnik k 
JOIN korisnik_skola ks ON k.id_korisnik = ks.korisnik_id 
JOIN plesna_skola ps ON ps.id_plesna_skola = ks.plesna_skola_id WHERE k.uloga_id = 2 OR k.uloga_id = 3");

$mentori = $baza->selectDB($sqlUpit);

$head = "<thead> <tr><th>-----------</th><th>Ime i prezime</th> <th>E-mail</th> <th>Max polaznici</th> <th>Plesna škola</th> </tr> </thead>";
$tablica = "";

while ($row = $mentori->fetch_assoc()){
    $tablica = $tablica ."<tr><td> <a href='posaljiZahtjevMentorstvo.php?id=" .$row["id_korisnik"] .  "&naziv=" .$row["naziv"] . "'>Pošalji zahtjev</a></td><td>".$row["ime"]." ".$row["prezime"]."</td> <td>".$row["email"]."</td> <td>".$row["max_polaznik"]."</td> <td>".$row["naziv"]."</td></tr>";
}
$baza->zatvoriDB();


?>


<section class="section" style="display: block;">
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
    <?php include 'footer.php'; ?>
</footer>
</body>
</html>
