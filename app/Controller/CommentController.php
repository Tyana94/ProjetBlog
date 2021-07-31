<?php

namespace App\Controller;

use App\Model\Comment;

class CommentController {


    function afficher($id)
    {
        $post = (new Post())->allForArticle($id);

        include('../app/views/article.php');
    }


    function addcom($user_id,$comment,$getid,$comment_date)
    {
        $post = (new Post())->add($user_id,$comment,$getid,$comment_date);

        include('../app/views/addComment.php');
    }


    function supcom($suppr_id)
    {
        $post = (new Post())->delete($suppr_id);

        include('../app/views/deleteCom.php');
    }


    function approuvcom($approuve)
    {
        $post = (new Post())->approuv($approuve);

        include('../app/views/approuvCom.php');
    }


}
