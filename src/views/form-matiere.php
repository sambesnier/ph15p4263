<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 20/06/2017
 * Time: 11:31
 */
?>

<form method="post">
    <div class="form-group">
        <label><?= $pageTitle ?></label>
        <input type="text" name="matiere" class="form-control" value="<?= empty($value)?"":$value ?>" required>
        <input type="text" name="matiere_name" class="hidden" value="<?= empty($value)?"":$value ?>">
        <input type="hidden" name="token" value="<?= $token ?>">
    </div>
    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-success"><?= $action ?></button>
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
