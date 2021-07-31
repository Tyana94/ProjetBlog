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

    function find($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, contents, user_id, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($id));
        $post = $req->fetch();

        return $post;
    }

    function delete($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $req->execute(array($id));
        $post = $req->fetch();

        return $post;
    }


    function ajout($post_title, $post_content, $post_contents, $post_user_id)
    {
        $db = $this->dbConnect();
        $ins = $db->prepare('INSERT INTO posts (title, content, contents, user_id, creation_date) VALUES (?,?,?,?, NOW())');
        $ins->execute(array($post_title, $post_content, $post_contents, $post_user_id));

        return $affectedLines;
    }

    
    function modif($post_title, $post_content, $post_contents, $post_user_id, $edit_id)
    {
        $db = $this->dbConnect();
        $update = $db->prepare('UPDATE posts SET title = ?, content = ?, contents = ?, user_id = ?, edition_date = NOW() WHERE id = ?');
        $update->execute(array($post_title, $post_content, $post_contents, $post_user_id, $edit_id));

    }


    function edit($id)
    {
        $db = $this->dbConnect();
        $edit_post = $db->prepare('SELECT * FROM posts WHERE id = ?');
        $edit_post->execute(array($edit_id));
        $edit_post = $edit_post->fetch();

        return $post;

    }

}


?>


