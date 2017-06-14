<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 14/06/2017
 * Time: 14:20
 */

// Récupération du contrôleur
$controllerName = $_GET['controller'];

// Définition du dossier racine du projet
define('ROOT_PATH', dirname(__DIR__));

// Définition du chemin du contrôleur
$controllerPath = ROOT_PATH.'/src/controllers/'.$controllerName.'.php';

// Test de l'existence du contrôleur
if(! file_exists($controllerPath)) {
    // Envoi vers le fichier erreur
    $controllerPath = ROOT_PATH.'/src/controllers/erreur.php';
}

// Éxecution du contrôleur
require $controllerPath;