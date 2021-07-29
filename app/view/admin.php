<?php
  @session_start();
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

$comments = $db->query('SELECT * FROM comments ORDER BY id DESC LIMIT 0,5');
$posts = $db->query('SELECT * FROM posts ORDER BY id DESC LIMIT 0,5');
?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta http-equiv="cache-control" content="max-age=0" />
      <meta http-equiv="cache-control" content="no-cache" />
      <meta http-equiv="expires" content="0" />
      <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
      <meta http-equiv="pragma" content="no-cache" />
      <title><?= $title ?></title>
      <link href="../public/css/style.css" rel="stylesheet" type="text/css"   />
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <?php include("../app/view/menu.php"); ?>
      <div class="present">
          <h2>Bonjour <?= $_SESSION["user"]["pseudo"] ?></h2>
          <p>Email : <?= $_SESSION["user"]["email"] ?></p>
      </div>

      <div class="droits">
          <p>Vous avez la possibilité de : </p>
          <div class="btnadd">
              <a href="<?=("http://localhost/blog/public/addarticle") ;?>">Ajouter un post</a><br />
          </div>
      </div>

      <div class="articles">
        <p>Modifier ou supprimer un post : </p>
          <?php while($p = $posts->fetch()) { ?>
          <li><?= $p['id'] ?> : <?= $p['title'] ?><?= $p['content'] ?><?php if($p['content']== 0) { ?>  <a href="../app/view/modifPost.php?edit=<?= $p['id'] ?>">Modifier</a><?php } ?> - <a href="http://localhost/blog/public?supcom=<?= $p['id'] ?>">Supprimer</a></li>
          <?php } ?>
      </div>

      <div class="verif">
          <p>Vérifier des commentaires laissés par les utilisateurs : </p>
         <?php while($c = $comments->fetch()) { ?>
          <li><?= $c['id'] ?> : <?= $c['comment'] ?><?php if($c['confirme'] == 0) { ?>  <a href="http://localhost/blog/public?confirme=<?= $c['id'] ?>">Confirmer</a><?php } ?> - <a href="http://localhost/blog/public?supcom=<?= $c['id'] ?>">Supprimer</a></li>
          <?php } ?>
      </div>

      <div class="deconnect">
          <a href="http://localhost/blog/public/sedeconnecter">Se déconnecter</a>
      </div>




    <?php if(isset($c_msg)) { echo $c_msg; } ?>
    <br />
    <?php while($c = $comments->fetch()) { ?>


    <p><strong><?php echo htmlspecialchars($c['user_id']); ?></strong> le <?php echo $c['comment_date'] ?>; </p>
    <p><?php echo nl2br(htmlspecialchars($c['comment'])); ?></p>

    <?php } ?>



    <?php include("../app/view/footer.php"); ?>
  </body>
</html>
