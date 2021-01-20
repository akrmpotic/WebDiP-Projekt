<?php

include "./header_navigation.php";

if (isset($_POST["submit"])) {
    $baza = new Baza();
    $baza->spojiDB();
    $nazivSkole = $_POST["nazivSkole"];
    $maxPolaznici = $_POST["maxPolaznici"];
    $opisPlesa = $_POST["opisPlesa"];

    $sqlNovaSkola = sprintf("INSERT INTO `plesna_skola`(`naziv`, `max_polaznici`, `trenutni_polaznici`, `opis_plesa`)
                                    VALUES ('%s','%s','0','%s')",
                                    $nazivSkole, $maxPolaznici, $opisPlesa);
    $baza->selectDB($sqlNovaSkola);

    $idKorisnik = dohvatiIdKorisnik($korime, "korisnicko_ime", $baza);
    $aktivnost = "Kreiranje nove plesne škole: ";
    $opis = "Korisnik " . $korime . " je kreirao plesnu školu naziva: " . $nazivSkole . ".";
    upisiDnevnik($aktivnost, $opis, $idKorisnik, $baza);

    ispisiAlert("Kreirana je nova škola!");


    $baza->zatvoriDB();
}

?>

<section class="section" style="display: block;">
    <h2>Obrazac kreiranja škole</h2>
    <form id="kreirajSkolu_form" method="post" name="prijava" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="nazivSkole">Naziv: </label>
        <input type="text" id="nazivSkole" name="nazivSkole" size="45" maxlength="50"
               placeholder="Naziv plesne škole"><br>
        <label for="maxPolaznici">Max polaznici: </label>
        <input type="number" id="maxPolaznici" name="maxPolaznici" size="10" placeholder="Broj polaznika"><br>
        <label for="opisPlesa">Opis plesa: </label>
        <input type="text" id="opisPlesa" name="opisPlesa" size="50" maxlength="255"
               placeholder="Opis plesa (255)"><br>
        <input id="kreiraj_submit" name="submit" type="submit" value="Kreiraj">
    </form>
</section>
<footer>
    <?php
    include "./footer.php";
    ?>
</footer>
</body>
</html>
