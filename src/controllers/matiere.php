<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 20/06/2017
 * Time: 10:21
 */

$connexion = getPDO();

$errors = [];

// Récupération des matières
$sql = "SELECT * FROM matieres ORDER BY matiere";
$rs = $connexion->query($sql);
$listMatieres = $rs->fetchAll(PDO::FETCH_ASSOC);


// Appel de la fontion renderView
renderView(
    'matiere',
    [
        'pageTitle' => 'Matières',
        'listMatieres' => [
            $listMatieres
        ],
        'errors' => $errors
    ]
);