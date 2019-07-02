<?php
    namespace App\Validators;

    use App\Core\Validator;
    use App\Core\StringValidator;
    use App\Core\NumberValidator;

    class TextValidator extends StringValidator {
        public function matchPattern(string $value) {
            if(!\preg_match(, $value)){
                return false;
            }
            return $this->isValid($value);

        }
    }