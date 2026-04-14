<?php

namespace App\Controller;

use App\Service\TypeService;
use App\Controller\AbstractController;

class HomeController extends AbstractController {
    
    private TypeService $typeService;

    public function __construct() {
        $this->typeService = new TypeService();
    }

    // méthode d'affichage de la page d'accueil
    public function home(): mixed {
        return $this->render("home", "Accueil");
    }

    // méthode d'affichage du formulaire de signalement
    public function report(): mixed {

        if(isset($_GET)) {
            $data["report_type"] = isset($_GET["lost"]) ? 0 : 1;
        }
        // récupération des types
        $data["types"] = $this->typeService->getAllTypes();

        return $this->render("report", "Signalement", $data);
    }
}