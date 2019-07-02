<?php
namespace App\Controllers;

use App\Models\ProjekcijaModel;
use App\Core\Controller;

class ProjekcijaController extends Controller {
    public function show($projekcijaId) {
        $pm = new ProjekcijaModel($this->getDatabaseConnection());
        $projekcija = $pm->getById($projekcijaId);

        if ( !$pm->isActive($projekcija) ) {
            ob_clean();
            header('Location: ' . BASE);
            exit;
        }
    }

    public function postSearch() {
        $keyword = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);

        $pm = new ProjekcijaModel($this->getDatabaseConnection());

        $projekcije = $pm->getAllByFilmId($keyword);

        $this->set('projekcije', $projekcije);
    }
}
