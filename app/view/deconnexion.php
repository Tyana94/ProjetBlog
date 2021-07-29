<?php
session_start();
if(!isset($_SESSION["user"])) {
    header("Location: http://localhost/blog/public/login");
    exit;
}
// Supprime une variable
unset($_SESSION["user"]);
header("Location: http://localhost/blog/public/");
