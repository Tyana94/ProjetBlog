<?php
// On démarre la session php
@session_start();
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');


$mode_edition = 0;

        if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
            $mode_edition = 1;
            $edit_id = htmlspecialchars($_GET['edit']);
            $edit_post = $db->prepare('SELECT * FROM posts WHERE id = ?');
            $edit_post->execute(array($edit_id));

            if($edit_post->rowCount() ==1) {

                $edit_post = $edit_post->fetch();

            } else {
                die('Erreur : l\'article n\'existe pas.');
            }
        }

        if(isset($_POST['post_title'], $_POST['post_content'], $_POST['post_contents'], $_POST['post_user_id'])) {
            if(!empty($_POST['post_title']) AND !empty($_POST['post_content']) AND !empty($_POST['post_contents']) AND !empty($_POST['post_user_id'])){
                $post_title = htmlspecialchars($_POST['post_title']);
                $post_content = htmlspecialchars($_POST['post_content']);
                $post_contents = htmlspecialchars($_POST['post_contents']);
                $post_user_id = htmlspecialchars($_POST['post_user_id']);

                if($mode_edition == 1) {
                    $update = $db->prepare('UPDATE posts SET title = ?, content = ?, contents = ?, user_id = ?, edition_date = NOW() WHERE id = ?');
                    $update->execute(array($post_title, $post_content, $post_contents, $post_user_id, $edit_id));
                    $message ="<span style='color:green'>Votre article a bien été mis à jour</span>";
                }

                } else {
                    $message = "<span style='color:red'>Veuillez remplir tous les champs</span>";
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
        <link href="/blog/public/css/style.css" rel="stylesheet" type="text/css"   />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
<body>
<?php include("../app/includes/menu.php"); ?>
  <p><a href="/blog/">Retour à la liste des posts</a></p>
  
  <div class="modif_post" align="center">
    <h2>Modifier le post</h2><br />
    <form class="edit_post" method="POST" action="/blog/posts/<?= $post['id'];?>/update">
        <p>Titre : </p>
        <input type="text" name="post_title" placeholder="Titre" value="<?= strip_tags($post['title']) ?>" /><br />
        <p>Chapo : </p>
        <textarea name="post_content" placeholder="Chapo"><?= strip_tags($post['content'])  ?></textarea><br />
        <p>Contenu du post : </p>
        <textarea rows="5" cols="50" name="post_contents" placeholder="Contenu de l'article"><?= $post['contents'] ?></textarea><br />
        <p>Identifiant du rédacteur : </p>
        <textarea name="post_user_id" placeholder="Identifiant"><?= $post['user_id'] ?></textarea><br />
        <input type="submit" value="Envoyer l'article" />
    </form>
  </div>
    <br />
    <?php if(isset($message)) { echo $message; } ?>
    <br /><br /><br />
    <?php include("../app/includes/footer.php"); ?>
</body>
</html>
