<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Entity\Account;

class AccountRepository {
    
    //connexion à la BDD
    private \PDO $connect;

    public function __construct() {
        $this->connect = Mysql::connectBdd();
    }

    public function addAccount(Account $account): Account {
        try {
            //1 Ecrire la requête SQL
            $sql = "INSERT INTO `account`(
                user_name,
                user_email,
                user_pwd,
                created_at,
                updated_at,
                `status`,
                role_id)
            VALUE(?, ?, ?, ?, ?, ?, ?)";
            //2 Préparation de la requête
            $req = $this->connect->prepare($sql);
            //3 Assignation des paramètres
            $date = date('Y-m-d');
            $req->bindValue(1, $account->getName(),\PDO::PARAM_STR);
            $req->bindValue(2, $account->getEmail(),\PDO::PARAM_STR);
            $req->bindValue(3, $account->getPassword(),\PDO::PARAM_STR);
            $req->bindParam(4, $date,\PDO::PARAM_STR);
            $req->bindParam(5, $date,\PDO::PARAM_STR);
            $req->bindValue(6, true,\PDO::PARAM_BOOL);
            $req->bindValue(7, 1,\PDO::PARAM_INT);
            //4 Exécuter la requête
            $req->execute();
            //5 retourner (id account)
            $id = $this->connect->lastInsertId();
            //6 Setter id (account)
            $account->setId($id);
        } catch(\PDOException $e) {}
        return $account;
    }

    public function isAccountExistsByEmail(string $email): bool {
        try  {
            //1 Ecrire la requête SQL
            $sql = "SELECT a.id_account FROM account AS a WHERE a.user_email = ?";
            //2 Préparer la requête,
            $req = $this->connect->prepare($sql);
            //3 Assigner le paramètre,
            $req->bindParam(1, $email, \PDO::PARAM_STR);
            //4 Exécuter la requête,
            $req->execute();
            //5 Fetch en FETCH assoc,
            $account = $req->fetch(\PDO::FETCH_ASSOC);
            //6 retourner true si tableau est non vide, sinon false,
            if (!empty($account)) return true;
        } catch(\PDOException $e) {}
        return false;
    }

    public function findAccountByEmail(string $email): ?Account {
        try {
            //1 Ecrire la requête,
            $sql = "SELECT
                a.id_account, 
                a.user_name, 
                a.user_email, 
                a.user_pwd, 
                a.created_at,
                a.updated_at,
                a.status,
                a.role_id
            FROM account AS a
            WHERE a.user_email = ?";
            //2 Préparer la requête,
            $req = $this->connect->prepare($sql);
            //3 Assigner le paramètre,
            $req->bindParam(1, $email, \PDO::PARAM_STR);
            //4 Exécuter la requête,
            $req->execute();
            //5 Fetch en FETCH assoc,
            $account = $req->fetch(\PDO::FETCH_ASSOC);
            //6 retourner le résultat du Fetch.
            if (isset($account) && $account == true) {
                //Hydratation en Account
                return $this->hydrateAccount($account);
            }
            return null;
        } catch(\PDOException $e) {}
        return null;
    }

    /**
     * Méthode pour Hydrater en Account
     * @param array $row ligne d'enregistrement SQL
     * @return Account Objet Account
     */
    public function hydrateAccount(array $row): Account {
        $account = new Account($row["user_email"], $row["user_pwd"]);
        $account
            ->setId($row["id_account"])
            ->setName($row["user_name"])
            ->setCreatedAt($row["created_at"])
            ->setUpdatedAt($row["updated_at"])
            ->setStatus($row["status"])
            ->setRole($row["role_id"]);
        return $account;
    }
}

