<?php
@session_start();

$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');



if(isset($_SESSION["user"])) {
  header("Location: ../app/views/profil.php");
  exit;
}

// On vérifie si le formulaire a été envoyé
if(!empty($_POST)) {

// On vérifie que tous les champs requis sont remplis
  if(isset($_POST["pseudo"], $_POST["email"], $_POST["password"])
      && !empty($_POST["pseudo"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
         
         // Patch XSS
          $pseudo = htmlspecialchars($_POST['pseudo']);
          $_SESSION["error"] = [];

          if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
              $_SESSION["error"][] = "<span style='color:red'>L'adresse email est incorrecte.</span>";
          } 

          //On va hasher le mot de passe
          $password = password_hash($_POST["password"], PASSWORD_DEFAULT);


          $reqpseudo = $db->prepare("SELECT * FROM users4 WHERE username = ?");
          $reqpseudo->execute(array($pseudo));
          $pseudoexist = $reqpseudo->rowCount();
          if($pseudoexist == 0) {

          } else {
              $error = "<span style='color:red'>Pseudo déjà utilisé.</span>";
          }


          $reqemail = $db->prepare("SELECT * FROM users4 WHERE email = ?");
          $reqemail->execute(array($email));
          $emailexist = $reqemail->rowCount();
          if($emailexist == 0) {

          } else {
              $error = "<span style='color:red'>Adresse email déjà utilisée.</span>";
          }


          // On enregistre en bdd
          $sql = "INSERT INTO users4 (username, email, password, roles) VALUES (:pseudo, :email, '$password', '[\"ROLE_USER\"]')";

          $query = $db->prepare($sql);
          $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
          $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
          $query->execute();

          // On récupère l'id du nouvel l'utilisateur
          $id = $db->lastInsertId();


          // On stock dans $_SESSION les données de l'utilisateur
          $_SESSION["user"] = [
              "id" => $id,
              "pseudo" => $pseudo,
              "email" => $_POST["email"],
              "roles" => ["ROLE_USER"]
          ];

          // On peut rediriger vers la page profil
          header("Location: ../app/views/profil.php");

                  } else {
                      $_SESSION["error"] = ["<span style='color:red'>Le formulaire est incomplet.</span>"];
                  }

          }


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
    <?php include("../app/includes/menu.php"); ?>
      
    
    <div class="present">
          <h2>Bonjour <?= $_SESSION["user"]["pseudo"] ?></h2>
          <p>Email : <?= $_SESSION["user"]["email"] ?> </p>    
          
      </div>

      <div class="droits">
          <h5><p>Vous avez la possibilité de : </p> </h5>         
      </div>
      <div class="ajout">
          <u><a href="<?=("/blog/addpost") ;?>">Ajouter un post</a></u><br />
      </div>

      <div class="articles">
        <p><u>Modifier ou supprimer un post : </u></p>
          <?php while($p = $posts->fetch()) { ?>
          <em><li><?= $p['id'] ?> : <b><?= $p['title'] ?></b><br /><?= $p['content'] ?><?php if($p['content']== 0) { ?> <br /> <a href="/blog/posts/<?= $post['id'];?>/update">Modifier</a><?php } ?> - <a href="/blog/posts/<?= $post['id'];?>/delete">Supprimer</a></li></em><br />
          <?php } ?>                                                                                                                                                                                                                                                                                                                                
      </div>

      <div class="verif">
          <p><u>Approuver ou supprimer les commentaires laissés par les utilisateurs : </u></p>
         <?php while($c = $comments->fetch()) { ?>
          <em><li><?= $c['id'] ?> : <br /><?= $c['comment'] ?><?php if($c['approuve'] == 0) { ?>  <a href="/blog/approuve/<?= $c['id'] ?>/">Approuver</a><?php } ?> - <a href="/blog/deletecom/<?= $c['id'] ?>/">Supprimer</a></li></em><br />
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



    <?php include("../app/includes/footer.php"); ?>
  </body>
</html>
