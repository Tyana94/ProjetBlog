<?php
//namespace Rilcy\Blog\App\Model;
//require_once("../app/Model/Model.php");
namespace App\Model;

use App\Model\LoginManager;
use App\Model\PostManager;
use App\Model\CommentManager;


// Requêtes pour les articles
class CommentManager extends Model {


    public function allForArticle($id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, user_id, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($id));

        return $comments;
    }


// Ajouter commentaire
    public function add($id)
    {
        $db = $this->dbConnect();

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
                    $c_msg = "<span style='color:red'>Tous les champs doivent être renseignés.</span>";
                }
            }
            $comments = $db->prepare('SELECT * FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
            $comments->execute(array($getid));
        }

        return ;
    }


// Supprimer article
    public function del($id)
    {
        $db = $this->dbConnect();
        if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {  
            $suppr_id = htmlspecialchars($_GET['supprime']);
            $suppr = $db->prepare('DELETE FROM comments WHERE id = ?');
            $suppr->execute(array($suppr_id));
            header("Location: http://localhost/blog/public/admin");
          }

        return ;
    }


// Approuver commentaire    
    public function approuv()
    {
        $db = $this->dbConnect();
        if(isset($_GET['approuve']) AND !empty($_GET['approuve'])) {
            $approuve = (int)_GET['approuve'];
          
            $req = $db->prepare('UPDATE comments SET approuve = 1 WHERE id = ?');
            $req->execute(array($approuve));

        return ;
        }

    }

}