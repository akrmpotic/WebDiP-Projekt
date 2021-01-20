<?php
include './header_navigation.php';
$baza = new Baza();
$baza->spojiDB();

$dohvatiPlesneSkole = "SELECT * FROM plesna_skola";
$plesneSkole = $baza->selectDB($dohvatiPlesneSkole);

$head = "<thead> <tr> <th>------</th> <th>Naziv</th> <th>Max polaznici</th> <th>Trenutni polaznici</th> <th>Opis plesa</th> </tr> </thead>";
$tablica = "";

while ($row = $plesneSkole->fetch_assoc()){
    $tablica = $tablica . "<tr> <td><a href = 'odabranaSkola.php?id=" . $row["id_plesna_skola"] . "'>Detalji</a>" . "</td> <td>" .$row["naziv"] . "</td> <td>" . $row["max_polaznici"] . "</td> <td>" . $row["trenutni_polaznici"] . "</td> <td>" . $row["opis_plesa"] . "</td></tr>";
}
$baza->zatvoriDB();

?>

        <section>
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
            <?php include 'footer.php'; ?>
        </footer>
    </body>
</html>