<?php
@session_start();
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');



if(isset($_GET['approuve']) AND !empty($_GET['approuve'])) {
  $approuve = (int)_GET['approuve'];

  $req = $db->prepare('UPDATE comments SET approuve = 1 WHERE id = ?');
  $req->execute(array($approuve));
}

if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
  $supprime = (int)_GET['supprime'];

  $req = $db->prepare('DELETE FROM comments WHERE id = ?');
  $req->execute(array($supprime));
  header("Location: http://localhost/blog/admin");
}

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
      <link href="public/css/style.css" rel="stylesheet" type="text/css"   />
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <?php include("../app/views/menu.php"); ?>
      <div class="present">
          <h2>Bonjour <?= $_SESSION["user"]["pseudo"] ?></h2>
          <p>Email : <?= $_SESSION["user"]["email"] ?></p>
      </div>

      <div class="droits">
          <p>Vous avez la possibilité de : </p>          
      </div>
      <div class="ajout">
          <a href="<?=("http://localhost/blog/addpost") ;?>">Ajouter un post</a><br />
      </div>

      <div class="articles">
        <p>Modifier ou supprimer un post : </p>
          <?php while($p = $posts->fetch()) { ?>
          <em><li><?= $p['id'] ?> : <?= $p['title'] ?><br /><?= $p['content'] ?><?php if($p['content']== 0) { ?> <br /> <a href="../app/views/modifPost.php?edit=<?= $p['id'] ?>">Modifier</a><?php } ?> - <a href="../app/views/deletePost.php<?= $p['id'] ?>">Supprimer</a></li></em><br />
          <?php } ?>
      </div>

      <div class="verif">
          <p>Approuver ou supprimer les commentaires laissés par les utilisateurs : </p>
         <?php while($c = $comments->fetch()) { ?>
          <em><li><?= $c['id'] ?> : <br /><?= $c['comment'] ?><?php if($c['approuve'] == 0) { ?>  <a href="../app/views/approuvCom.php<?= $c['id'] ?>">Approuver</a><?php } ?> - <a href="'../app/views/deleteCom.php<?= $c['id'] ?>">Supprimer</a></li></em><br />
          <?php } ?>
      </div>

      <div class="deconnect">
          <a href="http://localhost/blog/logout">Se déconnecter</a>
      </div>




    <?php if(isset($c_msg)) { echo $c_msg; } ?>
    <br />
    <?php while($c = $comments->fetch()) { ?>


    <p><strong><?php echo htmlspecialchars($c['user_id']); ?></strong> le <?php echo $c['comment_date'] ?>; </p>
    <p><?php echo nl2br(htmlspecialchars($c['comment'])); ?></p>

    <?php } ?>



    <?php include("../app/views/footer.php"); ?>
  </body>
</html>
