<?php
$url = '';
if(isset($_GET['url'])) {
    $url = $_GET['url'];
}

if($url == '') {
    require '../app/view/frontend/listPostsView.php';
} elseif(preg_match('#post#', $url, $params)) {
    $post['id'] = $params[1];
    require '../app/view/frontend/postView.php';
} else {
    require '../app/view/404.php';
}








<?php
// On démarre la session php
session_start();
require("../vendor/autoload.php");
/*require('../app/controller/Frontend.php');*/
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
$controller = new \App\Controller\Frontend();


$url = '';
if(isset($_GET['url'])) {
    $url = $_GET['url'];
}

if($url == '') {
    require '../app/view/frontend/listPostsView.php';                  // Affichage liste des articles -----------> KO KO


} elseif(preg_match('#post-([0-9]+)#', $url, $params)) {              // Affichage un article -----------> KO
    $post['id'] = $params[1];
    require '../app/view/frontend/postView.php';


} elseif(preg_match('#inscription#', $url, $params)) {              // Inscription -----------> OK
    require '../app/view/inscription.php';

} elseif(preg_match('#login#', $url, $params)) {                   // Connexion    -----------> OK
    require '../app/view/connexion.php';
}

elseif(preg_match('#sedeconnecter#', $url, $params)) {                // Deconnexion  -----------> OK
    require '../app/view/deconnexion.php';
}

elseif(preg_match('#addarticle#', $url, $params)) {                 // Ajouter un post -----------> OK
    require '../app/view/addPost.php';
}

else {
    require '../app/view/404.php';
}




$url = '';
if(isset($_GET['url'])) {
    $url = $_GET['url'];
}

if($url == '') {
    require '../app/view/frontend/listPostsView.php';                  // Affichage liste des articles -----------> KO KO

elseif(preg_match('#modifpost#', $url, $params)) {                 // Modifier un post  ----------->
    require '../app/view/modifPost.php';
}

elseif(preg_match('#suppost#', $url, $params)) {                 // Supprimer un post  ----------->
    require '../app/view/deletePost.php';
}

elseif(preg_match('#addcom#', $url, $params)) {                  // Ajouter un commentaire  ----------->
    require '../app/view/addComment.php';
}



elseif(preg_match('#profil#', $url, $params)) {                   // Profil
    require '../app/view/profil.php';
}


elseif(preg_match('#admin#', $url, $params)) {                   // Admin
    require '../app/view/admin.php';
}



else {
    require '../app/view/404.php';
}
