<?php
@session_start();
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');



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
          <form method="POST" action="/blog/login">
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
      <?php include("../app/includes/footer.php"); ?>
  </body>
</html>
