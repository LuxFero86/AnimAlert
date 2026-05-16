<?php

namespace App\Repository;

use DateTime;
use App\Database\Mysql;
use App\Entity\Report;

class ReportRepository {
    
    //connexion à la BDD
    private \PDO $connect;

    public function __construct() {
        $this->connect = Mysql::connectBdd();
    }

    private function strOrNull(?string $value): int {
        return $value === null ? \PDO::PARAM_NULL : \PDO::PARAM_STR;
    }

    public function saveReport(Report $report): Report {
        try {
            //1 Ecrire la requête SQL
            $sql = "INSERT INTO report(
                report_type,
                location,
                `comment`,
                is_deceased,
                reported_at,
                created_at,
                updated_at,
                finish_on,
                `status`,
                pet_id,
                account_id)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            //2 Préparation de la requête
            $req = $this->connect->prepare($sql);
            //3 Assignation des paramètres
            $date = (new DateTime())->format('Y-m-d');
            $finish = (new DateTime())->modify('+1 month')->format('Y-m-d');
            $req->bindValue(1, $report->getType(),\PDO::PARAM_BOOL);
            $req->bindValue(2, $report->getLocation(),\PDO::PARAM_STR);
            $req->bindValue(3, $report->getComment(),$this->strOrNull($report->getComment()));
            $req->bindValue(4, $report->getIsDeceased(),\PDO::PARAM_BOOL);
            $req->bindValue(5, $report->getReportedAt(),\PDO::PARAM_STR);
            $req->bindParam(6, $date,\PDO::PARAM_STR);
            $req->bindParam(7, $date,\PDO::PARAM_STR);
            $req->bindParam(8, $finish,\PDO::PARAM_STR);
            $req->bindValue(9, true,\PDO::PARAM_BOOL);
            $req->bindValue(10, $report->getPet(),\PDO::PARAM_INT);
            $req->bindValue(11, null,\PDO::PARAM_NULL);
            //4 Exécuter la requête
            $req->execute();
            //5 retourner (id report)
            $id = $this->connect->lastInsertId();
            //6 Setter id (report)
            $report->setId($id);
        } catch(\PDOException $e) {
            throw new \RuntimeException('Erreur BDD : ' . $e->getMessage(), 0, $e);
        }
        return $report;
    }
}
