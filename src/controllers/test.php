<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 19/06/2017
 * Time: 16:09
 */

// Récupération d'une connexion à la base de données
$connexion = getPDO();

$sql = "SELECT * FROM personnes ORDER BY nom";

$rs = $connexion->query($sql);

// Récupération ligne à ligne
/*
while ( ($ligne = $rs->fetch(PDO::FETCH_ASSOC)) !== false) {
    echo $ligne['nom']. ' ' . $ligne['prenom'] .'<br>';
}*/

// Récupération globale
$rs = $connexion->query($sql);
$donnees = $rs->fetchAll(PDO::FETCH_ASSOC);

$nbPersonnes = count($donnees);

for ($i = 0; $i < $nbPersonnes; $i++) {
    echo $donnees[$i]['nom'] . ' ' . $donnees[$i]['prenom'] . '<br>';
}

// Supprimer les inscriptions de la personne dont l'id est 1
$sql = "DELETE FROM inscription_formation WHERE personne_id = 1";
$nbSupprim = $connexion->exec($sql);
echo "<p>$nbSupprim inscriptions supprimées</p>";

// Supprimer les notes de la personne dont l'id est 1
$sql = "DELETE FROM notes WHERE personne_id = 1";
$nbSupprim = $connexion->exec($sql);
echo "<p>$nbSupprim notes supprimées</p>";

// Supprimer les ventes de la personne dont l'id est 1
$sql = "DELETE FROM ventes WHERE vendeur_id = 1";
$nbSupprim = $connexion->exec($sql);
echo "<p>$nbSupprim ventes supprimées</p>";

// Supprimer la personne dont l'id est 1
$sql = "DELETE FROM personnes WHERE personne_id = 1";
$nbSupprim = $connexion->exec($sql);
echo "<p>$nbSupprim personnes supprimées</p>";

// Éxécution d'une procédure stockée
$sql = "CALL proc_insert_personne_pdo('LENNE','Evariste', '1623-12-01')";
$connexion->exec($sql);

// Récupération de l'id de la personne créée
$id = $connexion->lastInsertId();

// Requête pour vérifier l'insertion des données
$sql = "SELECT * FROM personnes WHERE personne_id=@id";
$resultat = $connexion->query($sql);
var_dump($resultat->fetch(PDO::FETCH_ASSOC));