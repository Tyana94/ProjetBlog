
<?php
// On démarre la session php
@session_start();
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

if(isset($_GET['id']) AND !empty($_GET['id'])) {
    $suppr_id = htmlspecialchars($_GET['id']);
    $suppr = $db->prepare('DELETE FROM posts WHERE id = ?');
    $suppr->execute(array($id));

    header('Location: /blog/admin');
}
?>

