<?php

namespace App\Repository;

use DateTime;
use App\Database\Mysql;
use App\Entity\Pet;

class PetRepository {
    
    //connexion à la BDD
    private \PDO $connect;

    public function __construct() {
        $this->connect = Mysql::connectBdd();
    }

    private function strOrNull(?string $value): int {
        return $value === null ? \PDO::PARAM_NULL : \PDO::PARAM_STR;
    }

    public function savePet(Pet $pet): Pet {
        try {
            //1 Ecrire la requête SQL
            $sql = "INSERT INTO pet(
                pet_name,
                pet_age,
                pet_sex,
                pet_breed,
                pet_coat,
                created_at,
                updated_at,
                finish_on,
                type_id,
                account_id)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            //2 Préparation de la requête
            $req = $this->connect->prepare($sql);
            //3 Assignation des paramètres
            $date = (new DateTime())->format('Y-m-d');
            $finish = (new DateTime())->modify('+1 month')->format('Y-m-d');
            $req->bindValue(1, $pet->getName(),$this->strOrNull($pet->getName()));
            $req->bindValue(2, $pet->getAge(),\PDO::PARAM_INT);
            $req->bindValue(3, $pet->getSex(),\PDO::PARAM_BOOL);
            $req->bindValue(4, $pet->getBreed(),$this->strOrNull($pet->getBreed()));
            $req->bindValue(5, $pet->getCoat(),$this->strOrNull($pet->getCoat()));
            $req->bindParam(6, $date,\PDO::PARAM_STR);
            $req->bindParam(7, $date,\PDO::PARAM_STR);
            $req->bindParam(8, $finish,\PDO::PARAM_STR);
            $req->bindValue(9, $pet->getType(),\PDO::PARAM_INT);
            $req->bindValue(10, null,\PDO::PARAM_NULL);
            //4 Exécuter la requête
            $req->execute();
            //5 retourner (id pet)
            $id = $this->connect->lastInsertId();
            //6 Setter id (pet)
            $pet->setId($id);
        } catch(\PDOException $e) {
            throw new \RuntimeException('Erreur BDD : ' . $e->getMessage(), 0, $e);
        }
        return $pet;
    }
}
