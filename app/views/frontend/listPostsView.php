<?php  @session_start();
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
?>
<?php ob_start(); ?>


<?php $title = 'Mon blog'; ?>
<?php require('../app/model/Model.php'); ?>
<?php require("../app/model/Post.php"); ?>
<!-- <Menu -->
<?php include("../app/view/menu.php"); ?>

<!--banniere ----------------------------------------->
<?php include("../app/view/banniere.php"); ?>

                  <!--A PROPOS DE MOI ----------------------------------------->
  <div class="container" id="moi">
        <div class="row">
          <div class="col-12 col-lg-12">
             <div class="texte1">
               <h2>A propos de moi</h2>
               <p>Je m'appelle Tatiana RILCY et mes expériences professionnelles au sein de différents services m'ont permis d'acquérir des connaissances variées et surtout une bonne capacité d'adaptation à différents environnements de travail. </p>
               <p> Ayant été Chef de projet digital, Consultante MOA, Business Analyst, je souhaite actuellement enrichir mes compétences techniques, en suivant une formation de "Développeur application PHP" chez Openclassroom. </p>
              <p>Cette formation m'a déjà beaucoup apportée avec la réalisation de différents projets, comme :
                 <ul>
                   <li>la création du prototype d'un site en HTML et CSS</li>
                   <li>la création de schéma UML et Base de données MySQL avec un jeu de données de démo</li>
                   <li>la création d'un blog en PHP</li>
                 </ul>
              </p><br />
              <p>
                Vous souhaitez en savoir plus sur mon parcours professionnel et personnel, n'hésitez pas à consulter mon <a class="nav-link" href="cv/cv_developpeuse_php.pdf"><b>Curriculum Vitae</b></a>
              </p>
             </div>
          </div>
        </div>
  </div>
  <div class="partage">
    <p>Je partage ici des sujets variés qui retiennent mon attention.</p>
  </div>


<?php
foreach ($posts as $post) {
?>

    <div class="news">
        <h4>
            <?= htmlspecialchars($post['title']) ?>
        </h4>

        <p>
            <em>le <?= $post['creation_date_fr'] ?></em><br />
            <?= nl2br(htmlspecialchars($post['content'])) ?>
            <br />
            <em><a href="../public/index.php?action=post&amp;id=<?= $post['id'] ?>">Lire la suite</a></em>
        </p>
    </div>
<?php
}
?>

<?php include('../app/view/contact.php'); ?>
<?php include('../app/view/footer.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php require('../app/view/frontend/template.php'); ?>
