<?php ob_start(); ?>


<?php $title = 'Mon blog'; ?>

<!-- <Menu -->
<?php include("../app/includes/menu.php"); ?>

<!--banniere ----------------------------------------->
<?php include("../app/includes/banniere.php"); ?>

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
                Vous souhaitez en savoir plus sur mon parcours professionnel et personnel, n'hésitez pas à consulter mon <a class="nav-link" href="public/cv/cv_developpeuse_php.pdf"><b>Curriculum Vitae</b></a>
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
  //echo '<a href="articles/' . $post['id'] . '/">' . $post['title'] . '</a><br>';
?>

    <div class="news">
        <h4>
            <?= htmlspecialchars($post['title']) ?>
        </h4>

        <p>
            <em>le <?= $post['creation_date_fr'] ?></em><br />
            <?= nl2br(htmlspecialchars($post['content'])) ?>
            <br />
            <em><?= '<a href="article/' . $post['id'] . '/">Lire la suite</a>' ?></em>
        </p>
    </div>
<?php
} 
?>
<?php include('../app/views/contact.php'); ?>

<?php include('../app/includes/footer.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php require('../app/includes/template.php'); ?>
