<?php
namespace App\Controllers;

use App\Models\FilmModel;
use App\Core\Controller;
use App\Models\ProjekcijaModel;
use App\Models\AdministratorModel;
use App\Validators\StringValidator;

class MainController extends Controller {
    public function home() {
        $fm = new FilmModel($this->getDatabaseConnection());
        $filmovi = $fm->getAll();
        
        $this->set('filmovi', $filmovi);
    }

    public function filmoviSortedById() {
        $fm = new FilmModel($this->getDatabaseConnection());
        $filmovi = $fm->getAll();

        usort($filmovi, function($a, $b) {
            return $b->naziv <=> $a->naziv;
        });

        $this->set('filmovi', $filmovi);
    }

    public function showFilmskeProjekcije($filmId) {
        $pm = new ProjekcijaModel($this->getDatabaseConnection());
        $projekcije = $pm->getAllActiveByFilmId($filmId);
        $this->set('projekcije', $projekcije);

        $fm = new FilmModel($this->getDatabaseConnection());
        $film = $fm->getById($filmId);
        $this->set('film', $film);
    }

    public function loginGet() {
        
    }
    public function loginOut() {
        $this->getSession()->remove('administratorId');
        $this->getSession()->save();
        header('Location: ' . BASE );
        exit;
    }

    public function loginPost() {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $am = new AdministratorModel($this->getDatabaseConnection());

        $administrator = $am->getByFieldName('username', $username);

        if (!$administrator) {
            sleep(1);
            $this->set('message', 'Loši podaci!');
            return;
        }


        if (!password_verify($password, $administrator->password)) {
            sleep(1);
            $this->set('message', 'Loši podaci!');
            return;
        }

        $this->getSession()->put('administratorId', $administrator->administrator_id);

        \ob_clean();
        header('Location: ' . BASE . 'administrator/home/');
        exit;
    }
    
}
