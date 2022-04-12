<?php

require "pdo/pdoconnect.php";

$user_id = $_GET["email"];
try{
var_dump($user_id);
    $db=connectToDatabase();
    var_dump($db);
    if($db){
        $select_query = 'select * from student where id=:id';
        $select_stmt = $db->prepare($select_query);
        $select_stmt->bindParam(":id",$user_id );

        $res=$select_stmt->execute();
        if ($res){
            $users = $select_stmt->fetchAll(PDO::FETCH_OBJ);
  
            var_dump($users[0]);
        }
    }

}catch (PDOException $e){
    echo $e->getMessage();
}
