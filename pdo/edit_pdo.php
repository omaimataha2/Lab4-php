<?php
require "pdoconnect.php";
function update_user($id, $data, $img = "")
{
    try{
        $dsn = 'mysql:dbname=sakila;host=127.0.0.1;port=3306;';#port number
        $user = 'root';
        $password = '1234';
            $db = new PDO($dsn, $user, $password);
        if($db){
            if(isset($img) && $img != ""){
                $update_query = 'update student set `username`=:username,`email`=:email,`password`=:password where `id`='.$id;
            } else {
                $update_query = 'update student set `username`=:username,`email`=:email,`password`=:password where `id`='.$id;
            }
         
            $data = explode(":",$data);
  
            echo "<pre>";
            print_r($data);
            echo "</pre>";
            // exi  t();
            $update_stmt = $db->prepare($update_query);

            $update_stmt->bindParam(":username",$data[0] );
            $update_stmt->bindParam(":email",$data[1] );
            $update_stmt->bindParam(":password",$data[3] );
           


            $res=$update_stmt->execute();
            if ($res){
                return true;
            }
        }
    return false;
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}