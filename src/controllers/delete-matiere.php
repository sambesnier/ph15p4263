<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 20/06/2017
 * Time: 13:01
 */

// Gestion de la suppression d'une matière
$itemDelete = filter_input(INPUT_GET,'itemDelete', FILTER_SANITIZE_STRING);

if(!empty($itemDelete)){

    try {
        $connexion = getPDO();

        $sql = "DELETE FROM matieres WHERE matiere=:matiere";

        $statement = $connexion->prepare($sql);

        $statement->execute(['matiere' => $itemDelete]);

        $_SESSION["flash"] = "Matière supprimée";
    } catch (PDOException $e) {
        $_SESSION["flash"] = "Impossible de supprimer cette matière";
    }

    //Redirection pour éviter de reposter les données
    header("location:/?controller=matiere");
}