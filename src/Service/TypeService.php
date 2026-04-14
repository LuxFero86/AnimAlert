<?php

namespace App\Service;

use App\Entity\Type;
use App\Repository\TypeRepository;

class TypeService {
    
    private TypeRepository $typeRepository;

    public function __construct() {
        $this->typeRepository = new TypeRepository();
    }

    public function getAllTypes(): array {
        return $this->typeRepository->findAllType();
    }
    
    public function insertType(array $type): string {
        // vérifier que le champ soit rempli
        if (empty($type["pet_type"])) {
            return "Veuillez remplir le champ !";
        }
        // vérifier si le type existe déjà
        if ($this->typeRepository->isTypeExistsByName($type["pet_type"])) {
            return "Le type existe déjà !";
        }
        // créer un objet Type
        $typ = new Type($type["pet_type"]);
        // ajouter l'objet en base de données
        $this->typeRepository->addType($typ);

        return "Le type : ".$typ->getType().", a été ajouté !";
    }
}