<?php

namespace App\Service;

use App\Entity\Image;
use App\Repository\ImageRepository;

class ImageService {

    private ImageRepository $imageRepository;

    public function __construct() {
        $this->imageRepository = new ImageRepository();
    }

    public function addImage(int $id_pet): mixed {

        // Vérifier MIME réel
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES['file_input']['tmp_name']);

        $allowed = ['image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($mime, $allowed)) {
            return "Format non supporté";
        }

        // Nom unique final
        $storedName = uniqid('pet_', true);
        $uploadDir = __DIR__ . "/../../public/assets/media/pets/";
        $destination = $uploadDir . $storedName . '.webp';

        // Création image source
        switch ($mime) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($_FILES['file_input']['tmp_name']);
                break;
            case 'image/png':
                $source = imagecreatefrompng($_FILES['file_input']['tmp_name']);
                imagepalettetotruecolor($source);
                imagealphablending($source, true);
                imagesavealpha($source, true);
                break;
            case 'image/webp':
                $source = imagecreatefromwebp($_FILES['file_input']['tmp_name']);
                break;
            default:
                return "Format non supporté";
        }

        // Conversion WebP et enregistrement (0-100 quality)
        imagewebp($source, $destination, 75);

        // Dimensions et Taille du fichier
        $width = imagesx($source);
        $height = imagesy($source);
        $fileSize = filesize($destination);

        // Création de l'objet Image
        $image = new Image($storedName, $width, $height, $fileSize, $id_pet);

        // Enregistrement en BDD
        return $this->imageRepository->saveImage($image);
    }
}
