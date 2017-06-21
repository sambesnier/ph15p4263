<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 15/06/2017
 * Time: 11:49
 */

// Récupération de la liste des compétences
// Chemin vers le fichier json
$filePath = ROOT_PATH. '/src/data/competences.json';

// Récupération des données postées
$skill = filter_input(
    INPUT_POST,
    'skill',
    FILTER_SANITIZE_STRING
);

$isSubmitted = filter_has_var(
    INPUT_POST,
    'submit'
);

$index = 0;
$isClicked = false;

$errors = [];

// Récupération des données sous la forme d'un tableau
$data = json_decode(file_get_contents($filePath), true);

for ($i = 0; $i < count($data['skills']); $i++) {
    if (filter_has_var(
        INPUT_POST,
        $data['skills'][$i]
    )) {
        $index = $i;
        $isClicked = true;
    }
}

if ($isSubmitted && !$isClicked) {

    if (empty($skill)) {
        $errors[] = "Vous devez saisir une compétence";
    } else if (!in_array($skill, $data['skills'])) {
        // Traitement des données s'il n'y a pas d'erreur
        // Récupération des données sous la forme d'un tableau
        array_push($data['skills'], $skill);
        file_put_contents($filePath, json_encode($data));
        // Redirection pour éviter de reposter les données
        header("location:/?controller=home-admin");
        exit();
    } else {
        $errors[] = "Cette compétence existe déjà";
    }
}

if ($isClicked) {
    // Récupération des données sous la forme d'un tableau
    array_splice($data['skills'], $index, 1);
    $data = json_encode($data);
    file_put_contents($filePath, $data);
    header("location:/?controller=home-admin");
    exit();
}

// Récupération des données sous la forme d'un tableau
$data = json_decode(file_get_contents($filePath), true);

// Appel de la fontion renderView
renderView(
    'home-admin',
    [
        'pageTitle' => 'Interface d\'administration',
        'skills' => $data['skills'],
        'errors' => $errors
    ]
);