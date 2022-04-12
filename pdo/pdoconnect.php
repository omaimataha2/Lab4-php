<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);


$dsn = 'mysql:dbname=sakila;host=127.0.0.1;port=3306;';#port number
$user = 'root';
$password = '1234';

try {
    //code...

    $db = new PDO($dsn, $user, $password);
    var_dump($db);
    $table = "userData";

    $sql = "CREATE table IF NOT EXISTS $table(
    ID INT( 10 ) AUTO_INCREMENT PRIMARY KEY,
    
    username VARCHAR( 50 ) NOT NULL, 
    email VARCHAR( 250 ) NOT NULL,
    password VARCHAR( 100 ) NOT NULL, 
    image VARCHAR( 200 )  NOT NULL,
    room VARCHAR( 100 ) NOT NULL )";
    $db->exec($sql);
} catch (PDOException $e) {
    $e->getMessage();
}