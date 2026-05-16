<?php

namespace App\Repository;

use DateTime;
use App\Database\Mysql;
use App\Entity\Image;

class ImageRepository {
    
    //connexion à la BDD
    private \PDO $connect;

    public function __construct() {
        $this->connect = Mysql::connectBdd();
    }

    public function saveImage(Image $image): Image {
        try {
            //1 Ecrire la requête SQL
            $sql = "INSERT INTO image(
                stored_name,
                width,
                height,
                file_size,
                created_at,
                pet_id)
            VALUES(?, ?, ?, ?, ?, ?)";
            //2 Préparation de la requête
            $req = $this->connect->prepare($sql);
            //3 Assignation des paramètres
            $date = (new DateTime())->format('Y-m-d');
            $req->bindValue(1, $image->getName(),\PDO::PARAM_STR);
            $req->bindValue(2, $image->getWidth(),\PDO::PARAM_INT);
            $req->bindValue(3, $image->getHeight(),\PDO::PARAM_INT);
            $req->bindValue(4, $image->getSize(),\PDO::PARAM_INT);
            $req->bindParam(5, $date,\PDO::PARAM_STR);
            $req->bindValue(6, $image->getPet(),\PDO::PARAM_INT);
            //4 Exécuter la requête
            $req->execute();
            //5 retourner (id image)
            $id = $this->connect->lastInsertId();
            //6 Setter id (image)
            $image->setId($id);
        } catch(\PDOException $e) {}
        return $image;
    }
}
