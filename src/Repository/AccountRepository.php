<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Entity\Account;

class AccountRepository
{
    //connexion à la BDD
    private \PDO $connect;

    public function __construct()
    {
        $this->connect = Mysql::connectBdd();
    }

    public function addAccount(Account $account): Account
    {
        try {
            //1 Ecrire la requête SQL
            $sql = "INSERT INTO `account`(user_name, user_email, user_pwd, created_at, updated_at) VALUE(?,?,?,?,?)";
            //2 Préparation de la requête
            $req = $this->connect->prepare($sql);
            //3 Assignation des paramètres
            $date = date('Y-m-d H:i:s');
            $req->bindValue(1, $account->getName(),\PDO::PARAM_STR);
            $req->bindValue(2, $account->getEmail(),\PDO::PARAM_STR);
            $req->bindValue(3, $account->getPassword(),\PDO::PARAM_STR);
            $req->bindParam(4, $date,\PDO::PARAM_STR);
            $req->bindParam(5, $date,\PDO::PARAM_STR);
            //4 Exécuter la requête
            $req->execute();
            //5 retourner (id account)
            $id = $this->connect->lastInsertId();
            //6 Setter id (account)
            $account->setId($id);
        } catch(\PDOException $e) {}
        return $account;
    }

    public function isAccountExistsByEmail(string $email): bool 
    {
        try  {
            //1 Ecrire la requête SQL
            $sql = "SELECT a.id FROM account AS a WHERE a.email = ?";
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

    public function findAccountByEmail(string $email): ?Account
    {
        try {
            //1 Ecrire la requête,
            $sql = "SELECT a.id, a.firstname, a.lastname, a.email, a.password, a.image FROM account AS a
            WHERE a.email = ?";
            //2 Préparer la requête,
            $req = $this->connect->prepare($sql);
            //3 Assigner le paramètre,
            $req->bindParam(1, $email, \PDO::PARAM_STR);
            //4 Exécuter la requête,
            $req->execute();
            //5 Fetch en FETCH assoc,
            $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Account::class);
            $account = $req->fetch();
            //6 retourner le résultat du Fetch.
            if (isset($account) && $account == true) {
                return $account;
            }
            return null;
        } catch(\PDOException $e) {}
        return null;
    }
}

