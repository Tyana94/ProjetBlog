<?php
@session_start();
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');    

if(isset($_GET['id']) AND !empty($_GET['id'])) {
    $getid = htmlspecialchars($_GET['id']);

    $post = $db->prepare('SELECT * FROM posts WHERE id = ?');
    $post->execute(array($id));
    $post = $post->fetch();

    if(isset($_post['submit_comment'])) {
        if(isset($_POST['user_id'],$_POST['comment']) AND !empty($_POST['user_id']) AND !empty($_POST['comment'])
            ) {
            $user_id = htmlspecialchars($_POST['user_id']);
            $comment = htmlspecialchars($_POST['comment']);


            if(strlen($user_id) < 30) {

                $ins = $db->prepare('INSERT INTO comments(user_id, comment, post_id, comment_date) VALUES (?,?,?,NOW())');
                $ins->execute(array($user_id,$comment,$getid,$comment_date));
                $c_msg = "<span style='color:green'>Votre commentaire a été soumis pour validation. Il sera traité dans les meilleurs délais.</span>";
                }
            } else {
            $c_msg = "Erreur: Tous les champs doivent être renseignés";
        }
    }
    $comments = $db->prepare('SELECT * FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
    $comments->execute(array($getid));
}

?>
 
 <?php include("../app/includes/menu.php"); ?>
        <h5>Ajouter un commentaire :</h5>
        <div class="add_comment">
            <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                <div class="addcom">
                    <label for="user_id">Identifiant</label><br />
                    <input type="text" id="user_id" name="user_id" />
                </div>
                <div class="addcom">
                    <label for="comment">Votre commentaire</label><br />
                    <textarea rows="2" cols="50" id="comment" name="comment"></textarea>
                </div><br />

            </form>
        </div>


        <?php
        
        if(isset($_SESSION['id']) AND $_SESSION['USER'] == 1) {
        ?>
                <div>
                    <input type="submit" value="Poster commentaire" name="submit_comment" />
                </div>
            <?php } ?>

            <input type="submit" value="Poster commentaire" name="submit_comment" />

            <?php
        if(isset($_SESSION['id']) AND $_SESSION['approuve'] == 1) { ?>    
            <?php if(isset($c_msg)) { echo $c_msg; } ?>
        <br />
        <?php while($c = $comments->fetch()) { ?>
        <p><strong><?php echo htmlspecialchars($c['user_id']); ?></strong> le <?php echo $c['comment_date'] ?>; </p>
        <p><?php echo nl2br(htmlspecialchars($c['comment'])); ?></p>
        <?php } ?>

        <?php
        }
        ?>

       