<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 20/06/2017
 * Time: 11:31
 */

$connexion = getPDO();

$errors = [];

$title = "Nouvelle Matière";
$action = "Ajouter";

// Récupération des données postées
$matiere = filter_input(
    INPUT_POST,
    'matiere',
    FILTER_SANITIZE_STRING
);

$matiere_name = filter_input(
    INPUT_POST,
    'matiere_name',
    FILTER_SANITIZE_STRING
);

$isSubmitted = filter_has_var(
    INPUT_POST,
    'submit'
);

if ($isSubmitted) {
    $token = filter_input(INPUT_POST, 'token', FILTER_DEFAULT);
    $valid = $valid & ($token == $_SESSION['token']);
    try {
        if (empty($matiere_name)) {
            // Nouvelle matière
            var_dump('new');
            $sql = "INSERT INTO matieres (matiere) VALUES (:matiere)";
            $statement = $connexion->prepare($sql);
            $statement->execute(['matiere' => $matiere]);
            $_SESSION["flash"] = "Matière bien ajoutée";
        } else {
            // Modification de matière
            $sql = "UPDATE matieres SET matiere=:matiere WHERE matiere=:name";
            $statement = $connexion->prepare($sql);
            $statement->execute(['matiere' => $matiere, 'name' => $matiere_name]);
            $_SESSION["flash"] = "Matière modifiée";
        }
    } catch (PDOException $e) {
        $_SESSION["flash"] = "Requête impossible";
    }
    header("location:/?controller=matiere");
}

// Gestion de la modification d'une matière
$itemUpdate = filter_input(INPUT_GET,'itemUpdate', FILTER_VALIDATE_INT);
$itemName = filter_input(INPUT_GET,'itemName', FILTER_SANITIZE_STRING);

if($itemUpdate >0){
    $title = "Modification de la matière : $itemName";
    $action = "Modifier";
}

// Génération d'un token de protection contre les attaques CSRF
// Cross Site Request Forgery
$token = uniqid();
$_SESSION['token'] = $token;

// Appel de la fontion renderView
renderView(
    'form-matiere',
    [
        'pageTitle' => $title,
        'action' => $action,
        'value' => $itemName,
        'id' => $token,
        'errors' => $errors
    ]
);