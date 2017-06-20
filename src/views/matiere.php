<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 20/06/2017
 * Time: 10:22
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

<h1>Espace des matières</h1>

<h2>Liste des matières</h2>
<a href="/?controller=form-matiere" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Nouvelle Matière</a>
<br>
    <table class="table table-bordered table-striped">
        <tr>
            <th>Matière</th>
            <th>Action</th>
        </tr>
        <form method="post">
            <?php $index = 1 ?>
            <?php for ($i = 0; $i < count($listMatieres[0]); $i++) : ?>
                <tr>
                    <td><?= $listMatieres[0][$i]['matiere'] ?></td>
                    <td>
                        <a href="/?controller=delete-matiere&itemDelete=<?= $listMatieres[0][$i]['matiere'] ?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                        <a href="/?controller=form-matiere&itemUpdate=<?= $index ?>&itemName=<?= $listMatieres[0][$i]['matiere'] ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                    </td>
                </tr>
                <?php $index++ ?>
            <?php endfor; ?>
        </form>
    </table>

