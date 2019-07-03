<?php
    namespace App\Validators;

    use App\Core\Validator;
    use App\Validators\DateTimeValidator;

    class DatumProjekcijeValidator extends DateTimeValidator {
        public function validateProjekcija($value) {
            if(!$this->isValid($value)){
                return false;
            }
            $date_time = explode(' ', $value);
            $date = explode('-', $date_time[0]);
            $time = explode(':', $date_time[1]);
            if($date[0] < date('Y')){
                return false;
            }
            if($date[0] == date('Y')){
                if($date[1] >= date('m')){
                    if($date[2] == date('d')){
                        if ($time[0] >= date('H')) {
                            return true;
                        }
                        return false;
                    }
                    elseif($date[2] > date('d')){
                        return true;
                    }
                    return false;
                }
                return false;
            }
            return true;
        }
    }