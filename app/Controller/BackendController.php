<?php
//namespace Rilcy\Blog\App\Model;
//use \Rilcy\Blog\App\Model\General;

namespace App\Controller;

use App\Model\LoginManager;
use App\Model\PostManager;
use App\Model\CommentManager;
use App\Model\FormManager;


// Controller de la partie Admin.
class BackendController {


// Page administrateur    
    public function administre()
    {

        $hasEmail = isset($_POST['post_email']);
        $hasPseudo = isset($_POST['post_username']);

        if ($hasEmail && $hasPseudo) {
            $user = (new LoginManager())->admin();
         }
         header('Location: /blog/admin');
    }

    

    // Afficher     
    public function affich($id)
    {
        $post = (new PostManager())->affiche($id);
        
        include('../app/views/addPost.php');
    }


// Ajouter un post    
    public function insert($id)
    { 
        $hasTitle = isset($_POST['post_title']);
        $hasChapo = isset($_POST['post_content']);
        $hasContent = isset($_POST['post_contents']);
        $hasuser = isset($_POST['post_user_id']);
        
        if ($hasChapo && $hasTitle && $hasContent && $hasuser) {
           $post = (new PostManager())->insert($id);
        }
        header('Location: /blog'); 

    }


// Afficher un article    
    public function modif($id)
    {
        $post = (new PostManager())->find($id);

        include('../app/views/modifPost.php');
    }


// Modifier un article    
    public function update($id)
    {
        $hasTitle = isset($_POST['post_title']);
        $hasChapo = isset($_POST['post_content']);
        $hasContent = isset($_POST['post_contents']);
         
        if ($hasChapo && $hasTitle && $hasContent) {
            $post = (new PostManager())->update($id);
        }
        header('Location: /blog/');
    }



//Afficher    
  //  public function supp($id)
   // {
   //     $post = (new PostManager())->find($id);

            //include('../app/views/deletepost.php');
   // }


// Supprimer un article    
    public function delete($id)
{
    $hasTitle = isset($_POST['post_title']);
    $hasChapo = isset($_POST['post_content']);
    $hasContent = isset($_POST['post_contents']);
    
    if ($hasChapo && $hasTitle && $hasContent) {
        $post = (new PostManager())->delete($id);
    }
    header('Location: /blog/public/');
}


// Supprimer un commentaire    
    function supcom($id)
    {
        $comment = (new CommentManager())->del($id);

        include('../app/views/deleteCom.php');
    }


// Approuver commentaire    
    function approuvcom($approuve)
    {
        $comment = (new CommentManager())->approuv($approuve);

        include('../app/views/approuvCom.php');
    }


}