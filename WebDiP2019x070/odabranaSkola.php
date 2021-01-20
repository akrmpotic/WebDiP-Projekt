<?php
include "./header_navigation.php";
$idSkole = $_GET["id"];
$baza = new Baza();
$baza->spojiDB();
$sqlUpit = "SELECT * FROM plesna_skola WHERE id_plesna_skola = ".$idSkole . "";
$skole = $baza->selectDB($sqlUpit);
$row = $skole->fetch_assoc();
$baza->zatvoriDB();
?>

<section class="section">
    <h2>Detalji</h2>
    <p>
        <?php
            echo "<h3>" .$row["naziv"] . "</h3><br>";
            echo $row["opis_plesa"];
            echo "<br><br>";
            echo "Maksimalan broj polaznika ove plesne škole je " .$row["max_polaznici"];
        ?>
    </p>
</section>
<footer>
    <?php
        include "./footer.php";
    ?>
</footer>
</body>
</html>

