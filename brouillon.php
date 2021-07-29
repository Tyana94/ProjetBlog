














































 CONNEXION
 <?php
// On démarre la session php
session_start();
if(isset($_SESSION["user"])) {
    header("Location: profil.php");
    exit;
}

$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

// On vérifie si le formulaire a été envoyé
if(!empty($_POST)) {

  // On vérifie que tous les champs requis sont remplis
    if(isset($_POST["email"], $_POST["password"])
        && !empty($_POST["email"]) && !empty($_POST["password"])) {

          $_SESSION["error"] = [];
          // On vérifie que c'est bien un email
          if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
              $_SESSION["error"][] = "Ce n'est pas un email";
        }

        if($_SESSION["error"] === []) {

            // On se connecte à la bdd
            $sql = "SELECT * FROM users4 WHERE email = :email";
            $query = $db->prepare($sql);
            $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
            $query->execute();
            $user = $query->fetch();

            if(!$user) {
                $_SESSION["error"][] ="L'utilisateur et/ou le mot de passe est incorrect";
            }

            // Ci dessous user existant, on peut vérifier son mot de passe
            if(!password_verify($_POST["password"], $user["password"])) {
                $_SESSION["error"][] ="L'utilisateur et/ou le mot de passe est incorrect";
         }
             if($_SESSION["error"] === []) {
                // On stock dans $_SESSION les données de l'utilisateur
                $_SESSION["user"] = [
                "id" => $user["id"],
                "pseudo" => $user["username"],
                "email" => $user["email"],
                "roles" => $user["roles"]
            ];

                // On peut rediriger vers la page profil
                header("Location: admin.php");
            }
        }
    }
}
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

      <div align="center">
          <h2>Connexion</h2>
          <?php
            if(isset($_SESSION["error"])) {
                foreach($_SESSION["error"] as $message) {
                    ?>
                    <p><?= $message ?></p>
                    <?php
                }
                unset($_SESSION["error"]);
            }
          ?>
          <br /><br />
          <form method="POST" action="">
                <div>
                    <label for="email">Email :</label>
                    <input type="email" placeholder="email" id="email" name="email" />
                </div>
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" placeholder="Mot de passe" id="password" name="password" />
                </div>
                <button type="submit">Connexion</button>
          </form>

          <?php
          if(isset($error))
          {
              echo $error;
          }
          ?>
      </div>
      <?php include("footer.php"); ?>
  </body>
</html>







ROUTER
<?php

require_once "router.php";

route('/', function () {
    return "Hello World";
});

route('/about', function () {
    return "Hello form the about route";
});

$action = $_SERVER['REQUEST_URI'];
dispatch($action);
?>




index.php

<?php
require("vendor/autoload.php");
require './elements/header.php';
?>

<h1>Bienvenue sur mon site</h1>

<?php require './elements/footer.php'; ?>




OK OK OK OK -> btn pour afficher masquer un bouton
    <?php
    if(isset($_SESSION['ROLE_ADMIN']))
    { ?>
        <div class="row">
               <a href="modifPost.php?edit=<?= $post['id'] ?>">Modifier</a> |
               <a href="deletePost.php?id=<?= $post['id'] ?>">Supprimer</a>
        </div>
    <?php } ?>



Pour la connexion et redirection sur p admin ou profil
<?php
    if($_SESSION["ROLE_ADMIN"]) {

                // On peut rediriger vers la page profil
                header("Location: admin.php");
            }  else {
                header("Location: profil.php");
            }
            http://localhost/blog/public/admin
?>



MODIFIER ET SUPPRIMER UN Post{ ?>
  <?php
  //if(isset($_SESSION['ROLE_ADMIN']))
  //if($_SESSION["user"] = ["ROLE_ADMIN"])
    <div class="row">
           <a href="../app/view/modifPost.php?edit=<?= $post['id'] ?>">Modifier</a> |
           <a href="../app/view/deletePost.php?id=<?= $post['id'] ?>">Supprimer</a>
    </div>
<?php } ?>





Bouton pour afficher "Ajout Post"
<button type="button" class="btn btn-primary"><a href="<?=("addPost.php") ;?>">Ajouter un post</a></button>




INSCRIPTION
<?php
@session_start();
if(isset($_SESSION["user"])) {
    header("Location: profil.php");
    exit;
}
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

