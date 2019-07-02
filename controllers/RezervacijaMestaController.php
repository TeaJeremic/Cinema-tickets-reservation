<?php
namespace App\Controllers;

use App\Models\RezervacijaMestaModel;
use App\Models\RezervacijaModel;
use App\Models\RezervacijaController;
use App\Models\MestoController;
use App\Core\Controller;

class RezervacijaMestaController extends Controller {
    public function getAdd() { //prikupljanje dodatih projekcija
        $mm= new MestoModel($this->getDatabaseConnection());
        $items = $mm->getAll();
        $this->set('mesto', $items);
    }

    public function postAdd() {
        $mestoId = filter_input(INPUT_POST, 'mestoId', FILTER_SANITIZE_NUMBER_INT);
        $rezervacijaId = filter_input(INPUT_POST, 'rezervacijaId', FILTER_SANITIZE_NUMBER_INT);

        $rmm = new RezervacijaMestaModel($this->getDatabaseConnection());
        $rezervacija_mestaId = $rmm->add([
            'mestoId' => $mestoId,
            'rezervacijaId' => $rezervacijaId
            
        ]);

        if (!$rezervacija_mestaId) {
            $this->set('message', 'Došlo je do greške prilikom rezervacije mesta.');
            return;
        }

        \ob_clean();
        header('Location: ' . BASE . 'rezervacija/' . $rezervacijaId);
        exit;
    }

    
    }