<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<?php
include './header_navigation.php';
$korisnik = Sesija::dajKorisnika();
?>
        </header>
        <section class="section" style="display:block;">
            <h2>Dobrodošli na stranicu Plesne škole</h2><br>
            <p>
                Kako bi ste počeli sa radom prvo se morate prijaviti. <br>
                Ukoliko nemate račun, morate se registrirati.
            </p>
        </section>
        <footer>
            <?php include './footer.php'?>
        </footer>
    </body>
</html>
