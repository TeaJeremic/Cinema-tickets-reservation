<?php
    namespace App\Core;

    class AdministratorController extends Controller {
        public function __pre() {
            if (!$this->getSession()->get('administratorId', null)) {
                ob_clean();
                header('Location: ' . BASE . 'administrator/login', true, 307);
                exit;
            }
        }
    }
