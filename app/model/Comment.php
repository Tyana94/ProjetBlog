<?php

namespace App\Model;


class Comment extends Model{

    function allForArticle($getid)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, user_id, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($getid));
        /*$comments = $db->prepare('SELECT * FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($getid));*/

        return $comments;
    }

    function add($user_id, $comment, $getid)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(user_id, comment, post_id, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($user_id, $comment, $getid, $comment_date));

        return $affectedLines;
    }

}

?>
