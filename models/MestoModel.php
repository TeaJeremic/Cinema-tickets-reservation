<?php
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\StringValidator;
    use App\Validators\BitValidator;
    use \PDO;

    class MestoModel extends Model {
        protected function getFields() {
            return [
                'mesto_id'          => new Field(
                                        (new NumberValidator())
                                            ->setInteger()
                                            ->setUnsigned()
                                            ->setMaxIntegerDigits(10), false),
                'sala_id'           => new Field(
                                        (new NumberValidator())
                                            ->setInteger()
                                            ->setUnsigned()
                                            ->setMaxIntegerDigits(10)),
                'red'               => new Field(
                                        (new StringValidator())
                                            ->setMinLength(1)
                                            ->setMaxLength(64)),
                'broj_sedista'      => new Field(
                                    (new NumberValidator())
                                    ->setInteger()
                                    ->setUnsigned()
                                    ->setMaxIntegerDigits(3)),
                'is_active'          => new Field(
                                    (new BitValidator())),
                'projekcija_id'     => new Field(
                                    (new NumberValidator())
                                        ->setInteger()
                                        ->setUnsigned()
                                        ->setMaxIntegerDigits(10))
            ];
        }

        public function getAllReservedSeats($projekcija_id) {
            $tableName = $this->getTableName();
            $pdo = $this->getDatabaseConnection()->getConnection();
            $sql = 'SELECT red, broj_sedista FROM mesto WHERE is_active = 0 AND projekcija_id =' . $projekcija_id . ' ;';
            $prep = $pdo->prepare($sql);
            $items = [];

            if ($prep) {
                $res = $prep->execute( [$projekcija_id] );

                if ($res) {
                    $items = $prep->fetchAll(PDO::FETCH_OBJ);
                }
            }

            return $items;
        }
    }
