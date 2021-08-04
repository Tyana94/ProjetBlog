<?php
//namespace Rilcy\Blog\App\Model;
//use \Rilcy\Blog\App\Model\General;

namespace App\Controller;

use App\Model\LoginManager;
use App\Model\PostManager;
use App\Model\CommentManager;
use App\Model\FormManager;

// Controller de l'espace utilisateur.

class AccountController {


// Page utilisateur    
    public function profil()
    {

       $user = (new LoginManager())->utilisateur();

        include('../app/views/profil.php');

    }


// Ajouter commentaire
    public function addcom($id)
    {
        $commentmodel = (new CommentManager())->add($id);

        include('../app/views/addComment.php');
    }







}