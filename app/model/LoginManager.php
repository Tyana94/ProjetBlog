<?php
//namespace Rilcy\Blog\App\Model;
//require_once("../app/Model/Model.php");
namespace App\Model;



// Requêtes pour identification (connexion, inscription, deconnexion...)
class LoginManager extends Model

{    

    public function all()
    {  
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, user_id, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 2');
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        
        return $result;
    }


// Inscription
    public function register()
    {
        $db = $this->dbConnect();
     
        $post_username = htmlspecialchars($_POST['post_username']);
        $post_email = htmlspecialchars($_POST['post_email']);
        $post_password = htmlspecialchars($_POST['post_password']);
        
        $register = $db->prepare("INSERT INTO users4 (username, email, password, roles) VALUES (:pseudo, :email, :password, '[\"ROLE_USER\"]')") ;
        $register->execute(array($post_username, $post_email, $post_password));
        
    } 


// Connexion
    public function connect()
    {
        $db = $this->dbConnect();

        $post_email = htmlspecialchars($_POST['post_email']);
        $post_password = htmlspecialchars($_POST['post_password']);
        
        // On se connecte à la bdd
        $connect = $db->prepare("SELECT * FROM users4 WHERE email = ? password = ?");
        $connect->execute(array($post_email, $post_password));

    }
        
       





















    




// Deconnexion
    public function deconnect()
    {
        $db = $this->dbConnect();
        if(!isset($_SESSION["user"])) {
        header("Location: /blog/login");
         exit;
        }
        // Supprime une variable
        unset($_SESSION["user"]);
         header("Location: /blog/");
    }
    

// Accès page utilisateur
     public function utilisateur()
    {
        $db = $this->dbConnect();

           $posts = $db->query('SELECT * FROM posts ORDER BY id DESC LIMIT 0,4');
           $post = $db->query('SELECT * FROM posts ORDER BY id DESC LIMIT 0,4');
           $content = $db->query('SELECT * FROM posts ORDER BY id DESC LIMIT 0,4');
           $user = $db->query('SELECT * FROM user4 WHERE id = ? username = ? email = ?');





           
    }


// Accès page administrateur
     public function admin()
    {
        $db = $this->dbConnect();
  
        $post_username = htmlspecialchars($_POST['post_username']);
        $post_email = htmlspecialchars($_POST['post_email']);
          $comments = $db->query('SELECT * FROM comments ORDER BY id DESC LIMIT 0,5');
          $posts = $db->query('SELECT * FROM posts ORDER BY id DESC LIMIT 0,5');    
          $user = $db->query('SELECT * FROM user4 WHERE id = ? username = ? email = ?');
           
        return ;
    } 

    //$hasEmail = isset($_POST['post_email']);
    //$hasPseudo = isset($_POST['post_username']);
}