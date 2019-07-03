<?php
    namespace App\Validators;

    use App\Core\Validator;
    use App\Core\StringValidator;
    use App\Core\NumberValidator;

    class SlovaValidator extends StringValidator {
        public function matchPattern(string $value) {
            if(!\preg_match( '|[a-zA-Z ]{2,}|', $value)){
                return false;
            }
            return $this->isValid($value);
        }
    }