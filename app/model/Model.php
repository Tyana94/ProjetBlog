<?php

namespace App\Model;

abstract class Model {

    function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
        return $db;
    }
}


?>
