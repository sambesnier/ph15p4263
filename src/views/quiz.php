<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 15/06/2017
 * Time: 16:28
 */
?>

<h1>Quiz</h1>

<h2>Questions</h2>

<?php if (!empty($correction)) : ?>
    <div class="alert alert-success">
        Félicitations, vous avez obtenu un score de <?= end($correction)['score'] ?>/<?= end($correction)['total'] ?> !
    </div>
<?php endif; ?>

<form method="post">
    <?php foreach ($quiz as $num => $ask) : ?>
        <h3><?= $ask['question'] ?></h3>
        <?php if (!empty($correction)) : ?>
            Bonne réponse : 
            <p style="<?= $correction[$num]['reponse']['good']=="yes"?
            'color: green':
            'color:red'; ?>">
                <?= $correction[$num]['reponse']['rightAnswer'] ?>
            </p>
        <?php endif; ?>
        <div class="form-group">
        <?php foreach ($ask['reponses'][0] as $key => $rep) : ?>
            <input type="radio" name="question<?= $num+1 ?>" value="<?= $key ?>" required> <?= $rep ?><br>
        <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
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