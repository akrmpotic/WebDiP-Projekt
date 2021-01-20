<?php
include './header_navigation.php';

$baza = new Baza();
$baza->spojiDB();

$email = "";
$nova_lozinka = rand(1000, 9999);
$salt = '}#f4ga~g%7hjg4&j(7mk?/!bj30ab-wi=6^7-$^R9F|GK5J#E6WT;IO[JN';
$hashLozinka = sha1($salt . $nova_lozinka);


if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $sqlZaboravljenaLozinka = "SELECT * FROM korisnik WHERE email = '" . $email . "'";
    $korisnik = $baza->selectDB($sqlZaboravljenaLozinka);
    if (mysqli_num_rows($korisnik) > 0) {
        while ($row = $korisnik->fetch_assoc()) {
            $korime2 = $row["korisnicko_ime"];
            $id_korisnik2 = $row["id_korisnik"];
        }

        $mail_to = $email;
        $mail_subject = "Nova lozinka - WebDiP2019x070";
        $mail_body = "Nova lozinka je: " .$nova_lozinka;
        $mail_from = "From: WebDiP2019x070";
        mail($mail_to, $mail_subject, $mail_body, $mail_to);

        $aktivnost = "Resetiranje lozinke";
        $opis = "Resetirana lozinka korisnika:" . $korime2;
        $datum = date("Y-M-D h:i:s");
        $unosZapisa = "INSERT INTO 'dnevnik'('aktivnost', 'opis', 'vrijeme', 'korisnik_id') 
                        VALUES ('".$aktivnost."','".$opis."','".$datum."','".$id_korisnik2."')";
        $baza->selectDB($unosZapisa);

        $novaLozinkaUpis = "UPDATE korisnik SET lozinka = '".$nova_lozinka."', lozinka_SHA1 = '".$hashLozinka."' WHERE email = '".$email."'";
        $upit = $baza->selectDB($novaLozinkaUpis);
    }

}
$baza->zatvoriDB();
?>


<section class="section" style="display:block;">
    <form id="zaboravljenaLozinkaForm" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="email">Unesite email: </label>
        <input type="text" id="email" name="email"><br>
        <input type="submit" id="submit" name="submit" value="Pošalji">
    </form>
</section>
<footer>
    <?php
    include './footer.php';
    ?>
</footer>
</body
</html>