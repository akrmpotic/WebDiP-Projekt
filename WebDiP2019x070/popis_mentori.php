<?php
include './header_navigation.php';
$baza = new Baza();
$baza->spojiDB();

$dohvatiMentore = "SELECT k.ime, k.prezime, k.email, k.max_polaznik, ps.naziv FROM korisnik k 
JOIN korisnik_skola ks ON k.id_korisnik = ks.korisnik_id 
JOIN plesna_skola ps ON ps.id_plesna_skola = ks.plesna_skola_id WHERE k.uloga_id = 2 OR k.uloga_id = 3";
$mentori = $baza->selectDB($dohvatiMentore);

$head = "<thead> <tr> <th>Ime i prezime</th> <th>E-mail</th> <th onclick='sortTable(2)'>Max polaznici</th> <th>Plesna škola</th> </tr> </thead>";
$tablica = "";

while ($row = $mentori->fetch_assoc()){
    $tablica = $tablica ."<tr><td>".$row["ime"]." ".$row["prezime"]."</td> <td>".$row["email"]."</td> <td>".$row["max_polaznik"]."</td> <td>".$row["naziv"]."</td></tr>";
}
$baza->zatvoriDB();

?>
<script>
    function search() {

        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("tablica");
        tr = table.getElementsByTagName("tr");


        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("tablica");
        switching = true;
        dir = "asc";
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch= true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount ++;
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>

<section class="section" style="display: block;">
    <input type="text" id="search" onkeyup="search()" placeholder="Pretraži plesne škole.. ">
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