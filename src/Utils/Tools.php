<?php

namespace App\Utils;

use DateTime;

class Tools {

    /**
     * Méthode pour sanitize les données utilisateurs
     * @param string $str chaine de caractère à nettoyer
     * @return string chaine nettoyée
     */

    public static function sanitizeString(?string $str): ?string {
        if ($str === null) {return null;}
        $str = trim($str);
        if ($str === '') {return null;} // chaîne vide → null
        $str = strip_tags($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str, ENT_NOQUOTES);
        return $str;
    }

    /**
     * Méthode pour sanitize un entier
     * @param int $int entier à nettoyer
     * @return int entier nettoyé
     */

    public static function sanitizeInt(int &$int): int {
        $int = filter_var($int, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        return $int > 0 ?? null;
    }

    /**
     * Méthode pour sanitize un booléen
     * @param bool $bool booléen à nettoyer
     * @return bool bouléen nettoyé
     */

    public static function sanitizeBool(bool &$bool): bool {
        $bool = filter_var($bool, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        return $bool;
    }

    /**
     * Méthode pour sanitize un tableau
     * @param array $data 
     * @return array $data retourne le tableau sanitize
     */

    public static function sanitizeArray(array &$data): array {
        //Boucle pour itérer sur le tableau $data
        foreach ($data as $key => $value) {
            //Test si la valeur est de type string
            if (gettype($value) == "string") {
                $data[$key] = self::sanitize($value);
            }
            //Test si $value est un tableau
            if (gettype($value) == "array") {
                //nettoyage du sous tableau
                foreach ($value as $cle => $contenu) {
                    $data[$key][$cle] = self::sanitize($contenu);
                }
            }
        }
        return $data;
    }

    /**
     * Méthode pour vérifier des coordonnées géographiques
     * @param string $input chaine de caractère à vérifier
     * @return bool renvoie true si ok
     */
    
    public static function validatePosition(string $input): ?string {
        // Regex pour extraire les valeurs
        $pattern = '/Lat\.\s*(-?\d+(\.\d+)?),\s*Lon\.\s*(-?\d+(\.\d+)?)/';

        if (!preg_match($pattern, $input, $matches)) {
            return null;
        }

        $lat = (float) $matches[1];
        $lon = (float) $matches[3];

        // Validation des plages GPS
        if ($lat < -90 || $lat > 90 || $lon < -180 || $lon > 180) {
            return null;
        }

        return $matches[1] . ', ' . $matches[3];
    }

    /**
     * Méthode pour sanitize une datetime-local
     * @param string $value datetime-local à nettoyer
     * @return string date nettoyée et reformatée
     */

    public static function sanitizeDateTime(string $value): ?string {
    
        $value = trim($value);
        $date = DateTime::createFromFormat('Y-m-d\TH:i', $value);

        if (
            $date === false ||
            $date->format('Y-m-d\TH:i') !== $value
        ) {
            return null;
        }

        return $date->format('Y-m-d H:i:s');
    }

    /**
     * Méthode qui retourne l'extension d'un fichier
     * @param string $file nom du fichier
     * @return string extension du fichier
     */

    public static function getFileExtension($file) {
        return strtolower(substr(strrchr($file, '.'), 1));
    }
}