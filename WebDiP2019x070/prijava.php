<?php
include './header_navigation.php';
$baza = new Baza();

global $pamti_korime;
if (isset($_COOKIE['zapamti'])) {
    $pamti_korime = $_COOKIE['zapamti'];
}

if (isset($_POST["submit"])) {
    $baza->spojiDB();
    $korime = $_POST["loginKorime"];
    $lozinka = $_POST["loginLozinka"];

    $loginQuery = "SELECT * FROM korisnik WHERE korisnicko_ime ='" . $korime . "' AND lozinka ='" . $lozinka . "'";
    $korisnik = $baza->selectDB($loginQuery);
    if (mysqli_num_rows($korisnik) > 0) {
        while ($row = $korisnik->fetch_assoc()) {
            $ulogaId = $row["uloga_id"];
            $id_korisnik = $row["id_korisnik"];
            $neuspjesni_pokusaji = $row["neuspjesni_pokusaji"];
            $zakljucan = $row["aktiviran"];
        }
        if ((int)$neuspjesni_pokusaji < 3) {
            var_dump($ulogaId);
            $_SESSION['korisnikov_tip'] = $ulogaId;
            if ((int)$zakljucan = 1) {
                if (intval($ulogaId) == 3) {
                    $tipKorisnika = "administrator";
                    Sesija::kreirajKorisnika($korime, $tipKorisnika, $id_korisnik);
                    setcookie('Login', $korime, time() + 3600);
                    $sqlResetPokusaji = "UPDATE korisnik SET neuspjesni pokusaji = '0' WHERE korisnicko_ime = '" . $korime . "'";
                    $reset = $baza->selectDB($sqlResetPokusaji);
                }
                elseif (intval($ulogaId) == 2) {
                    $tipKorisnika = "moderator";
                    Sesija::kreirajKorisnika($korime, $tipKorisnika, $id_korisnik);
                    setcookie('Login', $korime, time() + 3600);
                    $sqlResetPokusaji = "UPDATE korisnik SET neuspjesni pokusaji = '0' WHERE korisnicko_ime = '" . $korime . "'";
                    $reset = $baza->selectDB($sqlResetPokusaji);
                }
                elseif ($ulogaId == '1') {
                    $tipKorisnika = "registrirani_korisnik";
                    Sesija::kreirajKorisnika($korime, $tipKorisnika, $id_korisnik);
                    setcookie('Login', $korime, time() + 3600);
                    $sqlResetPokusaji = "UPDATE korisnik SET neuspjesni pokusaji = '0' WHERE korisnicko_ime = '" . $korime . "'";
                    $reset = $baza->selectDB($sqlResetPokusaji);
                }

            } else {
                ispisiAlert("Korisnik nije aktiviran!");
            }
        } else {
            ispisiAlert("Korisnik je zaključan!");
        }

    } else {
        ispisiAlert("Korisnik nije pronađen u bazi podataka!");

        $sqlUpitGreske = "SELECT * FROM korisnik WHERE korisnicko_ime = '" . $korime . "'";
        $rezultat = $baza->selectDB($sqlUpitGreske);
        if (mysqli_num_rows($rezultat) > 0) {
            while ($row = $rezultat->fetch_assoc()) {
                $pogresanPokusaj = $row["neuspjesni_pokusaji"];
            }

            $pogresanPokusaj++;
            if ($pogresanPokusaj >= 3) {
                $sqlZakljucaj = "UPDATE korisnik SET neuspjesni_pokusaji ='3' WHERE korisnicko_ime = '" . $korime . "'";
                $zakljucaj = $baza->selectDB($sqlZakljucaj);
                $greska = 1;

            } else {
                $sqlKrivaLozinka = "UPDATE korisnik SET neuspjesni_pokusaji = '" . $pogresanPokusaj . "' WHERE korisnicko_ime = '" . $korime . "'";
                $izmjena = $baza->selectDB($sqlKrivaLozinka);
                $greska = 2;
            }
        }
    }
    $baza->zatvoriDB();
    header('Location:index.php');
}


?>

<section class="section" style="display: block;">
    <h2>Obrazac prijave</h2>
    <form id="prijava_form" method="post" name="prijava" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="loginKorime">Korisničko ime:</label>
        <?php echo '<input type="text" id="loginKorime" name="loginKorime" size="15" maxlength="20" placeholder="Korisničko ime" value="' . $pamti_korime . '", required="required"><br>'; ?>
        <label for="loginLozinka">Lozinka</label>
        <input type="password" id="loginLozinka" name="loginLozinka" size="15" maxlength="40" placeholder="Lozinka"
               required="required"><br>
        <input id="prijava_submit" name="submit" type="submit" value="Prijavi se">
    </form>
    <a id="zaboravljenaLozinka" href="zaboravljenaLozinka.php">Zaboravljena lozinka?</a><br>
    <?php
        if(isset($greska)) {
            if ($greska === 1) echo "Prekoračili ste broj krivih unosa. Račun je zaključan!";
            elseif ($greska === 2) echo "Neuspješna prijava!";
        }
    ?>
</section>
<footer>
    <?php
    include './footer.php';
    ?>
</footer>
</body>
</html>

