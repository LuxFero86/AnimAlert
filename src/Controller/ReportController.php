<?php

namespace App\Controller;

use App\Service\ReportService;
use App\Controller\AbstractController;

class ReportController extends AbstractController {
    
    private ReportService $reportService;

    public function __construct() {
        $this->reportService = new ReportService();
    }

    public function post(): mixed {
        $data["report_msg"] = $this->reportService->addReport();

        return $this->render("post", "Enregistrement", $data);
    }
}
