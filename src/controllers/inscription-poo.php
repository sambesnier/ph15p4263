<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 26/06/2017
 * Time: 09:47
 */

// Include class
require_once ROOT_PATH.'/src/classes/Inscription.php';

// Class instanciation with injection of form data
$pdo = getPDO();
$inscription = new Inscription($_POST, getPDO());

if ($inscription->isFormSubmitted())
{
    try
    {
        $inscription->handleRequest();

        if (!$inscription->hasErrors())
        {
            $_SESSION['flash'] = "Vous êtes iscrit, vous pouvez maintenant vous identifier";
            header("location:index.php?controller=accueil");
            exit();
        }
    } catch (PDOException $e)
    {
        $pdo->rollBack();
        $_SESSION["flash"] = "Impossible de traiter les données".$e->getMessage();
    }
}

renderView(
    "inscription",
    [
        "pageTitle" => "Inscription",
        "errors" => $inscription->getErrors()
    ]
);