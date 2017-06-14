<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 14/06/2017
 * Time: 14:20
 */

// Récupération du contrôleur
$controllerName = $_GET['controller'];

define('ROOT_PATH', dirname(__DIR__));

require ROOT_PATH.'/src/controllers/'.$controllerName.'.php';