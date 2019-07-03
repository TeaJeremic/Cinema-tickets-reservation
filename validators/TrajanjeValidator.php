<?php
    namespace App\Validators;

    use App\Core\Validator;
    use App\Core\StringValidator;
    use App\Core\NumberValidator;

    class TrajanjeValidator extends StringValidator {
        public function matchPattern(string $value) {
            if(!\preg_match( '|[0-9]{2,}|', $value)){
                return false;
            }
            return $this->isValid($value);
        }
    }