<?php


$dsn = 'mysql:dbname=sakila;host=127.0.0.1;port=3306;'; #port number
$user = 'root';
$password = '1234';

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

try{

    $db= new PDO($dsn, $user, $password);
    var_dump($db);

}catch (Exception $e){
    echo $e->getMessage();
}