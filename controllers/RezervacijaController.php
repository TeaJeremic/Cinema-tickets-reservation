<?php
namespace App\Controllers;

use App\Models\RezervacijaModel;
use App\Models\RezervacijaMestaModel;
use App\Models\ProjekcijaModel;
use App\Models\MestoModel;
use App\Core\Controller;

class RezervacijaController extends Controller {
    public function getAdd($projekcija_id) { 
        $mm = new MestoModel($this->getDatabaseConnection());
        $zauzeta_mesta = $mm->getAllReservedSeats($projekcija_id);
        $this->set('zauzeta_mesta', $zauzeta_mesta);
    }

    public function postAdd($projekcija_id) {
        
        $ime_korisnika = filter_input(INPUT_POST, 'ime_korisnika', FILTER_SANITIZE_STRING);
        $prezime_korisnika = filter_input(INPUT_POST, 'prezime_korisnika', FILTER_SANITIZE_STRING);
        $broj_telefona = filter_input(INPUT_POST, 'broj_telefona', FILTER_SANITIZE_STRING);
        $mesta = filter_input(INPUT_POST, 'mesta', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        
        $rm = new RezervacijaModel($this->getDatabaseConnection());
        $rmm = new RezervacijaMestaModel($this->getDatabaseConnection());
        $pm = new ProjekcijaModel($this->getDatabaseConnection());
        $mm = new MestoModel($this->getDatabaseConnection());

        $sala_id = $pm->getById($projekcija_id)->sala_id;

        
        $rezervacijaId = $rm->add([
            'ime_korisnika' => $ime_korisnika,
            'prezime_korisnika' => $prezime_korisnika,
            'broj_telefona' => $broj_telefona,
            'projekcija_id' => $projekcija_id
        ]);

        if (!$rezervacijaId) {
            $this->set('message', 'Došlo je do greške prilikom rezervacije.');
            return;
        }
        foreach($mesta as $mesto) {
            $mesto_id = $mm->add([
                'sala_id'       => $sala_id,
                'red'           => substr($mesto,0,1),
                'broj_sedista'  => substr($mesto,1,strlen($mesto)-1),
                'is_active'     => 0,
                'projekcija_id' => $projekcija_id
                ]);

            if (!$mesto_id) {
                $this->set('message', 'Došlo je do greške prilikom rezervacije mesta.');
                return;
            }
            $rezervacija_mesta_id = $rmm->add([
                'mesto_id'       => $mesto_id,
                'rezervacija_id' => $rezervacijaId
                ]);

            if (!$rezervacija_mesta_id) {
                $this->set('message', 'Došlo je do greške prilikom rezervacije mesta.');
                return;
            }
        }

        $this->set('message', 'Uspesno ste izvrsili rezervaciju.');
        return;

    }

    }