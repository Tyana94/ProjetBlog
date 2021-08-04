<?php
// On démarre la session php
@session_start();
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {  
    $suppr_id = htmlspecialchars($_GET['supprime']);
    $suppr = $db->prepare('DELETE FROM comments WHERE id = ?');
    $suppr->execute(array($id));
    header("Location: /blog/public/admin");
  }
