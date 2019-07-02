function validateDodavanjeFilmaForms() {
    let status = true;
    document.querySelector('#error-message').innerHTML = '';

    let naziv = document.getElementById('naziv').value;
    if (!naziv.match(/^\+.'![0-9a-zA-Z]{3,}$/)) {
        document.querySelector('#error-message').innerHTML += 'Naziv mora sadrzati najmanje 3 vidljiva uzastopna karaktera.<br>';
        document.querySelector('#error-message').classList.remove('d-none');
        status = false;
    }

    let opis = document.getElementById('opis').value;
    if (!opis.match(/^\+.'!,[0-9a-zA-Z]{3,}$/)) {
        document.querySelector('#error-message').innerHTML += 'Opis mora sadrzati najmanje 3 vidljiva uzastopna karaktera.<br>';
        document.querySelector('#error-message').classList.remove('d-none');
        status = false;
    }

    
   

    let reziser = document.getElementById('reziser').value;
    if (!reziser.match(/^\.'!,[a-zA-Z]{3,}$/)) {
        document.querySelector('#error-message').innerHTML += 'Reziser mora sadrzati najmanje 3 vidljiva uzastopna karaktera.<br>';
        document.querySelector('#error-message').classList.remove('d-none');
        status = false;
    }

    let trajanje = document.getElementById('trajanje').value;
    if (!trajanje.match(/^\.',[0-9a-zA-Z]{2,}$/)) {
        document.querySelector('#error-message').innerHTML += 'Trajanje filma mora imati minimum 2 uzastopna karaktera.<br>';
        document.querySelector('#error-message').classList.remove('d-none');
        status = false;
    }

    let kategorija = document.getElementById('kategorija').value;
    if (!kategorija.match(/^\.',[a-zA-Z]{3,}$/)) {
        document.querySelector('#error-message').innerHTML += 'Kategorija mora sadrzati najmanje 3 vidljiva uzastopna karaktera.<br>';
        document.querySelector('#error-message').classList.remove('d-none');
        status = false;
    }

    return status;

    
}

    function validateRezervacijaForms() {
        let status = true;
        document.querySelector('#error-message').innerHTML = '';

        let ime_korisnika = document.getElementById('ime_korisnika').value;
        if (!ime_korisnika.match(/.*[^\s]{3,}.*/)) {
            document.querySelector('#error-message').innerHTML += 'Ime mora sadrzati najmanje 3 vidljiva uzastopna karaktera.<br>';
            document.querySelector('#error-message').classList.remove('d-none');
            status = false;
        }

        let prezime_korisnika = document.getElementById('prezime_korisnika').value;
        if (!prezime_korisnika.match(/.*[^\s]{3,}.*/)) {
            document.querySelector('#error-message').innerHTML += 'Prezime mora sadrzati najmanje 3 vidljiva uzastopna karaktera.<br>';
            document.querySelector('#error-message').classList.remove('d-none');
            status = false;
        }
    
        let telefon = document.getElementById('telefon').value;
        if (!telefon.match(/^\+[0-9]{6,24}$/)) {
            document.querySelector('#error-message').innerHTML += 'Telefon mora sadrzati najmanje 6 vidljivih uzastopnih karaktera.<br>';
            document.querySelector('#error-message').classList.remove('d-none');
            status = false;
        }
        return status;
    }
    
    
        function validateDodavanjeProjekcijeForms() {
            let status = true;
            document.querySelector('#error-message').innerHTML = '';

            let is_active = document.getElementById('is_active').value;
        if (!is_active.match(/^\[0-1]{1,}$/)) {
            document.querySelector('#error-message').innerHTML += 'Za aktivnost projekcije upisite 0 za neaktivnu i 1 za aktivnu.<br>';
            document.querySelector('#error-message').classList.remove('d-none');
            status = false;
        }
        return status;
        }

        function validateDodavanjePrijavaForms() {
            let status = true;
            document.querySelector('#error-message').innerHTML = '';

            let username = document.getElementById('username').value;
        if (!username.match(/[A-Za-z0-9]{3,}/)) {
            document.querySelector('#error-message').innerHTML += 'Korisnicko ime mora sadrzati najmanje 3 vidljiva uzastopna karaktera.<br>';
            document.querySelector('#error-message').classList.remove('d-none');
            status = false;
        }
        return status;

        }
