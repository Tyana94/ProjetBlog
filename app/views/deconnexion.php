<?php
session_start();
if(!isset($_SESSION["user"])) {
    header("Location: /blog/login");
    exit;
}
// Supprime une variable
unset($_SESSION["user"]);
header("Location: /blog/");  
