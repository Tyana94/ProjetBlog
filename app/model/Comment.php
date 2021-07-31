<?php

namespace App\Model;


class Comment extends Model{
    

    function allForArticle($id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, user_id, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($id));

        return $comments;
    }

    function add($user_id,$comment,$getid,$comment_date)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(user_id, comment, post_id, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($user_id,$comment,$getid,$comment_date));

        return $affectedLines;
    }


    function delete($suppr_id)
    {
        $db = $this->dbConnect();
        $suppr = $db->prepare('DELETE FROM comments WHERE id = ?');
        $suppr->execute(array($suppr_id));

        return $affectedLines;
    }


    function approuv($approuve)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET approuve = 1 WHERE id = ?');
        $req->execute(array($approuve));

        return $affectedLines;
    }

}

    
?>
