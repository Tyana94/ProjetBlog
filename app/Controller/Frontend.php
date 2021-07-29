<?php

namespace App\Controller;

/*require('app/model/Model.php');
require('app/model/Post.php');
require('app/model/Comment.php');
*/
class Frontend {

    function index()
    {

        $modelPost = new \App\Model\Post();
        $posts = $modelPost->all();

        require('http://localhost/blog/public/');

    }

    function add()
    {
        $modelPost = new \App\Model\Post();
        $post = $modelPost->get($_GET['id']);
        $modelComment = new \App\Model\Comment();
        $comments = $modelComment->allForArticle($_GET['id']);

        require('../app/view/frontend/postView.php');
    }

    function addtwo($getid, $user_id, $comment)
    {
        $modelComment = new \App\Model\Comment();
        $affectedLines = $modelComment->add($getid, $user_id, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: ../public/index.php?action=post&id=' . $getid);
        }
    }
  }
