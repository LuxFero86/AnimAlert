<?php

namespace App\Service;

use App\Entity\Pet;
use App\Entity\Report;
use App\Service\PetService;
use App\Repository\ReportRepository;
use App\Utils\Tools;

class ReportService {

    private PetService $petService;
    private ReportRepository $reportRepository;

    public function __construct() {
        $this->petService = new PetService();
        $this->reportRepository = new ReportRepository();
    }

    public function addReport(): string {
    
        if (!isset($_POST)) {
            return "Erreur";
        }

        // Vérification des données obligatoires
        if (!isset($_POST['report_type']) ||
            !isset($_POST['report_location']) ||
            !isset($_POST['pet_type']) ||
            !isset($_POST['report_datetime'])) {
            return "Erreur";
        }
        
        // Enregistrement de l'animal
        $pet = $this->petService->addPet();
        if (!$pet instanceof Pet) {
            return $pet;
        }

        // Traitement des données obligatoires
        $reportType = Tools::sanitizeBool($_POST['report_type']);
        $reportLocation = Tools::validatePosition($_POST['report_location']);
        if ($reportLocation === null) {
            return "Erreur";
        }
        $reportDateTime = Tools::sanitizeDateTime($_POST['report_datetime']);

        // Traitement des données facultatives
        $comment = isset($_POST['comment']) ? Tools::sanitizeString($_POST['comment']) : null;
        $isDeceased = isset($_POST['is_deceased']) ? Tools::sanitizeBool($_POST['is_deceased']) : null;

        // Création d'un objet Report
        $report = new Report($reportType, $pet->getId());
        $report->setLocation($reportLocation)
            ->setComment($comment)
            ->setIsDeceased($isDeceased)
            ->setReportedAt($reportDateTime);

        // Enregistrement du signalement
        $this->reportRepository->saveReport($report);

        return "Signalement enregistré";
    }
}
