<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Service\SecurityService;

class SecurityController extends AbstractController {
    private SecurityService $securityService;

    public function __construct() {
        $this->securityService = new SecurityService();
    }

    public function createAccount() : void {
        $data= [];
        if (isset($_POST["submit"])) {

            //Procédure de création
            $data["msg"] = $this->securityService->register($_POST);

            //Si ajouté/connecté -> redirection vers la connexion       
            if (str_contains($data["msg"], 'ajouté')) header("Location:/");

            //redirection
            header("Refresh:2;");
        }

        $this->render("registration","inscription", $data);
    }

    public function connexion(): void {
        $data= [];
        if (isset($_POST["submit"])) {
            
            //Procédure de connexion
            $data["msg"] = $this->securityService->login($_POST); 

            //Si connecté -> redirection vers l'accueil       
            if ($data["msg"] == "Connexion réussie !") header('Location:/');

            //redirection
            header("Refresh:2;");
        }

        $this->render("connection","connexion", $data);
    }

    public function profile(): void {
        $this->render("profile","Profil");
    }

    public function deconnexion(): void {
        $this->securityService->logout();
    }
}
