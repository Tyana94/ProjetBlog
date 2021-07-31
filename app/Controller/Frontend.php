<?php

namespace App\Controller;

use App\Model\Post;

class Frontend {

    function home()
    {
        $model = new Post();
        $posts = $model->all();

        include('../app/views/home.php');
    }


    function lost()
    {
        $model = new Post();
        $posts = $model->all();

        include('../app/views/404.php');
    }


    function inscription()
    {
        $model = new Post();
        $posts = $model->all();

        include('../app/views/inscription.php');

    }


    function login()
    {
        $model = new Post();
        $posts = $model->all();

        include('../app/views/connexion.php');

    }


    //function logout()
    //{
    //    $model = new Post();
    //    $posts = $model->all();

    //    include('../app/views/deconnexion.php');

   // }



    function contact()
    {
        $model = new Post();
        $posts = $model->all();

        include('../app/views/contact.php');
    }


    function profil()
    {
        $model = new Post();
        $posts = $model->all();

        include('../app/views/profil.php');
    }


    function admin()
    {
        $model = new Post();
        $posts = $model->all();

        include('../app/views/admin.php');
    }

  }
