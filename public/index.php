<?php

include '../vendor/autoload.php';
//démarrage de la session
session_start();

//Charger les variables d'environnement
$dotenv = Dotenv\Dotenv::createImmutable("../");
$dotenv->load();

//Récupération de l'URL
$url = parse_url($_SERVER['REQUEST_URI']);
//test soit l'url a une route sinon on renvoi à la racine
$path = isset($url['path']) ? $url['path'] : '/';

//Importer les controllers
use App\Controller\HomeController;
use App\Controller\SecurityController;

//instancier les controllers
$homeController = new HomeController();
$securityController = new SecurityController();

?>

<!DOCTYPE html>
<html lang="fr">

<?php include '../template/component/head.php'; ?>

<body>

    <?php include '../template/component/animalert.php';

        //Routeur (test)
        switch ($path) {
            case '/':
                $homeController->index();
                break;
            case '/register':
                $securityController->createAccount();
                break;
            case '/login':
                $securityController->connexion();
                break;
            case '/logout':
                $securityController->deconnexion();
                break;
            default:
                echo "404 la page n'existe pas";
                break;
        }

    include '../template/component/footer.php'; ?>

</body>
</html>