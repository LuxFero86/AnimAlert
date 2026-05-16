<?php

namespace App\Controller;

abstract class AbstractController {
    
    protected function render(string $template, ?string $title, array $data = []): void {
        include_once __DIR__ . "/../../template/" . $template . ".php";
    }
}
