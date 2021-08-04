
  <?php 
   session_start();
   $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');


   if(isset($_GET['id']) AND $_GET['id'] > 0) {
    $getid = intval($_GET['id']);
    $requser = $db->prepare('SELECT * FROM user4 WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
}
   $posts = $db->query('SELECT * FROM posts ORDER BY id DESC LIMIT 0,4');
   $post = $db->query('SELECT * FROM posts ORDER BY id DESC LIMIT 0,4');
   $content = $db->query('SELECT * FROM posts ORDER BY id DESC LIMIT 0,4');
   $user = $db->query('SELECT * FROM user4 WHERE username = ? email = ?');

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
      
      <div class="profil">
          <h2>Bonjour <?= $_SESSION["user"]["pseudo"] ?></h2>
          <p>Email : <?= $_SESSION["user"]["email"] ?></p>
      </div>
      <div class="auto">
          <h4>Il vous est désormais possible de laisser vos commentaires sous les articles.</h4> 
          
          <div class="com">
            
              <?php while($p = $posts->fetch()) { ?>
              <li><?= $p['id'] ?> : <b><?= $p['title'] ?></b><br /><?= $p['content'] ?><?php if($p['content']== 0) { ?> <br /> <a href="/blog/article/<?= $p['id'] ?>/">Ajouter</a><?php } ?> </li><br /><br />
              <?php } ?>
          </div>
          <div class="btnsup">
              <a href="http://localhost/blog/logout">Se déconnecter</a>
          </div>
      </div>




<?php include("../app/includes/footer.php"); ?>

  </body>
</html>
