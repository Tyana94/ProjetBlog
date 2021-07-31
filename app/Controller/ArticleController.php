<?php

namespace App\Controller;

use App\Model\Post;

class ArticleController {
    

    function show($id)
    {
        $post = (new Post())->find($id);

        include('../app/views/article.php');
    }


    function addpost($post_title, $post_content, $post_contents, $post_user_id)
    {
        $post = (new Post())->ajout($_POST['post_title'], $_POST['post_content'], $_POST['post_contents'], $_POST['post_user_id']);

        include('../app/views/addpost.php');
    }



    function modif($post_title, $post_content, $post_contents, $post_user_id, $edit_id)
    {
        $post = (new Post())->modif($_POST['post_title'], $_POST['post_content'], $_POST['post_contents'], $_POST['post_user_id']);

        include('../app/views/modifPost.php');
    }


    function editpost($edit_id)
    {
        $post = (new Post())->edit($edit_id);

        include('../.php');
    }


    function supp($id)
    {
        $post = (new Post())->delete($id);

        include('../app/views/deletePost.php');
    }


    





}