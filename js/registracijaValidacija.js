function provjeriFormu(forma) {

    var brojacGresaka = 0;
    var ispisGreski = "";

    if (forma["godinaRodenja"].value === "") {
        ispisGreski += "Klijent: Niste unijeli godinu rođenja!<br>";
        brojacGresaka++;
    } else {
        if (forma["godinaRodenja"].value < 1960 || forma["godinaRodenja"].value > 2004) {
            ispisGreski += "Klijent: Godina nije u rasponu 1960-2004!<br>";
            brojacGresaka++;
        }
    }

    if (forma["ime"].value === "") {
        ispisGreski += "Klijent: Niste popunili ime!<br>";
        brojacGresaka++;
    }
    else {
        if (forma["ime"].value[0] !== forma["ime"].value[0].toUpperCase()) {
            ispisGreski += "Klijent: Ime mora početi velikim slovom!<br>";
            brojacGresaka++;
        }
        else if (forma["ime"].value.length < 3) {
            ispisGreski += "Klijent: Ime mora imati više od tri slova!<br>";
            brojacGresaka++;
        }
    }

    if (forma["prezime"].value === "") {
        ispisGreski += "Klijent: Niste popunili prezime!<br>";
        brojacGresaka++;
    }
    else {
        if (forma["prezime"].value[0] !== forma["prezime"].value[0].toUpperCase()) {
            ispisGreski += "Klijent: Prezime mora početi velikim slovom!<br>";
            brojacGresaka++;
        }
        else if (forma["prezime"].value.length < 3) {
            ispisGreski += "Klijent: Prezime mora imati više od tri slova!<br>";
            brojacGresaka++;
        }
    }

    if (forma["potvrdaLozinke"].value === "") {
        ispisGreski += "Klijent: Niste potvrdili lozinku!<br>";
        brojacGresaka++;
    } else {
        if (forma["lozinka"].value !== forma["potvrdaLozinke"].value) {
            ispisGreski += "Klijent: Lozinke se ne podudaraju!<br>";
            brojacGresaka++;
        }
    }

    if (forma["korime"].value === "") {
        ispisGreski += "Klijent: Niste unijeli korisničko ime!<br>";
        brojacGresaka++;
    } else {
        var rizraz = /^(?=.*[a-z])[a-z0-9]{4,12}$/;
        if (!rizraz.test(forma["korime"].value)) {
            ispisGreski += "Klijent: Neispravno korisničko ime!<br>";
            brojacGresaka++;
        }
    }

    if (forma["email"].value === "") {
        ispisGreski += "Klijent: Niste unijeli e-mail!<br>";
        brojacGresaka++;
    } else {
        var rizraz = /^\w{1,}@\w{1,}\.\w{1,}$/;
        if (!rizraz.test(forma["email"].value)) {
            ispisGreski += "Klijent: E-mail mora biti oblika (jhonsnow@gmail.com)!<br>";
            brojacGresaka++;
        }
    }

    ispisGreski += "Klijent: Broj pogrešno popunjenih polja: " + brojacGresaka + "<br>";
    var divJsGreske = document.getElementById('jsGreske');
    divJsGreske.innerHTML = ispisGreski;

    if (brojacGresaka === 0)
        return true;
    else
        return false;

}


document.getElementById("formaRegistracija").addEventListener("submit", function (event) {
    if (provjeriFormu(this) === true)
        return true;
    else
        event.preventDefault();
}
);
