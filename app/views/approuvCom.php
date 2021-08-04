<?php
@session_start();
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');


if(isset($_GET['approuve']) AND !empty($_GET['approuve'])) {
  $approuve = (int)_GET['approuve'];

  $req = $db->prepare('UPDATE comments SET approuve = 1 WHERE id = $id');
  $req->execute(array($approuve));
  echo "Commentaire validé !";
  header("Location: /blog/admin");
}

// Alors affiche le commentaire  sous le bon post

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
      <link href="public/css/style.css" rel="stylesheet" type="text/css"   />
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <?php include("../app/includes/menu.php"); ?>
      
    
      <div class="verif">
          <p><u>Approuver ou supprimer les commentaires laissés par les utilisateurs : </u></p>
         <?php while($c = $comments->fetch()) { ?>
          <em><li><?= $c['id'] ?> : <br /><?= $c['comment'] ?><?php if($c['approuve'] == 0) { ?>  <a href="/blog/approuve/<?= $c['id'] ?>/">Approuver</a><?php } ?> - <a href="/blog/deletecom/<?= $c['id'] ?>/">Supprimer</a></li></em><br />
          <?php } ?>                                                                                        
      </div>





    <?php if(isset($c_msg)) { echo $c_msg; } ?>
    <br />
    <?php while($c = $comments->fetch()) { ?>


    <p><strong><?php echo htmlspecialchars($c['user_id']); ?></strong> le <?php echo $c['comment_date'] ?>; </p>
    <p><?php echo nl2br(htmlspecialchars($c['comment'])); ?></p>

    <?php } ?>



    <?php include("../app/includes/footer.php"); ?>
  </body>
</html>