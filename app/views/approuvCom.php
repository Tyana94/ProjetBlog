<?php
@session_start();
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');


if(isset($_GET['approuve']) AND !empty($_GET['approuve'])) {
  $approuve = (int)_GET['approuve'];

  $req = $db->prepare('UPDATE comments SET approuve = 1 WHERE id = ?');
  $req->execute(array($approuve));
}

// Alors affiche le commentaire  sous le bon post