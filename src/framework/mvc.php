<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 14/06/2017
 * Time: 16:16
 */

/**
 * @param string $view : le nom de la vue
 * @param array $data : un tableau des données passées à la vue
 * @return string : le code html de la vue
 */
function getTemplate(string $view, array $data = []) {
    // Mise en tampon du résultat de l'interprétation PHP
    // N'envoie pas de réponse HTTP implicite
    ob_start();
    // Transformation du tableau associatif des données
    // en une suite de variables
    extract($data);
    // Inclusion du fichier de la vue dans le tampon
    require ROOT_PATH."/src/views/{$view}.php";
    // Récupération du contenu du tampon dans une variable
    $content = ob_get_clean();

    return $content;
}

/**
 * Affiche le résultat d'une vue décorée par un layout
 * @param string $view : le nom de la vue
 * @param array $data : un tableau associatif des données passées à la vue
 * @param string $layout : le layout qui décorera la vue
 */
function renderView(
    string $view,
    array $data = [],
    string $layout = 'layout') {

    // Récupération du code html (interpolé) de la vue
    $viewContent = getTemplate($view, $data);

    // Ajout du rendu de la vue aux données passées au layout
    $data['content'] = $viewContent;

    // Application du layout
    $result = getTemplate($layout, $data);

    echo $result;
}

/**
 * Fonction de connexion à une base de données avec
 * la bibliothèque PDO
 * @return PDO
 */
function getPDO() {
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    return new PDO(
        DSN,
        DB_USER,
        DB_PASS, $options);
}

/**
 * Fonction d'auto chargement des classes utilisées par spl_autoload_register
 * @param $className
 * @throws Exception
 */
function autoloader($className)
{
    $path = ROOT_PATH."/src/classes/{$className}.php";
    if (file_exists($path)) {
        require_once $path;
    } else {
        throw new Exception("Le fichier $path ne peut être chargé");
    }
}

/**
 * Return the authenticated user
 * @return User
 */
function getUser()
{
    if (isset($_SESSION["user"])) {
        $user = unserialize($_SESSION["user"]);
    } else {
        $user = new User();
        // Default user
        $user->setUserName("Invité")->setRole("guest");
        $_SESSION["user"] = serialize($user);
    }
    return $user;
}