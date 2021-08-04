<?php
//namespace Rilcy\Blog\App\Model;

namespace App\Model;

abstract class Model {

    
     protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
        
        return $db;
    }
}


?>
