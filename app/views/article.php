<?php ob_start(); ?>

<?php include("../app/views/menu.php"); ?>

<div class="retour"><p><a href="/blog/"> <<< Retour</a></p></div>
<div class="news">

    <h4>
        <?= htmlspecialchars($post['title']) ?>
    </h4>
    <p>
        <em>le <?= $post['creation_date_fr'] ?></em><br />
        <?= nl2br(htmlspecialchars($post['contents'])) ?><br />
    </p>

    



    <?php include("../app/views/addComment.php"); ?>

    <div class="inscrip">
        <p>N'hésitez pas à vous inscrire pour laisser vos commentaires : <a href="<?=("http://localhost/blog/public/inscription") ;?>">Inscrivez-vous</a></p> <br /><br />
    </div>
</div>

<?php require('../app/views/footer.php'); ?>
<?php $content = ob_get_clean(); ?>
<?php require('../app/views/frontend/template.php'); ?>
