<?php
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\DateTimeValidator;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    use App\Validators\BitValidator;

    class AdministratorModel extends Model {
        protected function getFields() {
            return [
                'administrator_id'        => new Field(
                                    (new NumberValidator())
                                        ->setInteger()
                                        ->setUnsigned()
                                        ->setMaxIntegerDigits(11), false),
               'username'       => new Field(
                                        (new StringValidator())
                                            ->setMinLength(1)
                                            ->setMaxLength(64)),
                'password'        => new Field(
                                        (new StringValidator())
                                            ->setMinLength(1)
                                            ->setMaxLength(128)),
                ];
        }
    }
