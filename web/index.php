<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 14/06/2017
 * Time: 14:20
 */

// Démarrage de la session
session_start();

// Récupération du contrôleur
if( isset($_GET['controller']) ) {
    $controllerName = $_GET['controller'];
}
else {
    $controllerName = 'accueil';
}

// Sécurisation l'accès à l'administration
session_regenerate_id(true);

$securedRoutes =
    [
        "home-admin"
    ];

$role = isset($_SESSION["role"])?$_SESSION["role"]:"";

// Si on tente d'accéder à une page sécurisée sans s'être identifié au
// au préalable alors la route est modifiée pour afficher le formulaire de login
if (in_array($controllerName, $securedRoutes) && $role != "admin") {
    header(
        "location:/?controller=login-admin"
    );
}

// Définition du dossier racine du projet
define('ROOT_PATH', dirname(__DIR__));

// Inclusion de dépendance du projet
require_once ROOT_PATH.'/src/framework/mvc.php';

// Définition du chemin du contrôleur
$controllerPath = ROOT_PATH.'/src/controllers/'.$controllerName.'.php';

// Test de l'existence du contrôleur
if(! file_exists($controllerPath)) {
    // Envoi vers le fichier erreur
    $controllerPath = ROOT_PATH.'/src/controllers/erreur.php';
}

// Éxecution du contrôleur
require $controllerPath;