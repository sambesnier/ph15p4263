<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 15/06/2017
 * Time: 10:23
 */
?>

<form method="post">
    <div class="form-group">
        <label>Votre identifiant</label>
        <input type="text" name="login" class="form-control" value="<?= $login ?>" required>
    </div>
    <div class="form-group">
        <label>Votre mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-success">Valider</button>
    </div>

    <?php if (count($errors) > 0) : ?>
    <div class="alert alert-danger">
        <ul>
        <?php foreach ($errors as $error) : ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

</form>
