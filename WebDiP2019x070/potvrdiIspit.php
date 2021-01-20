<?php
include "./header_navigation.php";



global $id_zahtjev_ispit;
$id_zahtjev_ispit = $_GET["id"];

if(isset($_POST["prolaz"])){
    $baza = new Baza();
    $baza->spojiDB();

    $sqlUpit = "UPDATE zahtjev_ispit SET status = 2 WHERE  id_zahtjev_ispit = $id_zahtjev_ispit";

    $baza->selectDB($sqlUpit);
    $baza->zatvoriDB();
}
if(isset($_POST["pad"])){
    $baza = new Baza();
    $baza->spojiDB();

    $sqlUpit = "UPDATE zahtjev_ispit SET status = 1 WHERE  id_zahtjev_ispit = $id_zahtjev_ispit";

    $baza->selectDB($sqlUpit);
    $baza->zatvoriDB();
}


?>
    <section class="section">
        <form action="potvrdiIspit.php?id=<?php echo $id_zahtjev_ispit ?>" method="POST" >
            <input type="submit" id="prolaz" name="prolaz" value="Prolaz">
            <input type="submit" id="pad" name="pad" value="Pad">
        </form>

    </section>
<footer>
    <?php
        include "./footer.php";
    ?>
</footer>

