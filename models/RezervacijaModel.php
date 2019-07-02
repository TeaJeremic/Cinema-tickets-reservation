<?php
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    use App\Validators\DateTimeValidator;

    class RezervacijaModel extends Model {
        protected function getFields() {
            return [
                'rezervacija_id'    => new Field(
                                    (new NumberValidator())
                                        ->setInteger()
                                        ->setUnsigned()
                                        ->setMaxIntegerDigits(10), false),
                'created_at'        => new Field(new DateTimeValidator(), false),
                'ime_korisnika'     => new Field(
                                    (new StringValidator())
                                        ->setMinLength(1)
                                        ->setMaxLength(64)),
                'prezime_korisnika' => new Field(
                                    (new StringValidator())
                                        ->setMinLength(1)
                                        ->setMaxLength(64)),
                'broj_telefona'     => new Field(
                                    (new StringValidator())
                                        ->setMinLength(6)
                                        ->setMaxLength(12)),
                ];
        }

        public function getAllByProjekcijaId(int $projekcijaId): array {
            return $this->getAllByFieldName('projekcija_id', $projekcijaId);
        }
    }
