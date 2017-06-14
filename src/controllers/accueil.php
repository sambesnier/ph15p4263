<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 14/06/2017
 * Time: 14:29
 */

// Appel de la fontion renderView
renderView('accueil',
    [
        'pageTitle' => 'Bienvenue sur mon site',
        'now' => date('l jS \of F Y h:i:s A')
    ]
);