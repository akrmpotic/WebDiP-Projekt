<?php
include "./header_navigation.php";

$idKorisnik = Sesija::dajIdKorisnika();
$baza = new Baza();
$baza->spojiDB();
$sqlUpit = "SELECT * FROM termin WHERE korisnik_id_korisnik = " .$idKorisnik . "";

$termini = $baza->selectDB($sqlUpit);

$head = "<thead> <tr> <th>Vrijeme početka</th> <th>Vrijeme kraja</th> <th>Video</th> <th>Naziv</th> <th>Opis</th>  </tr> </thead>";
$tablica = "";

while ($row = $termini->fetch_assoc()){
    $tablica = $tablica . "<tr> <td>" . $row["vrijeme_od"] . "</td> <td>" .$row["vrijeme_do"] . "</td> <td>" . $row["video"] . "</td> <td>" . $row["naziv"] . "</td> <td>" . $row["opis"] . "</td></tr>";
}
$baza->zatvoriDB();
?>

<section class="section">
    <table class="section" border="2">
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
