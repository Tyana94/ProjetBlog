<?php
// On démarre la session php
//session_start();
require("../vendor/autoload.php");
$router = new AltoRouter();
$router->setBasePath('blog/');


//== page d'accueil ============================================  OK
$router->map('GET','/', function() {                          
    $controller = new \App\Controller\Frontend();
    $controller->home();   
}, 'home');


//== afficher un article ============================================  OK
$router->map('GET','/articles/[i:id]/', function($id) {        
    $controller = new \App\Controller\ArticleController();
    $controller->show($id);
}, 'article');


//== ajouter un article ============================================  KO
$router->map('GET','/addpost', function($post_title, $post_content, $post_contents, $post_user_id) {            
    $controller = new \App\Controller\ArticleController();
    $controller->addpost($_POST['post_title'], $_POST['post_content'], $_POST['post_contents'], $_POST['post_user_id']);   
}, 'addpost');


//== modifier un article ============================================  KO
$router->map('GET','/modifPost/[i:id]/', function($post_title, $post_content, $post_contents, $post_user_id, $edit_id) {        
    $controller = new \App\Controller\ArticleController();
    $controller->modif($_POST['post_title'], $_POST['post_content'], $_POST['post_contents'], $_POST['post_user_id']);
}, 'modifier');


//== éditer un article ============================================
$router->map( 'GET', '/editpost/[i:id]/', function($edit_id) {
    $controller = new \App\Controller\ArticleController();
    $controller->editpost($edit_id);
}, 'edition');


//== supprimer un article ============================================  KO
$router->map('POST','/deletePost/[i:id]/', function ($id) {
    $controller = new \App\Controller\ArticleController();
    $controller->supp($id);
} , 'supprime'); 






//== afficher commentaires ============================================  
$router->map('GET','/commentaires/[i:id]/', function($id) {        
    $controller = new \App\Controller\CommentController();
    $controller->afficher($id);
}, 'commentaire');


//== ajouter un commentaire ============================================  
$router->map('GET','/addcom/[i:id]/', function($user_id,$comment,$getid,$comment_date) {        
    $controller = new \App\Controller\CommentController();
    $controller->addcom($user_id,$comment,$getid,$comment_date);
}, 'ajout');


//== supprimer un commentaire ============================================  
$router->map('GET','/deletecom/[i:id]/', function($suppr_id) {        
    $controller = new \App\Controller\CommentController();
    $controller->supcom($suppr_id);
}, 'supprimecom');


//== approuver un commentaire ============================================  
$router->map('GET','/approuve/[i:id]/', function($approuve) {        
    $controller = new \App\Controller\CommentController();
    $controller->approuvcom($approuve);
}, 'approuve');








//== inscription ============================================  KO
$router->map('GET','/inscription', function() {                      
    $controller = new \App\Controller\Frontend();
    $controller->inscription();   
}, 'inscription');


//== connexion ============================================  KO
$router->map('GET','/login', function() {                          
    $controller = new \App\Controller\Frontend();
    $controller->login();   
}, 'login');


//== deconnexion ============================================  KO
$router->map('GET','/logout', function() {                         
    $controller = new \App\Controller\Frontend();
    $controller->logout();   
}, 'logout');



//== contact ============================================  OK
$router->map('GET','/contact', function() {                          
    $controller = new \App\Controller\Frontend();
    $controller->contact();   
}, 'contact');


//== profil ============================================  OK
$router->map('GET','/user', function() {                          
    $controller = new \App\Controller\Frontend();
    $controller->profil();   
}, 'profil');

//== admin ============================================  OK
$router->map('GET','/admin', function() {                          
    $controller = new \App\Controller\Frontend();
    $controller->admin();   
}, 'admin');







# call closure or throw 404 status CALL CLOSURE OR THROW 404 STATUS         Page 404  ------------->  OK
$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
    # NO ROUTE WAS WATCHED
    $controller = new \App\Controller\Frontend();
    $controller->lost();
}





