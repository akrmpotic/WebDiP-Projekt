$(document).ready(function () {

    $('#regkorime').keyup(function () {
        var korisnik = $('#regkorime').val();
        var response = '';

        $.ajax({
            type: "GET",
            url: "korisnicka_imena.php",
            async: false,
            success: function (text) {
                response = text;
            }
        });

        if (response.indexOf(korisnik) >= 0) {
            $("#reg_sumbit").attr("disabled", true);
            $('#regkorime').css("outline", "none");
            $('#regkorime').css("borderColor", "#F37E6C");
            $('#regkorime').css("boxShadow", "0 0 5px #F37E6C");
            $('#errorKorime').text('Korisnik sa tim korisničkim imenom već postoji!');
            console.log('Korisnik vec postoji!');
        } else if (korisnik.indexOf("!") >= 0 || korisnik.indexOf("@") >= 0 || korisnik.indexOf("#") >= 0 || korisnik.indexOf("$") >= 0 || korisnik.indexOf("%") >= 0 || korisnik.indexOf("&") >= 0) {
            $('#regkorime').css("outline", "none");
            $('#regkorime').css("borderColor", "#F37E6C");
            $('#regkorime').css("boxShadow", "0 0 5px #F37E6C");
            $('#errorKorime').text("Korisnicko ime sadrzi nedozvoljeni znak!");
            $("#regsumbit").attr("disabled", true);
        } else {
            $("#regsumbit").attr("disabled", false);
            $('#regkorime').css("outline", "none");
            $('#regkorime').css("borderColor", "#6CF372");
            $('#regkorime').css("boxShadow", "0 0 5px #6CF372");
            $('#errorKorime').text('Korisnicko ime je slobodno!');
            console.log('Korisnicko ime je slobodno!');
        }

    });


    $('#regemail').keyup(function () {
        var mail = $('#regemail').val();
        var regMail = new RegExp(/^[^\.][a-zA-Z0-9]{0,}[\.]{0,1}[a-zA-Z0-9]{0,}@[a-zA-Z0-9]{0,}[\.]{1}[a-zA-Z0-9]{2,}/);
        var mailValid = regMail.test(mail);

        if (!mailValid) {
            $('#regemail').css("outline", "none");
            $('#regemail').css("borderColor", "#F37E6C");
            $('#regemail').css("boxShadow", "0 0 5px #F37E6C");
            $('#errorEmail').text("E-mail nije unesen prema pravilima!");
            $("#reg_sumbit").attr("disabled", true);
        } else {
            $('#regemail').css("outline", "none");
            $('#regemail').css("borderColor", "#6CF372");
            $('#regemail').css("boxShadow", "0 0 5px #6CF372");
            $('#errorEmail').text("");
            $("#reg_sumbit").attr("disabled", false);
        }
    });


    $('#reglozinka1').keyup(function () {
        var loz1 = $('#reglozinka1').val();
        if (loz1.length < 3 || loz1.length > 20) {
            $('#reglozinka1').css("outline", "none");
            $('#reglozinka1').css("borderColor", "#f37e6c");
            $('#reglozinka1').css("boxShadow", "0 0 5px #F37E6C");
            $('#errorLozinka1').text("Lozinka mora sadrzavati vise od 2 i manje od 20 znakova!");
            $("#regsumbit").attr("disabled", true);
        } else {
            $('#reglozinka1').css("outline", "none");
            $('#reglozinka1').css("borderColor", "#6CF372");
            $('#reglozinka1').css("boxShadow", "0 0 5px #6CF372");
            $('#errorLozinka1').text("");
            $("#reg_sumbit").attr("disabled", false);
        }
    });


    $('#reglozinka2').keyup(function () {
        var loz1 = $('#reglozinka1').val();
        var loz2 = $('#reglozinka2').val();
        if (loz2 !== loz1) {
            $('#reglozinka2').css("outline", "none");
            $('#reglozinka2').css("borderColor", "#F37E6C");
            $('#reglozinka2').css("boxShadow", "0 0 5px #F37E6C");
            $('#errorLozinka2').text("Lozinka unesena u potvrdu lozinke nije jednaka orginalnoj lozinci!");
            $("#reg_sumbit").attr("disabled", true);
        } else {
            $('#reglozinka2').css("outline", "none");
            $('#reglozinka2').css("borderColor", "#6CF372");
            $('#reglozinka2').css("boxShadow", "0 0 5px #6CF372");
            $('#errorLozinka2').text("");
            $("#regsumbit").attr("disabled", false);
        }
    });


    $('#regime').keyup(function () {
        var ime = $('#regime').val();
        if (ime === "") {
            $('#regime').css("outline", "none");
            $('#regime').css("borderColor", "#F37E6C");
            $('#regime').css("boxShadow", "0 0 5px #F37E6C");
            $('#errorIme').text("Ime nije uneseno!");
            $("#reg_sumbit").attr("disabled", true);
        } else {
            $('#regime').css("outline", "none");
            $('#regime').css("borderColor", "#6CF372");
            $('#regime').css("boxShadow", "0 0 5px #6CF372");
            $('#errorIme').text("");
            $("#reg_sumbit").attr("disabled", false);
        }
    });


    $('#regprez').keyup(function () {
        var prez = $('#regprez').val();
        if (prez === "") {
            $('#regprez').css("outline", "none");
            $('#regprez').css("borderColor", "#F37E6C");
            $('#regprez').css("boxShadow", "0 0 5px #F37E6C");
            $('#errorPrezime').text("Prezime nije uneseno!");
            $("#reg_sumbit").attr("disabled", true);
        } else {
            $('#regprez').css("outline", "none");
            $('#regprez').css("borderColor", "#6CF372");
            $('#regprez').css("boxShadow", "0 0 5px #6CF372");
            $('#errorPrezime').text("");
            $("#regsumbit").attr("disabled", false);
        }
    });

});