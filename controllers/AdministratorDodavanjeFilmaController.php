<?php
namespace App\Controllers;

use App\Core\AdministratorController;
use App\Models\FilmModel;
use App\Validators\TextValidator;

class AdministratorDodavanjeFilmaController extends AdministratorController
{
    public function filmovi()
    { //pribavljanje baze i tabele
        $fm = new FilmModel($this->getDatabaseConnection());
        $items = $fm->getAll();
        $this->set('filmovi', $items);
    }
    public function getAdd()
    {
    }

    private function doUpload($fieldName, $filename)
    {
        $path = new \Upload\Storage\FileSystem(\Configuration::UPLOAD_DIR);
        $file = new \Upload\File($fieldName, $path);
        $file->setName($filename);
        $file->addValidations([
            new \Upload\Validation\Mimetype('image/jpeg'),
            new \Upload\Validation\Size('3M')
        ]);

        try {
            $file->upload();
            //return true;
        } catch (\Exception $e) {
            $this->set('message', 'Došlo je do greške: ' . implode(', ', $file->getErrors()));
            ///return false;
        }
    }


    public function postAdd()
    { //dodavanje filma
        $naziv = filter_input(INPUT_POST, 'naziv', FILTER_SANITIZE_STRING);
        $opis = filter_input(INPUT_POST, 'opis', FILTER_SANITIZE_STRING);
        $kategorija = filter_input(INPUT_POST, 'kategorija', FILTER_SANITIZE_STRING);
        $reziser = filter_input(INPUT_POST, 'reziser', FILTER_SANITIZE_STRING);
        $trajanje = filter_input(INPUT_POST, 'trajanje', FILTER_SANITIZE_NUMBER_INT);

        if(!$this->validateInputs($naziv, $opis,$reziser,$trajanje,$kategorija)){
            $this->set('message', 'Došlo je do greške prilikom dodavanja novog filma.');
            return;
        }


        $fm = new FilmModel($this->getDatabaseConnection());
        $filmId = $fm->add([
            'naziv' => $naziv,
            'opis' => $opis,
            'kategorija' => $kategorija,
            'reziser' => $reziser,
            'trajanje' => $trajanje,
            'image_path' => rand(1000, 9999),
            'administrator_id' => $this->getSession()->get('administratorId')
        ]);

        if (!$filmId) {
            $this->set('message', 'Došlo je do greške prilikom dodavanja novog filma.');
            return;
        }

        if (!$this->doUpload('image', $filmId)) {
            return;
        }

        \ob_clean();
        header('Location: ' . BASE . 'administrator/home');
        exit;
    }

    

    public function getEdit($id)
    { //pribavljanje id za izmenu filma
        $fm = new FilmModel($this->getDatabaseConnection());

        $film = $fm->getById($id);

        if (!$film) {
            \ob_clean();
            header('Location: ' . BASE . 'administrator/home');
            exit;
        }

        $this->set('film', $film);
    }
    
    
    public function postEdit($id)
    { //izmena filma i dodavanje
        $naziv = filter_input(INPUT_POST, 'naziv', FILTER_SANITIZE_STRING);
        $opis = filter_input(INPUT_POST, 'opis', FILTER_SANITIZE_STRING);
        $kategorija = filter_input(INPUT_POST, 'kategorija', FILTER_SANITIZE_STRING);
        $reziser = filter_input(INPUT_POST, 'reziser', FILTER_SANITIZE_STRING);
        $trajanje = filter_input(INPUT_POST, 'trajanje', FILTER_SANITIZE_NUMBER_INT);
        
        if(!$this->validateInputs($naziv, $opis,$reziser,$trajanje,$kategorija)){
            $this->set('message', 'Došlo je do greške prilikom dodavanja novog filma.');
            return;
        }

        $fm = new FilmModel($this->getDatabaseConnection());
        $res = $fm->editById($id, [
            'naziv' => $naziv,
            'opis' => $opis,
            'kategorija' => $kategorija,
            'reziser' => $reziser,
            'trajanje' => $trajanje
            
        ]);

        if (!$res) {
            $this->set('message', 'Došlo je do greške prilikom izmene ovog filma.');
            return;
        }
        
        if (!$this->doUpload('image', $filmId)) {
            return;
        }

        \ob_clean();
        header('Location: ' . BASE . 'administrator/home');
        exit;
    }

    private function validateInputs($naziv, $opis,$reziser,$trajanje,$kategorija, $filmId = false)
    {
        $validator = (new TextValidator())->setMinLength(3)->setMaxLength(65);
        if (! $validator->matchPattern($naziv)) {
            $this->set('message', 'Naziv mora sadržati najmanje 3 vidljiva uzastopna karaktera.');
            if ($id) {
                $this->set('film_id', $filmId);
            }
            return false;
        }

        $validator = (new TextValidator())->setMinLength(3);
        if (! $validator->matchPattern($opis)) {
            $this->set('message', 'Opis mora sadržati najmanje 3 vidljivih uzastopna karaktera.');
            if ($id) {
                $this->set('film_id', $filmId);
            }
            return false;
        }

        $validator = (new SlovaValidator())->setMinLength(2);
        if (! $validator->matchPattern($reziser)) {
            $this->set('message', 'Reziser mora sadržati najmanje 2 vidljiva uzastopna karaktera.');
            if ($id) {
                $this->set('film_id', $filmId);
            }
            return false;
        }

        $validator = (new TrajanjeValidator())->setMinLength(2);
        if (! $validator->matchPattern($trajanje)) {
            $this->set('message', 'Trajanje filma mora sadržati najmanje 3 vidljivih uzastopna karaktera.');
            if ($id) {
                $this->set('film_id', $filmId);
            }
            return false;
        }

        $validator = (new SlovaValidator())->setMinLength(2);
        if (! $validator->matchPattern($kategorija)) {
            $this->set('message', 'Kategorija filma mora sadržati najmanje 2 vidljiva uzastopna karaktera.');
            if ($id) {
                $this->set('film_id', $filmId);
            }
            return false;
        }
    }
}
