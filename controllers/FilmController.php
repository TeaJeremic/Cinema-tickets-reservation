<?php
namespace App\Controllers;

use App\Models\FilmModel;
use App\Core\Controller;

class FilmController extends Controller
{


    public function postSearch() {
        $keyword = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);

        $fm = new FilmModel($this->getDatabaseConnection());

        $filmovi = $fm->getAllBySearch($keyword);

        $this->set('filmovi', $filmovi);
    }
}