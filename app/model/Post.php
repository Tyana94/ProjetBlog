<?php

namespace App\Model;

class Post extends Model{
    function all()
    {

        $db = $this->dbConnect();

        $req = $db->query('SELECT id, title, content, user_id, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 2');
      $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    function get($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, contents, user_id, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    function delete()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE id, title, content, user_id, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

}


?>
