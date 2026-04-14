<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Entity\Type;

class TypeRepository {
    
    //connexion à la BDD
    private \PDO $connect;

    public function __construct() {
        $this->connect = Mysql::connectBdd();
    }

    public function addType(Type $type): Type {
        try {
            //1 Ecrire la requête SQL
            $sql = "INSERT INTO `type`(pet_type) VALUE(?)";
            //2 Préparation de la requête
            $req = $this->connect->prepare($sql);
            //3 Assignation des paramètres
            $req->bindParam(1, $type->getType(), \PDO::PARAM_STR);
            //4 Exécuter la requête
            $req->execute();
            //5 retourner (id account)
            $id = $this->connect->lastInsertId();
            //6 Setter id (type)
            $type->setId($id);
        } catch(\PDOException $e) {}
        return $type;
    }

    public function isTypeExistsByName(string $name): bool {
        try {
            //1 Ecrire la requête
            $sql = "SELECT t.id_type FROM `type` AS t WHERE t.pet_type = ?";
            //2 préparer la requête
            $req = $this->connect->prepare($sql);
            //3 Assigner le paramètre
            $req->bindParam(1, $name, \PDO::PARAM_STR);
            //4 Exécuter la requête
            $req->execute();
            //5 récupérer la réponse
            $type = $req->fetch(\PDO::FETCH_ASSOC);
            //test si existe -> true sinon false
            if(!empty($type)) return true;
        } catch(\PDOException $e) {}
        return false;
    }

    public function findAllType(): array {
        try {
            //1 Ecrire la requête
            $sql = "SELECT t.id_type, t.pet_type FROM `type` AS t ORDER BY t.id_type";
            //2 Préparer la requête
            $req = $this->connect->prepare($sql);
            //3 Exécuter la requête
            $req->execute();
            //4 Récupérer la réponse (tableau indexé contenant des tableaux associatifs)
            $types = $req->fetchAll(\PDO::FETCH_ASSOC);
            //5 tableau vide (qui va contenir les objets Type)
            $arrayTypes = [];
            //6 Parcours de la réponse FetchAll
            foreach ($types as $type) {
                //7 hydrater le tableau associatif en objet Type
                $arrayTypes[] = $this->hydrateType($type);
            }
        } catch(\PDOException $e) {}
        return $arrayTypes;
    }

    /**
     * Méthode pour Hydrater en Type
     * @param array $row ligne d'enregistrement SQL
     * @return Type Objet Type
     */
    public function hydrateType(array $row): Type {
        $type = new Type($row["pet_type"]);
        $type->setId($row["id_type"]);
        return $type;
    }
}