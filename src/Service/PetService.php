<?php

namespace App\Service;

use App\Entity\Pet;
use App\Entity\Image;
use App\Service\ImageService;
use App\Repository\PetRepository;
use App\Utils\Tools;

class PetService {

    private ImageService $imageService;
    private PetRepository $petRepository;

    public function __construct() {
        $this->imageService = new ImageService();
        $this->petRepository = new PetRepository();
    }

    public function addPet(): mixed {

        // Ajout de l'animal

        // Traitement des données obligatoires
        $petType = Tools::sanitizeInt($_POST['pet_type']);

        // Traitement des données facultatives
        $petName = isset($_POST['pet_name']) ? Tools::sanitizeString($_POST['pet_name']) : null;
        $petAge = filter_var($_POST['pet_age'] ?? null, FILTER_VALIDATE_INT);
        $petAge = $petAge !== false ? Tools::sanitizeInt($petAge) : null;
        $petSex = isset($_POST['pet_sex']) ? Tools::sanitizeBool($_POST['pet_sex']) : null;
        $petBreed = isset($_POST['pet_breed']) ? Tools::sanitizeString($_POST['pet_breed']) : null;
        $petCoat = isset($_POST['pet_coat']) ? Tools::sanitizeString($_POST['pet_coat']) : null;

        // Création d'un objet Pet
        $pet = new Pet($petType);
        $pet->setName($petName)
            ->setAge($petAge)
            ->setSex($petSex)
            ->setBreed($petBreed)
            ->setCoat($petCoat);
        
        // Enregistrement de l'animal en BDD
        $this->petRepository->savePet($pet);
        
        // Traitement de l'image si ajoutée
        if (isset($_FILES['file_input']) && $_FILES['file_input']['error'] === UPLOAD_ERR_OK) {
            $upload = $this->imageService->addImage($pet->getId());
            if (!$upload instanceof Image) {
                return $upload;
            }
        }

        return $pet;
    }
}
