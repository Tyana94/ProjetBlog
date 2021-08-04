<?php
//namespace Rilcy\Blog\App\Model;
//require_once("../app/Model/Model.php");
namespace App\Model;

use App\Model\Post;
use App\Model\Author;


// Requêtes pour les articles
class PostManager extends Model {


// Afficher article
    public function find($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, contents, user_id, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($id));
        $post = $req->fetch();

        return $post;
    }


// Afficher 
    public function affiche($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, contents, user_id, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        //$req->execute(array());
        $post = $req->fetch();

        return $post;
    }


// Ajouter un article    
    public function insert($id)
    {   
        $db = $this->dbConnect();
        
        $post_title = htmlspecialchars($_POST['post_title']);
        $post_content = htmlspecialchars($_POST['post_content']);
        $post_contents = htmlspecialchars($_POST['post_contents']);
        $post_user_id = htmlspecialchars($_POST['post_user_id']);

        $insert = $db->prepare('INSERT INTO posts (title, content, contents, user_id, creation_date) VALUES (?,?,?,?, NOW())');
        $insert->execute(array($post_title, $post_content, $post_contents, $post_user_id));
        $message ="<span style='color:green'>Votre article a bien été posté</span>";
    
    }
       
    












    
// Modifier article
    public function update($id)
    {
        $db = $this->dbConnect();

        $post_title = htmlspecialchars($_POST['post_title']);
        $post_content = htmlspecialchars($_POST['post_content']);
        $post_contents = htmlspecialchars($_POST['post_contents']);
        $post_user_id = htmlspecialchars($_POST['post_user_id']);
   
        $update = $db->prepare('UPDATE posts SET title = ?, content = ?, contents = ?, user_id = ?, edition_date = NOW() WHERE id = ?');    
        $update->execute(array($post_title, $post_content, $post_contents, $post_user_id, $id));
        $message ="<span style='color:green'>Votre article a bien été mis à jour</span>";
            
    }


    public function delete($id)
    {
        $db = $this->dbConnect();

        $post_title = htmlspecialchars($_POST['post_title']);
        $post_content = htmlspecialchars($_POST['post_content']);
        $post_contents = htmlspecialchars($_POST['post_contents']);
        $post_user_id = htmlspecialchars($_POST['post_user_id']);
        $suppr_id = htmlspecialchars($_GET['id']);
        $suppr = $db->prepare('DELETE FROM posts WHERE title = ? content = ? contents = ? user_id = ?');
        $suppr->execute(array($post_title, $post_content, $post_contents, $post_user_id, $id));
        
        
    }


}
