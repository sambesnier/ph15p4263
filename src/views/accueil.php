<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 14/06/2017
 * Time: 15:51
 */
?>

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

<h1>Accueil</h1>

<?= $now ?>
