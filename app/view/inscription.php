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
            header("Location: http://localhost/blog/public/profil");

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