// On vérifie si le formulaire a été envoyé
if(!empty($_POST)) {

  // On vérifie que tous les champs requis sont remplis
    if(isset($_POST["pseudo"], $_POST["email"], $_POST["password"])
        && !empty($_POST["pseudo"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
           // Le formulaire est complet
           // On récupère les donneés en les protégeant
           // Patch XSS
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $_SESSION["error"] = [];

            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $_SESSION["error"][] = "L'adresse email est incorrecte";
            }

            //On va hasher le mot de passe
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);


            // Ajoutez ici tous les contrôles souhaités, comme pseudo unique, adresse mail unique
            $reqpseudo = $db->prepare("SELECT * FROM users4 WHERE username = ?");
            $reqpseudo->execute(array($pseudo));
            $pseudoexist = $reqpseudo->rowCount();
            if($pseudoexist == 0) {

            } else {
                $error = "Pseudo déjà utilisé !";
            }


            $reqemail = $db->prepare("SELECT * FROM users4 WHERE email = ?");
            $reqemail->execute(array($email));
            $emailexist = $reqemail->rowCount();
            if($emailexist == 0) {

            } else {
                $error = "Adresse mail déjà utilisée !";
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
            header("Location: profil.php");

                    } else {
                        $_SESSION["error"] = ["Le formulaire est incomplet"];
                    }

            }
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
        <div class="inscrip" align="center">
            <h2>Inscription</h2>
            <?php
              if(isset($_SESSION["error"])) {
                  foreach($_SESSION["error"] as $message) {
                    ?>
                    <p><?= $message ?></p>
                    <?php
                }
                unset($_SESSION["error"]);
              }
          ?>
          <br /><br />
          <form method="POST" action="">
            <table>
            <tr>
                <td align="right"><br />
                <label for="pseudo">Pseudo :</label>
                </td>
                <td>
                <input type="text" id="pseudo" name="mailconnect" />
                </td>
            </tr>
            <tr>
                <td align="right"><br />
                <label for="email">Email : </label>
                </td>
                <td>
                <input type="email" id="email" name="email" />
                </td>
            </tr>
            <tr>
                <td align="right"><br />
                <label for="password">Mot de passe : </label>
                </td>
                <td>
                <input type="password" id="password" name="password" />
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                <br /><br />
                <input type="submit" name="formconnexion" value="Inscription" />
                </td>
            </tr>
            </table>
          </form>

          <?php
          if(isset($error))
          {
              echo $error;
          }
          ?>
      </div>
      <?php include("../app/view/footer.php"); ?>
  </body>
</html>






Ancien index.php
//<?php
// On démarre la session php
//session_start();
//require("vendor/autoload.php");
  /*require('app/controller/Frontend.php');*/
//$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
//$controller = new \App\Controller\Frontend();

//try {
    //if (isset($_GET['action'])) {

        //if ($_GET['action'] == 'listPosts') {
         //   $controller->index();
       // }

        //elseif ($_GET['action'] == 'post') {
         //   if (isset($_GET['id']) && $_GET['id'] > 0) {
               // $controller->add();
           // } else {
             //   throw new Exception('Article non envoyé');
           // }
       // }

        //elseif ($_GET['action'] == 'addComment') {
        //  if(isset($_GET['id']) AND !empty($_GET['id'])) {
        //    $getid = htmlspecialchars($_GET['id']);
          //  $controller->add($_GET['id'], $_POST['user_id'], $_POST['comment']);
     //     } else {
       //       throw new Exception('Article non envoyé');
         // }

           // if(isset($_post['addComment'])) {
      //          if(isset($_POST['user_id'],$_POST['comment']) AND !empty($_POST['user_id']) AND !empty($_POST['comment'])
        //            ) { $c_msg = "<span style='color:green'>Votre commentaire a bien été posté</span>";

          //        } else {
       //               throw new Exception('Tous les champs doivent être renseignés !');
         //         }
           //   }

             //       $user_id = htmlspecialchars($_POST['user_id']);
               //     $comment = htmlspecialchars($_POST['comment']);
                 //   if(strlen($user_id) < 30) {
                   //   $ins = $db->prepare('INSERT INTO comments(user_id, comment, post_id) VALUES (?,?,?)');
          //            $ins->execute(array($user_id,$comment,$getid));
            //          $c_msg = "<span style='color:green'>Votre commentaire a bien été posté</span>";

           //       } else {
             //         throw new Exception('Le pseudo doit faire moins de 30 caractères');
               //   }
        //        }
          //      }
        //        else {
          //        $controller->index();
    //            }
      //      }
  //    catch(Exception $e) {
    //      echo 'Erreur : ' . $e->getMessage();
     // }
