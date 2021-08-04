<?php
@session_start();

$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');


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
                        if($_SESSION["roles"] === $_SESSION["ROLE_ADMIN"]) {
                        // On peut rediriger vers la page profil
                                header("Location: /blog/admin");
                            }
                            if($_SESSION["roles"] === $_SESSION["ROLE_USER"]) {
                                header("Location: /blog/user");
                            }
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
<?php include("../app/includes/menu.php"); ?>
       <div class="connex" align="center">
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
          <form method="POST" action="/blog/user">
            <table>
            <tr>
                <td align="right"><br />
                <label for="email">Votre e-mail : </label>
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
                <input type="submit" name="connexion" value="Connexion" />
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
      <?php include("../app/includes/footer.php"); ?>
  </body>
</html>
