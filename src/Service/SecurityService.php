<?php

namespace App\Service;

use App\Entity\Account;
use App\Repository\AccountRepository;
use App\Utils\Tools;

class SecurityService {
    private AccountRepository $accountRepository;

    public function __construct() {
        $this->accountRepository = new AccountRepository();
    }

    public function login(array $account): string {
        //1 vérifier si les champs sont remplis
        if (
            empty($account["usermail"]) ||
            empty($account["password"])
        ) {
            return "Veuillez remplir tous les champs du formulaire";
        }

        //2 nettoyer les données
        Tools::sanitize_array($account);

        //3 récupération du compte
        $user = $this->accountRepository->findAccountByEmail($account["usermail"]);

        //5 vérifier l'existence du compte
        if ($user == null) {
            return "Informations incorrectes !";
        }

        //6 vérification du mot de passe
        if (!$user->verifyPassword($account["password"])) {
            return "Informations incorrectes !";
        }
        // Super globale de session
        $_SESSION['connected'] = true;
        $_SESSION['username'] = $user->getName();

        return "Connexion réussie !";
    }

    public function register(array $account): string {
        //1 vérifier si les champs sont remplis
        if (
            empty($account["username"]) || 
            empty($account["usermail"]) ||
            empty($account["password"]) ||
            empty($account["confirm_password"])
        ) {
            return "Veuillez remplir tous les champs du formulaire";
        }

        //2 valider les formats
        if (!filter_var($account["usermail"], FILTER_VALIDATE_EMAIL)) {
            return "Veuillez saisir un email valide";
        }

        //3 vérifier si les 2 mots de passe sont identiques
        if ($account["password"] != $account["confirm_password"]) {
            return "Les 2 mots de passe ne sont pas identiques";
        }

        //4 nettoyer les données
        Tools::sanitize_array($account);

        //5 vérifier si le compte existe déja
        if ($this->accountRepository->isAccountExistsByEmail($account["usermail"])) {
            return "Le compte existe déja";
        }

        //6 Créer un objet Account
        $user = new Account($account["usermail"], $account["password"]);
        $user->setName($account["username"]);
        
        //7 hasher le password
        $user->hashPassword();

        //8 ajouter le compte
        $this->accountRepository->addAccount($user);

        return "Le compte : " . $user->getEmail() . " a été ajouté !";
    }

    public function logout(): void {
        //détruire la session
        session_destroy();
        //Supprime le cookie
        unset($_COOKIE["PHPSESSID"]);
        //Redirection vers accueil
        header('Location: /');
        //echo "déconnecté";
        //header("Refresh:2; url=/");
    }
}
