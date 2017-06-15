<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 15/06/2017
 * Time: 16:29
 */


// Récupération de la liste des compétences
// Chemin vers le fichier json
$filePath = ROOT_PATH. '/src/data/quiz.json';

// Récupération des données sous la forme d'un tableau
$data = json_decode(file_get_contents($filePath), true);

$size = count($data['quiz']);



// Appel de la fontion renderView
renderView(
    'quiz',
    [
        'pageTitle' => 'Quiz',
        'quiz' => $data['quiz']
    ]
);
