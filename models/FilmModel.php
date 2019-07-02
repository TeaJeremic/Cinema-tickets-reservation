<?php
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\StringValidator;
    use App\Validators\NumberValidator;
    use \PDO;
   

    class FilmModel extends Model {
        protected function getFields() {
            return [
                'film_id'        => new Field(
                                    (new NumberValidator())
                                        ->setInteger()
                                        ->setUnsigned()
                                        ->setMaxIntegerDigits(10), false),
                'naziv'        => new Field(
                                    (new StringValidator())
                                        ->setMinLength(1)
                                        ->setMaxLength(64)),
                'opis'         => new Field(
                                    (new StringValidator())
                                        ->setMinLength(1)
                                        ->setMaxLength(60000)),
                'kategorija'        => new Field( 
                                    (new StringValidator())
                                        ->setMinLength(1)
                                        ->setMaxLength(64)), 
                'reziser'      => new Field(
                                    (new StringValidator())
                                        ->setMinLength(1)
                                        ->setMaxLength(64)), 
                 'trajanje'         => new Field(
                    (new NumberValidator())
                        ->setInteger()
                        ->setUnsigned()
                        ->setMaxIntegerDigits(10)),
                'administrator_id'  => new Field(
                                    (new NumberValidator())
                                        ->setInteger()
                                        ->setUnsigned()
                                        ->setMaxIntegerDigits(10)), 
                'image_path'     => new Field(
                                     (new StringValidator())
                                        ->setMinLength(1)
                                        ->setMaxLength(255))
                    
                        
            ];
        }

        public function getAllSorted() {
            $pdo = $this->getDatabaseConnection()->getConnection();
            $sql = 'SELECT * FROM film ORDER BY naziv DESC;';
            $prep = $pdo->prepare($sql);
            $items = [];

            if ($prep) {
                $res = $prep->execute();

                if ($res) {
                    $items = $prep->fetchAll(PDO::FETCH_OBJ);
                }
            }

            return $items;
        }

        public function getAllBySearch($keyword) {
            $sql = 'SELECT
                        *
                    FROM
                        film;';
                    
            
            $prep = $this->getDatabaseConnection()->getConnection()->prepare($sql);

            $res = $prep->execute([ '%' . $keyword . '%' ]);

            if ($res) {
                return $prep->fetchAll(\PDO::FETCH_OBJ);
            }

            return [];
        }
    }
