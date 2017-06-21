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
        // Connexion à la base de données pour vérifier l'authentification
        $connexion = getPDO();
        $sql = "SELECT CONCAT_WS(' ',p.prenom, p.nom) AS username, u.role
                FROM utilisateurs AS u INNER JOIN personnes AS p
                ON p.personne_id=u.personne_id
                WHERE u.email=? AND u.mot_de_passe=?";

        $statement = $connexion->prepare($sql);

        $statement->execute([$login, sha1($password)]);

        $rs = $statement->fetch(PDO::FETCH_ASSOC);

        $ok = count($rs) > 0;

        if ($ok) {
            // Définition des variables de session
            $_SESSION['role'] = $rs['role'];
            $_SESSION['userName'] = $rs['username'];

            $redirections = [
                "admin" => "home-admin",
                "stagiaire" => "home-stagiaire",
                "formateur" => "home-formateur"
            ];

            $cible = $redirections[$rs['role']] ?? "accueil";

            // Redirection
            header(
                "location:/?controller=$cible"
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