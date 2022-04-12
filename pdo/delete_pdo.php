<?php

require "pdoconnect.php";

$user_id = $_GET["id"];
try{

    $dsn = 'mysql:dbname=sakila;host=127.0.0.1;port=3306;';#port number
    $user = 'root';
    $password = '1234';
        $db = new PDO($dsn, $user, $password);
    var_dump($db);
    if($db){
        $delete_query = 'delete from student where `id` =:stdid';
        $del_stmt = $db->prepare($delete_query);
        $del_stmt->bindParam(":stdid",$user_id );
        $res=$del_stmt->execute();
        if ($res){
            header("Location:viewTable.php");
        }

    }

}catch (PDOException $e){
    echo $e->getMessage();
}
