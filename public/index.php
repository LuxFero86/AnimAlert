<?php

include_once '../vendor/autoload.php';

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
use App\Controller\ReportController;
use App\Controller\SecurityController;

//instancier les controllers
$homeController = new HomeController();
$reportController = new ReportController();
$securityController = new SecurityController();

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Signalez et retrouvez des animaux perdus ou errants grâce à une application web mobile sécurisée, simple et centralisée partout en France.">
        <link rel="preload" fetchpriority="high" as="image" href="assets/media/dark_theme/AnimAlert_500x139.webp" type="image/webp">
        <link rel="stylesheet" href="assets/style/main.css">
        <?php if($path != '/'): ?>
            <link rel="stylesheet" href="assets/style/<?= $url['path'] ?>.css">
        <?php endif ?>
        <script type="module" src="assets/script/<?= $path != '/' ? $path : "main" ?>.js" defer></script>
        <title><?= $title ?? "AnimAlert" ?></title>
    </head>

    <body>
        <div class="app">

            <?php

            include_once '../template/component/header.php';

                //Routeur (test)
                switch ($path) {
                    case '/':
                        $homeController->home();
                        break;
                    case '/report':
                        $homeController->report();
                        break;
                    case '/post':
                        $reportController->post();
                        break;
                    case '/login':
                        $securityController->connexion();
                        break;
                    case '/register':
                        $securityController->createAccount();
                        break;
                    case '/logout':
                        $securityController->deconnexion();
                        break;
                    case '/profile':
                        $securityController->profile();
                        break;
                    default:
                        echo "404 la page n'existe pas";
                        break;
                }

            include_once '../template/component/footer.php'; ?>

        </div>
    </body>
</html>
