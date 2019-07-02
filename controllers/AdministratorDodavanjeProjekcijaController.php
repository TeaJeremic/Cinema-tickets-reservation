<?php
namespace App\Controllers;

use App\Core\AdministratorController;
use App\Models\FilmModel;
use App\Models\SalaModel;
use App\Models\ProjekcijaModel;

class AdministratorDodavanjeProjekcijaController extends AdministratorController {

    public function projekcije(){
        $pm = new ProjekcijaModel($this->getDatabaseConnection());
        $projekcije = $pm->getAll();
        $this->set('projekcije', $projekcije);
    }

    public function getAdd() { //prikupljanje dodatih filmova da bi se napravila projekcija za svaki
        $fm= new FilmModel($this->getDatabaseConnection());
        $sm= new SalaModel($this->getDatabaseConnection());
        $filmovi = $fm->getAll();
        $sale = $sm->getAll();
        $this->set('sale', $sale);
        $this->set('filmovi', $filmovi);
    }

   

    public function postAdd() {
        $termin_at = filter_input(INPUT_POST, 'termin_at', FILTER_SANITIZE_STRING);
        $filmId = filter_input(INPUT_POST, 'film_id', FILTER_SANITIZE_NUMBER_INT);
        $salaId = filter_input(INPUT_POST, 'sala_id', FILTER_SANITIZE_NUMBER_INT);
       
        $pm = new ProjekcijaModel($this->getDatabaseConnection());

        $termin_at .= ':00';
       
        $termin_at = str_replace('T', ' ', $termin_at);
        $projekcijaId=$pm->add([
            'termin_at' => $termin_at,
            'film_id' => $filmId,
            'sala_id' => $salaId 
            
        ]); 
        
        if (!$projekcijaId) {
            $this->set('message', 'Došlo je do greške prilikom dodavanja nove projekcije.');
            return;
        }
        
        \ob_clean();
        header('Location: ' . BASE . 'administrator/projekcije');
        exit;
    }

    public function getEdit($id) { //pribavljanje id za izmenu projekcije
        $pm = new ProjekcijaModel($this->getDatabaseConnection());

        $projekcija = $pm->getById($id);

        if (!$projekcija) {
            \ob_clean();
            header('Location: ' . BASE . 'administrator/projekcije');
            exit;
        }

        $this->set('projekcija', $projekcija);
    }
    
    
    public function postEdit() { //izmena projekcije i dodavanje
        $datum_at = filter_input(INPUT_POST, 'termin_at', FILTER_SANITIZE_STRING);
        $termin_at = filter_input(INPUT_POST, 'termin_at', FILTER_SANITIZE_STRING);
        $filmId = filter_input(INPUT_POST, 'filmId', FILTER_SANITIZE_NUMBER_INT);
        $salaId = filter_input(INPUT_POST, 'salaId', FILTER_SANITIZE_NUMBER_INT);

        $pm = new ProjekcijaModel($this->getDatabaseConnection());
      
        $res = $pm->editById($id,[
            'datum_at' => $datum_at,
            'termin_at' => $termin_at,
            'filmId' => $filmId,
            'salaId' => $salaId
        ]);

        if (!$res) {
            $this->set('message', 'Došlo je do greške prilikom izmene ove projekcije.');
            return;
        }

        \ob_clean();
        header('Location: ' . BASE . 'projekcija/' . $id);
        exit;
    }

   
}
