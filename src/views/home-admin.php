<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 15/06/2017
 * Time: 11:50
 */
?>

<h1>Espace d'administration</h1>

<h2>Liste des compétences</h2>
<div class="col-md-8">
    <table class="table table-bordered table-striped">
        <tr>
            <th>Compétence</th>
            <th></th>
        </tr>
        <form method="post">
        <?php foreach ($skills as $skill) : ?>
        <tr>
            <td><?= $skill ?></td>
            <td><button name="<?= $skill ?>" type="submit" class="btn btn-danger center-block glyphicon glyphicon-trash"></button></td>
        </tr>
        <?php endforeach; ?>
        </form>
    </table>
</div>
<div class="col-md-4 well">
    <form method="post">
        <div class="form-group">
            <label>Nouvelle compétence</label>
            <input type="text" name="skill" class="form-control" required>
        </div>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success">Ajouter</button>
        </div>
    </form>
    <?php if (count($errors) > 0) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>