<?php
include './header_navigation.php';


$baza = new Baza();
$baza->spojiDB();

if(isset($_POST["submit"])){

    $ime = $_POST["regime"];
    $errorIme = "";
    $nedozvoljeniZnakovi_imePrezime = '/[?!@#$%]/';
    if(empty($ime)){
        $errorIme = "Polje je prazno!";
    }
    if(preg_match($nedozvoljeniZnakovi_imePrezime, $ime)){
        $errorIme = "Nedozvoljeni znakovi u imenu!";
    }

    $prezime = $_POST["regprez"];
    $errorPrezime ="";
    if(empty($prezime)){
        $errorPrezime = "Polje je prazno!";
    }
    if(preg_match($nedozvoljeniZnakovi_imePrezime, $prezime)){
        $errorPrezime = "Nedozvoljeni znakovi u prezimenu!";
    }

    $korime = $_POST["regkorime"];
    $errorKorime = "";
    if(strlen($korime) < 3 || strlen($korime) > 15){
        $errorKorime = "Korisničko ime mora imati između 3 i 15 znakova!";
    }

    $email = $_POST["regemail"];
    $errorEmail = "";
    if(empty($email)){
        $errorEmail = "Polje je prazno!";
    }
    //TODO odkomentiraj provjeru emaila prije predaje
    //if(mysqli_num_rows($baza->selectDB("SELECT email FROM korisnik WHERE email = '$email' ")) > 0){
    //    $errorEmail = "E-mail adresa se već koristi!";
    //}

    $lozinka1 = $_POST["reglozinka1"];
    $errorLoznika1 = "";
    if(empty($lozinka1)){
        $errorLoznika1 = "Polje je prazno!";
    }
    if(strlen($lozinka1) < 3 || strlen($lozinka1) > 40){
        $errorLoznika1 = "Lozinka mora imati između 3 i 40 znakova!";
    }

    $lozinka2 = $_POST["reglozinka2"];
    $errorLozinka2 = "";
    if(strlen($lozinka2) < 3 || strlen($lozinka2) > 40){
        $errorLozinka2 = "Lozinka mora imati između 3 i 40 znakova!";
    }
    if($lozinka2 !== $lozinka1){
        $errorLozinka2 ="Lozinke se ne podudaraju!";
    }


    if($errorIme === "" && $errorPrezime === "" && $errorKorime === "" && $errorEmail === "" && $errorLoznika1 === "" && $errorLozinka2 ===""){
        $akt_kod = uniqid(time());
        $salt = '}#f4ga~g%7hjg4&j(7mk?/!bj30ab-wi=6^7-$^R9F|GK5J#E6WT;IO[JN';
        $hash1_sha1 = sha1($salt. $lozinka1);

        $datum = date("Y-M-D h:i:s");
        $sqlInsert = sprintf("INSERT INTO `korisnik`(`ime`, `prezime`, `email`, `lozinka`, `lozinka_SHA1`, `datum_uvjeti_koristenja`, `neuspjesni_pokusaji`, `aktiviran`, `korisnicko_ime`, `uloga_id`, `aktivacijski_kod`)
                                        VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '0', '0', '%s', '1', '%s')",
                                          $ime,$prezime,$email,$lozinka1,$hash1_sha1,$datum,$korime,$akt_kod );
        $baza->selectDB($sqlInsert);




        $poveznica = "http://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x070/aktivacija.php?korime=" . $korime . "&kod=" . $akt_kod;
        $mail_kor = $email;
        $mail_naslov = "Aktivacija novog racuna - WebDiP2019x070";
        $mail_tijelo = $poveznica;
        $mail_od = "WebDiP2019x070";
        mail($mail_kor, $mail_naslov, $mail_tijelo, $mail_od);

        $idKorisnik = dohvatiIdKorisnik($korime, "korisnicko_ime", $baza );
        $aktivnost = "Registracija korisnika: ";
        $opis = "Korisnik " . $korime . " je  registriran.";
        upisiDnevnik($aktivnost, $opis, $idKorisnik, $baza);
        header('Location:prijava.php');
    }else{
        echo "jos uvijek postoji greska";
    }

}
$baza->zatvoriDB();


?>

<section>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <form class="section" style="display: block;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="reg_forma" onsubmit="return captchaValidacija();">
        <h2>Registracija</h2>
            <label for="regime">Ime: </label>
            <input type="text" id="regime" name="regime" size="30" placeholder="Ime"><br>
            <p id="errorIme"></p><br>
            <label for="regprez">Prezime: </label>
            <input type="text" id="regprez" name="regprez" size="30" placeholder="Prezime"><br>
            <p id="errorPrezime"></p><br>
            <label for="regkorime">Korisničko ime: </label>
            <input type="text" id="regkorime" name="regkorime" size="30" placeholder="Korisničko ime"><br>
            <p id="errorKorime"></p><br>
            <label for="regemail">E-mail adresa: </label>
            <input type="email" id="regemail" name="regemail" size="40" placeholder="ime.prezime@posluzitelj.xxx"><br>
            <p id="errorEmail"></p><br>
            <label for="reglozinka1">Lozinka: </label>
            <input type="password" id="reglozinka1" name="reglozinka1" size="30" placeholder="lozinka"><br>
            <p id="errorLozinka1"></p><br>
            <label for="reglozinka2">Potvrda lozinke: </label>
            <input type="password" id="reglozinka2" name="reglozinka2" size="30" placeholder="lozinka"><br>
            <p id="errorLozinka2"></p><br>
            <div class="g-recaptcha" data-sitekey="6Ld8hgEVAAAAAD4UTdXDqEn_VFiYKSx4JOK_S6EO"></div><br>

            <script type="text/javascript">
                function captchaValidacija(){
                    if (grecaptcha.getResponse() === ""){
                        alert("Captcha validacija nije uspjela!");
                        return false;
                    }
                    else {
                        return true;
                    }
                }
            </script>


        <input id="reg_submit" name="submit" type="submit" value=" Registriraj se "><br>

    </form>
</section>

        <footer>
            <?php
            include './footer.php';
            ?>
        </footer>
</html>
