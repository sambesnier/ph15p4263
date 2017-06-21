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

    <!-- Navigation principale -->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Projet web</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="/?controller=quiz">Quiz</span></a></li>
                    <li><a href="/?controller=matiere">Matières</span></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        $role = isset($_SESSION["role"])?$_SESSION["role"]:"";
                        $userName = isset($_SESSION["userName"])?$_SESSION["userName"]:"Invité";
                    ?>
                    <li class="navbar-text">Bonjour <?= $userName ?></li>
                    <?php if (!empty($role)) : ?>
                        <?php if ($role == 'admin') : ?>
                            <li><a href="/?controller=home-admin">Accès admin</a></li>
                        <?php endif; ?>
                        <li><a href="/?controller=logout">Déconnexion</a></li>
                    <?php else : ?>
                        <li><a href="/?controller=login">Connexion</a></li>
                        <li><a href="/?controller=inscription">Inscription</a></li>
                    <?php endif; ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <!-- Affichage des mesages flash -->
    <?php if (isset($_SESSION['flash'])) : ?>
        <div class="row">
            <div class="col-md-6 col-md-offset-3 alert alert-info">
                <?php
                echo $_SESSION["flash"];

                unset($_SESSION["flash"]);
                ?>
            </div>
        </div>
    <?php endif; ?>

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