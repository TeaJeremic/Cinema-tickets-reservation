<?php
namespace App\Controllers;

use App\Models\MestoModel;
use App\Models\SalaModel;
use App\Models\RezervacijaMestaModel;
use App\Core\Controller;

class MestoController extends Controller {
    public function getAdd() { //prikupljanje sale
        $sm= new SalaModel($this->getDatabaseConnection());
        $items = $sm->getAll();
        $this->set('sala', $items);
    }

    public function postAdd() {
        
        $red = filter_input(INPUT_POST, 'red', FILTER_SANITIZE_STRING);
        $broj_sedista = filter_input(INPUT_POST, 'broj_sedista', FILTER_SANITIZE_NUMBER_INT);
        $salaId = filter_input(INPUT_POST, 'salaId', FILTER_SANITIZE_NUMBER_INT);
       
        $mm = new MestoModel($this->getDatabaseConnection());

        if (!$mestoId) {
            $this->set('message', 'Došlo je do greške prilikom odabira mesta.');
            return;
        }

        \ob_clean();
        header('Location: ' . BASE . 'sala/' . $salaId);
        exit;
    }

    private function proveraDostupnogMesta($id) {
        $mm = new MestoModel($this->getDatabaseConnection());

        $mesto = $mm->getById($id);

        if (!$mesto) {
            \ob_clean();
            header('Location: ' . BASE . 'rezervacija/');
            exit;
        }


        $this->set('mesto', $mesto);
    }

    public function getEdit($id) {
        $this->proveraDostupnogMesta($id);

        $this->getAdd();
    }

    public function postEdit() {
        
        $red = filter_input(INPUT_POST, 'red', FILTER_SANITIZE_STRING);
        $broj_sedista = filter_input(INPUT_POST, 'broj_sedista', FILTER_SANITIZE_NUMBER_INT);
        $salaId = filter_input(INPUT_POST, 'salaId', FILTER_SANITIZE_NUMBER_INT);
       
        $mm = new MestoModel($this->getDatabaseConnection());

        $res = $mm->editById($id, [
            'red' => $red,
            'broj_sedista' => $broj_sedista,
            'salaId' => $salaId
            
        ]);
        if (!$res) {
            $this->set('message', 'Došlo je do greške prilikom izmene ovog mesta.');
            return;
        }

        \ob_clean();
        header('Location: ' . BASE . 'sala/' . $salaId);
        exit;
    }

    
    }