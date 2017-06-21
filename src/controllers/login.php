<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 15/06/2017
 * Time: 10:28
 */

// Récupération des données postées
$login = filter_input(
    INPUT_POST,
    'login',
    FILTER_SANITIZE_STRING
);

$password = filter_input(
    INPUT_POST,
    'password',
    FILTER_SANITIZE_STRING
);

$isSubmitted = filter_has_var(
    INPUT_POST,
    'submit'
);

$errors = [];

// Validation des données si le formulaire est soumi
if ($isSubmitted) {

    if (empty($login)) {
        $errors[] = "Vous devez saisir un identifiant";
    }
    if (empty($password)) {
        $errors[] = "Vous devez saisir un mot de passe";
    } else {

    }

    // Traitement des données s'il n'y a pas d'erreur
    if (count($errors) == 0) {
        $ok = $login == "admin" && $password == "123";

        if ($ok) {
            // Définition des variables de session
            $_SESSION['role'] = 'admin';
            $_SESSION['userName'] = 'Administrateur';

            // Redirection
            header(
                "location:/?controller=home-admin"
            );
        } else {
            $errors[] = "Vos informations d'identification sont incorrectes";
        }
    }
}

// Appel de la fontion renderView
renderView(
    'login',
    [
        'pageTitle' => 'Login administration',
        'errors' =>$errors,
        'login' => $login
    ]
);