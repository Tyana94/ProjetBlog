<?php
namespace App\Controller;

use App\Model\LoginManager;
use App\Model\PostManager;
use App\Model\CommentManager;
use App\Model\FormManager;

// Controller de la partie public du blog.

class FrontendController {

// Page d'accueil
    public function home()
    {
        $posts = (new LoginManager())->all();

        include('../app/views/home.php');
    }


// Connexion GET
    public function login()
    {
        $post = (new LoginManager())->all();

        include('../app/views/connexion.php');

    }

    // Connexion POST
    public function connect()
{
        $hasEmail = isset($_POST['post_email']);
        $hasPassword = isset($_POST['post_password']);

        if ($hasEmail && $hasPassword) {
            $post = (new LoginManager())->connect();
         }
         // On peut rediriger vers la page profil
         if($_SESSION["roles"] === $_SESSION["ROLE_ADMIN"]) {
                        
            header("Location: blog/admin");
        }
        if($_SESSION["roles"] === $_SESSION["ROLE_USER"]) {
            header("Location: /blog/user");
        } 

}













// Inscription GET   
    public function inscription()
    {
        $posts = (new LoginManager())->all();

        include('../app/views/inscription.php');
        
    }

// Inscription POST    
    public function inscrit()
    {
    
        $hasUsername = isset($_POST['post_username']);
        $hasEmail = isset($_POST['post_email']);
        $hasPassword = isset($_POST['post_password']);
        
        if ($hasUsername && $hasEmail && $hasPassword) {
           $post = (new LoginManager())->register();
        }
        header('Location: /blog/login'); 

    }



// Afficher article 
    public function show($id)
    {
        $post = (new PostManager())->find($id);

        include('../app/views/article.php');
    }    

// Afficher commentaire
    public function afficher($id)
    {
        $loginmanager = (new LoginManager())->allForArticle($id);

        include('../app/views/article.php');
    }


// Page 404
    public function lost()
    {
        $posts = (new LoginManager())->all();

        include('../app/views/404.php');
    } 
    
    
// Déconnexion
    public function logout()
    {  
        $loginmanager = (new LoginManager())->deconnect();

     include('../app/views/deconnexion.php');

    }  
    
    
// Formulaire de contact GET
    public function contact()
    {
        $loginmanager = (new FormManager())->all();
      
    include('../app/views/contact.php');

    }


    // Formulaire de contact POST
    public function contacter()
    {  
    $hasNom = isset($_POST['post_nom']);
    $hasPrenom = isset($_POST['post_prenom']);
    $hasEmail = isset($_POST['post_email']);
    $hasMessage = isset($_POST['post_message']);
    
    if ($hasNom && $hasPrenom && $hasEmail && $hasMessage) {
       $post = (new FormManager())->contacter();
    }
    header('Location: /blog/'); 


    }



}