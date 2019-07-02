<?php
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\StringValidator;
    use App\Validators\BitValidator;
    use \PDO;

    class ProjekcijaModel extends Model {
        protected function getFields() {
            return [
                'projekcija_id'     => new Field(
                                        (new NumberValidator())
                                            ->setInteger()
                                            ->setUnsigned()
                                            ->setMaxIntegerDigits(10), false),
                'termin_at'         => new Field(new DateTimeValidator()),
                'film_id'           => new Field(
                                        (new NumberValidator())
                                             ->setInteger()
                                             ->setUnsigned()
                                             ->setMaxIntegerDigits(10)),
                'sala_id'           => new Field(
                                         (new NumberValidator())
                                             ->setInteger()
                                             ->setUnsigned()
                                             ->setMaxIntegerDigits(10)),
                'is_active'           => new Field(
                                                (new BitValidator()))
                                                                                
                
            ];
        }

        public function getAllActiveByFilmId($filmId) {
            $pdo = $this->getDatabaseConnection()->getConnection();
            $sql = 'SELECT * FROM projekcija WHERE is_active = 1 AND film_id =' . $filmId  .';';
            $prep = $pdo->prepare($sql);
            $items = [];

            if ($prep) {
                $res = $prep->execute( [$filmId] );

                if ($res) {
                    $items = $prep->fetchAll(PDO::FETCH_OBJ);
                }
            }

            return $items;
        }

        public function getAllByFilmId(int $filmId): array {
            return $this->getAllByFieldName('film_id', $filmId);
        }

        public function isActive($projekcija) {
            if (!$projekcija) {
                return false;
            }

            if ($projekcija->is_active == 0) {
                return false;
            }

            if ( \strtotime($projekcija->termin_at) > time() ) {
                return false;
            }        

            return true;
        }

        
    }
