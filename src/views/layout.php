<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 14/06/2017
 * Time: 15:39
 */
?>

<!DOCTYPE html>
<html>
<head>
	<title>
        <?= $pageTitle ?>
    </title>
	<meta charset="utf-8">
    <!-- Chargement du CSS de Bootstrap -->
    <link rel="stylesheet" href="dependancies/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dependancies/bootstrap/dist/css/bootstrap-theme.min.css">
</head>
<body class="container-fluid">

    <!-- Contenu de l'application -->
    <section class="row">
        <div class="col-md-8 col-md-offset-2">
            <?= $content ?>
        </div>
    </section>

    <!-- Chargement du Javascript de Bootstrap -->
    <script src="dependancies/jquery/dist/jquery.min.js"></script>
    <script src="dependancies/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>