<?php
namespace App\Controllers;

use App\Models\FilmModel;
use App\Core\ApiController;
use App\Models\ProjekcijaModel;

class MainApiController extends ApiController {
    public function filmovi() {
        $fm = new FilmModel($this->getDatabaseConnection());
        $items = $fm->getAll();
        $this->set('filmovi', $items);
        sleep(1);
    }

    public function projekcije($filmId) {
        $pm = new ProjekcijaModel($this->getDatabaseConnection());
        $items = $pm->getAllByCategoryId($filmId);
        $this->set('projekcije', $items);
        sleep(1);
    }
}
